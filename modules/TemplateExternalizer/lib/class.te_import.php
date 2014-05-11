<?php
class te_import
{
	

	
	
	
	
	
	
	
/* Importer tous les templates - Début ************************************** */

public static function ImportAll($mod) {
	self::ImportTemplates($mod) ;
	self::ImportUDT($mod) ;
	self::ImportCSS($mod) ;
	self::ImportExaCSS($mod) ;
	self::ImportModulesTemplates($mod) ;
	self::ImportGCB($mod) ;
	self::ImportSitePrefs($mod) ;
	te_base::CheckTimeOut($mod) ;
}

/* Importer tous les templates - Fin **************************************** */









/* Importer les gabarits - Début ******************************************** */

private static function ImportTemplates($mod)
{
	
	// Sous-dossier des fichiers
	$subdir = "_Templates" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');
	
	// Récupération de la liste des gabarits
	$gCms = cmsms() ;
  $to =& $gCms->getTemplateOperations() ;
  $templates = $to->LoadTemplates() ;
    
  foreach($templates as $key => $template) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($template->name).'.'.$template_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);
		
		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $template->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $templates[$key]->content = fread($fp, $fsize);
			$templates[$key]->Save();
      fclose($fp);
			te_base::ResetTimeOut($mod) ;
    }

  }

}
	
/* Importer les gabarits - Fin ********************************************** */









/* Importer les feuilles de style - Début *********************************** */

private static function ImportCSS($mod)
{
	
	// Sous-dossier des fichiers
	$subdir = "_CSS" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;
	
	// Récupération de l'extension du fichier
	$stylesheet_extension = $mod->GetPreference('stylesheet_extension');
	
	// Récupération de la liste des gabarits
	$gCms = cmsms() ;
  $so = $gCms->getStylesheetOperations() ;
  $stylesheets = $so->LoadStylesheets() ;
    
  foreach($stylesheets as $key => $stylesheet) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($stylesheet->name).'.'.$stylesheet_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $stylesheet->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $stylesheets[$key]->value = fread($fp, $fsize);
      $stylesheets[$key]->Save();
      fclose($fp);
			te_base::ResetTimeOut($mod) ;
    }
  }
	
}
	
/* Importer les feuilles de style - Fin ************************************* */









/* Importer ExaCSS - Début ************************************************** */

private static function ImportExaCSS($mod)
{

	$db = cmsms()->GetDb();
	$ExaCSS = cms_utils::get_module('ExaCSS') ;
	
	if ($ExaCSS == false)
	{
		return ;
	}
	
	// Sous-dossier des fichiers
	$subdir = "ExaCSS" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;
	
	// Récupération de l'extension du fichier
	$stylesheet_extension = $mod->GetPreference('stylesheet_extension');
	
	// Récupération de la liste des feuilles de style
	$stylesheets = ExaCSSstylesheet::Get() ;
	$stylesheets = $stylesheets['list'] ;
	 
	foreach ($stylesheets as $stylesheet)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("style_".$stylesheet['name']).'.'.$stylesheet_extension) ;
		$ftime = @filemtime($fname);
		$most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
		if($ftime > $db->UnixTimeStamp($stylesheet['date_modification']) && ($fsize = filesize($fname)) != 0)
		{
			$fp = fopen($fname, 'r');
			$stylesheet['content'] = fread($fp, $fsize);
			$tmp = ExaCSSstylesheet::EditContent($stylesheet['id'], $stylesheet['content']) ;
			fclose($fp);
			te_base::ResetTimeOut($mod) ;
		}
	}
	
	// Récupération de la liste des feuilles de variables
	$variables = ExaCSSvariable::Get() ;
	$variables = $variables['list'] ;
	 
	foreach ($variables as $variable)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("variable_".$variable['name']).'.'.$stylesheet_extension) ;
		$ftime = @filemtime($fname);
		$most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
		if($ftime > $db->UnixTimeStamp($variable['date_modification']) && ($fsize = filesize($fname)) != 0)
		{
			$fp = fopen($fname, 'r');
			$variable['content'] = fread($fp, $fsize);
			$tmp = ExaCSSvariable::EditContent($variable['id'], $variable['content']) ;
			fclose($fp);
			te_base::ResetTimeOut($mod) ;
		}
	}
	
	// Récupération de la liste des feuilles de mixins
	$mixins = ExaCSSmixin::Get() ;
	$mixins = $mixins['list'] ;
	 
	foreach ($mixins as $mixin)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("mixin_".$mixin['name']).'.'.$stylesheet_extension) ;
		$ftime = @filemtime($fname);
		$most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
		if($ftime > $db->UnixTimeStamp($mixin['date_modification']) && ($fsize = filesize($fname)) != 0)
		{
			$fp = fopen($fname, 'r');
			$mixin['content'] = fread($fp, $fsize);
			$tmp = ExaCSSmixin::EditContent($mixin['id'], $mixin['content']) ;
			fclose($fp);
			te_base::ResetTimeOut($mod) ;
		}
	}
	
}
	
/* Importer ExaCSS - Fin **************************************************** */









/* Importer les gabarits des modules - Début ******************************** */

private static function ImportModulesTemplates($mod)
{

	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  $mo = $gCms->GetModuleOperations() ;
	$modules = $mo->GetInstalledModules() ;
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;

  foreach($modules as $modulename)
  {
		$query = 'SELECT * FROM '.cms_db_prefix().'module_templates
							WHERE module_name = ?';
		$alltemplates = $db->GetArray($query,array($modulename));
		if( !count($alltemplates) ) continue;

    foreach( $alltemplates as $onetemplate )
		{
			$fname = $cache_path.DIRECTORY_SEPARATOR.$modulename.DIRECTORY_SEPARATOR.te_base::escapeFilename($onetemplate['template_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($onetemplate['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$onetemplate['content'] = fread($fp,$fsize);
				fclose($fp);

				$query = 'UPDATE '.cms_db_prefix()."module_templates SET content = ?, modified_date = $fdbtime
									WHERE module_name = ? AND template_name = ?";  
				$dbr = $db->Execute($query,
				array($onetemplate['content'], $modulename, $onetemplate['template_name']));
				te_base::ResetTimeOut($mod) ;
			}
		}
   }

}
	
/* Importer les gabarits des modules - Fin ********************************** */









/* Importer les blocs de contenus globaux - Début *************************** */

public static function ImportGCB($mod)
{

	// Sous-dossier des fichiers
	$subdir = "_GCB" ;

	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  $gco = $gCms->GetGlobalContentOperations() ;
	$gcbs = $gco->LoadHtmlBlobs() ;

	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;

  foreach($gcbs as $key => $gcb) {
    $fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($gcb->name).'.'.$template_extension;
    $ftime = @filemtime($fname);
    $most_recent_edit = max($most_recent_edit, $ftime);

		// Chargement du fichier seulement s'il a été modifié et si la taille est supérieure à 0
    if($ftime > $gcb->modified_date && ($fsize = filesize($fname)) != 0) {
      $fp = fopen($fname, 'r');
      $gcb->content = fread($fp, $fsize);
			$result = $gco->UpdateHtmlBlob($gcb);
      fclose($fp);
			te_base::ResetTimeOut($mod) ;
    }
  }

}
	
/* Importer les blocs de contenus globaux - Fin ***************************** */









/* Importer les préférences du site - Début ********************************* */

private static function ImportSitePrefs($mod)
{

	// Sous-dossier des fichiers
	$subdir = "_SitePrefs" ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');

	// Récupération de la liste des modules
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
  
	// Charger quelques SitePrefs et les sauver dans des fichiers
	$query = 'SELECT * FROM '.cms_db_prefix().'siteprefs';
	$allsiteprefs = $db->GetAll($query);
	
	// Date de la dernière modification
	$most_recent_edit = te_base::GetMostRecentEdit($mod) ;
	
	foreach( $allsiteprefs as $onesiteprefs )
	{
	
		if ($onesiteprefs['sitepref_name'] == 'sitedownmessage' OR
				$onesiteprefs['sitepref_name'] == 'metadata' OR
				$onesiteprefs['sitepref_name'] == 'page_metadata' OR
				$onesiteprefs['sitepref_name'] == 'defaultpagecontent')
		{
			$fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($onesiteprefs['sitepref_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($onesiteprefs['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$onesiteprefs['sitepref_value'] = fread($fp,$fsize);
				fclose($fp);

				$query = 'UPDATE '.cms_db_prefix()."siteprefs SET sitepref_value = ?, modified_date = $fdbtime
									WHERE sitepref_name = ?";  
				$dbr = $db->Execute($query,
				array($onesiteprefs['sitepref_value'], $onesiteprefs['sitepref_name']));
				te_base::ResetTimeOut($mod) ;
			}
		
		}
	}
	
}
	
/* Importer les préférences du site - Fin *********************************** */









/* Importer les balises utilisateurs - Début ******************************** */

private static function ImportUDT($mod)
{
	
	// Création du sous-dossier
	$subdir = "_UDT" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('udt_extension');

	// Récupération de la liste des GCB
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
	$uto = $gCms->GetUserTagOperations() ;
	$udts = $uto->ListUserTags() ;
	
	if(count($udts) > 0)
	{
	
		// Date de la dernière modification
		$most_recent_edit = te_base::GetMostRecentEdit($mod) ;

		foreach( $udts as $udt )
		{
		
			$udt = $uto->GetUserTag($udt) ;

			$fname = $cache_path.DIRECTORY_SEPARATOR.$subdir.DIRECTORY_SEPARATOR.te_base::escapeFilename($udt['userplugin_name']).'.'.$template_extension;
			if( !@file_exists($fname) ) continue;

			$ftime = filemtime($fname);
			$fsize = filesize($fname);
			$most_recent_edit = max($most_recent_edit, $ftime);
			$dbmtime = $db->UnixTimeStamp($udt['modified_date']);
			$fdbtime = $db->DbTimeStamp($ftime);

			if( $ftime > $dbmtime && $fsize != 0 )
			{
				$fp = fopen($fname,'r');
				$udt['code'] = fread($fp,$fsize);
				fclose($fp);

				$uto->SetUserTag($udt['userplugin_name'], $udt['code']) ;
				te_base::ResetTimeOut($mod) ;
			}
		
		}
		
	}
	
}
	
/* Importer les balises utilisateurs - Fin ********************************** */









}
?>