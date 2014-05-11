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

if( !isset( $params['uniqueid'] ) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_insufficientparams'));
    return;
  }

// get user details
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

// now display a form to allow the user to change his info
// set some smarty stuff
$smarty->assign( $userinfo );
$smarty->assign('formstart',
		      $this->CreateFrontendFormStart($id,$returnid,'do_usersettings'));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('prompt_username',$this->Lang('username'));
$smarty->assign('submitbtn',$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('username', $this->CreateInputText($id, 'username', $userinfo['username'], 30, 150 ));
$smarty->assign('formhidden',
		      $this->CreateInputHidden( $id, 'uniqueid', $params['uniqueid'] ));
$tmparray = array();


// get all of the lists that this user is eligble for and also indicate
// the membership.
$q = "SELECT A.listid, A.name, A.description, B.userid, B.active 
        FROM ".NMS_LIST_TABLE." A LEFT OUTER 
        JOIN ".NMS_LISTUSER_TABLE." B 
          ON A.listid = B.listid AND B.userid = ?
       WHERE A.public = ?";
$dbresult = $db->GetArray( $q, array( $userinfo['userid'], 1 ) );

if( !$dbresult || !count($dbresult) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_dberror'));
    return;
  }

foreach( $dbresult as $row )
  {
    $extratext = '';
    if( $row['userid'] != null )
      {
	$extratext = 'checked="checked"';
      }
    $temparray[] = "<label>" . 
      $this->CreateInputCheckbox($id, "lists[]",$row['listid'],"",$extratext).
      $row['name'] . " - " . $row['description'] . "</label>";
  }
$smarty->assign('listids',$temparray);
echo $this->ProcessTemplateFromDatabase('usersettings_form2');

?>
