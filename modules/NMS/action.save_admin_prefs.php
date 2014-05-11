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
if (!$this->CheckPermission('Modify Site Preferences') && 
    !$this->CheckPermission('Manage NMS Preferences'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

if( isset($params['messages_per_batch']) )
  {
    $messages_per_batch = (int)$params['messages_per_batch'];
    $maxvalue = 200;
    if( $this->CheckPermission('NMS Advanced Mode') )
      {
	$maxvalue = 5000;
      }
    $messages_per_batch = min($messages_per_batch,$maxvalue);
    $this->SetPreference('messages_per_batch',$messages_per_batch);
  }
if( isset($params['ms_between_message_sleep']) )
  {
    $ms_between_message_sleep = (int)$params['ms_between_message_sleep'];
    $minvalue = 500;
    if( $this->CheckPermission('NMS Advanced Mode') )
      {
	$minvalue = 1;
      }
    $ms_between_message_sleep = max($ms_between_message_sleep,$minvalue);
    $this->SetPreference('ms_between_message_sleep',$ms_between_message_sleep);
  }
if( isset($params['between_batch_sleep']) )
  {
    $between_batch_sleep = (int)$params['between_batch_sleep'];
    $minvalue = 30;
    if( $this->CheckPermission('NMS Advanced Mode') )
      {
	$minvalue = 1;
      }
    $between_batch_sleep = max($between_batch_sleep,$minvalue);
    $this->SetPreference('between_batch_sleep',$between_batch_sleep);
  }

$this->SetPreference('email_user_on_admin_subscribe',
		     isset($params['email_user_on_admin_subscribe'])?$params['email_user_on_admin_subscribe']:0);
$this->SetPreference('send_admin_copies', isset($params['send_admin_copies'])?$params['send_admin_copies']:false);
$this->SetPreference('admin_email', isset($params['admin_email'])?$params['admin_email']:'Root');
$this->SetPreference('admin_name', isset($params['admin_name'])?$params['admin_name']:'root@localhost.com');
$this->SetPreference('admin_replyto', isset($params['admin_replyto'])?$params['admin_replyto']:'');

$this->SetPreference('pop3_server', isset($params['pop3_server'])?$params['pop3_server']:'');
$this->SetPreference('pop3_username', isset($params['pop3_username'])?$params['pop3_username']:'');
$this->SetPreference('pop3_password', isset($params['pop3_password'])?$params['pop3_password']:'');

$bounce_limit = (int)$params['bounce_limit'];
$bounce_limit = min(100,$bounce_limit);
$bounce_limit = max(1,$bounce_limit);
$this->SetPreference('bounce_limit',$bounce_limit);

$bounce_messagelimit = (int)$params['bounce_messagelimit'];
$bounce_messagelimit = min(1000,$bounce_messagelimit);
$bounce_messagelimit = max(1,$bounce_messagelimit);
$this->SetPreference('bounce_messagelimit',$bounce_messagelimit);

$this->SetPreference('message_charset', isset($params['message_charset'])?$params['message_charset']:$this->defaultcharset);

$this->SetPreference('require_confirmation',(int)$params['require_confirmation']);
$this->SetPreference('unsubscribe_deletes',(int)$params['unsubscribe_deletes']);

// if you wanted to have a comprehensive audit log, you could write something here.      
$this->RedirectToTab( $id, 'preferences' );

#
# EOF
#
?>