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

$smarty->assign('title', $this->Lang('createnewlist_text'));
$smarty->assign('prompt_name', $this->Lang('name'));
$smarty->assign('prompt_description', $this->Lang('description'));
$smarty->assign('prompt_public', $this->Lang('prompt_public'));
$smarty->assign('startform',$this->CreateFormStart($id, 'save_new', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());
$smarty->assign('submit',  $this->CreateInputSubmit($id, 'submit',
				 $this->Lang('submit')));
$smarty->assign('cancel',  $this->CreateInputSubmit($id, 'cancel',
				 $this->Lang('cancel')));
$smarty->assign('hidden', $this->CreateInputHidden($id,'orig_action',$params['action']));

if (isset( $params['error'] ) && $params['error'] != ''){
	$smarty->assign('error', $params['error']);
 }
if (isset( $params['message'] ) && $params['message'] != ''){
	$smarty->assign('message', $params['message']);
 }

$smarty->assign('name', $this->CreateInputText($id, 'name', 
					       isset($params['name'])?$params['name']:'',40));
$smarty->assign('description', $this->CreateInputText($id, 'description', 
						      isset($params['description'])?$params['description']:'', 55));
$smarty->assign('public',$this->CreateInputCheckbox($id,'public','1','1'));

// Display the populated template
echo $this->ProcessTemplate('createnew.tpl');
?>