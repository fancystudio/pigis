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

if( !isset($params['msgID']) )
  {
    $this->_DisplayErrorPage($id,$params,$returnid,
			     $this->Lang('error_insufficientparams'));
    return;
  }

// display a particular archived newsletters, but only pull out public messages
$db = &$this->GetDb();
$query = 'SELECT * FROM '.NMS_MESSAGES_TABLE.' WHERE messageid=? AND archivable = 1';
$row = $db->GetRow($query,array($params['msgID']));
if( !$row )
  {
    $this->_DisplayErrorPage($id,$params,$returnid,
			     $this->Lang('error_itemnotfound'));
    return;
  }

//
// Setup Smarty
//
$obj = new StdClass();
foreach( $row as $key => $value )
{
  $obj->$key = $value;
}
$obj->entered = $db->UnixTimeStamp($obj->entered);
$obj->modified = $db->UnixTimeStamp($obj->entered);

$smarty->assign('nms_archive_view',1);
$smarty->assign('messageinfo',$obj);
$smarty->assign('subject',$row['subject']);
$smarty->assign('uniqueid','{literal}{$uniqueid}{/literal}');
$smarty->assign('username','{literal}{$username}{/literal}');
$smarty->assign('email','{literal}{$email}{/literal}');
$smarty->assign('unsubscribe','{literal}{$unsubscribe}{/literal}');
$smarty->assign('preferences','{literal}{$preferences}{/literal}');
$smarty->assign('confirmurl','{literal}{$confirmurl}{/literal}');
$smarty->assign('msg_permalink','{literal}{$msg_permalink}{/literal}');
$smarty->assign('textmessage',$this->ProcessTemplateFromData($row['message']));
$smarty->assign('messageidtext',$this->Lang('message_id'));
$smarty->assign('subjecttext',$this->Lang('subject'));
$smarty->assign('messagetext',$this->Lang('text_message'));
$smarty->assign('htmlmessagetext',$this->Lang('html_message'));
$smarty->assign('modifiedtext',$this->Lang('modified'));
$smarty->assign('enteredtext',$this->Lang('entered'));
$smarty->assign('templatetext',$this->Lang('template'));

foreach ($this->GetModulesWithCapability('nms_vars') as $one_module)
{
  cms_utils::get_module($one_module)->SetSmartyVars($id, -1, $params['msgID'], '', $smarty, 'view');
}

$template = $this->GetPreference('curdeflt_archivemsg');
if( isset($params['archivemsg_template']) )
  {
    $template = trim($params['archivemsg_template']);
  }
echo $this->ProcessTemplateFromDatabase('archivemsg_'.$template);

#
# EOF
#
?>
