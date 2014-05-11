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
  // todo, check to make sure the params are sufficient

$record = array();
$dateconfirmed = trim($db->DBTimeStamp(time()),"'");
$record["dateconfirmed"] = $dateconfirmed;
$record["uniqueid"] = $params['uniqueid'];
$query = "UPDATE ".NMS_USERS_TABLE." SET confirmed = 1, dateconfirmed = ? 
               WHERE uniqueid = ?";
$dbresult = $db->Execute($query, $record);

$query = "SELECT * from ".NMS_USERS_TABLE." WHERE uniqueid = ?";
$record = array();
$record["uniqueid"] = $params['uniqueid'];
$dbresult = $db->Execute($query, $record);
$row = $dbresult->FetchRow();
$record["dateconfirmed"] = $dateconfirmed;

$smarty->assign('dateconfirmed',$record['dateconfirmed']);
$smarty->assign('uniqueid',$record['uniqueid']);
$smarty->assign('email', trim($row['email']));
$smarty->assign('username', trim($row['username']));
echo $this->ProcessTemplateFromDatabase('post_email_confirm_message');

// todo get the list of lists this user is subscribed to

//send subscribe thank you e-mail.
$mailer =& $this->GetModuleInstance('CMSMailer');
$mailer->reset();
$mailer->SetSubject($this->GetPreference('subscribe_subject'));		

$smarty->assign('unsubscribe',
		      $this->_cleanLink(
					$this->_CreatePrettyLink($id,$returnid,'unsubscribe',
								$this->Lang('unsubscribe'),
								array('uniqueid' => $row['uniqueid']))));
$smarty->assign('unsubscribeurl',
		      $this->_cleanLink(
					$this->_CreatePrettyLink($id,$returnid,'unsubscribe',
								$this->Lang('unsubscribe'), 
								array('uniqueid' => $row['uniqueid']), '', true)));
$smarty->assign('preferences',
		      $this->_cleanLink(
					$this->_CreatePrettyLink($id,$returnid,'usersettings',
								$this->Lang('preferences'),
								array('uniqueid' => $row['uniqueid']))));
$smarty->assign('preferencesurl',
		      $this->_cleanLink(
					$this->_CreatePrettyLink($id,$returnid,'usersettings',
								$this->Lang('preferences'), 
								array('uniqueid' => $row['uniqueid']), '', true)));

$bodyText = $this->ProcessTemplateFromDatabase('confirm_email_body');
$mailer->SetBody($bodyText);
$mailer->AddAddress($row['email']);
$mailer->SetCharSet($this->GetPreference('message_charset'));
$mailer->SetFromName($this->GetPreference('admin_name'));
$mailer->SetFrom($this->GetPreference('admin_email'));
$mailer->Send();   		

?>