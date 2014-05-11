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

$db = $this->GetDb();

if( isset($params['email']) )
  {
    $query = 'SELECT uniqueid FROM '.NMS_USERS_TABLE.' WHERE email = ?';
    $uniqueid = $db->GetOne($query,array($params['email']));
    if( !$uniqueid )
      {
	$this->_DisplayErrorPage( $id, $params, $returnid,
				  $this->Lang('error_invalidemail'));
	return;
      }
    $params['uniqueid'] = $uniqueid;
  }

if( !isset( $params['uniqueid'] ) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_insufficientparams'));
    return;
  }


$query = "SELECT * FROM ".NMS_USERS_TABLE." WHERE uniqueid = ?";
$record["uniqueid"] = $params['uniqueid'];
$dbresult = $db->Execute($query, $record);
if( !$dbresult || ( $dbresult->RecordCount() == 0 ) )
  {
    $this->_DisplayErrorPage( $id, $params, $returnid,
			      $this->Lang('error_invaliduniqueid'));
    return;
  }

$userinfo = $dbresult->FetchRow();
$smarty->assign( $userinfo );
$smarty->assign( 'confirm_unsubscribe_url',
		       $this->_cleanlink(
					 $this->_CreatePrettyLink( $id, $returnid, 'unsubscribe',
								  '', array('uniqueid' => $userinfo['uniqueid']), 
								  '', true, '', true)));

$mailer =& $this->GetModuleInstance('CMSMailer');
$mailer->reset();
$mailer->SetSubject($this->GetPreference('unsubscribe_subject'));		

$bodyText = $this->ProcessTemplateFromDatabase('unsubscribe_email_body');

$mailer->SetBody($bodyText);
$mailer->AddAddress($userinfo['email']);
$mailer->SetCharSet($this->GetPreference('message_charset'));
$mailer->SetFromName($this->GetPreference('admin_name'));
$mailer->SetFrom($this->GetPreference('admin_email'));
$mailer->Send();

// display some meaningful text on the front end
echo $this->ProcessTemplateFromDatabase('unsubscribe_text');
?>