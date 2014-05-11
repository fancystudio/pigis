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
if (!$this->CheckPermission('Manage NMS Users'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }
$this->SetCurrentTab('users');
$db =& $this->GetDb();

if( isset( $params['message'] ) )
  {
    $smarty->assign('message',html_entity_decode($params['message']));
  }
if( isset( $params['error'] ) )
  {
    $smarty->assign('error',html_entity_decode($params['error']));
  }

$editing = (isset($params['userid']) && $params['userid'] != '' );
$userinfo = '';
$memberlists = array();
if( $editing )
  {
    // make sure we have enough params
    if( !isset( $params['uniqueid'] ) )
      {
	$this->SetError($this->Lang('error_invalidparams'));
	$this->RedirectToTab($id);
	return;
      }

    // find the user
    $query = "SELECT * FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
    $dbresult = $db->Execute($query, array( $params['uniqueid'] ));
    if( !$dbresult || $dbresult->RecordCount() == 0 )
      {
	$this->SetError($this->Lang('error_usernotfound'));
	$this->RedirectToTab($id);
	return;
      }

    $userinfo = $dbresult->FetchRow();
    $smarty->assign('formstart',
		    $this->CreateFormStart( $id, 'do_edit_user', $returnid ) );
    $smarty->assign('formhidden',
		    $this->CreateInputHidden( $id, 'userid', $userinfo['userid'] ).
		    $this->CreateInputHidden( $id, 'uniqueid', $params['uniqueid'] ));

    // and get his lists
    $query = "SELECT * FROM ".NMS_LISTUSER_TABLE." WHERE userid = ?";
    $dbresult = $db->Execute( $query, array( $userinfo['userid'] ) );
    if( $dbresult )
      {
	while( $row = $dbresult->FetchRow() )
	  {
	    $memberlists[] = $row;
	  }
      }
  }
 else
   {
     $smarty->assign('formstart',
		     $this->CreateFormStart( $id, 'do_create_new_user', $returnid ));
   }

$smarty->assign('prompt_email',
		$this->Lang('emailaddress'));
$smarty->assign('email', 
		$this->CreateInputText($id, 'email',
				       (isset($params['email'])?$params['email']:''),
				       30, 150 ,'class="input_text"'));
$smarty->assign('prompt_username',
		$this->Lang('username'));
$smarty->assign('username', 
		$this->CreateInputText($id, 'username',
				       (isset($params['username'])?$params['username']:''),
				       30, 150 ,'class="input_text"'));

$smarty->assign('prompt_disabled',
		      $this->Lang('disabled'));
$smarty->assign('disabled',
		$this->CreateInputCheckbox( $id, 'disabled', '1',
					    (isset($params['disabled'])?$params['disabled']:'0')));

$smarty->assign('userinfo',$userinfo);
if( $editing )
  {
    $smarty->assign('prompt_bounces',$this->Lang('bounce_count'));
    $smarty->assign('bounces',
  		$this->CreateInputText($id,'bounces',
				       (isset($userinfo['bounce_count'])?$userinfo['bounce_count']:'0'),3,3));
  }

$smarty->assign('submit',$this->CreateInputSubmit($id,'submit',$this->Lang('submit'),
						  'class="button"'));
$smarty->assign('cancel',$this->CreateInputSubmit($id,'cancel',$this->Lang('cancel'),
						  'class="button"'));
$smarty->assign('formend',$this->CreateFormEnd());
$smarty->assign('text',$this->Lang('createuser'));

// query all of the active lists
$result = array();
$temparray = array();
$query = "SELECT * FROM ".NMS_LIST_TABLE." WHERE active = ?
                ORDER BY listid";
$dbresult = $db->Execute($query,array(1));
    
if ($dbresult && $dbresult->RecordCount() > 0)
  {
    // check if we only have one list.
    $oneonly = ($dbresult->RecordCount() == 1 );

    while ($row = $dbresult->FetchRow())
      {
	// cross reference with the member lists
	$member = false;
	foreach( $memberlists as $ml )
	  {
	    if( $row['listid'] == $ml['listid'] )
	      {
		$member = true;
		break;
	      }
	  }

	if( $oneonly )
	  {
	    $temparray[] = $this->CreateInputHidden($id,"lists[]",$row['listid']);
	  }
	$extratext = '';
	if( $oneonly )
	  {
	    $extratext .= 'disabled="disabled" ';
	  }
	if( $member || $oneonly )
	  {
	    $extratext .= 'checked="checked" ';
	  }
	$temparray[] = "<label>" . 
	  $this->CreateInputCheckbox($id, "lists[]",$row['listid'],"",$extratext).
	  $row['name'] . " - " . $row['description'] . "</label>";
      }
    $smarty->assign('listids',$temparray);
  }

echo $this->ProcessTemplate('createuser.tpl');

#
# EOF
#
?>
