<?php
setlocale(LC_ALL, 'sk_SK.UTF8');
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

require_once(dirname(__FILE__)."/function.utils.php");

require_once(dirname(__FILE__)."/defines.php");
class NMS extends CGExtensions
{
  var $_actionid;
  var $current_message;
  var $attached_files;
  var $attached_images;
  var $processing_prefspage;	
  var $defaultcharset = 'iso-8859-1';
  var $default_subscribe_email_body = '
Hello {$username}.
Someone, hopefully you, has subscribed your email address to the following newsletters:
{foreach from=$lists item=list}
* {$list}
{/foreach}
If this is correct, please click the following link to confirm your subscription or copy and paste the link into your web browser. Without this confirmation, you will not receive any newsletters. {$confirmurl} If you did not sign up for this newsletter you do not need to do anything, simply delete this message. Thank you!';
  var $default_message_template = '
   <html>
   <body>
   <h1>Hello {$username}</h1>
   <p>
   Have a good day, and again, welcome.
   </p>

   <hr />
   <p>If you have received this message to this email address: {$email} it means that you are a member of one or more
   lists on our website.  You have a number of options, you can ignore the message (this is probably safe to do),
   or you can:
   <ul>
   <li>Unsubscribe:  Just follow this link <a href="{$unsubscribe}" title="unsubscribe">{$unsubscribe}</a></li>
   <li>Change your preferences:  Just follow this link <a href="{$preferences}" title="Preferences">{$preferences}</a></li>
   <li>Confirm that this is a valid email address by following this link: <a href="{$confirmurl}" title="Confirm">{$confirmurl}</a></li>
   </ul>
   </p>

   </body>
   </html>
';
  var $default_confirm_email_body = '
Thank you {$username} for subscribing to the mailing list {$listname}.  Your registration has been confirmed.  At any time you can unsubscribe from this list by following this link {$unsubscribeurl}.  You may also change your preferences by following this link: {$preferencesurl}';
  var $default_post_email_confirm_message = '
Thank you {$username}.  Your email address {$email} has been marked as confirmed as of {$dateconfirmed|cms_date_format}.  Your uniquid (for future reference) is {$uniqueid}';
  var $default_subscribe_form = '
	{if $message ne ""}
	<br /><span class="nms_message">{$message}</span><br />
	{/if}
	{$formstart}
		{$formhidden}
        {if $prompt_email ne ""}
		{$prompt_email}:&nbsp;{$email}<br />
        {/if}
        {if $prompt_username ne ""}
                {$prompt_username}:&nbsp;{$username}<br />
        {/if}
		{foreach from=$listids item=curr_id}
		  {$curr_id}<br/>
		{/foreach}
		{$submitbtn}
	{$formend}';
  var $default_unsubscribe_email_body = '
Hello {$username} <{$email}>

This message is to confirm that it is indeed you that has chosen to unsubscribe from all of the
mailing lists with us.  if this is indeed the case, please confirm this action by clicking 
on the following link:
{$confirm_unsubscribe_url}

If you did not instantiate this action, you can safely ignore this message.

Thank you.
';
  var $default_unsubscribe_prompt = 'Enter your email to unsubscribe';
  var $default_unsubscribe_form = '
	{if $message ne ""}
	<br /><span class="nms_message">{$message}</span><br/>
	{/if}
	{$formstart}
	{$formhidden}
        {if $prompt_email ne ""}
		{$prompt_email}:&nbsp;{$email}<br/>
        {/if}
	{$submitbtn}
	{$formend}';
  var $default_unsubscribe_text = '
Thank you {$username}.  An email as been sent to {$email} to confirm your wish to unsubscribe from all mailing lists on this site.  You should be receiving it shortly.  Thank you';
  var $default_post_unsubscribe_text = '
Thank you {$username} <{$email}>.  You have now been unsubscribed from all public mailing lists.  We are sorry to see you go.
';
  var $default_usersettings_subject = 'User Settings Information';
  var $default_usersettings_email_body = '
Thank you {$username} <{$email}>.  You requested information as to how to change your subscription information.  Here it is:

Follow this link to adjust your settings:
{$usersettings_url}

Follow this link to completely unsubscribe from all public mailing lists:
{$unsubscribe_url}
';
  var $default_usersettings_text = '
Thank you {$username <{$email}>.  An email has been sent to {$email} with further instructions.
';
  var $default_usersettings_form = '
	{if $message ne ""}
	<br/><span class="nms_message">{$message}</span><br/>
	{/if}
	{$formstart}
	{$formhidden}
        {if $prompt_email ne ""}
		{$prompt_email}:&nbsp;{$email}<br/>
        {/if}
	{$submitbtn}
	{$formend}';
  var $default_usersettings_form2 = '
	{if $message ne ""}
	<br/><span class="nms_message">{$message}</span><br/>
	{/if}
	{$formstart}
	{$formhidden}
	{$prompt_username}:&nbsp;{$username}<br/>
	{foreach from=$listids item=curr_id}
	  {$curr_id}<br/>
	{/foreach}
	{$submitbtn}
	{$formend}';
  var $default_usersettings_text2 = '
Thank you {$username} <{$email}>, your settings have been changed.
';
        

  /*---------------------------------------------------------
   Module Constructor
   ---------------------------------------------------------*/
  function __construct()
  {
    parent::__construct();
    $this->_actionid = '';
    $this->attached_images = array();
    $this->attached_files = array();
    $this->current_message = -1;
    $this->processing_prefspage = NULL;

    $gCms = cmsms();
    $smarty = $gCms->GetSmarty();

    if( version_compare(CMS_VERSION,'1.11-alpha0') < 0 ) {
      $smarty->register_resource("nms_content",
                                array(&$this,
                                      "nms_content_get_block",
                                      "nms_content_get_timestamp",
                                      "db_get_secure", 
                                      "db_get_trusted"));
    }
    else {
      $smarty->registerResource('nms_content',new NMSContentResource($this));
    }

    // at the same time, we'll register a few smarty plugins
    $smarty->register_function('nms_image',
			       array(&$this,'function_nms_image'));
    $smarty->register_function('nms_attachment',
			       array(&$this,'function_nms_attachment'));
    $smarty->register_function('nms_content',
			       array(&$this,'function_nms_content'));
    $smarty->register_function('nms_getmessage',
			       array(&$this,'function_nms_getmessage'));
  }


  /*---------------------------------------------------------
   Set the action id
   ---------------------------------------------------------*/
  function set_action_id($id)
  {
    $this->_actionid = $id;
  }


  /*---------------------------------------------------------
   Return the current action id
   ---------------------------------------------------------*/
  function get_action_id()
  {
    return $this->_actionid;
  }


  /*---------------------------------------------------------
   Return the module name
   ---------------------------------------------------------*/
  function GetName()
  {
    return 'NMS';
  }


  /*---------------------------------------------------------
   Return an array of the module dependencies.
   ---------------------------------------------------------*/
  function GetDependencies()
  {
    return array( 'CMSMailer' => '1.73.8',
                  'CGExtensions' => '1.27.5');
  }


  /*---------------------------------------------------------
   GetEventDescription( $name )
   ---------------------------------------------------------*/
  function GetEventDescription( $name )
  {
    return $this->Lang('info_event_'.$name );
  }


  /*---------------------------------------------------------
   GetEventHelp( $eventname )
   ---------------------------------------------------------*/
  function GetEventHelp ( $eventname )
  {
    return $this->Lang ('help_'.$eventname);
  }


  function AllowAutoInstall()
  {
    return FALSE;
  }


  function AllowAutoUpgrade()
  {
    return FALSE;
  }


  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

	
  function GetVersion()
  {
    return '2.4.3';
  }


  function GetHelp()
  {
    return $this->Lang('help');
  }


  function GetAuthor()
  {
    return 'Robert Campbell';
  }


  function GetAuthorEmail()
  {
    return 'calguy1000@cmsmadesimple.org';
  }


  function GetChangeLog()
  {
    //return $this->Lang('changelog');
    return $this->ProcessTemplate('changelog.tpl');
  }


  function IsPluginModule()
  {
    return true;
  }


  function HasAdmin()
  {
    return true;
  }
	

  function VisibleToAdminUser()
  {
    $x = 
      $this->CheckPermission('Manage NMS Users') ||
      $this->CheckPermission('Manage NMS Jobs') ||
      $this->CheckPermission('Manage NMS Lists') ||
      $this->CheckPermission('Manage NMS Messages') ||
      $this->CheckPermission('Manage NMS Preferences') ||
      $this->CheckPermission('Modify Templates') ||
      $this->CheckPermission('Modify Site Preferences');

    return $x;
  }


  function SetParameters()
  {
    $this->RegisterModulePlugin();
    $this->RestrictUnknownParams();
    $this->AddImageDir('icons');

    $this->CreateParameter('action', 'default', $this->Lang('helpaction'));

    $this->CreateParameter('mode', 'subscribe', $this->Lang('helpmode'));
    $this->SetParameterType('mode',CLEAN_STRING);

    $this->CreateParameter('archivelist_template','',
        $this->Lang('help_archivelist_template'));
    $this->SetParameterType('archivelist_template',CLEAN_STRING);
    $this->CreateParameter('archivemsg_template','',
        $this->Lang('help_archivemsg_template'));
    $this->SetParameterType('archivemsg_template',CLEAN_STRING);

    $this->CreateParameter('select', NULL, $this->Lang('helpselect'));
    $this->SetParameterType('select',CLEAN_STRING);

    $this->CreateParameter('limit','',$this->Lang('help_limit'));
    $this->SetParameterType('limit',CLEAN_INT);

    $this->CreateParameter('sortby','entered',$this->Lang('help_sortby'));
    $this->SetParameterType('sortby',CLEAN_STRING);

    $this->CreateParameter('sortorder','DESC',$this->Lang('help_sortorder'));
    $this->SetParameterType('sortorder',CLEAN_STRING);

    $this->SetParameterType('msgID',CLEAN_INT);

    // internal params (users don't use these on tags)
    $this->SetParameterType('message',CLEAN_STRING);
    $this->SetParameterType('error',CLEAN_INT);
    $this->SetParameterType('email',CLEAN_STRING);
    $this->SetParameterType('username',CLEAN_STRING);
    $this->SetParameterType('lists',CLEAN_STRING);
    $this->SetParameterType('submit',CLEAN_STRING);
    $this->SetParameterType('uniqueid',CLEAN_STRING);
    $this->SetParameterType('subaction',CLEAN_STRING);
    $this->SetParameterType('value',CLEAN_STRING);
    $this->SetParameterType('usersettings',CLEAN_STRING);

    $this->RegisterRoute('/[Nn][Mm][Ss]\/(?P<returnid>[0-9]+)\/(?P<subaction>.*?)\/(?P<value>[0-9a-f]+)$/');

  }


  function GetAdminSection()
  {
    return 'extensions';
  }


  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }


  function MinimumCMSVersion()
  {
    return "1.10.1";
  }


  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }
	

  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }


  /*---------------------------------------------------------
   DoAction($action, $id, $params, $returnid)
   This is the main function that gets called if your module
   is a plug-in type module.
   ---------------------------------------------------------*/
  function DoAction($action, $id, $params, $returnid='')
  {
    global $gCms;
    $smarty = $gCms->GetSmarty(); $smarty->assign('formid',$id);
    $smarty->assign('mod',$this);

    switch( $action )
      {
      case 'delete_email':
	if ($this->CheckPermission('Manage NMS Users'))
	  {
	    $status = $this->DeleteEmail($id, $params, $returnid);
	    $parms = array();
	    if( !$status )
	      {
		$this->parms['error'] = 1;
		$this->parms['message'] = $this->Lang('errordeletinguser');
	      }
	    $this->RedirectToTab($id,'users');
	  }
	else
	  {
	    $this->_DisplayErrorPage($id, $params, $returnid, 
				     $this->Lang('accessdenied'));
	  }
	break;

      case 'pause_job':
	if ($this->CheckPermission('Manage NMS Jobs'))
	  {
	    $message = $this->_AdminDoPauseJob($id, $params, $returnid);
	  }
	else
	  {
	    $this->_DisplayErrorPage($id, $params, $returnid, 
				     $this->Lang('accessdenied'));
	  }
	break;

      case 'reset_job':
	if ($this->CheckPermission('Manage NMS Jobs'))
	  {
	    $message = $this->_AdminDoResetJob($id, $params, $returnid);
	  }
	else
	  {
	    $this->_DisplayErrorPage($id, $params, $returnid, 
				     $this->Lang('accessdenied'));
	  }
	break;

      case 'resume_job':
	if ($this->CheckPermission('Manage NMS Jobs'))
	  {
	    $message = $this->_AdminDoResumeJob($id, $params, $returnid);
	  }
	else
	  {
	    $this->_DisplayErrorPage($id, $params, $returnid, 
				     $this->Lang('accessdenied'));
	  }
	break;
	
      // fallback through to call the action.xxxx.php file
      default:
	parent::DoAction( $action, $id, $params, $returnid );
	break;
      }
  }
	

  /*---------------------------------------------------------
   _AdminDoPauseJob($id, $params, $returnid, $message)
   ---------------------------------------------------------*/
  function _AdminDoPauseJob($id, &$params, $returnid)
  {
    if( !isset( $params['jobid'] ) )
      {
	$this->_DisplayErrorPage( $id, $params, $returnid,
				  $this->Lang('error_insufficientparams'));
	return;
      }

    $db = $this->GetDb();
    $q = "UPDATE ".NMS_JOBS_TABLE." SET status = ? WHERE jobid = ?";
    $dbresult = $db->Execute( $q, array( 2, $params['jobid'] ) );
    $this->RedirectToTab($id,'jobs');
  }


  /*---------------------------------------------------------
   _AdminDoResetJob($id, $params, $returnid, $message)
   ---------------------------------------------------------*/
  function _AdminDoResetJob($id, &$params, $returnid)
  {
    if( !isset( $params['jobid'] ) )
      {
	$this->_DisplayErrorPage( $id, $params, $returnid,
				  $this->Lang('error_insufficientparams'));
	return;
      }

    $db = $this->GetDb();

    // drop the temporary table
    $dict = NewDataDictionary( $db );
    $sqlarray = $dict->DropTableSQL( NMS_TEMP_TABLE );
    $dict->ExecuteSQLArray($sqlarray);

    $q = "UPDATE ".NMS_JOBS_TABLE." SET status = ? WHERE jobid = ?";
    $dbresult = $db->Execute( $q, array( 0, $params['jobid'] ) );

    $this->SetCurrentTab('jobs');
    $this->RedirectToTab($id);
  }


  /*---------------------------------------------------------
   _AdminDoResumeJob($id, $params, $returnid, $message)
   ---------------------------------------------------------*/
  function _AdminDoResumeJob($id, &$params, $returnid)
  {
    if( !isset( $params['jobid'] ) )
      {
	$this->_DisplayErrorPage( $id, $params, $returnid,
				  $this->Lang('error_insufficientparams'));
	return;
      }

    $db = $this->GetDb();
    $q = "UPDATE ".NMS_JOBS_TABLE." SET status = ? WHERE jobid = ?";
    $dbresult = $db->Execute( $q, array( 0, $params['jobid'] ) );
    $this->RedirectToTab($id,'jobs');
  }


  /*---------------------------------------------------------
   _ProcessOneEmail($id,&$messasge,$destrow)
   ---------------------------------------------------------*/
  protected function _ProcessOneEmail($id,&$message,$destrow,$job_id = -1)
  {
    if( !$this->_isValidEmail($destrow['email']) ) {
      $query = 'UPDATE '.NMS_USERS_TABLE.' SET error_count = COALESCE(error_count,0) + 1 WHERE email = ?';
      $db = cmsms()->GetDb();
      $db->Execute($query,array($destrow['email']));
      audit('',$this->GetName().'Error sending email to '.$destrow['email'].': invalid email address');
      return;
    }

    $gCms = cmsms();
    $smarty = $gCms->GetSmarty();
    $config = $gCms->GetConfig();
    if( $this->processing_prefspage == NULL )
      {
        //
        // Do this on processing the first message
        //
        $prefspage = $this->GetPreference('usersettings_page');
        $contentops = $gCms->GetContentOperations();
        if( $prefspage == '' )
 	  {
	    $prefspage = $contentops->GetDefaultPageID();
	  }
        $content = $contentops->LoadContentFromAlias($prefspage);
        if( !$content )
        {
	   $prefspage = $contentops->GetDefaultPageID();
	}
        $this->processing_prefspage = $prefspage;

      }

    $prefspage = $this->processing_prefspage;

    //
    // Do this every time the messageid changes
    //
    if( $message['messageid'] != $this->current_message )
      {
        $this->attached_images = array();
        $this->attached_files = array();
        $this->current_message = $message['messageid'];
      }

    // Setup the message
    $mailer = $this->GetModuleInstance('CMSMailer');
    $mailer->reset();
    $mailer->ClearAllRecipients();	
    $mailer->SetSubject($message['subject']);
    $mailer->SetCharSet($this->GetPreference('message_charset'));
    $mailer->SetFromName($this->GetPreference('admin_name'));
    $mailer->SetFrom($this->GetPreference('admin_email'));
    $mailer->AddCustomHeader('X-NMS_MessageID: '.$message['messageid']);
    $mailer->AddCustomHeader('X-NMS_ListMember: '.$destrow['email']);
    if( isset($destrow['uniqueid']) )
      {
	$mailer->AddCustomHeader('X-NMS_MemberID: '.$destrow['uniqueid']);
      }
    $mailer->AddCustomHeader("Precedence: bulk");
    $mailer->AddCustomHeader("X-Mailer: CMS Made Simple ".CMS_VERSION.' ('.$this->GetName()." ".$this->GetVersion().' )');
    $replyto = $this->GetPreference('admin_replyto');
    if( !empty($replyto) )
    {
      $mailer->AddReplyTo($replyto);
    }

    //
    // setup smarty
    //
    if( !empty($message) )$smarty->assign('message', $message);

    $smarty->assign('subject',$message['subject']);
    if( isset($destrow['username']) )
      {
	$smarty->assign('username',$destrow['username']);
      }
    $smarty->assign('email',$destrow['email']);
    if( isset($destrow['uniqueid']) )
      {
	$smarty->assign('uniqueid',$destrow['uniqueid']);

	$link = $this->_CreatePrettyLink( $id, $message['pageid'], 'unsubscribe_email','', 
					  array('uniqueid'=>$destrow['uniqueid']), 
					  '', true, '', true);
	$smarty->assign('unsubscribe',$link);
	
	$link = $this->_CreatePrettyLink( $id, $prefspage, 'usersettings', '',
					  array('uniqueid'=>$destrow['uniqueid']),
					  '', true, '', true);
	$smarty->assign('preferences',$link);
	
	$link = $this->_CreatePrettyLink( $id, $message['pageid'], 'confirm_email','',
					  array('showtemplate'=>false,'uniqueid'=>$destrow['uniqueid']),
					  '', true, '', true);
	$smarty->assign('confirmurl',$link);
    
    $link = $this->_CreatePrettyLink( $id, $message['pageid'], 'showmessage','',
					  array('showtemplate'=>false,'msgID'=>$this->current_message),
					  '', true, '', true);
    $smarty->assign('msg_permalink',$link);
      }

	foreach ($this->GetModulesWithCapability('nms_vars') as $one_module)
	{
	  $obj = cms_utils::get_module($one_module);
	  if( !is_object($obj) ) continue;
	  $obj->SetSmartyVars($id, $job_id, $message['messageid'], $destrow['email'], $smarty, 'send');
	}

    //
    // do the processing				
    //
    $htmlbody = '';
    if( !$message['text_only'] )
      {
	$htmlbody = $this->ProcessTemplateFromDatabase($message['template']);
      }
    $textbody = $this->ProcessTemplateFromData($message['message']);
    if( empty($htmlbody) && empty($textbody)  )
      {
	return false;
      }

    // Postprocess the text
    // and create absolute links
    if( !$message['text_only'] )
      {
	$htmlbody = make_absolute_links($htmlbody,$config['root_url']);
      }
    $textbody = make_absolute_links($textbody,$config['root_url']);

    //
    // attach the attachments
    //
    foreach( $this->attached_images as $obj )
    {
      $fn = cms_join_path($config['image_uploads_path'],$obj->filename);
      if( !file_exists($fn) ) continue;
      $mimetype = cge_utils::get_mime_type($fn);
      if( empty($mimetype) || $mimetype == 'unknown' )
	{
	  $mimetype = 'application/octet-stream';
	}
      $mailer->AddEmbeddedImage($fn,$obj->cid,basename($obj->filename),'base64',$mimetype);
    }
    foreach( $this->attached_files as $onefile )
    {
      $fn = cms_join_path($config['uploads_path'],$onefile);
      $mailer->AddAttachment($fn,$onefile);
    }

    //
    // handle the mail contents
    //
    if( !empty($htmlbody) )
      {
	$mailer->IsHTML(true); 
	$mailer->SetBody($htmlbody);
	if( !empty($textbody) )
	  {
	    $mailer->SetAltBody($textbody);
	  }
      }
    else
      {
	$mailer->IsHTML(false);
	$mailer->SetBody($textbody);
      }

    //
    // Add the destination and send it
    //
    $res = $mailer->AddAddress($destrow['email']);
    if( $res ) $res = $mailer->Send();

    if( !$res || $mailer->the_mailer->ErrorInfo != '' )
      {
	// error sendimg message.
	audit('',$this->GetName(),'Error sending email to '.$destrow['email'].' '.$mailer->the_mailer->ErrorInfo);
	$query = 'UPDATE '.NMS_USERS_TABLE.' SET error_count = COALESCE(error_count,0) + 1 WHERE email = ?';
	$db = $gCms->GetDb();
	$db->Execute($query,array($destrow['email']));
	$mailer->the_mailer->ErrorInfo = '';
      }
  }


  function _cleanLink($strMessage)
  {
    $strMessage = str_replace('&amp;', '&',$strMessage);
    	
    return $strMessage;
  }


  function DeleteEmail($id, &$params, $returnid )
  {
    $db = &$this->GetDb();
		
    $query = "DELETE FROM ".NMS_USERS_TABLE." WHERE userid = ?";
    $dbresult = $db->Execute($query,array($params['userid']));	
    if( $dbresult )
      {
	$query = "DELETE FROM ".NMS_LISTUSER_TABLE." WHERE userid = ?";
	$dbresult = $db->Execute($query,array($params['userid']));	
      }

    if ($dbresult){
      // send an event
      $parms = array( 'id' => $params['userid'] );
      $this->SendEvent('OnDeleteUser',$parms);

      return true;
    }else{
      $params['error'] = 1;
      $params['message'] = $db->GetErrorMsg();
      return false;
    }
  }
    
    
  /*---------------------------------------------------------
   _DisplayErrorPage($id, $params, $returnid, $message)
   ---------------------------------------------------------*/
  function _DisplayErrorPage($id, &$params, $returnid, $message='')
  {
    global $gCms;
    $smarty = $gCms->GetSmarty();
    $smarty->assign('title_error', $this->Lang('error'));
    if ($message != '')
      {
	$smarty->assign('message', $message);
      }
    
    // Display the populated template
    echo $this->ProcessTemplate('error.tpl');
  }


  /*---------------------------------------------------------
   _statusToText( $status );
   ---------------------------------------------------------*/
  function _statusToText( $status )
  {
    switch( $status )
      {
      case -1:
	return $this->Lang('status_error');
      case 0:
	return $this->Lang('status_unstarted');
      case 1:
	return $this->Lang('status_inprogress');
      case 2:
	return $this->Lang('status_paused');
      case 3:
	return $this->Lang('status_complete');
      default:
	return $this->Lang('status_unknown');
      }
  }

  ####################
  #
  # Smarty Plugins
  #
  ####################


  /*---------------------------------------------------------
   nms_content_get_block 
   -
   A smarty function to extract one content block from a 
   message template.
   ---------------------------------------------------------*/
  function nms_content_get_block($tpl_name, &$tpl_source, &$smarty_obj)
  {
    global $gCms;
    $db = $gCms->GetDb();
    $config = $gCms->GetConfig();

    if( empty($tpl_name) )
      {
	//return '<!-- ERROR: nms_content_get_block no block name specified -->';
	return false;
      }
    if( $this->current_message == NULL || $this->current_message <= 0 )
      {
	//return '<!-- ERROR: nms_content_get_block no current message -->';
	return false;
      }

    $query = 'SELECT value FROM '.NMS_MESSAGE_CONTENT_TABLE.'
               WHERE name = ? AND messageid = ?';
    $tpl_source = $db->GetOne($query,array($tpl_name,$this->current_message));
    return true;
  }

  
  /*---------------------------------------------------------
   nms_content_get_timestamp
   -
   A smarty function to get the modification date of a particular
   message
   ---------------------------------------------------------*/
  function nms_content_get_timestamp( $tpl_name, &$tpl_timestap, &$smarty_obj )
  {
    // this should mean that the template always changes, and force recompile
    $tpl_timestamp = time();
    return true;
  }


  /*---------------------------------------------------------
   db_get_secure
   -
   A placeholder function
   ---------------------------------------------------------*/
  function db_get_secure($tpl_name, &$smarty_obj)
  {
    // assume all templates are secure
    return true;
  }

  
  /*---------------------------------------------------------
   db_get_trusted
   -
   A placeholder function
   ---------------------------------------------------------*/
  function db_get_trusted($tpl_name, &$smarty_obj)
  {
    // not used for templates
  }


  /*---------------------------------------------------------
   function_nms_content
   -
   A function to provide the {nms_content} tag
   ---------------------------------------------------------*/
  function function_nms_content($params, &$smarty)
  {
    if( $this->current_message == NULL || $this->current_message <= 0 )
      {
	// do nothing
	return;
      }
    
    if( !isset($params['name']) )
      {
	// do nothing
	return;
      }

    $name = str_replace(' ','_',$params['name']);
    $smarty->force_compile = true;
    $result = $smarty->fetch("nms_content:$name",$this->current_message);
    $smarty->force_compile = false;

    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$result);
	return;
      }
    return $result;
  }


  /*---------------------------------------------------------
   function_nms_image
   -
   A function to provide the {nms_image} tag
   ---------------------------------------------------------*/
  function function_nms_image($params, &$smarty)
  {
    if( $this->current_message == NULL || $this->current_message <= 0 )
      {
	// do nothing
	return;
      }
    
    if( !isset($params['name']) )
      {
	// do nothing
	return;
      }

    $filename = '';
    $cid = '';
    // Check for the src argument
    if( isset($params['src']) )
      {
	$filename = $params['src'];
	$cid = md5(basename($filename));
	
	$obj = new StdClass();
	$obj->filename = $filename;
	$obj->cid = $cid;
	$this->attached_images[$params['name']] = $obj;
      }
    else
      {
	// Check the cache
	if( is_array($this->attached_images) &&
	    isset($this->attached_images[$params['name']]) )
	  {
	    // woot, it's cached
	    $obj =& $this->attached_images[$params['name']];
	    $filename = $obj->filename;
	    $cid = $obj->cid;
	  }
	else
	  {
	    // get the filename from the database
	    $db = $this->GetDb();
	    $query = 'SELECT value FROM '.NMS_MESSAGE_CONTENT_TABLE.'
               WHERE name = ? AND messageid = ?';
	    $filename = $db->GetOne($query,array($params['name'],$this->current_message));
	    if( !$filename || $filename == -1 ) 
	      {
		// do nothing
		return;
	      }
	    $cid = md5(basename($filename));

	    // add it to the cache
	    $obj = new StdClass();
	    $obj->filename = $filename;
	    $obj->cid = $cid;
	    $this->attached_images[$params['name']] = $obj;
	  }
      }

    // 4.  format the output
    $basename = basename($filename);
    $txt = '<img src="cid:'.$cid.'" ';
    foreach( $params as $key => $value )
      {
	if( $key == 'name' ) continue;
	if( $key == 'src' ) continue;
	if( $key == 'prompt' ) continue;
	$txt .= sprintf("%s=\"%s\" ",$key,$value);
      }
    $txt .= '/>';

    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$result);
	return;
      }

    return $txt;
  }


  /*---------------------------------------------------------
   function_nms_attachment
   -
   A function to provide the {nms_attachment} tag
   ---------------------------------------------------------*/
  function function_nms_attachment($params, &$smarty)
  {
    if( $this->current_message == NULL || $this->current_message <= 0 )
      {
	// do nothing
	return;
      }
    
    if( !isset($params['name']) )
      {
	// do nothing
	return;
      }

    // 1.  Check the cache first
    $filename = '';
    if( is_array($this->attached_files) &&
	isset($this->attached_files[$params['name']]) )
      {
	// woot, it's cached
	$filename = $this->attached_files[$params['name']];
      }
    else
      {
	// 2.  get the filename from the database
	$db = $this->GetDb();
	$query = 'SELECT value FROM '.NMS_MESSAGE_CONTENT_TABLE.'
               WHERE name = ? AND messageid = ?';
	$filename = $db->GetOne($query,array($params['name'],$this->current_message));
	if( !$filename ) 
	  {
	    // do nothing
	    return;
	  }

	// add it to the cache
	$this->attached_files[$params['name']] = $filename;
      }

    return;
  }


  /*---------------------------------------------------------
   function_nms_getmessage
   -
   A function to provide the {nms_getmessage} tag
   ---------------------------------------------------------*/
  function function_nms_getmessage($params, &$smarty)
  {
    $msgid = '';
    if( isset($params['msg']) )
      {
	$msgid = (int)$params['msg'];
      }
    if( isset($params['messageid']) )
      {
	$msgid = (int)$params['messageid'];
      }
    // Set a member variable for use by the other nms plugins
    // so that they can know the message to work with.
    $this->current_message = $msgid;

    // retrieve the message
    $db = $this->GetDb();
    $query = 'SELECT * FROM '.NMS_MESSAGES_TABLE.' WHERE messageid = ?';
    $message = $db->GetRow($query,array($msgid));
    if( !is_array($message) ) return;
                          
    // process the template
    $template = $this->GetTemplate($message['template']);
    $text = $this->ProcessTemplateFromData($template);
    //    $text = $this->ProcessTemplateFromDatabase($message['template'],$message['messageid']);

    $this->current_message = -1;

    // return the results
    if( isset($params['assign']) )
      {
	$smarty->assign(trim($params['assign']),$result);
	return;
      }
    return $text;
  }

  ####################
  #
  # End of smarty functions
  #
  ####################


  /*---------------------------------------------------------
   _handle_user_bounce
   -
   Handle a bounce message for a single user.
   ---------------------------------------------------------*/
  function _handle_user_bounce(&$fields)
  {
    if( !is_array($fields) || !isset($fields['ListMember']) ||
	!isset($fields['MemberID']) )
      {
	return;
      }

    $db = $this->GetDb();

    // get the bounce count, and the disabled status
    $query = 'SELECT disabled,bounce_count FROM '.NMS_USERS_TABLE.'
               WHERE uniqueid = ? AND email = ?';
    $row = $db->GetRow($query,array($fields['MemberID'],$fields['ListMember']));
    if( !$row )
      {
	// user not found?
	// ignore this
	return;
      }
    if( !$row['bounce_count'] ) $row['bounce_count'] = 0;
    $row['bounce_count']++;

    // if the bounce count is now too high
    // make sure the user is disabled
    if( $row['bounce_count'] >= $this->GetPreference('bounce_limit',10) )
      {
	$row['disabled'] = 1;
      }

    // update the user record
    $query = 'UPDATE '.NMS_USERS_TABLE.' 
                 SET bounce_count = ?, disabled = ?
               WHERE uniqueid = ? AND email = ?';
    $db->Execute($query,
		 array($row['bounce_count'],$row['disabled'],
                       $fields['MemberID'],$fields['ListMember']));
  }


  /*---------------------------------------------------------
   _CreatePrettyLink
   -
   Create a pretty url for all frontend links
   ---------------------------------------------------------*/
  function _CreatePrettyLink( $id, $returnid, $action, $contents = '', 
			   $params = array(), $warn_message = '',
			   $onlyhref = false, $inline = true, $addtext = '',
			   $targetcontentonly = false)
  {
    global $gCms;
    $config = $gCms->GetConfig();
  
    $pretty = false;
    if( $config['assume_mod_rewrite'] === true ||
	$config['internal_pretty_urls'] === true )
      {
	$pretty = true;
      }
  
    if( $pretty === false )
      {
	$link = $this->CreateFrontendLink($id,$returnid,$action,$contents,
					  $params,$warn_message,$onlyhref,
					  $inline,
					  $addtext,$targetcontentonly);
	return $link;
      }
  
    $str = sprintf('NMS/%d',$returnid);
    switch( $action )
      {
      case 'unsubscribe':
	{
	  if( isset($params['uniqueid']) )
	    {
	      $url = $str.'/unsub/'.$params['uniqueid'];
	    }
	}
	break;
      
      case 'unsubscribe_email':
	{
	  if( isset($params['uniqueid']) )
	    {
	      $url = $str.'/unsub_email/'.$params['uniqueid'];
	    }
	}
	break;
      
      case 'usersettings':
	{
	  if( isset($params['uniqueid']) )
	    {
	      $url = $str.'/settings/'.$params['uniqueid'];
	    }
	}
	break;
      
      case 'preferences':
	{
	  $url = $str.'/prefs';
	}
	break;
      
      case 'confirm_email':
	{
	  if( isset($params['uniqueid']) )
	    {
	      $url = $str.'/confirm/'.$params['uniqueid'];
	    }
	}
	break;
      
      case 'showmessage':
	{
	  if( isset($params['msgID']) )
	    {
	      $url = $str.'/message/'.$params['msgID'];
	    }
	}
      }
  
    $link = $this->CreateFrontendLink($id,$returnid,$action,$contents,
				      $params,$warn_message,$onlyhref,$inline,$addtext,
				      $targetcontentonly,$url);
    return $link;
  }



  /*---------------------------------------------------------
   GetLists : Public
   -
   Return an array of lists
   filter can be 'all', 'public', or 'private'
   ---------------------------------------------------------*/
  function GetLists($filter = 'all',$active = true)
  {
    $db = $this->GetDb();
    $filter = strtolower($filter);

    $query = '';
    $where = array();
    switch( $filter )
      {
      case 'public':
	$where[] = 'public = 1';
	break;

      case 'private':
	$where[] = 'public = 0';
	break;

      default:
	break;
      }

    if( $active )
      {
	$where[] = 'active = 1';
      }

    $query = 'SELECT * FROM '.NMS_LIST_TABLE;
    if( count( $where ) )
      {
	$query .= ' WHERE ';
	$query .= implode(' AND ',$where);
      }

    $results = $db->GetArray($query);
    return $results;
  }


  /*---------------------------------------------------------
   GetListsForPulldown : Public
   -
   Return an array of lists
   filter can be 'all', 'public', or 'private'
   ---------------------------------------------------------*/
  function GetListsForPulldown($filter = 'all',$active = true,$selectone = true)
  {
    $tmp = $this->GetLists($filter,$active);

    $results = array();
    if( $selectone )
      {
	$results[$this->Lang('select_one')] = '';
      }
    foreach( $tmp as $one )
      {
	$results[$one['name']] = $one['listid'];
      }

    return $results;
  }


  /*---------------------------------------------------------
   GetMessagesForPulldown : Public
   -
   Return an array of messages
   ---------------------------------------------------------*/
  function GetMessagesForPulldown($selectone = true)
  {
    $db = $this->GetDb();
    $query = 'SELECT messageid,subject FROM '.NMS_MESSAGES_TABLE;
    $dbr = $db->Execute($query);

    $results = array();
    if( $selectone )
      {
	$results[$this->Lang('select_one')] = '';
      }
    while( $dbr && ($row = $dbr->FetchRow()) )
      {
	$results[$row['subject']] = $row['messageid'];
      }

    return $results;
  }


  private function _isValidEmail($email)
  {
    if( !is_email($email) ) return FALSE;
    /*
    static $good_domains = array();
    if( function_exists('checkdnsrr') )
      {
	list($junk,$domain) = explode('@',$email,2);
	if( in_array($domain,$good_domains) ) return TRUE;

	if( checkdnsrr($domain,'MX') ) {
	  $good_domains[] = $domain;
	  return TRUE;
	}
      }
    */
    return TRUE;
  }

  /*---------------------------------------------------------
   SendMessageToExternalUsers
   -
   Send a specified message to a supplied list of 
   email addresses.
   ---------------------------------------------------------*/
  function SendMessageToExternalUsers($id,$messageid,$addresses)
  {
    // destrow
    //   email
    //   uniqueid
    //   username

    $db = $this->GetDb();
    $query = 'SELECT * FROM '.NMS_MESSAGES_TABLE.' WHERE messageid = ?';
    $message = $db->GetRow($query,array($messageid));
    if( !$message ) return false;
    if( !is_array($addresses) ) return false;

    foreach( $addresses as $email )
      {
	$tmp = array();
	$tmp['email'] = $email;
	$this->_ProcessOneEmail($id,$message,$tmp);
      }
  }


  /*---------------------------------------------------------
   AddUser
   -
   Add a new user to one or more lists
   ---------------------------------------------------------*/
   function AddUser($email,$lists,$username='',$disabled=0,$confirmed=0)
   {
     if( empty($email) ) return $this->Lang('error_invalidemail');
     if( !is_array($lists) || count($lists) == 0 ) 
       return $this->Lang('error_selectonelist');
     if( !is_email($email) )
       return $this->Lang('error_invalidemail');

     $uniqueid = md5(uniqid(rand(),1));
     $db = &$this->GetDb();

     // Set the values for the fields in the record
     $record = array(); 
     $record["email"] = trim($email);
     $record["username"] = trim($username);
     $record["uniqueid"] = $uniqueid;
     $record["disabled"] = (isset($disabled)) ? $disabled : 0;
     $record["confirmed"] = $confirmed;
     $record["htmlemail"] = 1;
     $record["dateadded"] = trim($db->DBTimeStamp(time()),"'");

     $query = "SELECT userid,email FROM ".NMS_USERS_TABLE." WHERE email = ?";
     $row = $db->GetRow($query,array($record['email']));
     $userid = '';
     if ( $row )
       {
	 // email already exists
	 $userid = $row['userid'];
	 $newuser = 0;
	 
	 // update the lists he's a member of
	 foreach ($lists as $listid){
	   $query = 'SELECT userid FROM '.NMS_LISTUSER_TABLE.' 
                   WHERE listid = ? AND userid = ?';
	   $num = $db->GetOne($query,array($listid,$userid));
	   if( !$num )
	     {
	       $record = array();
	       $record["userid"] = $userid;
	       $record["listid"] = $listid;
	       $record["active"] = 1;
	       $record["entered"] = trim($db->DBTimeStamp(time()),"'");
	       
	       $query = "INSERT INTO ".NMS_LISTUSER_TABLE." 
                        (userid, listid, active, entered) VALUES (?,?,?,?)";
	       $db->Execute($query, $record); 	
	     }
	 }
       }
     else
       {
	 // insert the user
	 $query = "INSERT INTO ".NMS_USERS_TABLE." (email, username, uniqueid, disabled, confirmed, htmlemail, dateadded) VALUES (?,?,?,?,?,?,?)";
	 $dbresult = $db->Execute($query, $record); 
	 if( !$dbresult ) 
	   {
	     echo $db->ErrorMsg();
	     return;
	   }
	 
	 // get user id back from the table
	 $query = "SELECT userid FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
	 $dbresult = $db->Execute($query,array($uniqueid));
      
	 if ($dbresult && $dbresult->RecordCount() > 0)
	   {
	     $row = $dbresult->FetchRow();
	     $userid = $row['userid'];
	   }
	 
	 // add him to his member lists
	 foreach ($lists as $listid){
	   // add to list/user table
	   $record = array();
	   $record["userid"] = $userid;
	   $record["listid"] = $listid;
	   $record["active"] = 1;
	   $record["entered"] = trim($db->DBTimeStamp(time()),"'");
	   
	   $query = "INSERT INTO ".NMS_LISTUSER_TABLE." 
                        (userid, listid, active, entered) VALUES (?,?,?,?)";
	   $dbresult = $db->Execute($query, $record); 	
	 }
       }

     return '';
   }



} /* class */



// EOF
?>
