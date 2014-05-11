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
if (!$this->CheckPermission('Manage NMS Users')) {
	$this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
	return;
    }
	

// check to make sure FEU is installed and the required table exists, 
// return if not
$feu =& $this->GetModuleInstance('FrontEndUsers');
if( !$feu ) {
	$this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('import_feu_feunotinstalled'));
	return;
} 

// get the lists
$lists = array();
$q = "SELECT * FROM ".NMS_LIST_TABLE;
$dbresult = $db->Execute( $q );
if( $dbresult && $dbresult->RecordCount() > 0 ) {
  while( $row = $dbresult->FetchRow() ) {
    $lists[$row['name']." (list ID = ".$row['listid'].")"] = $row['listid'];
  }
}


// Get all of the groups in FEU
// that have email address properties
// or all groups if feu is set to use email address as username
$emailgroups = array();
$username_is_email = $feu->GetPreference('username_is_email',0);
{
  $props  = $feu->GetPropertyDefns();
  $groups = $feu->GetGroupListFull();
  foreach( $groups as $onegroup ) {
    $is_goodgroup = false;
    if( $username_is_email )
      {
	$is_goodgroup = true;
      }
    else
      {
	$proprelns = $feu->GetGroupPropertyRelations($onegroup['id']);
	foreach( $proprelns as $onereln )
	  {
	    // find out if this property is an email type
	    $is_email = false;
	    foreach( $props as $oneprop )
	      {
		if( $oneprop['name'] == $onereln['name'] &&
		    $oneprop['type'] == 2 ) {
		  $is_email = true;
		  break;
		}
	      }
	    
	    if( $is_email == true ) {
	      $is_goodgroup = true;
	      break;
	    }
	  }
      }

    if( $is_goodgroup == true ) {
      $emailgroups[$onegroup['groupname'].' - '.$onegroup['groupdesc']] = $onegroup['id'];
    }
  }
}

// display a page that will enable admin to import users from the FEU tables
$smarty->assign('startform', 
				$this->CreateFormStart($id, 
									   'do_feu_import_users', $returnid ));
$smarty->assign('title',$this->Lang('import_feu_title'));
$smarty->assign('import_feu_info',$this->Lang('import_feu_info'));

$smarty->assign('prompt_groupname',$this->Lang('import_feu_prompt_groupname'));
$smarty->assign('input_groupname',
				$this->CreateInputDropdown($id,'groupid',$emailgroups));

$yesno = array( $this->Lang('yes') => 1,
				$this->Lang('no') => 0 );
$smarty->assign('flag_username_is_email',$username_is_email);
$smarty->assign('prompt_copyusername',
				$this->Lang('import_feu_prompt_copyusername'));
$smarty->assign('input_copyusername',
				$this->CreateInputDropdown($id,'copyusername', $yesno, 0 ));
$smarty->assign('info_copyusername',
				$this->Lang('import_feu_info_copyusername'));

$smarty->assign('prompt_list',
				$this->Lang('import_feu_selectlists'));
$smarty->assign('input_list',
				$this->CreateInputDropdown($id,'listid',$lists));

$smarty->assign('submit',
				$this->CreateInputSubmit($id,'submit',$this->Lang('submit')));
$smarty->assign('cancel',
				$this->CreateInputSubmit($id,'cancel',$this->Lang('cancel')));
$smarty->assign('endform',$this->CreateFormEnd());

echo $this->ProcessTemplate('feu_import.tpl');
?>