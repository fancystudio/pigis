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
//$db = $gCms->GetDb();

$taboptarray= array (
	'mysql' => 'TYPE=MyISAM'
);

$dict= NewDataDictionary($db);
$flds= "userid I KEY AUTO,
	uniqueid C(225),
	email C(125),
        username C(225),
	disabled I,
	confirmed I,
	htmlemail I,
	dateadded " . CMS_ADODB_DT . ",
	dateconfirmed " . CMS_ADODB_DT.",
        error_count I,
        bounce_count I";
$sqlarray= $dict->CreateTableSQL(NMS_USERS_TABLE,$flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
$flds= "userid I,
        fieldname C(125),
		value X2";
$sqlarray= $dict->CreateTableSQL(NMS_USER_DATA_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
$flds= "messageid I KEY AUTO,
	uniqueid C(255),
	subject C(125),
	message X2,
	entered " . CMS_ADODB_DT . ",
        modified ". CMS_ADODB_DT . ",
        template C(200),
        pageid I,
        archivable I1,
        text_only I1";
$sqlarray= $dict->CreateTableSQL(NMS_MESSAGES_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
$flds= "listid I KEY AUTO,
	name C(125),
	description C(250),
	active I,
        public I,
	dateadded " . CMS_ADODB_DT;
$sqlarray= $dict->CreateTableSQL(NMS_LIST_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
$flds= "
	userid I KEY,
	listid I KEY,
	active I,
	entered " . CMS_ADODB_DT;
$sqlarray= $dict->CreateTableSQL(NMS_LISTUSER_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
// status: 0 = unstarted, 1 = in progress, 2 = paused, 3 = complete, -1 = error
$flds= "jobid I KEY AUTO,
        title  C(255),
	created " .  CMS_ADODB_DT . ",
	started " .  CMS_ADODB_DT . ",
        finished " . CMS_ADODB_DT . ",
	status I";
$sqlarray= $dict->CreateTableSQL(NMS_JOBS_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$dict= NewDataDictionary($db);
// status: 0 = unstarted, 1 = in progress, 2 = paused, 3 = complete, -1 = error
$flds= "jobid I KEY,
	listid I KEY,
	messageid I KEY,
	status I";
$sqlarray= $dict->CreateTableSQL(NMS_JOB_PARTS_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);
$db->CreateSequence(NMS_SEQ_TABLE);

$dict = NewDataDictionary($db);
$flds = 'messageid I KEY NOT NULL,
         name      C(50) KEY NOT NULL,
         type      C(50) NOT NULL,
         value     X2,
         created   '. CMS_ADODB_DT.',
         modified  '. CMS_ADODB_DT;
$sqlarray = $dict->CreateTableSQL(NMS_MESSAGE_CONTENT_TABLE, $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// $dict = NewDataDictionary($db);
// $flds = "
//    template_id I KEY AUTO,
//    name        C(50),
//    value       X2';
// ";
// $sqlarray = $dict->CreateTableSQL(NMS_MSG_TEMPLATES_TABLE, $flds, $taboptarray);
// $dict->ExecuteSQLArray($sqlarray);


$this->CreatePermission('Manage NMS Users', 'Manage NMS Users');
$this->CreatePermission('Manage NMS Lists', 'Manage NMS Lists');
$this->CreatePermission('Manage NMS Jobs', 'Manage NMS Jobs');
$this->CreatePermission('Manage NMS Messages', 'Manage NMS Messages');
$this->CreatePermission('NMS Advanced Mode', 'NMS Advanced Mode');
$this->CreatePermission('Manage NMS Preferences', 'Manage NMS Preferences');

// create preferences
$this->SetPreference('users_per_page', 25);
$this->SetPreference('messages_per_batch', 50);
$this->SetPreference('ms_between_message_sleep', 500);
$this->SetPreference('between_batch_sleep', 30);
$this->SetPreference("email_user_on_admin_subscribe", 0);
$this->SetPreference("send_admin_copies", true);
$this->SetPreference("confirm_subject", $this->Lang('default_confirm_subject'));
$this->SetPreference("extra_fields", "");
$this->SetPreference("admin_email", 'root@localhost.com');
$this->SetPreference("admin_name", 'Root');
$this->SetPreference("message_charset", $this->defaultcharset);
$this->SetPreference("subscribe_posttext", $this->Lang('default_postsubscribe_text'));
$this->SetPreference("subscribe_subject", $this->Lang('default_subscribe_subject'));
$this->SetTemplate("subscribe_email_body", $this->default_subscribe_email_body);
$this->SetTemplate('nms_subscribeform', $this->default_subscribe_form);
$this->SetTemplate('nms_unsubscribeform', $this->default_unsubscribe_form);
$this->SetTemplate('confirm_email_body', $this->default_confirm_email_body);
$this->SetTemplate('post_email_confirm_message', $this->default_post_email_confirm_message);
$this->SetTemplate('unsubscribe_text', $this->default_unsubscribe_text);
$this->SetPreference('nms_unsubscribe_prompt', $this->default_unsubscribe_prompt);
$this->SetPreference('unsubscribe_subject', $this->Lang('default_unsubscribe_subject'));
$this->SetTemplate('unsubscribe_email_body', $this->default_unsubscribe_email_body);
$this->SetTemplate("post_unsubscribe_text", $this->default_post_unsubscribe_text);
$this->SetTemplate("usersettings_form", $this->default_usersettings_form);
$this->SetTemplate("usersettings_form2", $this->default_usersettings_form2);
$this->SetPreference("usersettings_subject", $this->default_usersettings_subject);
$this->SetTemplate('usersettings_email_body', $this->default_usersettings_email_body);
$this->SetTemplate("usersettings_text", $this->default_usersettings_text);
$this->SetTemplate("usersettings_text2", $this->default_usersettings_text2);
$this->SetPreference("default_message_template", $this->default_message_template);

// Events
$this->CreateEvent('OnNewUser');
$this->CreateEvent('OnEditUser');
$this->CreateEvent('OnDeleteUser');
$this->CreateEvent('OnNewList');
$this->CreateEvent('OnEditList');
$this->CreateEvent('OnDeleteList');
$this->CreateEvent('OnCreateMessage');
$this->CreateEvent('OnEditMessage');
$this->CreateEvent('OnDeleteMessage');
$this->CreateEvent('OnCreateJob');
$this->CreateEvent('OnDeleteJob');
$this->CreateEvent('OnStartJob');
$this->CreateEvent('OnFinishJob');
$this->CreateEvent('OnUnsubscribe');

// put mention into the admin log
$this->Audit(0, $this->Lang('friendlyname'), $this->Lang('installed', $this->GetVersion()));

$fn = cms_join_path(dirname(__FILE__),'templates','orig_msgtemplate.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetPreference('sysdflt_msgtemplate',$template);
    $this->SetTemplate('msgtemplate_Sample',$template);
    $this->SetPreference('curdeflt_msgtemplate','Sample');
  }

$fn = cms_join_path(dirname(__FILE__),'templates','orig_archive.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetPreference('sysdflt_archivelist',$template);
    $this->SetTemplate('archivelist_Sample',$template);
    $this->SetPreference('curdeflt_archivelist','Sample');
  }

$fn = cms_join_path(dirname(__FILE__),'templates','orig_archivemsg.tpl');
if( file_exists($fn) )
  {
    $template = file_get_contents($fn);
    $this->SetPreference('sysdflt_archivemsg',$template);
    $this->SetTemplate('archivemsg_Sample',$template);
    $this->SetPreference('curdeflt_archivemsg','Sample');
  }
?>
