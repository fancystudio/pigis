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
$message = '';
if( isset($params['message']) )
  {
    $message = html_entity_decode($params['message']);
  }
 
$smarty->assign('prompt_email',$this->Lang('emailaddress'));
if( isset( $params['error'] ) )  $smarty->assign('error',$params['error']);
$smarty->assign('submitbtn', 
		      $this->CreateInputSubmit($id, 'submit', 
					       $this->Lang('submit')));
$template = 'nms_subscribeform';

$mode = 'subscribe';
if(isset($params['mode']) && $params['mode'] != '')
  {
    $mode = $params['mode'];
  }

switch( $mode ) {
 case 'usersettings':
   {
     $smarty->assign('formstart',
			   $this->CreateFrontendFormStart($id, $returnid, 'usersettings_email' ));
     $smarty->assign('formend',$this->CreateFormEnd());
     $smarty->assign('email', $this->CreateInputText($id, 'email','',
							   30, 150 ));
     $smarty->assign('formhidden', $this->CreateInputHidden($id, 'usersettings'));
     $template = 'usersettings_form';
   }
   break;

 case 'unsubscribe':
   {
     $smarty->assign('formstart',$this->CreateFrontendFormStart($id, $returnid, 'unsubscribe_email'));
     $smarty->assign('email', $this->CreateInputText($id, 'email','',
							   30, 150 ));
     $smarty->assign('formend',$this->CreateFormEnd());
     $smarty->assign('email', $this->CreateInputText($id, 'email','',30, 150 ));

//      $smarty->assign('formhidden', $this->CreateInputHidden($id, 'unsubscribe'));
     $template = 'nms_unsubscribeform';
   }
   break;

 case 'subscribe':
   {
     $lists = "";
     if( isset( $params['select'] ) && $params['select'] != "" )
       {
	 $ar = explode(",",$params['select']);
	 $lists = '("'.implode('","',$ar).'")';
       }
     $email = '';
     if( isset( $params['email'] ) && $params['email'] != "" )
       {
	 $email = $params['email'];
       }
     $username = '';
     if( isset( $params['username'] ) && $params['username'] != "" )
       {
	 $username = $params['username'];
       }
     
     $result = array();
     $temparray = array();
     
     $query = "SELECT * FROM ".NMS_LIST_TABLE."
                       WHERE active = ? 
                         AND public = ?";
     if( $lists != "" )
       {
	 $query .= " AND name IN ".$lists;
       }
     $query .= " ORDER BY listid";
     
     $dbresult = $db->Execute($query,array(1,1));
     
     if ($dbresult && $dbresult->RecordCount() > 0)
       {
	 $hidden = '';
	 $oneonly = ($dbresult->RecordCount() == 1);
	 while ($row = $dbresult->FetchRow())
	   {
	     $extratext = '';
	     if( $oneonly )
	       {
		 $hidden .= $this->CreateInputHidden($id,"lists[]",$row['listid']);
		 $extratext = 'checked="checked" disabled="disabled"';
	       }
	     $temparray[] = "<label>" . 
	       $this->CreateInputCheckbox($id, "lists[]",$row['listid'],"",$extratext).
	       $row['name'] . " - " . $row['description'] . "</label>";
	   }
	 $smarty->assign('listids',$temparray);
	 $smarty->assign('formstart',$this->CreateFrontendFormStart($id, $returnid, 'do_create_new_user','post','',true,'',$params));
	 $smarty->assign('formend',$this->CreateFormEnd());
	 $smarty->assign('email', $this->CreateInputText($id, 'email',$email,30, 150 ));
	 $smarty->assign('prompt_username',$this->Lang('name'));
	 $smarty->assign('username', $this->CreateInputText($id, 'username', $username, 30, 150 ));
	 $smarty->assign('formhidden', $hidden );
       }
     else
       {
	 $message = $this->Lang('nolists');
       }
   }
   break;
	
 default:
   echo '<!-- NMS: unknown mode -->';
   return;
   break;
 }

// Display the populated template
if($mode != 'archive' && $mode != 'showmessage') {
  $smarty->assign('message',$message);
  echo $this->ProcessTemplateFromDatabase($template);
 }
?>
