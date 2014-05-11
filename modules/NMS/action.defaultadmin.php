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

// another way to handle errors
if( isset($params['error']) )
  {
    if( isset($params['message']) )
      {
	echo $this->ShowErrors($params['message']);
      }
  }
$this->DisplayErrors();

echo $this->StartTabHeaders();
if( $this->CheckPermission('Manage NMS Lists') )
  {
    echo $this->SetTabHeader('lists',$this->Lang('lists'));
  }
if( $this->CheckPermission('Manage NMS Users') )
  {
    echo $this->SetTabHeader('users',$this->Lang('users'));
  }
if( $this->CheckPermission('Manage NMS Messages') )
  {
    echo $this->SetTabHeader('messages',$this->Lang('messages'));
  }
  if( $this->CheckPermission('Modify Templates') )
  {
    echo $this->SetTabHeader('templates',$this->Lang('message_templates'));
  }
  
  
if( $this->CheckPermission('Manage NMS Jobs') )
  {
    echo $this->SetTabHeader('jobs',$this->Lang('jobs'));
  }
if( $this->CheckPermission('Modify Site Preferences') ||
    $this->CheckPermission('Manage NMS Preferences'))
  {
    echo $this->SetTabHeader('preferences',$this->Lang('preferences'));
  }
if( $this->CheckPermission('Modify Templates') )
  {
    echo $this->SetTabHeader('subscribe_form',$this->Lang('subscribe_form'));

    echo $this->SetTabHeader('confirm_subscribe_form',$this->Lang('confirm_subscribe'));

    echo $this->SetTabHeader('unsubscribe_form',$this->Lang('unsubscribe_form'));

    echo $this->SetTabHeader('user_settings',$this->Lang('user_settings'));
    
    echo $this->SetTabHeader('archive_templates',$this->Lang('archive_templates'));

    echo $this->SetTabHeader('default_templates',$this->Lang('default_templates'));
  }
echo $this->EndTabHeaders();


// the content of the tabs
echo $this->StartTabContent();

if( $this->CheckPermission('Manage NMS Lists') )
  {
    echo $this->StartTab('lists');
    include(dirname(__FILE__).'/function.admin_lists_tab.php');
    echo $this->EndTab();
  }

if( $this->CheckPermission('Manage NMS Users') )
  {
    echo $this->StartTab('users');
    include(dirname(__FILE__).'/function.admin_users_tab.php');
    echo $this->EndTab();
  }

if( $this->CheckPermission('Manage NMS Messages') )
  {
    echo $this->StartTab('messages');
    include(dirname(__FILE__).'/function.admin_messages_tab.php');
    echo $this->EndTab();
  }

if( $this->CheckPermission('Modify Templates') )
  {
    echo $this->StartTab('templates');
    include(dirname(__FILE__).'/function.admin_templates_tab.php');
    echo $this->EndTab();
    }
if( $this->CheckPermission('Manage NMS Jobs') )
    {
    echo $this->StartTab('jobs');
    include(dirname(__FILE__).'/function.admin_jobs_tab.php');
    echo $this->EndTab();
  }

if( $this->CheckPermission('Modify Site Preferences') ||
    $this->CheckPermission('Manage NMS Preferences') )
  {
    require_once(dirname(__FILE__).'/functions.admintabs.php');

    echo $this->StartTab('preferences');
    _DisplayAdminPrefsTab($this,$id,$params,$returnid);
    echo $this->EndTab();
  }

if( $this->CheckPermission('Modify Templates') )
  {
    require_once(dirname(__FILE__).'/functions.admintabs.php');

    echo $this->StartTab('subscribe_form');
    _DisplayAdminSubscribeFormTab($this,$id,$params,$returnid);
    echo $this->EndTab();
    
    echo $this->StartTab('confirm_subscribe_form');
    _DisplayAdminConfirmFormTab($this,$id,$params,$returnid);
    echo $this->EndTab();
    
    echo $this->StartTab('unsubscribe_form');
    _DisplayAdminUnsubscribeFormTab($this,$id,$params,$returnid);
    echo $this->EndTab();
    
    echo $this->StartTab('user_settings');
    _DisplayAdminUserSettingsTab($this,$id,$params,$returnid);
    echo $this->EndTab();

    echo $this->StartTab('archive_templates');
    include(dirname(__FILE__).'/function.admin_archive_templates_tab.php');
    echo $this->EndTab();

    echo $this->StartTab('default_templates');
    include(dirname(__FILE__).'/function.admin_default_templates_tab.php');
    echo $this->EndTab();
  }

echo $this->EndTabContent();
?>
