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


/*---------------------------------------------------------
 _DisplayAdminConfirmTab($id, $params, $returnid, $message)
 ---------------------------------------------------------*/
function _DisplayAdminConfirmFormTab(&$module, $id, & $params, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();
	$smarty->assign('startform', $module->CreateFormStart($id, 'save_confirm_prefs', $returnid));
	$smarty->assign('prompt_post_email_confirm_text', $module->Lang('prompt_post_confirm_text'));
	$smarty->assign('post_email_confirm_text', $module->CreateTextArea(false, $id, $module->GetTemplate('post_email_confirm_message'), 'post_email_confirm_message'));
	$smarty->assign('prompt_confirm_email_body', $module->Lang('prompt_confirm_email_body'));
	$smarty->assign('confirm_email_body', $module->CreateTextArea(false, $id, $module->GetTemplate('confirm_email_body'), 'confirm_email_body'));
	$smarty->assign('prompt_confirm_subject', $module->Lang('prompt_confirm_subject'));
	$smarty->assign('confirm_subject', $module->CreateInputText($id, 'confirm_subject', $module->GetPreference('confirm_subject', '1'), 30));
	$smarty->assign('submit', $module->CreateInputSubmit($id, 'submit', $module->Lang('submit'), '', '', $module->Lang('confirm_adjustsettings')));
	$smarty->assign('reset', $module->CreateInputSubmit($id, 'input_reset', $module->Lang('resetdefaults'), '', '', $module->Lang('confirm_resetdefaults')));
	$smarty->assign('endform', $module->CreateFormEnd());
	echo $module->ProcessTemplate('confirmform.tpl');
}


/*---------------------------------------------------------
 _DisplayAdminPrefsTab($id, $params, $returnid, $message)
 ---------------------------------------------------------*/
function _DisplayAdminPrefsTab(& $module, $id, & $params, $returnid, $message= '')
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();
	// simple way to have common nav available to all admin pages
	$smarty->assign('startform', $module->CreateFormStart($id, 'save_admin_prefs', $returnid));
	$smarty->assign('endform', $module->CreateFormEnd());
	$smarty->assign('submit', $module->CreateInputSubmit($id, 'submit', $module->Lang('submit')));
	if ($message != '')
	{
		$smarty->assign('message', $message);
	}
	$smarty->assign('prompt_messages_per_batch', $module->Lang('prompt_messages_per_batch'));
	$smarty->assign('messages_per_batch', $module->CreateInputText($id, 'messages_per_batch', $module->GetPreference('messages_per_batch', 50), 4, 4));
	$smarty->assign('prompt_ms_between_message_sleep', $module->Lang('prompt_ms_between_message_sleep'));
	$smarty->assign('ms_between_message_sleep', $module->CreateInputText($id, 'ms_between_message_sleep', $module->GetPreference('ms_between_message_sleep', 100), 4, 4));
	$smarty->assign('prompt_between_batch_sleep', $module->Lang('prompt_between_batch_sleep'));
	$smarty->assign('between_batch_sleep', $module->CreateInputText($id, 'between_batch_sleep', $module->GetPreference('between_batch_sleep', 5), 3, 3));
	$smarty->assign('prompt_email_user_on_admin_subscribe', $module->Lang('prompt_email_user_on_admin_subscribe'));
	$smarty->assign('email_user_on_admin_subscribe', $module->CreateInputCheckbox($id, 'email_user_on_admin_subscribe', 1, $module->GetPreference('email_user_on_admin_subscribe', 0)));
	$smarty->assign('prompt_send_admin_copies',
				$module->Lang('send_admin_copy'));
	$smarty->assign('send_admin_copies', $module->CreateInputCheckbox($id, 'send_admin_copies', 'true', $module->GetPreference('send_admin_copies', 'true')));

	$smarty->assign('prompt_admin_email',$module->Lang('admin_email'));
	$smarty->assign('admin_email', $module->CreateInputText($id, 'admin_email', $module->GetPreference('admin_email', ''), 50));
	$smarty->assign('prompt_admin_name',$module->Lang('admin_name'));
	$smarty->assign('prompt_admin_replyto',$module->Lang('admin_replyto'));
	$smarty->assign('admin_name', $module->CreateInputText($id, 'admin_name', $module->GetPreference('admin_name', ''), 50));
	$smarty->assign('admin_replyto', $module->CreateInputText($id, 'admin_replyto', $module->GetPreference('admin_replyto'), 50));

	$smarty->assign('prompt_pop3_server',$module->Lang('pop3_server'));
	$smarty->assign('pop3_server',
				$module->CreateInputText($id,'pop3_server',
						       $module->GetPreference('pop3_server'),50));
	$smarty->assign('prompt_pop3_username',$module->Lang('pop3_username'));
	$smarty->assign('pop3_username',
				$module->CreateInputText($id,'pop3_username',
						       $module->GetPreference('pop3_username'),50));
	$smarty->assign('prompt_pop3_password',$module->Lang('pop3_password'));
	$smarty->assign('pop3_password',
				$module->CreateInputPassword($id,'pop3_password',
						       $module->GetPreference('pop3_password')));

	$smarty->assign('prompt_bounce_limit',
				$module->Lang('bounce_limit'));
	$smarty->assign('bounce_limit',
				$module->CreateInputText($id,'bounce_limit',
						       $module->GetPreference('bounce_limit',10),3,3));
	$smarty->assign('info_bounce_limit',
				$module->Lang('info_bounce_limit'));
	$smarty->assign('prompt_bounce_messagelimit',
				$module->Lang('bounce_messagelimit'));
	$smarty->assign('info_bounce_messagelimit',
				$module->Lang('info_bounce_messagelimit'));
	$smarty->assign('bounce_messagelimit',
				$module->CreateInputText($id,'bounce_messagelimit',
						       $module->GetPreference('bounce_messagelimit',500),4,4));

	$smarty->assign('prompt_message_charset',
				$module->Lang('message_charset'));
	$smarty->assign('message_charset', $module->CreateInputText($id, 'message_charset', $module->GetPreference('message_charset', '1'), 50));

	$smarty->assign('prompt_require_confirmation',
			$module->Lang('require_confirmation'));
	$smarty->assign('require_confirmation',
			$module->CreateInputYesNoDropdown($id,'require_confirmation',$module->GetPreference('require_confirmation',1)));

	$smarty->assign('prompt_unsubscribe_deletes',
			$module->Lang('unsubscribe_deletes'));
	$smarty->assign('unsubscribe_deletes',
			$module->CreateInputYesNoDropdown($id,'unsubscribe_deletes',$module->GetPreference('unsubscribe_deletes',0)));

	// Display the populated template
	echo $module->ProcessTemplate('adminprefs.tpl');
}


/*---------------------------------------------------------
 _DisplayAdminSubscribeFormTab($id, $params, $returnid, $message)
 ---------------------------------------------------------*/
function _DisplayAdminSubscribeFormTab(& $module, $id, & $params, $returnid, $message= '')
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();

	$smarty->assign('startform', $module->CreateFormStart($id, 'save_subscribe_prefs', $returnid));
	$smarty->assign('endform', $module->CreateFormEnd());
	$smarty->assign('submit', $module->CreateInputSubmit($id, 'submit', $module->Lang('submit'), '', '', $module->Lang('confirm_adjustsettings')));
	$smarty->assign('reset', $module->CreateInputSubmit($id, 'input_reset', $module->Lang('resetdefaults'), '', '', $module->Lang('confirm_resetdefaults')));
	$smarty->assign('prompt_postsubscribetext', $module->Lang('prompt_postsubscribetext'));
	$smarty->assign('prompt_subscribesubject', $module->Lang('prompt_subscribesubject'));
	$smarty->assign('prompt_subscribe_email_body', $module->Lang('prompt_subscribe_email_body'));
	$smarty->assign('prompt_subscribe_form', $module->Lang('prompt_subscribe_form'));
	$smarty->assign('postsubscribetext', $module->CreateTextArea(false, $id, $module->GetPreference('subscribe_posttext', ''), 'postsubscribetext', "", "", 10, 10));
	$smarty->assign('subscribe_subject', $module->CreateInputText($id, 'subscribe_subject', $module->GetPreference('subscribe_subject', '1'), 30));
	$smarty->assign('subscribe_email_body', $module->CreateTextArea(false, $id, $module->GetTemplate('subscribe_email_body'), 'subscribe_email_body', "", "", "", "", 10, 10));
	$smarty->assign('subscribe_form', $module->CreateTextArea(false, $id, $module->GetTemplate('nms_subscribeform'), 'subscribe_form'));
	echo $module->ProcessTemplate('subscribeform.tpl');
}

/*---------------------------------------------------------
 _DisplayAdminUnsubscribeFormTab($id, $params, $returnid, $message)
 ---------------------------------------------------------*/
function _DisplayAdminUnsubscribeFormTab(& $module, $id, & $params, $returnid, $message= '')
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();

	$smarty->assign('startform', $module->CreateFormStart($id, 'save_unsubscribe_prefs', $returnid));
	$smarty->assign('endform', $module->CreateFormEnd());
	$smarty->assign('submit', $module->CreateInputSubmit($id, 'submit', $module->Lang('submit'), '', '', $module->Lang('confirm_adjustsettings')));
	$smarty->assign('reset', $module->CreateInputSubmit($id, 'input_reset', $module->Lang('resetdefaults'), '', '', $module->Lang('confirm_resetdefaults')));
	$smarty->assign('prompt_unsubscribe_prompt', $module->Lang('prompt_unsubscribe_prompt'));
	$smarty->assign('prompt_unsubscribe_text', $module->Lang('prompt_unsubscribe_text'));
	$smarty->assign('prompt_unsubscribe_subject', $module->Lang('prompt_unsubscribe_subject'));
	$smarty->assign('prompt_unsubscribe_email_body', $module->Lang('prompt_unsubscribe_email_body'));
	$smarty->assign('prompt_unsubscribe_form', $module->Lang('prompt_unsubscribe_form'));
	$smarty->assign('prompt_unsubscribe_text', $module->Lang('prompt_unsubscribe_text'));
	$smarty->assign('prompt_post_unsubscribe_text', $module->Lang('prompt_post_unsubscribe_text'));
	$smarty->assign('unsubscribe_prompt', $module->CreateInputText($id, 'unsubscribe_prompt', $module->GetPreference('nms_unsubscribe_prompt'), 30));
	$smarty->assign('unsubscribe_subject', $module->CreateInputText($id, 'unsubscribe_subject', $module->GetPreference('unsubscribe_subject'), 30));
	$smarty->assign('unsubscribe_email_body', $module->CreateTextArea(false, $id, $module->GetTemplate('unsubscribe_email_body'), 'unsubscribe_email_body'));
	$smarty->assign('unsubscribe_form', $module->CreateTextArea(false, $id, $module->GetTemplate('nms_unsubscribeform'), 'unsubscribe_form'));
	$smarty->assign('unsubscribe_text', $module->CreateTextArea(false, $id, $module->GetTemplate('unsubscribe_text'), 'unsubscribe_text'));
	$smarty->assign('post_unsubscribe_text', $module->CreateTextArea(false, $id, $module->GetTemplate('post_unsubscribe_text'), 'post_unsubscribe_text'));
	echo $module->ProcessTemplate('unsubscribeform.tpl');
}
/*---------------------------------------------------------
 _DisplayAdminUserSettingsTab($id, $params, $returnid, $message)
 ---------------------------------------------------------*/
function _DisplayAdminUserSettingsTab(& $module, $id, & $params, $returnid)
{
  global $gCms;
  $smarty =& $gCms->GetSmarty();

	$smarty->assign('startform', $module->CreateFormStart($id, 'save_usersettings_prefs', $returnid));
	$smarty->assign('prompt_usersettings_form', $module->Lang('prompt_usersettings_form'));
	$smarty->assign('usersettings_form', $module->CreateTextArea(false, $id, $module->GetTemplate('usersettings_form'), 'usersettings_form'));
	global $gCms;
	$contentops= & $gCms->GetContentOperations();
	$smarty->assign('prompt_usersettings_page', $module->Lang('prompt_usersettings_page'));
	$smarty->assign('info_usersettings_page', $module->Lang('info_usersettings_page'));
	$smarty->assign('usersettings_page', create_page_dropdown($module, $id, 'usersettings_page', $module->GetPreference('usersettings_page')));
	$smarty->assign('prompt_usersettings_form2', $module->Lang('prompt_usersettings_form2'));
	$smarty->assign('usersettings_form2', $module->CreateTextArea(false, $id, $module->GetTemplate('usersettings_form2'), 'usersettings_form2'));
	$smarty->assign('prompt_usersettings_text', $module->Lang('prompt_usersettings_text'));
	$smarty->assign('usersettings_text', $module->CreateTextArea(false, $id, $module->GetTemplate('usersettings_text'), 'usersettings_text'));
	$smarty->assign('prompt_usersettings_text2', $module->Lang('prompt_usersettings_text2'));
	$smarty->assign('usersettings_text2', $module->CreateTextArea(false, $id, $module->GetTemplate('usersettings_text2'), 'usersettings_text2'));
	$smarty->assign('prompt_usersettings_subject', $module->Lang('prompt_usersettings_subject'));
	$smarty->assign('usersettings_subject', $module->CreateInputText($id, 'usersettings_subject', $module->GetPreference('usersettings_subject', ''), 30));
	$smarty->assign('prompt_usersettings_email_body', $module->Lang('prompt_usersettings_email_body'));
	$smarty->assign('usersettings_email_body', $module->CreateTextArea(false, $id, $module->GetTemplate('usersettings_email_body'), 'usersettings_email_body'));
	$smarty->assign('submit', $module->CreateInputSubmit($id, 'submit', $module->Lang('submit'), '', '', $module->Lang('confirm_adjustsettings')));
	$smarty->assign('reset', $module->CreateInputSubmit($id, 'input_reset', $module->Lang('resetdefaults'), '', '', $module->Lang('confirm_resetdefaults')));
	$smarty->assign('endform', $module->CreateFormEnd());
	echo $module->ProcessTemplate('usersettingsform.tpl');
}



?>
