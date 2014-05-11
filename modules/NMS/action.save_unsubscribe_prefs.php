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

if (!$this->CheckPermission('Modify Site Preferences'))
  {
    $this->_DisplayErrorPage($id, $params, $returnid, 
			     $this->Lang('accessdenied'));
    return;
  }

if( isset( $params['input_reset'] ) )
  {
    $this->SetPreference('unsubscribe_subject', $this->Lang('default_unsubscribe_subject') );
    $this->SetPreference('nms_unsubscribe_prompt', $this->default_unsubscribe_prompt );
    $this->SetTemplate('unsubscribe_email_body', $this->default_unsubscribe_email_body );
    $this->SetTemplate('nms_unsubscribeform', $this->default_unsubscribe_form );
    $this->SetTemplate('unsubscribe_text', $this->default_unsubscribe_text );
    $this->SetTemplate('post_unsubscribe_text', $this->default_post_unsubscribe_text );
  }
 else
   {
     $this->SetPreference('nms_unsubscribe_prompt', 
			  isset($params['unsubscribe_prompt'])?$params['unsubscribe_prompt']:'');
     $this->SetPreference('unsubscribe_subject', isset($params['unsubscribe_subject'])?$params['unsubscribe_subject']:'');
     $this->SetTemplate('unsubscribe_email_body', isset($params['unsubscribe_email_body'])?$params['unsubscribe_email_body']:'');
     $this->SetTemplate('nms_unsubscribeform', isset($params['unsubscribe_form'])?$params['unsubscribe_form']:'');
     $this->SetTemplate('unsubscribe_text', 
			isset($params['unsubscribe_text'])?$params['unsubscribe_text']:'');
     $this->SetTemplate('post_unsubscribe_text', 
			isset($params['post_unsubscribe_text'])?$params['post_unsubscribe_text']:'');
   }

$this->RedirectToTab($id,'unsubscribe_form');

#
# EOF
#
?>