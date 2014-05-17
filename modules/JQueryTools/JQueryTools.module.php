<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: JQueryTools (c) 2006 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  A toolbox of conveniences to provide dynamic javascripty functionality
#  for CMS modules and website designers.
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

////////////////////////////////////////////////////////////
global $CMS_VERSION;
if( !class_exists('CGExtensions') ) {
  $cgextensions = cms_join_path(cmsms()->config['root_path'],'modules',
				'CGExtensions','CGExtensions.module.php');
  if( !is_readable( $cgextensions ) ) {
    echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
    return;
  }
  require_once($cgextensions);
}
////////////////////////////////////////////////////////////

class JQueryTools extends CGExtensions
{
  private $_required_libs;

  function GetName() { return 'JQueryTools'; }
  function GetFriendlyName() { return $this->Lang('friendlyname'); }
  function GetVersion() { return '1.2.6'; }
  function GetHelp() { return file_get_contents(dirname(__FILE__).'/help.inc'); }
  function GetAuthor() { return 'calguy1000'; }
  function GetAuthorEmail() { return 'calguy1000@cmsmadesimple.org'; }
  function GetChangeLog() { return @file_get_contents(dirname(__FILE__).'/changelog.inc'); }
  function IsPluginModule() { return true; }
  function HasAdmin() { return false; }
  function GetAdminSection() { return 'extensions'; }
  function GetAdminDescription() { return $this->Lang('moddescription'); }
  function VisibleToAdminUser() { return false; }
  function GetDependencies() { return array('CGExtensions'=>'1.38.4'); }
  function MinimumCMSVersion() { return "1.11.9"; }
  function InstallPostMessage() { return $this->Lang('postinstall'); }
  function UninstallPostMessage() { return $this->Lang('postuninstall'); }
  function UninstallPreMessage() { return $this->Lang('preuninstall'); }
  function AllowAutoInstall() { return FALSE; }
  function AllowAutoUpgrade() { return FALSE; }

  function InitializeFrontend()
  {
    $this->RestrictUnknownParams();
    $this->RegisterModulePlugin();
    $this->SetParameterType('exclude',CLEAN_STRING);
    $this->SetParameterType('no_css',CLEAN_INT);
    $this->SetParameterType('no_cdn',CLEAN_INT);
    $this->SetParameterType('no_js',CLEAN_INT);
    $this->SetParameterType('no_jquery',CLEAN_INT);
    $this->SetParameterType('no_ready',CLEAN_INT);
    $this->SetParameterType('lib',CLEAN_STRING);
  }

  function InitializeAdmin()
  {
    $this->RegisterModulePlugin();
    $this->CreateParameter('action',null,$this->Lang('param_action'));
    $this->CreateParameter('exclude',null,$this->Lang('param_exclude'));
    $this->CreateParameter('lib',null,$this->Lang('param_lib'));
    $this->CreateParameter('no_css',null,$this->Lang('param_no_css'));
    $this->CreateParameter('no_cdn',null,$this->Lang('param_no_cdn'));
    $this->CreateParameter('no_js',null,$this->Lang('param_no_js'));
    $this->CreateParameter('no_jquery',null,$this->Lang('param_no_jquery'));
    $this->CreateParameter('no_ready',null,$this->Lang('param_no_ready'));
  }

} // class

?>
