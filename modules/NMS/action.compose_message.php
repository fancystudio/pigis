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
if (!$this->CheckPermission('Manage NMS Messages'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }


$db = $this->GetDb();

// some default values (maybe from preferences)
$this->SetCurrentTab('messages');
$error = false;
$subject = false;
$textmessage = '';
$template = 'msgtemplate_'.$this->GetPreference('curdeflt_msgtemplate');
$pageid = false;
$archivable = 1;
$text_only = 0;
$messageid = -1;
$blockvalues = array();

if( isset( $params['messageid'] ) )
  {
    // I guess we're editing
    $messageid = (int)$params['messageid'];

    // load the stuff from the database
    $query = 'SELECT * FROM '.NMS_MESSAGES_TABLE.' WHERE messageid = ?';
    $row = $db->GetRow( $query, array( $messageid ) );
    if( !$row )
      {
	echo $this->ShowErrors($this->Lang('error_itemnotfound'));
	return;
      }

    $subject = $row['subject'];
    $textmessage = $row['message'];
    $template = $row['template'];
    $pageid = $row['pageid'];
    $archivable = $row['archivable'];
    $text_only = $row['text_only'];
    $entered = $row['entered'];

    // Now get any content block stuff
    $query = 'SELECT * FROM '.NMS_MESSAGE_CONTENT_TABLE.' WHERE messageid = ?';
    $dbr = $db->Execute( $query, array($messageid) );
    while( $dbr && ($row = $dbr->FetchRow() ) )
      {
	$blockvalues[$row['name']] = $row['value'];
      }
  }

// let params override the settings from the database if editing
if( isset( $params['subject'] ) )
  {
    $subject = trim($params['subject']);
  }
if( isset( $params['textmessage'] ) )
  {
    $textmessage = trim($params['textmessage']);
  }
if( isset( $params['template'] ) )
  {
    $template = $params['template'];
  }
if( isset( $params['pageid'] ) )
  {
    $pageid = (int)$params['pageid'];
  }
if( isset( $params['archivable'] ) )
  {
    $archivable = (int)$params['archivable'];
  }
if( isset( $params['text_only'] ) )
  {
    $text_only = (int)$params['text_only'];
  }
	
if( isset( $params['cancel'] ) )
  {
    $this->RedirectToTab($id);
    return;
  }
else if(isset( $params['submit'] ) )
  {
    // form validation
    // Changed by skypanther to permit reply-to to be left blank
    if( ! $subject || $subject == '' )
      {
	echo $this->ShowErrors($this->Lang('error_needsubject'));
	$error = true;
      }
//     else if( ! $textmessage || $textmessage == '' )
//       {
// 	echo $this->ShowErrors($this->Lang('error_needmessagetext'));
// 	$error = true;
//       }
    else if( ($template == '' && $textmessage == '') || (! $pageid ) )
      {
	echo $this->ShowErrors($this->Lang('error_formerror'));
	$error = true;
      }

    if( !$error )
      {
	// we got here, now we can insert/update the record, no problems.
	$event = 'OnCreateMessage';

	$record = array(); 
	$record["subject"] = $subject;
	$record["messsage"] = $textmessage;
	$record["template"] = $template;
	$record["pageid"] = ($pageid == false)?NULL:$pageid;
	$record['archivable'] = $archivable;
	$record['text_only'] = $text_only;

	if( $messageid == -1 )
	  {
	    //
	    // We're doing an insert
	    //
	    $record["modified"] = trim($db->DBTimeStamp(time()),"'");
	    $record["entered"] = trim($db->DBTimeStamp(time()),"'");
	    $record["uniqueid"] = md5(uniqid(rand(),1));

	    // Set the values for the fields in the record
	    $query = "INSERT INTO ".NMS_MESSAGES_TABLE." 
                       (subject, message, template, pageid, archivable, text_only, modified, entered, uniqueid) 
                       VALUES (?,?,?,?,?,?,?,?,?)";
	    
	    // get the message id so we can send an event
	    $dbresult = $db->Execute($query, $record); 
	    
	    if( !$dbresult )
	      {
		$smarty->assign('message',$this->Lang('error_problemwithmessage')."<br/>".$db->ErrorMsg());
		$error = true;
	      }
	    else 
	      {
		$messageid = $db->Insert_ID();
		$record['messageid'] = $messageid;
		
		// Add the content props
		$query = 'INSERT INTO '.NMS_MESSAGE_CONTENT_TABLE.'
                          (messageid,name,value,created,modified) 
                          VALUES (?,?,?,?,?)';
		foreach( $params as $key => $value )
		  {
		    if( preg_match( '/^block_/', $key ) )
		      {
			$key = substr($key,6);
			$db->Execute( $query, array( $messageid, $key, $value,
						     $record['modified'],
						     $record['modified']) );
			echo $db->sql.'<br/>';
		      }
		  }
	      }
	  }
	else
	  {
	    //
	    // We're doing an update
	    //
	    $event = 'OnEditMessage';

	    // update the messages table
	    $record["modified"] = trim($db->DBTimeStamp(time()),"'");
	    $record['messageid'] = $messageid;

	    $query = 'UPDATE '.NMS_MESSAGES_TABLE.'
                         SET subject = ?, message = ?, template = ?, pageid = ?, archivable = ?, text_only = ?,
                             modified = ?
                       WHERE messageid = ?';
	    $db->Execute( $query, $record );

	    // update the messages content table
	    $query = 'DELETE FROM '.NMS_MESSAGE_CONTENT_TABLE.' WHERE messageid = ?';
	    $db->Execute( $query, array($messageid) );

	    $query = 'INSERT INTO '.NMS_MESSAGE_CONTENT_TABLE.'
                      (messageid,name,value,created,modified) 
                      VALUES (?,?,?,?,?)';
	    if( empty($entered) )
	      {
		$entered = $record['modified'];
	      }
	    foreach( $params as $key => $value )
	      {
		if( preg_match( '/^block_/', $key ) )
		  {
		    $key = substr($key,6);
		    $db->Execute( $query, array( $messageid, $key, $value,
						 $entered,
						 $record['modified']) );
		  }
	      }
	  }
	
	// send an event
	$this->SendEvent($event,$record);

	// and redirect back to the tabs
	$this->RedirectToTab($id);
      }
  }

// create a template list
global $gCms;
$db = &$this->GetDb();

$smarty->assign('startform', 
		$this->CreateFormStart($id, $params['action'], $returnid,
				       'post','','','a'));
$smarty->assign('endform', $this->CreateFormEnd());
if( $messageid != -1 )
  {
    $smarty->assign('hidden',$this->CreateInputHidden($id,'messageid',$messageid));
  }
$smarty->assign('submit',
		$this->CreateInputSubmit($id, 'submit', 
					 $this->Lang('save')));
$smarty->assign('cancel',
		$this->CreateInputSubmit($id, 'cancel', 
					 $this->Lang('cancel')));
$smarty->assign('prompt_subject', $this->Lang('prompt_subject'));
$smarty->assign('prompt_template', $this->Lang('prompt_template'));
$smarty->assign('prompt_page', $this->Lang('prompt_page'));
$smarty->assign('prompt_archivable', $this->Lang('prompt_archivable'));
$smarty->assign('prompt_text_only', $this->Lang('prompt_text_only'));
$smarty->assign('prompt_selectstatus', $this->Lang('prompt_selectstatus'));
$smarty->assign('prompt_textmessage', $this->Lang('prompt_textmessage'));
$extra_help = '';
foreach ($this->GetModulesWithCapability('nms_vars') as $one_module)
{
  $extra_help .= cms_utils::get_module($one_module)->GetExtraNMSParamHelp();
}
$smarty->assign('message_help',$this->Lang('message_help', $extra_help));
$smarty->assign('message_help2',$this->Lang('message_help2'));
	
$result = array();
$temparray = array();
$smarty->assign('subject', 
		      $this->CreateInputText($id, 'subject', 
					     $subject,
					     30));

if( !$text_only )
  {
    $smarty->assign('templatelist',
		$this->CreateTemplateDropdown($id,'template','msgtemplate_',
					      $template,
					      'onchange="document.forms[0].submit()"'));
  }

$smarty->assign('pagelist',
		create_page_dropdown($this,$id,'pageid',$pageid));

$smarty->assign('archivable',
		$this->CreateInputYesNoDropdown($id,'archivable',$archivable));
$smarty->assign('text_only',
		$this->CreateInputYesNoDropdown($id,'text_only',$text_only,
						'onchange="document.forms[0].submit()"'));

//
// read the current template (or the first), parse, and show N content blocks
//
if( !$text_only )
  {
    $template_list = $this->ListTemplatesWithPrefix('msgtemplate_');
    if( !count($template_list) )
      {
	echo $this->ShowErrors($this->Lang('error_notemplates'));
	return;
      }
    if( $template == '' )
      {
	$template = $template_list[0];
      }
    $template_src = $this->GetTemplate($template);
    if( !$template_src )
      {
	// todo, improve this
	echo $this->ShowErrors($this->Lang('error_notemplatebyname',$template));
	$template = $template_list[0];
	$template_src = $this->GetTemplate($template);
      }
    $contentblocks = array();
    $pattern = '/{nms_([^}]*)}/';
    $pattern2 = '/([a-zA-z0-9]*)=["\']([^"\']+)["\']/';
    $result = preg_match_all($pattern,$template_src,$matches);
    if( $result && count($matches[1]) > 0)
      {
	foreach( $matches[1] as $wholetag )
	  {
	    $tagtype = explode(' ',$wholetag);
	    $tagtype = strtolower($tagtype[0]);
	    $result2 = preg_match_all($pattern2,$wholetag,$morematches);
	    if( $result2 )
	      {
		$keyval = array();
		for ($i = 0; $i < count($morematches[1]); $i++)
		  {
		    $keyval[$morematches[1][$i]] = $morematches[2][$i];
		  }
	      }
	    
	    // check for required arguments
	    if( !isset($keyval['name']) )
	      {
		// name is a required parameter
		// todo, display an error message?
		continue;
	      }
	    
	    // build the thing
	    $obj = new StdClass();
	    $safe_name = str_replace(' ','_',$keyval['name']);
	    $obj->name = 'block_'.$safe_name;
	    $obj->prompt = $keyval['name'];
	    if( isset($keyval['prompt']) )
	      {
		$obj->prompt = trim($keyval['prompt']);
	      }
	    switch( $tagtype )
	      {
	      case 'content':
		// a text area
		$wysiwyg = true;
		$content = '';
		if( isset($keyval['wysiwyg']) && 
		    ($keyval['wysiwyg'] == 0 || $keyval['wysiwyg'] == 'false') )
		  {
		    $wysiwyg = false;
		  }
		if( isset($keyval['content']) )
		  {
		    $content = $keyval['content'];
		  }
		if( isset($blockvalues[$safe_name]) )
		  {
		    $content = $blockvalues[$safe_name];
		  }
		if( isset($params[$obj->name]) )
		  {
		$content = trim($params[$obj->name]);
	      }
	    if( isset($keyval['oneline']) &&
		($keyval['oneline'] == 1 || $keyval['oneline'] == 'true') )
	      {
		$obj->control = $this->CreateInputText($id,$obj->name,$content,80,1024);
	      }
	    else
	      {
		$obj->control = $this->CreateTextArea($wysiwyg,$id,$content,$obj->name);
	      }
	    break;

	  case 'attachment':
	    // a file selector dropdown?
	    $content = '';
	    if( isset($blockvalues[$safe_name]) )
	      {
		$content = $blockvalues[$safe_name];
	      }
	    if( isset($params[$obj->name]) )
	      {
		$content = trim($params[$obj->name]);
	      }
	    $cgextensions = $this->GetModuleInstance('CGExtensions');
	    $obj->control = $cgextensions->CreateFileDropdown($id,$obj->name,$content);
	    break;

	  case 'image':
	    // an image dropdown
	    // from which directory?
	    $content = '';
	    if( isset($blockvalues[$safe_name]) )
	      {
		$content = $blockvalues[$safe_name];
	      }
	    if( isset($params[$obj->name]) )
	      {
		$content = trim($params[$obj->name]);
	      }
	    if( isset($keyval['src']) )
	      {
		$content = $keyval['src'];
		$obj->hidden = 1;
		$obj->control = $this->CreateInputHidden($id,$obj->name,$content);
	      }
	    else
	      {
		$dir = '';
		if( isset($keyval['dir']) ) $dir = $keyval['dir'];
		$cgextensions = $this->GetModuleInstance('CGExtensions');
		$obj->control = $cgextensions->CreateImageDropdown($id,$obj->name,$content,$dir,true);
	      }
	    break;
	  }
	$contentblocks[] = $obj;
      }
  }
  }

$smarty->assign('textmessage',
		$this->CreateTextArea(false,$id,$textmessage,'textmessage'));
// Display the populated template
if( !$text_only && count($contentblocks) )
  {
    $smarty->assign('contentblocks',$contentblocks);
  }
echo $this->ProcessTemplate('compose.tpl');

#
# EOF
#
?>
