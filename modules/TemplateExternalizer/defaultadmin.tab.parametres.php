<?php
if (!isset($gCms)) exit;

if (! $this->CheckAccess())
{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}









/* Traitement du formulaires - Début **************************************** */

if (isset($params['parametres_submit'])) {
	
	if ($params['cache_path'] != "")
	{
		$this->SetPreference("cache_path", $params['cache_path']) ;
	}
	
	if ($params['timeout'] != "")
	{
		$this->SetPreference("timeout", $params['timeout']) ;
	}
	
	if ($params['chmod'] != "")
	{
		$this->SetPreference("chmod", $params['chmod']) ;
	}
	
	if ($params['template_extension'] != "")
	{
		$this->SetPreference("template_extension", $params['template_extension']) ;
	}
	
	if ($params['stylesheet_extension'] != "")
	{
		$this->SetPreference("stylesheet_extension", $params['stylesheet_extension']) ;
	}
	
	if ($params['udt_extension'] != "")
	{
		$this->SetPreference("udt_extension", $params['udt_extension']) ;
	}
	
	unset($params) ;
	
}

/* Traitement du formulaires - Fin ****************************************** */









/* Récupération des données - Début ***************************************** */

$smarty->assign("cache_path", $this->GetPreference("cache_path")) ;
$smarty->assign("chmod", $this->GetPreference('chmod')) ;
$smarty->assign("template_extension", $this->GetPreference('template_extension')) ;
$smarty->assign("stylesheet_extension", $this->GetPreference('stylesheet_extension')) ;
$smarty->assign("udt_extension", $this->GetPreference('udt_extension')) ;
$smarty->assign("timeout", $this->GetPreference('timeout')) ;

/* Récupération des données - Fin ******************************************* */









/* Création du formulaire - Début ******************************************* */


$params['active_tab'] = "parametres" ;

$smarty->assign("actionid", $id) ;
$smarty->assign('formstart_parametres',
		$this->CreateFormStart($id,'defaultadmin',$returnid,'post','multipart/form-data',false,'',$params,'',''));
$smarty->assign('formend_parametres',$this->CreateFormEnd());

if ($this->GetPreference("dev_mode") == false)
{
	$smarty->assign('parametres_submit', $this->CreateInputSubmit($id, 'parametres_submit', $this->lang('save_params_submit')));
}

/* Création du formulaire - Fin ********************************************* */









/* Afficher le template - Début ********************************************* */

$smarty->assign_by_ref('mod',$this);
$config = $this->GetConfig() ;
$smarty->assign("root_path", $config['root_path']) ;
echo $this->ProcessTemplate('defaultadmin.tab.parametres.tpl');

/* Afficher le template - Fin *********************************************** */
?>