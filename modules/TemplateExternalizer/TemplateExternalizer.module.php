<?php
#-------------------------------------------------------------------------
# Module: TemplateExternalizer 
# Auteur : Jocelyn LUSSEAU - Epsigon - www.epsigon.fr
#-------------------------------------------------------------------------
class TemplateExternalizer extends CMSModule
{

	function __construct()
	{
		// Si le module est actif
		if($this->GetPreference("dev_mode"))
		{
			$this->Initialisation() ;
		}
	}

	function GetName()
	{
		return 'TemplateExternalizer';
	}

	function GetFriendlyName()
	{
		return $this->Lang('friendlyname');
	}

	function GetVersion()
	{
		return '2.1.3';
	}

	function GetHelp()
	{
		return $this->ProcessTemplate('help.tpl'); 
	}

	function GetAuthor()
	{
		return 'Jocelyn LUSSEAU &bull; <a href="http://www.exacore.fr">Exacore</a>';
	}

	function GetAuthorEmail()
	{
		return 'info@exacore.fr';
	}

	function GetChangeLog()
	{
		return $this->ProcessTemplate('changelog.tpl'); 
	}

	function IsPluginModule()
	{
		return false;
	}

	function HasAdmin()
	{
		return $this->CheckAccess();
	}

	function GetAdminSection()
	{
		return 'layout';
	}

	function GetAdminDescription()
	{
		return $this->Lang('admindescription');
	}

  function VisibleToAdminUser()
  {
    return $this->CheckAccess();
  }

	function CheckAccess($perm = 'Template Externalizer')
	{
		return $this->CheckPermission($perm);
	}

	public function LazyLoadAdmin()
	{
		return false;
	}
	
	function DisplayErrorPage($id, &$params, $return_id, $message='')
	{
		$this->smarty->assign('title_error', $this->Lang('error'));
		$this->smarty->assign_by_ref('message', $message);

		// Display the populated template
		echo $this->ProcessTemplate('error.tpl');
	}

	function GetDependencies()
	{
		return array();
	}

	function MinimumCMSVersion()
	{
		return "1.10";
	}

	function InstallPostMessage()
	{
		return $this->Lang('postinstall');
	}

	function UninstallPostMessage()
	{
		return $this->Lang('postuninstall');
	}

	function UninstallPreMessage()
	{
		return $this->Lang('really_uninstall');
	}
	
	function Initialisation()
	{
		if (!class_exists('te_base'))
		{
			require_once(dirname(__FILE__).'/lib/class.te_base.php');
		}
		if (!class_exists('te_import'))
		{
			require_once(dirname(__FILE__).'/lib/class.te_import.php');
		}
		te_import::ImportAll($this) ;
	}
	
}
?>