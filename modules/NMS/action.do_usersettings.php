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
if( !isset( $params['uniqueid'] ) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_insufficientparams'));
    return;
  }

$query = "SELECT * FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
$record["uniqueid"] = $params['uniqueid'];
$dbresult = $db->Execute($query, $record);
if( !$dbresult || ($dbresult->RecordCount() == 0) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_invalidid'));
    return;
  }
$userinfo = $dbresult->FetchRow();
if( $userinfo['disabled'] != 0 )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_accountdisabled'));
    return;
  }

// set some smarty stuff
$smarty->assign( $userinfo );

// update the username, and any membership info
$q = "UPDATE ".NMS_USERS_TABLE." SET username = ? 
       WHERE uniqueid = ?";
$dbresult = $db->Execute( $q, array( $params['username'], $params['uniqueid'] ));
if( !$dbresult )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $db->ErrorMsg()."<br/>".$this->Lang('error_dberror'));
    return;
  }

// convert the lists array into a flat array
$newlists = array();
if( isset($params['lists']) )
{
  foreach( $params['lists'] as $newelem )
  {
    $newlists[] = $newelem[0];
  }
}

// get an array of all publicly subscribed lists for this user
$currlists = array();
$q = "SELECT A.listid FROM ".NMS_LISTUSER_TABLE." A,".
      NMS_LIST_TABLE." B
      WHERE public = ? AND userid = ? AND A.listid = B.listid";
$dbresult = $db->GetArray( $q, array( 1, $userinfo['userid'] ) );
foreach( $dbresult as $row )
  {
    $currlists[] = $row['listid'];
  }


// and which lists to delete user from
$dellists = array_diff( $currlists, $newlists );

// now find out which lists to add user to
$addlists = array_diff( $newlists, $currlists );

// Do the deleting
if( count($dellists) )
  {
    $q = "DELETE FROM ".NMS_LISTUSER_TABLE."
       WHERE userid = ? AND listid IN (".implode(", ",$dellists).")";
    $db->Execute( $q, array( $userinfo['userid'] ) );
  }

// Do the adding
if( count($addlists) )
  {
    $now = $db->DbTimeStamp(time());
    $q = "INSERT INTO ".NMS_LISTUSER_TABLE."
           (userid,listid,active,entered)
           VALUES (?,?,1,$now)";
    foreach( $addlists as $add )
      {
	$db->Execute( $q, array( $userinfo['userid'], $add ));
      }
  }

$this->Audit('',$this->Getname(),trim($params['email']).' edited his information.');

// Send an event
$parms = array();
$parms['username'] = $params['username'];
$parms['email'] = $userinfo['email'];
$parms['id'] = $userinfo['userid'];
$parms['lists'] = array_merge( $newlists, $currlists );
$this->SendEvent( 'OnEditUser', $parms );

// get ready to output something
$smarty->assign('username',$params['username'] );
$smarty->assign('email',$userinfo['email'] );
echo $this->ProcessTemplateFromDatabase('usersettings_text2');

?>
