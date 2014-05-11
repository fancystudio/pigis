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
if (!$this->CheckPermission('Manage NMS Users'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

if( isset($params['cancel']) )
  {
    $this->RedirectToTab( $id, 'users' );
    return;
  }

if( !isset( $params['email'] ) || $params['email'] == '' )
  {
    $params['message'] = $this->Lang('error_invalidemail');
    $params['error'] = 1;
    $this->Redirect( $id, 'create_new_user', $returnid, $params );
    return;
  }
if( !isset( $params['bounces'] ) || 
    (int)$params['bounces'] < 0 || (int)$params['bounces'] > 100 )
  {
    $params['message'] = $this->Lang('error_invalidbounces');
    $params['error'] = 1;
    $this->Redirect( $id, 'create_new_user', $returnid, $params );
    return;
  }
if( !isset( $params['uniqueid'] ) )
  {
    $params['message'] = $this->Lang('error_insufficientparams');
    $params['error'] = 1;
    $this->Redirect( $id, 'create_new_user', $returnid, $params );
    return;
  }

$error = '';
if (!is_email($params['email']) )
  {
    $params['message'] = $this->Lang('error_invalidemail')." 2 ";
    $params['error'] = 1;
    $this->Redirect( $id, 'create_new_user', $returnid, $params );
    return;
  }

// make sure the email isn't currently used
$query = "SELECT email FROM ".NMS_USERS_TABLE." WHERE 
                 email = ? AND uniqueid != ?";
$dbresult = $db->Execute($query,array( $params['email'], $params['uniqueid'] ));
    
if ($dbresult && $dbresult->RecordCount() > 0)
  {
    $params['message'] = $this->Lang('error_emailexists');
    $params['error'] = 1;
    $this->Redirect( $id, 'edit_user', $returnid, $params );
    return;
  }

$disabled = 0;
if( isset( $params['disabled'] ) && $params['disabled'] != '' )
  {
    $disabled = $params['disabled'];
  }

$error_count = 0;
if( isset($params['error_count']) )
  {
    $error_count = (int)$params['error_count'];
    $error_count = max(0,$error_count);
  }

// and update the record
$query = "UPDATE ".NMS_USERS_TABLE." SET email = ?, disabled = ?, username = ?, bounce_count = ?, error_count = ? WHERE uniqueid = ?";
$dbresult = $db->Execute($query,array( $params['email'], $disabled, 
				       $params['username'], 
				       $params['bounces'],
				       $error_count,
				       $params['uniqueid'] ));
if( !$dbresult )
  {
    echo $db->sql."<br/>";
    echo $db->ErrorMsg();
    return;
  }
    
// get user id
$query = "SELECT * FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
$dbresult = $db->Execute($query, array( $params['uniqueid']) );
    
if ($dbresult && $dbresult->RecordCount() > 0)
  {
    $row = $dbresult->FetchRow();
    $userid = $row['userid'];
    $listNames = "";
	
    // delete all the existing list memberships
    $query = "DELETE FROM ".NMS_LISTUSER_TABLE." WHERE userid = ?";
    $dbresult = $db->Execute( $query, array($row['userid']) );
    if( !$dbresult )
      {
	$params['message'] = 'ERROR deleting existing membershiips: '.$db->ErrorMsg();
	$params['error'] = 1;
	$this->Redirect( $id, 'create_new_user', $returnid, $params );
	return;
      }

    // and set in the new ones
    if( isset( $params['lists'] ) )
      {
	foreach ($params['lists'] as $listid )
	  {
	    $query = "INSERT INTO ".NMS_LISTUSER_TABLE."
	       (userid, listid, active, entered) VALUES (?,?,?,?)";
	    $dbresult = $db->Execute( $query, 
				      array( $row['userid'], $listid, 1, 
					     trim($db->DBTimeStamp(time()),"'")));
	  }
      }

    // send an event
    $parms = array();
    $parms['username'] = $row['username'];
    $parms['email'] = $row['email'];
    $parms['id'] = $row['userid'];
    $parms['lists'] = $params['lists'];
    $this->SendEvent( 'OnEditUser', $parms );
  }
 else
   {
     $params['message'] = 'ERROR finding user: '.$db->ErrorMsg();
     $params['error'] = 1;
     $this->Redirect( $id, 'create_new_user', $returnid, $params );
     return;
   }

$this->RedirectToTab($id, 'users');

#
# EOF
#
?>