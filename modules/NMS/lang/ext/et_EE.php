<?php
$lang['import_feu_badversion'] = 'Could not find a compatible version of the FrontEndUsers module';
$lang['html'] = 'HTML';
$lang['prompt_text_only'] = 'This message contains only text';
$lang['prompt_archivable'] = 'Can this message appear in public archive lists';
$lang['select_one'] = 'Select One';
$lang['help_archivemsg_template'] = 'Specify a template from the archive message template list to be used for displaying a single message.  If this argument is not specified on the tag, the archive message template currently marked as &#039;default&#039; will be used.';
$lang['help_archivelist_template'] = 'Specify an archive list template to be used when displaying the archivelist.  This is only valuable with the archivelist action, and if no value is set, the template currently marked as &#039;default&#039; will be used.';
$lang['help_limit'] = 'Used in the &#039;archivelist&#039; action, this parameter determines the maximum number of archived messages to display.';
$lang['help_sortorder'] = 'Used in the &#039;archivelist&#039; action, this parameter determines the sorting order of the messages displayed.  Possible values are: ASC and DESC';
$lang['help_sortby'] = 'Used in the &#039;archivelist&#039; action, this parameter controls the field used for sorting the entries.  Possible values are msgid,id,subjectdate and entered';
$lang['title_setdflt_archivemsgtmpl'] = 'Default ShowMessage Template';
$lang['info_setdflt_archivemsgtmpl'] = 'This form allows you to specify the &#039;default&#039; contents of a show message template when you &#039;create a new template&#039; in the ShowMessage section of the &#039;Archive Templates&#039; tab.  Adjusting the content in this text area will have no immediate effect on your website';
$lang['addedit_archivemsg_template'] = 'Add/Edit ShowMessage Template';
$lang['info_templatemessage_archivemsg'] = '';
$lang['modified'] = 'Modified';
$lang['text_message'] = 'Text Message';
$lang['html_message'] = 'HTML Message';
$lang['message_id'] = 'Message ID';
$lang['archive_summary_templates'] = 'Archive Summary Templates';
$lang['archive_detail_templates'] = 'Archive Detail Templates';
$lang['title_setdflt_archivelistmpl'] = 'Default archive list template';
$lang['info_setdflt_archivelisttmpl'] = 'This form allows you to specify the &#039;default&#039; contents of an archive template when you  &#039;create a new template&#039; in the &#039;archive templates&#039; tab.  Adjusting the content in this text area will have no immediate effect on the display of your website';
$lang['title_setdflt_messagetemplate'] = 'Default message template';
$lang['info_setdflt_messagetemplate'] = 'This form allows you to specify the &#039;skeleton&#039; message template that will be used when you &#039;create a new template&#039; in the message templates tab.';
$lang['addedit_archivelist_template'] = 'Add/Edit Archive List Template';
$lang['info_templatemessage_archivelist_'] = '';
$lang['default_templates'] = 'Default Templates';
$lang['archive_templates'] = 'Archive Templates';
$lang['jobs_warning'] = '<h3>Warning:</h3>Improper use of this module can cause significant problems with your host, with your customers, or potentially with the law.  The developers of this module assume no risks or responsibilities what-so-ever with the use of this code.  <strong>Use At Your Own Risk</strong>';
$lang['warning'] = 'Warning';
$lang['send_admin_copy'] = 'Send Admin A Copy';
$lang['message_charset'] = 'Message Charset';
$lang['bounce_limit'] = 'Bounce Limit';
$lang['info_bounce_limit'] = 'The number of allowed bounces before a user is disabled (max 100)';
$lang['bounce_messagelimit'] = 'Bounce MessageLimit';
$lang['info_bounce_messagelimit'] = 'The number of pop3 messages to process at one time (max 1000).';
$lang['error_pop3_processing'] = 'Problem processing bounces';
$lang['error_pop3_connect'] = 'Problem connecting to pop3 server';
$lang['error_invalidbounces'] = 'Bounce Count is invalid (0 to 100)';
$lang['bounce_count'] = 'Bounce Count';
$lang['nms_job_complete_subject'] = 'NMS Email Job Complete';
$lang['nms_job_complete_msg'] = 'The NMS Email Job is complete.  it took %s Seconds';
$lang['pop3_server'] = 'POP3 Server';
$lang['pop3_username'] = 'POP3 Username';
$lang['pop3_password'] = 'POP3 Password';
$lang['admin_email'] = 'Admin Email Address';
$lang['admin_name'] = 'Administrator Name';
$lang['admin_replyto'] = 'Administrator ReplyTo Address';
$lang['process_bounces'] = 'Process Bounces';
$lang['error_notemplates'] = 'Could not find any matching templates';
$lang['error_notemplatebyname'] = 'Could not find a template named %s';
$lang['addedit_template'] = 'Add/Edit Message Template';
$lang['prompt_textmessage'] = 'Text Message';
$lang['found'] = 'found';
$lang['template'] = 'Template';
$lang['templates'] = 'Templates';
$lang['add_template'] = 'Add Template';
$lang['message_templates'] = 'Message Templates';
$lang['default_confirm_subject'] = 'Please confirm your subscription';
$lang['default_postsubscribe_text'] = 'Thank You for subscribing.';
$lang['default_subscribe_subject'] = 'Subscription Confirmed';
$lang['default_unsubscribe_subject'] = 'Unsubscribe notification';
$lang['cleantemptable'] = 'Clean Temporary Table';
$lang['error_problemwithmessage'] = 'Unspecified message problem.';
$lang['prompt_usersettings_page'] = 'Return page for Usersettings form';
$lang['info_usersettings_page'] = 'Page to return to when an email link is clicked on to edit user preferences.<br/>The (*) Indicates the default page.';
$lang['jobname'] = 'Job created at';
$lang['msg_jobprocessing'] = 'Batch Processing Window';
$lang['prompt_page'] = 'Return Page';
$lang['error_insufficientparams'] = 'One or more required parameters are missing from the request.  This action cannot proceed';
$lang['prompt_from'] = 'From';
$lang['prompt_replyto'] = 'Reply To';
$lang['prompt_subject'] = 'Subject';
$lang['prompt_template'] = 'Template';
$lang['prompt_selectstatus'] = 'Select Status';
$lang['prompt_message'] = 'Message';
$lang['prompt_userfilter'] = 'Email filter (regexp)';
$lang['prompt_usernamefilter'] = 'Username filter (regexp)';
$lang['prompt_listfilter'] = 'Filter on list Membership';
$lang['info_listfilter'] = '<strong>Note:</strong> Hold the CTRL key down and click on items to select and deselect them.
';
$lang['message_help'] = '<h3>Message Authoring:</h3><p>When typing a message, the following <em>smarty</em> variables are available:<br/>
<em>{$username}</em> - The users name<br/>
<em>{$email}</em> - The users email address<br/>
<em>{$unsubscribe}</em> - A URL that can be used to display a page for unsubscribing<br/>
<em>{$preferences}</em> - A URL that can be used to display a user preferences page<br/>
<em>{$confirmurl}</em> - A URL that can be used to confirm subscriptions<br/>
<p>In addition, you can use any other smarty variable, function or modifier in your message template or content.  You can even embed the output from other CMS Made Simple modules (if the template styles are taken care of, you may need to use seperate templates than what you use for your page output).  See the {get_template_vars} and the {$object|print_r} modifier to further debug your messages.</p>
<p><strong>Note: </strong>Images added to content blocks via the wysiwyg image functionality will result in the output email containing absolute references to external images.  <em>The images will NOT be attached to the email.</em></p>
<p><strong>Tip: </strong>Be sure to use the {literal} and {/literal} tags around any \<style\> tags.</p>
';
$lang['message_help2'] = '<h3>Notice:</h3>
<p>If you do not have a properly defined message template, then you will only be able to create text messages using the contents from the &#039;Text Message&#039; edit area.  If at least one content block, exists, the message is assumed to be in HTML format.  If the &#039;Text Message&#039; edit area remains empty, then the multipart portion of the email will not be sent.</p>';
$lang['applyfilter'] = 'Filter';
$lang['info_event_OnNewUser'] = 'Generated when a new user subscribes to one or more mailing lists';
$lang['info_event_OnEditUser'] = 'Generated when a user is modified either in the admin or via the front end';
$lang['info_event_OnDeleteUser'] = 'Generated when a user is deleted';
$lang['info_event_OnNewList'] = 'Generated when a mailing list is modified';
$lang['info_event_OnDeleteList'] = 'Generated when a mailing list is deleted';
$lang['info_event_OnCreateMessage'] = 'Generated when a message is created';
$lang['info_event_OnEditMessage'] = 'Generated when a message is modified';
$lang['info_event_OnDeleteMessage'] = 'Generated when a message is deleted';
$lang['info_event_OnCreateJob'] = 'Generated when a job is created';
$lang['info_event_OnDeleteJob'] = 'Generated when a job is deleted';
$lang['info_event_OnStartJob'] = 'Generated when the processing of a job begins';
$lang['info_event_OnFinishJob'] = 'Generated when the processing of a job finishes';
$lang['help_OnNewUser'] = '<p>An event generated when a new user subscribes to one or more mailing lists</p>
<h4>Parameters</h4>
<ul>
<li><em>email</em> - Users email address</li>
<li><em>username</em> - Username</li>
<li><em>lists</em> - Array of member lists</li>
</ul>
';
$lang['help_OnEditUser'] = '<p>An event generated when a user is modified either in the admin or via the front end</p>
<h4>Parameters</h4>
<ul>
<li><em>email</em> - Users email address</li>
<li><em>username</em> - Username</li>
<li><em>lists</em> - Array of member lists</li>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['help_OnDeleteUser'] = '<p>An event generated when a user is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['help_OnNewList'] = '<p>An event generated when a new mailing list is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The list name</li>
<li><em>description</em> - List description</li>
<li><em>public</em> - Public flag</li>
</ul>
';
$lang['help_OnEditList'] = '<p>An event generated when a mailing list is modified</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The list name</li>
<li><em>description</em> - List description</li>
<li><em>public</em> - Public flag</li>
<li><em>listid</em> - The list ID</li>
</ul>
';
$lang['help_OnDeleteList'] = '<p>An event generated when a mailing list is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>listid</em> - The list ID</li>
</ul>
';
$lang['help_OnCreateMessage'] = '<p>An event generated when a message is created</p>
<h4>Parameters</h4>
<ul>
<li><em>fromwho</em> - The Name of the person this message is from</li>
<li><em>reply_to</em> - The Email address for the reply to field</li>
<li><em>subject</em> - The subject of the message</li>
<li><em>message</em> - The body of the message <em>(may contain smarty tags)</em></li>
<li><em>entered</em> - The date the message was entered</li>
<li><em>uniqueid</em> - The unique id of this message</em>
</ul>
';
$lang['help_OnEditMessage'] = '<p>An event generated when a message is modified</p>
<h4>Parameters</h4>
<ul>
<li><em>fromwho</em> - The Name of the person this message is from</li>
<li><em>reply_to</em> - The Email address for the reply to field</li>
<li><em>subject</em> - The subject of the message</li>
<li><em>message</em> - The body of the message <em>(may contain smarty tags)</em></li>
<li><em>messageid</em> - The ID of this message</id>
</ul>
';
$lang['help_OnDeleteMessage'] = '<p>An event generated when a message is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>messageid</em> - The ID of the message that has been deleted</li>
</ul>
';
$lang['help_OnCreateJob'] = '<p>An event generated when a job is created</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
<li><em>lists</em> - An array of listids</li>
</ul>
';
$lang['help_OnDeleteJob'] = '<p>An event generated when a job is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
</ul>
';
$lang['help_OnStartJob'] = '<p>An event generated when the processing of a job begins</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
</ul>
';
$lang['help_OnFinishJob'] = '<p>An event generated when the processing of a job finishes</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
</ul>
';
$lang['error_needreplyto'] = 'You must enter a valid reply to email address';
$lang['error_needfrom'] = 'You must enter a valid name for the originator of the message';
$lang['error_needsubject'] = 'You must enter a valid email subject';
$lang['error_needmessagetext'] = 'You must enter something for a message body';
$lang['error_formerror'] = 'Form error';
$lang['error_dberror'] = 'Database error';
$lang['error_nameexists'] = 'An item by that name already exists';
$lang['error_itemnotfound'] = 'The specified item could not be found';
$lang['error_invalidparam'] = 'Invalid Parameter';
$lang['invalidparam'] = 'Invalid param in the NMS module tag';
$lang['prompt_users_per_page'] = 'Number of users to display on each page of the user list';
$lang['disabled'] = 'Disabled';
$lang['confirmed'] = 'Confirmed';
$lang['prompt_usersettings_text2'] = 'Text displayed after the user settings form is submitted';
$lang['prompt_usersettings_form2'] = 'Form displayed to users wishing to change settings';
$lang['prompt_usersettings_text'] = 'Text displayed after the user settings message is sent';
$lang['prompt_usersettings_email_body'] = 'Body of the user settings email';
$lang['prompt_usersettings_subject'] = 'Subject of user settings email';
$lang['prompt_usersettings_form'] = 'Form asking users who whish to change settings, their email address';
$lang['prompt_post_unsubscribe_text'] = 'Text displayed after the unsubscribe process is complete';
$lang['user_settings'] = 'User Settings';
$lang['prompt_unsubscribe_prompt'] = 'Prompt asking the user for his email address to unsubscribe';
$lang['prompt_unsubscribe_text'] = 'Text displayed after unsubscribe form is completed';
$lang['prompt_unsubscribe_subject'] = 'Subject of the email sent to unsubscribe';
$lang['prompt_unsubscribe_email_body'] = 'Body of the email sent to unsubscribe';
$lang['prompt_unsubscribe_form'] = 'Template for the unsubscribe form';
$lang['error_accountdisabled'] = 'We are sorry, but your account has been disabled and this action is not possible at this time';
$lang['prompt_post_confirm_text'] = 'Message displayed after email confirmation';
$lang['prompt_confirm_email_body'] = 'Confirmation email body';
$lang['prompt_confirm_subject'] = 'Confirmation email subject';
$lang['confirm_subscribe'] = 'Confirm Subscribe';
$lang['confirm_unsubscribe'] = 'Confirm Unsubscribe';
$lang['nolists'] = 'No lists found to subscribe to';
$lang['public'] = 'Public';
$lang['yes'] = 'Yes';
$lang['no'] = 'No';
$lang['prompt_postsubscribetext'] = 'Message displayed after subscription';
$lang['subscription_confirmed'] = 'Subscription confirmed';
$lang['reset'] = 'Reset';
$lang['suspend'] = 'Suspend';
$lang['resume'] = 'Resume';
$lang['action'] = 'Action';
$lang['processing_records'] = 'Processing records %s to %s';
$lang['initializing_job'] = 'Initializing Job';
$lang['processing_job'] = 'Processing Job';
$lang['deletecompleted'] = 'Delete Completed Jobs';
$lang['error_importerrorcount'] = 'Error count';
$lang['lines'] = 'Lines';
$lang['users_added'] = 'Users Added';
$lang['memberships'] = 'Memberships';
$lang['subscribe'] = 'Subscribe';
$lang['resetdefaults'] = 'Reset to Defaults';
$lang['confirm_adjustsettings'] = 'Are you sure you want to adjust these settings?';
$lang['confirm_resetdefaults'] = 'Are you sure you want to reset this form to its system default value?';
$lang['prompt_subscribetext'] = 'Subscribe Text';
$lang['prompt_subscribesubject'] = 'Subscribe Subject';
$lang['prompt_subscribe_email_body'] = 'Subscribe Email Body';
$lang['prompt_subscribe_form'] = 'Template for the Subscribe Form';
$lang['subscribe_form'] = 'Subscribe';
$lang['unsubscribe_form'] = 'Unsubscribe';
$lang['error_insertinglist'] = 'Problem creating the new list';
$lang['error_emailexists'] = 'That email address already exists in the user list';
$lang['error_invalidusername'] = 'Vale kasutajanimi';
$lang['error_invalidid'] = 'Vale unikaalne id';
$lang['error_invalidemail'] = 'VIGA - Vale emaili aadress';
$lang['username'] = 'Kasutajanimi';
$lang['name'] = 'Nimi';
$lang['prompt_public'] = 'This is a public mailing list';
$lang['error_usernotfound'] = 'Could not find user with specified uniqueid';
$lang['prompt_ms_between_message_sleep'] = 'Delay (in milliseconds) between sending each message';
$lang['prompt_between_batch_sleep'] = 'Delay (in seconds) between each batch';
$lang['prompt_messages_per_batch'] = 'The maximum number of messages to send in a batch';
$lang['okclosewindow'] = 'You can now close this window';
$lang['queuefinished'] = 'Processing of output queue finished';
$lang['totaltime'] = 'Total processing time:';
$lang['seconds'] = 'Seconds';
$lang['totalmails'] = 'Total Emails Sent (including to admin):';
$lang['page'] = 'Page';
$lang['of'] = 'of';
$lang['info_csvformat'] = 'The import file must be in CSV (comma separated value) format, one entry per line.<br />
* The columns are: <code>email address, username</code><br />
* The username field is optional.<br />
* Comments (anything after a # or // character sequence is ignored)<br />
* Blank lines are ignored.<br />
';
$lang['prompt_lines'] = 'Lines Imported';
$lang['prompt_usersadded'] = 'Users Added';
$lang['prompt_membershipsadded'] = 'Memberships added';
$lang['prompt_errorcount'] = 'Number of Errors';
$lang['importerror_cantgetuserid'] = 'Error at line %s, could not get userid %s';
$lang['importerror_cantcreateuser'] = 'Error at line %s, could not create user %s';
$lang['importerror_nosuchlist'] = 'Error at line %s, no such list %s';
$lang['importerror_nofields'] = 'Error at line %s, not enough fields';
$lang['import_users'] = 'Import Users from CSV';
$lang['error_emptyfile'] = 'ERROR- An empty file was uploaded';
$lang['error_nofilesuploaded'] = 'ERROR- no files were uploaded';
$lang['filename'] = 'Import Filename';
$lang['title_users_import'] = 'Import Users from CSV';
$lang['title_users_export'] = 'Export Users from Database';
$lang['nummessages'] = '# of Messages';
$lang['created'] = 'Created';
$lang['started'] = 'Started';
$lang['finished'] = 'Finished';
$lang['processjobs'] = 'Process Jobs';
$lang['status_error'] = 'ERROR';
$lang['status_unstarted'] = 'Not started';
$lang['status_inprogress'] = 'In Progress';
$lang['status_paused'] = 'Paused';
$lang['status_complete'] = 'Complete';
$lang['status_unknown'] = 'Unknown';
$lang['error_jobnameexists'] = 'ERROR- A job with that name already exists';
$lang['createjob'] = 'Create Job';
$lang['prompt_email_user_on_admin_subscribe'] = 'Send users an email when the administrator manually adds membership to a list';
$lang['error_nomessagesselected'] = 'No messages selected';
$lang['error_nolistsselected'] = 'No lists selected';
$lang['createjobmsg'] = 'Select one message, and one or more lists to send the message to';
$lang['error_nojobname'] = 'ERROR- No job name specified';
$lang['error_nolists'] = 'ERROR- No lists!';
$lang['error_nomessages'] = 'ERROR- No messages!';
$lang['jobs'] = 'Jobs';
$lang['status'] = 'Status';
$lang['jobsfoundtext'] = 'Jobs found';
$lang['messagesfoundtext'] = 'Messages found';
$lang['entered'] = 'Entered';
$lang['subject'] = 'Subject';
$lang['from'] = 'From';
$lang['delete_user_confirm'] = 'Are you sure you want to delete this user';
$lang['info_singlelist'] = 'This user will be added to the sole mailing list';
$lang['error_selectonelist'] = 'ERROR- You must select atleast one list';
$lang['error_invaliduniqueid'] = 'ERROR- invalid unique id';
$lang['error_couldnotfindjobpart'] = 'ERROR- Could not find a requested job part in the database.  This may indicate that another user (you?) is editing/deleting jobs whilst a job is processing.';
$lang['error_couldnotfindmessage'] = 'ERROR- Could not find a requested message.  This may indicate that another user (you?) is editing/deleting messages whilst a job is processing.';
$lang['error_couldnotfindtemplate'] = 'ERROR- Could not find a requested page template.  This may indicate that the template was deleted since the mail message was created.';
$lang['error_temporarytableexists'] = 'ERROR- The temporary database table, used for job processing already exists.  This probably indicates that an error occurred when trying to process a job previously.';
$lang['error_buildingtemptable'] = 'ERROR- A problem occurred when filling the temporary table';
$lang['error_otherprocessingerror'] = 'ERROR: An error occurred during processing';
$lang['userid'] = 'User ID';
$lang['emailaddress'] = 'Emaili aadress';
$lang['usersfoundtext'] = 'Kasutajat leitud';
$lang['title_user_createnew'] = 'Lisa kasutaja';
$lang['error_invalidlistname'] = 'VIGA - vale listi nimi';
$lang['editlist_text'] = 'Muuda listi';
$lang['id'] = 'ID';
$lang['listsfoundtext'] = 'Listi leitud';
$lang['users'] = 'Kasutajad';
$lang['preferences'] = 'Preferences';
$lang['messages'] = 'Messages';
$lang['queue'] = 'Queue';
$lang['submit'] = 'Saada';
$lang['cancel'] = 'T&uuml;hista';
$lang['description'] = 'Kirjeldus';
$lang['createnewlist_text'] = 'Loo list';
$lang['lists'] = 'Listid';
$lang['friendlyname'] = 'Newsletter Made Simple';
$lang['postinstall'] = 'Thank you for installing NMS. Be sure to set &quot;Use NMS&quot; permissions to use this module!';
$lang['postuninstall'] = 'Newsletter Made Simple Uninstalled.';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['prefsupdated'] = 'Newsletter Made Simple Module preferences updated.';
$lang['newslettercreated'] = 'A new newsletter has been created.';
$lang['no_email_error'] = 'You must fill in an email address.';
$lang['subscribe_thankyou'] = 'Thank you for subscribing. A confirmation e-mail has been sent to your inbox.';
$lang['enter_valid_email'] = 'You must enter a valid e-mail address and select at least one list.';
$lang['newslettercreatederror'] = 'You must enter a name and description.';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['error'] = 'Error!';
$lang['sent'] = 'Sent';
$lang['inqueue'] = 'In Queue';
$lang['send_next_batch'] = 'Sending the next batch of %s emails; starting at: %s';
$lang['messages_sent'] = '%s have been sent';
$lang['closewindow'] = 'Close Window';
$lang['testmode'] = 'You are in test mode. No e-mails will be sent.';
$lang['confirmdeletejob'] = 'Are you sure you want to delete this job';
$lang['confirmsend'] = 'Are you sure you want to send all messages?\n\nSending large amounts of messages could take considerable time and put significant drain on your host resources.\n\nUSE AT YOUR OWN RISK.';
$lang['confirmdelete'] = 'Are you sure you want to delete this message?';
$lang['confirmdeletelist'] = 'Are you sure you want to delete this list?';
$lang['keepwindowopen'] = 'Keep this window open till all messages have been sent.<br>';
$lang['profileupdated'] = 'Your profile has been updated.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['title_mod_prefs'] = 'Configuration';
$lang['title_mod_messages'] = 'Message Queue';
$lang['title_mod_createnew'] = 'Create a List';
$lang['title_mod_manage_user'] = 'Users';
$lang['title_mod_compose_job'] = 'Create Job';
$lang['title_mod_compose_message'] = 'Compose Message';
$lang['title_mod_process_queue'] = 'Process Queue';
$lang['title_mod_admin'] = 'Manage Lists';
$lang['user_delete_confirm'] = 'Are you sure you want to delete this user?';
$lang['userdeleted'] = 'User Deleted';
$lang['newsletterdeleted'] = 'Newsletter Deleted';
$lang['delete'] = 'Delete';
$lang['edit'] = 'Edit';
$lang['previous'] = 'Previous';
$lang['next'] = 'Next';
$lang['unsubscribemessage'] = 'You have been unsubscribed. Thank you.';
$lang['title_admin_panel'] = 'Newsletter Made Simple';
$lang['moddescription'] = 'This module is a module that allows you to create a newsletter system.';
$lang['welcome_text'] = '<p>Welcome to Newsletter Made Simple (NMS) Module admin section. </p>';
$lang['helpselect'] = 'Specify a comma separated list of mailing lists to display.  <em>(Valid only in subscribe mode)</em>';
$lang['helpaction'] = 'One way of specifying the behavior of the modulee. Options are:
<ul>
<li>archivelist - display a message archive</li>
<li>showmessage - display a specific message</li>
</ul>
';
$lang['helpmode'] = 'Specify the mode of operation (valid only when action is not specified or is &#039;default&#039;. Options are:
<ul>
<li>subscribe (default) - display the subscribe form</li>
<li>unsubscribe - display the unsubscribe form</li>
<li>usersettings - display the usersettings form</li>
</ul>
';
$lang['help'] = '<h3>Newsletter Made Simple (NMS)</h3>
<h4><strong>What does it do?</strong></h4>
<p>Enables you to have a e-mail newsletter system inside CMS Made Simple.</p>
<p>Features:
<ul>
  <li>Allows for public (users can subscribe and unsubscribe at will) and private (admins maintained) lists</li>
  <li>Allows for email confirmation of subscription and unsubscribe activities</li>
  <li>Allows for disabling certain users</li>
  <li>Import and export of users</li>
  <li>Completely template driven</li>
  <li>Allows displaying archived messages in the frontend</li>
  <li>Complete template driven messaging system</li>
  <li>Messages can be stored and re-used</li>
  <li>Allows for embedding images into emails</li>
  <li>Allows attaching files to emails</li>
  <li>Handles bounces</li>
  <li>Supports pretty urls</li>
  <li>Lots more</li>
</ul>
</p>
<br/>
<h4 style=&quot;color: red;&quot;>READ THIS FIRST</h4>
<p>This is an EXPERT tool, designed for use by bulk emailing experts.  It is not designed for use by people that don&#039;t have intimate knowledge of the advantages and pitfalls of sending HTML emails.  If you don&#039;t have the required knowledge you should seriously consider NOT using this package.</p>
<p>This module can be used for sending bulk emails.  This can be a problematic and error prone process, and you should do considerable research before using this module.  Things you should research include:
<ul>
  <li>How to Send bulk emails so that they won&#039;t be interpreted as spam</li>
  <li>Repeatedly sending spam, or sending spam to a large amount of email addresses could get your domain blacklisted, and possibly all of the domains hosted by your ISP. <strong>Use extreme caution.</strong></li>
  <li>How to send HTML emails so that your clients will be able to read them</li>
  <li>Your hosts policy and limitations about email sending</li>
  <li>How to research removing your ISP from various blacklists as a result of implied spamming</li>
  <li>If sending bulk email using an address list you acquired or purchased from others there may be legal rammifications for sending unsolicited email.</li>
</ul>
<br/>
<p>This module can and will require significant additional resources on your host.  The minimum CMS Made Simple requirements <strong>are probably not sufficient</strong>.  You should be prepared to debug issues, and contact your host to increase limits such as memory limit and timeouts before using this module.  This module is best used on a host where you have complete control of the php settings.</p>
<p>The developers and supporters of this package assume no risk or responsibility for its improper use. <strong>Use At Your Own Risk.</strong></p>
<h4>How do I use it?</h4>
<ol>
<li>Install the module (which you have probably done by this point).</li>
<li>Ensure that the CMSMailer module is properly configured and that the test function works as expected.</li>
<li>Grant appropriate permissions to the groups that will manage your lists. these include:
	<ul>
	<li>Manage NMS Lists &mdash; Add, remove mailing lists</li>	
	<li>Manage NMS Users &mdash; Add, remove users in the database</li>
	<li>Manage NMS Messages &mdash; Add, edit, remove messages but not send them</li> 	
	<li>Manage NMS Jobs &mdash; Send messages and perform other &#039;job&#039; functions</li>	
	</ul>
</li>
<li>Create a list</li>
<li>(Optional) Add the {NMS} to a page to enable web site visitors to sign up for your list.</li>
<li>(Optional) Add users to your list manually with the Users tab in the admin system</li>
<li>Create a message to be sent as part of a job</li>
<li>Create a job. You will select a message to send and a list to send it to.</li>
<li>Process the job and your message will be sent
    <p><strong>Note:</strong> NMS will only send messages to &#039;confirmed&#039; users.  You need at least one confirmed user in at least one list.</p>
</li>
</ol>

<h4>Basic Syntax:</h4>
<p>{NMS}  </p>

<h5>Further options:</h5>
<p>See below for a complete list of available parameters and their options.</p>

<h5>Display unsubscribe form:</h5>
<p>{NMS mode=&#039;unsubscribe&#039;}</p>

<h5>Display the user settings page:</h5>
<p>{NMS mode=&#039;usersettings&#039;}</p>

<h5>Display an archive of past newsletters:</h5>
<p>{NMS action=&#039;archivelist&#039;}</p>
<ul>
<lh>Optional parameters for the archive:</lh>
<li>limit=&#039;#&#039; where <code>#</code> is the number of past newsletters to show. If omitted, all are shown</li>
<li>sortby=&#039;date&#039; &mdash; <code>date</code> (default), <code>id</code> (message ID), or <code>subject</code></li>
<li>sortorder=&#039;DESC&#039; &mdash; either <code>DESC</code> (descending order, default) or <code>ASC</code> (ascending order)</li>
</ul>		

<h4>Import users from the Front End Users database</h4>
<p>Note: You must have a property defined in FEU that stores the users&#039; email address. It can be named whatever you want.</p>
<ol>
<li>Choose Extensions > Newsletter Made Simple</li>
<li>Activate the Users tab</li>
<li>At the bottom, click Import Users from FrontEndUsers</li>
<li>Select the FEU field that contains the users&#039; email addresses</li>
<li>Specify whether to copy the FEU user name to the NMS user name field. This is what would be output in your message if you included the {<span>$</span>username} placeholder.</li>
<li>Select the list to import to.</li>
<li>Click Submit.</li>
</ol>
<p>You will receive a report of the users processed, those already in your NMS database, those already on the list, and those that were added and subscribed. Users are not duplicated so there should be no harm in running an import periodically.</p>

<h4>Message variables:</h4>
<p>These are covered elsewhere, but added here for completeness. If you add these to your message, they will be replaced at sending time with the appropriate true values.</p>

<ul>
<li>{<span>$</span>username}  &mdash;  The user&#039;s name</li>
<li>{<span>$</span>email}  &mdash;  The user&#039;s email address</li>
<li>{<span>$</span>unsubscribe}  &mdash;  A URL that can be used to display a page for unsubscribing</li>
<li>{<span>$</span>preferences}  &mdash;  A URL that can be used to display a user preferences page</li>
<li>{<span>$</span>confirmurl}  &mdash;  A URL that can be used to confirm subscriptions</li>
</ul>
<h4>Bounce Processing:</h4>
<p>The built in bounce processing capabilities allow reading a pop3 mailbox and searching the mails in that inbox for matching messages.  If the user can be properly detected, the &#039;bounce count&#039; for that user will be incremented.  Once the &#039;bounce limit&#039; is reached, the user will be disabled.</p>
<p><strong>Note:</strong> Your hosts email server configuration may be such that you don&#039;t receive bounce notifications in your pop3 mail box.  You may have to work with your hosting provider to ensure that this functionality works for you.</p>
<p>It is strongly recommended that you configure your sending email address to be the same as your pop3 email account, and that you use this account only for bounce processing.</p>

<h4>Message Template Tips:</h4>
<h5>Styling:</h5>
<p>For maximum results when sending html email messages do not refer to external stylesheets, or to external images.  Most email clients will not read external stylesheets, and will block links to external images.</p>
<h5>Content Blocks:</h5>
<p>The following special smarty tags are avaiable for use in NMS message templates.  The use of these smarty tags in your template will enable different content blocks or functionalities when defining or editing message:
<ul>

<li>{nms_content name=&#039;block name&#039;}
    <p>This tag defines a content block.  When editing a message a text area will be provided for each nms_content tag in your template.</p>
    Options:<br/>
    <ul>
    <li><em>wysiwyg=&#039;false&#039;</em> : disable the wysiwyg for this content area</li>
    <li><em>oneline=&#039;true&#039;</em> : provide a text input field instead of a text area</li>
    <li><em>prompt=&#039;name&#039;</em> : Specify text for the prompt for this field when editing a message that uses this template.
    </ul><br/>
    </p>
</li>

<li>{nms_attachment name=&#039;block name&#039;}
    <p>This tag defines a reference to an attached file (usually not an imaage).  When editing a message, a dropdown will be provided to allow the message editor to select a file that has already been uploaded to your website.  Upon sending a message, this file will be attached to your message.  Any references to this block will be replaced with links to the embedded file.
    Options:<br/>
    <ul>
    <li><em>prompt=&#039;name&#039;</em> : Specify text for the prompt for this field when editing a message that uses this template.
    </ul><br/>
    </p>
</li>

<li>{nms_image name=&#039;block name&#039;}
    <p>This tag defines a reference to an attached image.  When editing a message, a dropdown will be provided to allow the message editor to select an image that has already been uploaded to your site.  When the message is sent, this image will be embedded into your message, and all references to it will be replaced with links to the embedded image.
    Options:<br/>
    <ul>
    <li><em>prompt=&#039;name&#039;</em> : Specify text for the prompt for this field when editing a message that uses this template.
    <li><em>src=&#039;image_name&#039;</em> : Specify an image filename.  If this parameter is set there will be no prompt in the message edit form to supply a value for this field.</li>
    <li>You can also specify other attributes for this tag, including alt, width, height, class, id, etc.  Anything that is XHTML valid.</li>
    </ul><br/>
    </p>
</li>
</ul>
</p>

<h4>Support:</h4>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report  please visit <a href=&#039;http://dev.cmsmadesimple.org/projects/newsletter/&#039; target=&#039;_blank&#039;>http://dev.cmsmadesimple.org/projects/newsletter/</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=&#039;http://forum.cmsmadesimple.org&#039; target=&#039;_blank&#039;>CMS Made Simple Forums</a>.</li>
<li>The author, Robert Campbell, can often be found in the <a href=&#039;irc://irc.freenode.net/#cms&#039;>CMS IRC Channel</a> (username: calguy1000).</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h4>Copyright and License</h4>
<p>Copyright &copy;, 2007, Robert Campbell <a href=&#039;mailto:calguy1000@hotmail.com&#039;>calguy1000@hotmail.com</a>.  All Rigts Are Reserved.</p>
<p>Credits to the original author of the module:, Paul Lemke <a href=&#039;mailto:lemkepf@gmx.net&#039;><lemkepf@gmx.net></a></p>
<p>This module has been released under the <a href=&#039;http://www.gnu.org/licenses/licenses.html#GPL&#039;>GNU Public License</a>. You must agree to this license before using the module.</p>
';
$lang['import_feu_title'] = 'Import Users from FrontEndUsers';
$lang['import_feu_info'] = 'Select the FEU group to import into NMS. <em>(only groups with an email address field are displayed)</em>';
$lang['import_feu_noproperties'] = 'You have not defined any properties in the Front End Users module. You must define at least one property to store the users&#039;s email addresses.';
$lang['import_feu_prompt_groupname'] = 'FrontEndUsers Group';
$lang['import_feu_prompt_copyusername'] = 'Copy FEU user name to NMS?';
$lang['import_feu_info_copyusername'] = '<em>If No is selected, the username will be left blank.</em>';
$lang['import_feu_selectlists'] = 'Import users to (list name)';
$lang['import_feu_feunotinstalled'] = 'The Front End Users module is not installed or the properties definition table does not exist. Cannot import users from FEU.';
$lang['processedAddressesTitle'] = 'Processed addresses';
$lang['inDatabaseTitle'] = 'Already in NMS';
$lang['onListAlreadyTitle'] = 'Already subscribed';
$lang['addressSubscribedTitle'] = 'Subscribed';
$lang['listidInfo'] = 'Importing to list ID: ';
$lang['processedAddressesCountInfo'] = 'Addresses processed: ';
$lang['archive_heading'] = '<h1>Archive of messages</h1>';
$lang['archivedmessage'] = '<h1>Archived message</h1>';
$lang['archive_tbl_msgID'] = 'Msg ID';
$lang['archive_tbl_subject'] = 'Subject';
$lang['archive_tbl_fullurl'] = 'Message link';
$lang['archive_tbl_href'] = 'Link target';
$lang['archive_tbl_date'] = 'Date';
$lang['utma'] = '156861353.3215545266732019000.1241091787.1253614635.1253625005.123';
$lang['utmz'] = '156861353.1253112986.115.25.utmccn=(referral)|utmcsr=forum.cmsmadesimple.org|utmcct=/index.php/topic,15318.0.html|utmcmd=referral';
$lang['qca'] = '1240683615-58409973-79915303';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1253625005';
?>