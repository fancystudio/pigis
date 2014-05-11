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
    $this->SetPreference('usersettings_subject', $this->default_usersettings_subject );
    $this->RemovePreference('usersettings_page');
    $this->SetTemplate('usersettings_email_body', $this->default_usersettings_email_body );
    $this->SetTemplate('usersettings_form', $this->default_usersettings_form );
    $this->SetTemplate('usersettings_form2', $this->default_usersettings_form2 );
    $this->SetTemplate('usersettings_text', $this->default_usersettings_text );
    $this->SetTemplate('usersettings_text2', $this->default_usersettings_text2 );
  }
 else
   {
     $this->SetPreference('usersettings_subject', isset($params['usersettings_subject'])?$params['usersettings_subject']:'');
     $this->SetPreference('usersettings_page', isset($params['usersettings_page'])?$params['usersettings_page']:'');
     $this->SetTemplate('usersettings_email_body', isset($params['usersettings_email_body'])?$params['usersettings_email_body']:'');
     $this->SetTemplate('usersettings_form', isset($params['usersettings_form'])?$params['usersettings_form']:'');
     $this->SetTemplate('usersettings_form2', isset($params['usersettings_form2'])?$params['usersettings_form2']:'');
     $this->SetTemplate('usersettings_text', isset($params['usersettings_text'])?$params['usersettings_text']:'');
     $this->SetTemplate('usersettings_text2', isset($params['usersettings_text2'])?$params['usersettings_text2']:'');
   }

$this->RedirectToTab($id,'user_settings');
?>