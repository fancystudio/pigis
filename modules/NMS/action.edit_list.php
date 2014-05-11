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
if (!$this->CheckPermission('Manage NMS Lists'))
    {
      $this->_DisplayErrorPage($id, $params, $returnid, 
			       $this->Lang('accessdenied'));
      return;
    }

$db = &$this->GetDb();

$smarty->assign('title', $this->Lang('editlist_text'));
$smarty->assign('prompt_name', $this->Lang('name'));
$smarty->assign('prompt_description', $this->Lang('description'));
$smarty->assign('prompt_public', $this->Lang('prompt_public'));
$smarty->assign('startform', $this->CreateFormStart($id, 'save_old', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit',
							 $this->Lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel',
							 $this->Lang('cancel')));

if (isset( $params['error'] ) && $params['error'] != ''){
	$smarty->assign('error', $params['error']);
 }
if (isset( $params['message'] ) && $params['message'] != ''){
	$smarty->assign('message', $params['message']);
 }
$query = "SELECT * FROM ".NMS_LIST_TABLE." WHERE listid = ? ORDER BY listid";
$dbresult = $db->Execute($query, array($params['listid']));	

if ($dbresult && $dbresult->RecordCount() > 0){
	while ($row = $dbresult->FetchRow()){
		$smarty->assign('name', $this->CreateInputText($id, 'name',$row['name'],40));
		$smarty->assign('listid', $this->CreateInputHidden($id, 'listid', $params['listid']));
		$smarty->assign('public',$this->CreateInputCheckbox($id,'public',1,$row['public']));
		$smarty->assign('description', $this->CreateInputText($id, 'description', $row['description'], 55));
	}
 }

// Display the populated template
echo $this->ProcessTemplate('createnew.tpl');
?>
