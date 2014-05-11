<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: Newsletter Made Simple (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide a flexible
#  mailing list solution.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE
if( !isset($gCms) ) exit;

{
  // this action is called from the admin or the frontend when the subscribe 
  // form is completed.
  $action = 'default';
  $confirmed = ($this->GetPreference('require_confirmation',1)==1)?0:1;
  $send_email = ($confirmed==0)?1:2;
  $admin = false;
  $newuser = 1;

  if($returnid=='')
    {
      // we're an admin
      $action = 'create_new_user';
      $confirmed=1;
      $admin = true;
      $params['cg_activetab'] = 'users';
      $this->SetCurrentTab('users');
    }

  if( $admin && isset($params['cancel']) )
    {
      $this->RedirectToTab($id);
      return;
    }

  if( !isset( $params['email'] ) || $params['email'] == '' )
    {
      $params['message'] = $this->Lang('error_invalidemail');
      $params['error'] = 1;
      $this->Redirect( $id, $action, $returnid, $params, !$admin );
      return;
    }
  if( !isset($params['lists']) || count($params['lists']) == 0 )
    {
      $params['message'] = $this->Lang('error_selectonelist');
      $params['error'] = 1;
      $this->Redirect( $id, $action, $returnid, $params, !$admin );
      return;
    }

  $error = '';
  if (!is_email($params['email']) )
    {
      $params['message'] = $this->Lang('error_invalidemail');
      $params['error'] = 1;
      $this->Redirect( $id, $action, $returnid, $params, !$admin );
      return;
    }

  $uniqueid = md5(uniqid(rand(),1));
  $db = &$this->GetDb();

  # Set the values for the fields in the record
  $record = array(); 
  $record["email"] = trim($params['email']);
  $record["username"] = trim($params['username']);
  $record["uniqueid"] = $uniqueid;
  $record["disabled"] = (isset($params['disabled'])) ? $params['disabled'] : 0;
  $record["confirmed"] = $confirmed;
  $record["htmlemail"] = 1;
  $record["dateadded"] = trim($db->DBTimeStamp(time()),"'");
    
  $query = "SELECT userid,email,uniqueid FROM ".NMS_USERS_TABLE." WHERE email = ?";
  $row = $db->GetRow($query,array($record['email']));
  $userid = '';
  if ( $row )
    {
      // email already exists
      $userid = $row['userid'];
      $uniqueid = $row['uniqueid'];
      $newuser = 0;

      // update the lists he's a member of
      foreach ($params['lists'] as $listid){
	$query = 'SELECT userid FROM '.NMS_LISTUSER_TABLE.' 
                   WHERE listid = ? AND userid = ?';
	$num = $db->GetOne($query,array($listid,$userid));
	if( !$num )
	  {
	    $record = array();
	    $record["userid"] = $userid;
	    $record["listid"] = $listid;
	    $record["active"] = 1;
	    $record["entered"] = trim($db->DBTimeStamp(time()),"'");
	
	    $query = "INSERT INTO ".NMS_LISTUSER_TABLE." 
                        (userid, listid, active, entered) VALUES (?,?,?,?)";
	    $db->Execute($query, $record); 	
	  }
      }
    }
  else
    {
      // insert the user
      $query = "INSERT INTO ".NMS_USERS_TABLE." (email, username, uniqueid, disabled, confirmed, htmlemail, dateadded) VALUES (?,?,?,?,?,?,?)";
      $dbresult = $db->Execute($query, $record); 
      if( !$dbresult ) 
	{
	  echo $db->ErrorMsg();
	  return;
	}
    
      // get user id back from the table
      $query = "SELECT userid FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
      $dbresult = $db->Execute($query,array($uniqueid));
      
      if ($dbresult && $dbresult->RecordCount() > 0)
	{
	  $row = $dbresult->FetchRow();
	  $userid = $row['userid'];
	}
	  
      // add him to his member lists
      foreach ($params['lists'] as $listid){
	// add to list/user table
	$record = array();
	$record["userid"] = $userid;
	$record["listid"] = $listid;
	$record["active"] = 1;
	$record["entered"] = trim($db->DBTimeStamp(time()),"'");
	
	$query = "INSERT INTO ".NMS_LISTUSER_TABLE." 
                        (userid, listid, active, entered) VALUES (?,?,?,?)";
	$dbresult = $db->Execute($query, $record); 	
      }
    }
	
  $pref = $this->GetPreference('email_user_on_admin_subscribe',0);
  $pref = ($pref == false ) ? 0 : $pref;
  $disabled = isset($params['disabled']) ? $params['disabled'] : 0;
  if( $admin )
    {
      if( $pref == 0 || $disabled == 0 )
	{
	  $send_email = 0;
	}
    }

  $this->Audit('',$this->Getname(),trim($params['email']).' subscribed to one or more lists');

  // Send an event
  {
    $parms = array();
    $parms['email'] = trim($params['email']);
    $parms['username'] = trim($params['username']);
    $parms['lists'] = $params['lists'];
    $this->SendEvent('OnNewUser',$parms);
  }

  // ***************send Confirm e-mail
  if( $send_email == 1)
    {
      // get the names of the lists matching the listid's
      $listnames = array();
      $q = "SELECT * FROM ".NMS_LIST_TABLE." WHERE listid = ?";
      foreach( $params['lists'] as $listid )
	{
	  $dbresult = $db->Execute( $q, array($listid) );
	  if( $dbresult && $dbresult->RecordCount() )
	    {
	      $row = $dbresult->FetchRow();
	      $listnames[] = $row['name'];
	    }
	}
      
      $mailer =& $this->GetModuleInstance('CMSMailer');
      $mailer->reset();
      $mailer->SetSubject($this->GetPreference('confirm_subject'));
      
      $smarty->assign('lists', $listnames );
      $smarty->assign('email', trim($params['email']));
      $smarty->assign('username', trim($params['username']));
      $smarty->assign('unsubscribe',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'unsubscribe',
								      $this->Lang('unsubscribe'))));
      $smarty->assign('unsubscribeurl',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'unsubscribe',
								      $this->Lang('unsubscribe'), array(), '', true)));
      $smarty->assign('preferences',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'preferences',
								      $this->Lang('preferences'))));
      $smarty->assign('preferencesurl',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'preferences',
								      $this->Lang('preferences'), array(), '', true)));
      
      $smarty->assign('confirm',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'confirm_email',
								      $this->Lang('confirm'), 
								      array('uniqueid' => $uniqueid))));
      $smarty->assign('confirmurl',
			    $this->_cleanLink(
					      $this->_CreatePrettyLink($id,$returnid,'confirm_email',
								      $this->Lang('confirm'), 
								      array('uniqueid' => $uniqueid), '', true)));
      $bodytext = $this->ProcessTemplateFromDatabase('subscribe_email_body');
      $mailer->SetBody($bodytext);
      $mailer->AddAddress($params['email']);
      $mailer->SetCharSet($this->GetPreference('message_charset'));
      $mailer->SetFromName($this->GetPreference('admin_name'));
      $mailer->SetFrom($this->GetPreference('admin_email'));
      $mailer->Send();
    }
  else if( $send_email == 2 )
    {
      // this user was automatically confirmed, and the admin didn't do it
      // so we should probably just send the thank you message.
      $parms = array();
      $parms['uniqueid'] = $uniqueid;
      $this->Redirect($id,'confirm_email',$returnid,$parms);
    }

  if( $admin )
    {
      $this->RedirectToTab($id);
    }
  else
    {
      echo $this->GetPreference('subscribe_posttext');
    }
}
?>