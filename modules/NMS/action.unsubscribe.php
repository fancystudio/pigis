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

  // this code will permanently delete a user (using the specified uniqueid) 
  // from the subscription database
  // it's kinda dangerous todo though as there's no confirmation
  // and somebody could theoretically delete all of the subscriptions with just
  // some funky scanning

if( !isset( $params['uniqueid'] ) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_insufficientparams'));
    return;
  }

$db = &$this->GetDb();

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

// delete membership from all public lists
// NOTE: could probably be done with one sql query
$query = "SELECT A.listid FROM ".NMS_LIST_TABLE." A, ".
  NMS_LISTUSER_TABLE." B WHERE A.listid = B.listid AND A.public = 1 
  AND B.userid = ?";
$q2 = "DELETE FROM ".NMS_LISTUSER_TABLE." WHERE userid = ? AND listid = ?";
$publiclists = $db->GetArray($query,array($userinfo['userid']));
if( !is_array($publiclists) ) {
  echo $db->ErrorMsg();
  return;
 }
foreach( $publiclists as $row )
{
  $dbresult2 = $db->Execute( $q2, array( $userinfo['userid'], $row['listid'] ));
}

$parms = array( 'userid' => $userinfo['userid'], 'email'=>$userinfo['email'] );
$this->SendEvent('OnUnsubscribe',$parms);

$this->Audit($userinfo['userid'],$this->GetName(),$userinfo['email'].' Unsubscribed from public lists');

if( $this->GetPreference('unsubscribe_deletes',0) )
  {
    // check if the user is still in any lists (even private ones)
    $query = 'SELECT count(listid) AS count FROM '.NMS_LISTUSER_TABLE.' 
               WHERE userid = ?';
    $tmp = $db->GetOne($query,array($userinfo['userid']));

    if( !$tmp )
      {
	$query = 'DELETE FROM '.NMS_USER_DATA_TABLE.'
                   WHERE userid = ?';
	$db->Execute($query,array($userinfo['userid']));

	$query = 'DELETE FROM '.NMS_USERS_TABLE.'
                   WHERE userid = ?';
	$db->Execute($query,array($userinfo['userid']));

	// send an event.
	$parms = array( 'id' => $params['userid'] );
	$this->SendEvent('OnDeleteUser',$parms);

	$this->Audit($userinfo['id'],$this->GetName(),$userinfo['email'].' deleted');
      }
  }

echo $this->ProcessTemplateFromDatabase('post_unsubscribe_text');
?>