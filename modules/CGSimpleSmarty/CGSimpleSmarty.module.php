<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSimpleSmarty (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple that provides simple smarty
#  methods and functions to ease developing CMS Made simple powered
#  websites.
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

$fn = cms_join_path(__DIR__,'function.module_action.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.repeat.php'); require_once($fn);
$fn = cms_join_path(__DIR__,'function.session_put.php'); require_once($fn);

class CGSimpleSmarty extends CMSModule
{
  public function __construct()
  {
    parent::__construct();

    $fn = __DIR__.'/class.cgsimple.php';
    require_once($fn);

    $smarty = cmsms()->GetSmarty();
    $obj = new cgsimple();
    $smarty->assign('cgsimple',$obj);

    $smarty->register_function('module_action_link','module_action_link');
    $smarty->register_function('cgrepeat','smarty_function_cgrepeat');
    $smarty->register_function('session_put','smarty_function_session_put');
    $smarty->register_function('session_erase','smarty_function_session_erase');
    $smarty->register_function('cgsi_array_set',array($this,'plugin_array_set'));
    $smarty->register_function('cgsi_array_unset',array($this,'plugin_array_unset'));
  }

  function GetName() { return 'CGSimpleSmarty'; }
  function GetFriendlyName() { return $this->Lang('friendlyname'); }
  function GetVersion() { return '1.7.2'; }
  function MinimumCMSVersion() { return '1.11.9'; }
  function GetHelp() { return file_get_contents(__DIR__.'/help.inc'); }
  function GetAuthor() { return 'calguy1000'; }
  function GetAuthorEmail() { return 'calguy1000@cmsmadesimple.org'; }
  function GetChangeLog() { return @file_get_contents(__DIR__.'/changelog.inc'); }
  function IsPluginModule() { return false; }
  function GetAdminDescription() { return $this->Lang('moddescription'); }
  function HasAdmin() { return false; }
  function HandlesEvents () { return false; }
  function InstallPostMessage() { return $this->Lang('postinstall'); }
  function UninstallPostMessage() { return $this->Lang('postuninstall'); }

  function plugin_array_set($params,&$smarty)
  {
    $name = get_parameter_value($params,'array');
    $key  = get_parameter_value($params,'key');
    $val  = get_parameter_value($params,'val');
    $val  = get_parameter_value($params,'value');

    $data = $smarty->get_template_var($name);
    if( !$data ) $data = array();

    if( !is_array($data) ) $data = array($data);
    $data[$key] = $value;

    $smarty->assign($name,$data);
  }

  function plugin_array_unset($params,&$smarty)
  {
    $name = get_parameter_value($params,'array');
    $key  = get_parameter_value($params,'key');

    $data = $smarty->get_template_var($name);
    if( !$data ) $data = array();
    if( !is_array($data) ) return;

    if( isset($data[$key]) ) unset($data[$key]);

    $smarty->assign($name,$data);
  }
}

?>
