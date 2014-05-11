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
if (!$this->CheckPermission('Manage NMS Users'))
{
  $this->_DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
  return;
}

// display a page that will allow users to upload a csv file, process it
// and then display results, and allow importing more users
$smarty->assign('startform', $this->CreateFormStart($id, 'do_import_users', $returnid, 'post', 'multipart/form-data'));
$smarty->assign('info_csvformat',$this->Lang('info_csvformat'));
$smarty->assign('title',$this->Lang('import_users'));
$lists = $this->GetListsForPulldown('all',true,false);
$smarty->assign('input_lists',
		$this->CreateInputSelectList($id,'input_lists[]',$lists));
$smarty->assign('prompt_filename', $this->Lang('filename'));
$smarty->assign('input_filename', $this->CreateFileUploadInput($id,'input_filename'));
$smarty->assign('submit',$this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('endform', $this->CreateFormEnd());

if( isset( $params['error'] ) )
{
  $smarty->assign( 'error', $params['error'] );
}
if( isset( $params['message'] ) )
{
  $smarty->assign( 'message', $params['message'] );
}
if( isset( $params['errorcount'] ) )
{
  $smarty->assign( 'prompt_errorcount', $this->Lang('prompt_errorcount'));
  $smarty->assign( 'errorcount', $params['errorcount'] );
}
if( isset( $params['errors'] ) )
{
  $smarty->assign( 'import_errors', $params['errors'] );
}
if( isset( $params['lines'] ) )
{
  $smarty->assign( 'prompt_lines', $this->Lang('prompt_lines'));
  $smarty->assign( 'lines', $params['lines'] );
}
if( isset( $params['usersadded'] ) )
{
  $smarty->assign( 'prompt_usersadded', $this->Lang('prompt_usersadded'));
  $smarty->assign( 'usersadded', $params['usersadded'] );
}
if( isset( $params['membershipsadded'] ) )
{
  $smarty->assign( 'prompt_membershipsadded', $this->Lang('prompt_membershipsadded'));
  $smarty->assign( 'membershipsadded', $params['membershipsadded'] );
}
echo $this->ProcessTemplate('import.tpl');
?>