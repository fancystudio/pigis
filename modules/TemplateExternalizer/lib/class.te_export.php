<?php
class te_export
{









/* Exporter tous les templates - Début ************************************** */

public static function ExportAll($mod) {
	if (te_base::CreateBaseDir($mod) == true)
	{
		self::ExportTemplates($mod) ;
		self::ExportCSS($mod) ;
		self::ExportExaCSS($mod) ;
		self::ExportModulesTemplates($mod);
		self::ExportGCB($mod) ;
		self::ExportSitePrefs($mod) ;
		self::ExportUDT($mod) ;
	}
}

/* Exporter tous les templates - Fin **************************************** */









/* Exporter les gabarits - Début ******************************************** */

private static function ExportTemplates($mod)
{
	
	// Création du sous-dossier
	$subdir = "_Templates" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');
	
	// Récupération de la liste des gabarits
	$gCms = cmsms() ;
  $to = $gCms->getTemplateOperations() ;
  $templates = $to->LoadTemplates() ;
	
	// Exportation de chaque template dans des fichiers séparés
  foreach($templates as $template) {
    $fname = $cache_path.'/'.$subdir.'/'.te_base::escapeFilename($template->name).'.'.$template_extension;
    $fp = fopen($fname, 'w');
		
		// Conversion du CRLF vers le LF pour la compatibilité Unix
    fwrite($fp, te_base::escapeContent($template->content));
    fclose($fp);
		
    // Rendre chaque fichier disponible en écriture
    chmod($fname, 0666);
		
    // Modifier la date du fichier avec la date de modification du template
    touch($fname, $template->modified_date);
  }
}
	
/* Exporter les gabarits - Fin ********************************************** */









/* Exporter les feuilles de style - Début *********************************** */

private static function ExportCSS($mod)
{
	
	// Création du sous-dossier
	$subdir = "_CSS" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$stylesheet_extension = $mod->GetPreference('stylesheet_extension');
	
	// Récupération de la liste des CSS
	$gCms = cmsms() ;
  $to = $gCms->getStylesheetOperations() ;
  $stylesheets = $to->LoadStylesheets() ;
	
	// Exportation de chaque CSS dans des fichiers séparés
  foreach($stylesheets as $stylesheet) {
    $fname = $cache_path.'/'.$subdir.'/'.te_base::escapeFilename($stylesheet->name).'.'.$stylesheet_extension;
    $fp = fopen($fname, 'w');
		
		// Conversion du CRLF vers le LF pour la compatibilité Unix
    fwrite($fp, te_base::escapeContent($stylesheet->value));
    fclose($fp);
		
    // Rendre chaque fichier disponible en écriture
    chmod($fname, 0666);
		
    // Modifier la date du fichier avec la date de modification du CSS
    touch($fname, $stylesheet->modified_date);
  }
	
}
	
/* Exporter les feuilles de style - Fin ************************************* */









/* Exporter ExaCSS - Début ************************************************** */

private static function ExportExaCSS($mod)
{

	$db = cmsms()->GetDb();
	$ExaCSS = cms_utils::get_module('ExaCSS') ;
	
	if ($ExaCSS == false)
	{
		return ;
	}
	
	// Création du sous-dossier
	$subdir = "ExaCSS" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$stylesheet_extension = $mod->GetPreference('stylesheet_extension');
	
	// Récupération de la liste des feuilles de styles
	$stylesheets = ExaCSSstylesheet::Get() ;
	$stylesheets = $stylesheets['list'] ;
	
	// Exportation de chaque feuille de style dans des fichiers séparés
	foreach ($stylesheets as $stylesheet)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("style_".$stylesheet['name']).'.'.$stylesheet_extension) ;
		$fp = fopen($fname, 'w') ;
   
		// Conversion du CRLF vers le LF pour la compatibilité Unix
		fwrite($fp, te_base::escapeContent($stylesheet['content'])) ;
		fclose($fp) ;
   
		// Rendre chaque fichier disponible en écriture
		chmod($fname, 0666) ;
   
		// Modifier la date du fichier avec la date de modification du CSS
		touch($fname, $db->UnixTimeStamp($stylesheet['date_modification'])) ;
	}
	
	// Récupération de la liste des feuilles de variables
	$variables = ExaCSSvariable::Get() ;
	$variables = $variables['list'] ;
	
	// Exportation de chaque feuille de variables dans des fichiers séparés
	foreach ($variables as $variable)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("variable_".$variable['name']).'.'.$stylesheet_extension) ;
		$fp = fopen($fname, 'w') ;
   
		// Conversion du CRLF vers le LF pour la compatibilité Unix
		fwrite($fp, te_base::escapeContent($variable['content'])) ;
		fclose($fp) ;
   
		// Rendre chaque fichier disponible en écriture
		chmod($fname, 0666) ;
   
		// Modifier la date du fichier avec la date de modification du CSS
		touch($fname, $db->UnixTimeStamp($variable['date_modification'])) ;
	}
	
	// Récupération de la liste des feuilles de mixins
	$mixins = ExaCSSmixin::Get() ;
	$mixins = $mixins['list'] ;
	
	// Exportation de chaque feuille de mixins dans des fichiers séparés
	foreach ($mixins as $mixin)
	{
		$fname = cms_join_path($cache_path,$subdir,te_base::escapeFilename("mixin_".$mixin['name']).'.'.$stylesheet_extension) ;
		$fp = fopen($fname, 'w') ;
   
		// Conversion du CRLF vers le LF pour la compatibilité Unix
		fwrite($fp, te_base::escapeContent($mixin['content'])) ;
		fclose($fp) ;
   
		// Rendre chaque fichier disponible en écriture
		chmod($fname, 0666) ;
   
		// Modifier la date du fichier avec la date de modification du CSS
		touch($fname, $db->UnixTimeStamp($mixin['date_modification'])) ;
	}
	
}
	
/* Exporter ExaCSS - Fin **************************************************** */









/* Exporter les gabarits des modules - Début ******************************** */

private static function ExportModulesTemplates($mod)
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

	// Exportation de tous les templates de chaque module dans des fichiers séparés
	foreach($modules as $modulename)
  {
		$query = 'SELECT * FROM '.cms_db_prefix().'module_templates
							WHERE module_name = ?';
		$alltemplates = $db->GetArray($query,array($modulename));
		if( !count($alltemplates) ) continue;

    // Création du répertoire d'exportation du module
		te_base::CreateSubDir($mod, $modulename) ;

    foreach($alltemplates as $onetemplate)
		{
			$fname = $cache_path.'/'.$modulename.'/'.te_base::escapeFilename($onetemplate['template_name']).'.'.$template_extension;
			$fp = fopen($fname, 'w');
			
			// Conversion du CRLF vers le LF pour la compatibilité Unix
			fwrite($fp, te_base::escapeContent($onetemplate['content']));
			fclose($fp);
			
			// Rendre chaque fichier disponible en écriture
			chmod($fname, 0666);
			
			// Modifier la date du fichier avec la date de modification du template
			touch($fname, $db->UnixTimeStamp($onetemplate['modified_date']));
		}
	}
	
}
	
/* Exporter les gabarits des modules - Fin ********************************** */









/* Exporter les blocs de contenus globaux - Début *************************** */

private static function ExportGCB($mod)
{

	// Création du sous-dossier
	$subdir = "_GCB" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');

	// Récupération de la liste des GCB
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;
	$gco = $gCms->GetGlobalContentOperations() ;
	$gcbs = $gco->LoadHtmlBlobs() ;
	
	if( !count($gcbs) ) continue;

	foreach( $gcbs as $gcb )
	{
		$fname = $cache_path.'/'.$subdir.'/'.te_base::escapeFilename($gcb->name).'.'.$template_extension;
		$fp = fopen($fname, 'w');

		// Conversion du CRLF vers le LF pour la compatibilité Unix
		fwrite($fp, te_base::escapeContent($gcb->content));
		fclose($fp);
		
		// Rendre chaque fichier disponible en écriture
		chmod($fname, 0666);
		
		// Modifier la date du fichier avec la date de modification du template
		touch($fname, $gcb->modified_date);	
		
	}
	
}
	
/* Exporter les blocs de contenus globaux - Fin ***************************** */









/* Exporter les préférences du site - Début ********************************* */

private static function ExportSitePrefs($mod)
{
	
	// Création du sous-dossier
	$subdir = "_SitePrefs" ;
	te_base::CreateSubDir($mod, $subdir) ;
	
	// Récupération du répertoire d'exportation
	$cache_path = te_base::GetCachePath($mod) ;
	
	// Récupération de l'extension du fichier
	$template_extension = $mod->GetPreference('template_extension');

	// Récupération de la liste des GCB
	$gCms = cmsms() ;
	$db = $gCms->GetDb() ;

	// Charger quelques SitePrefs et les sauver dans des fichiers
	$query = 'SELECT * FROM '.cms_db_prefix().'siteprefs';
	$allsiteprefs = $db->GetAll($query);
	if( !count($allsiteprefs) ) continue;

	foreach( $allsiteprefs as $onesiteprefs )
	{
	
		if ($onesiteprefs['sitepref_name'] == 'sitedownmessage' OR
				$onesiteprefs['sitepref_name'] == 'metadata' OR
				$onesiteprefs['sitepref_name'] == 'page_metadata' OR
				$onesiteprefs['sitepref_name'] == 'defaultpagecontent')
		{
			$fname = $cache_path.'/'.$subdir.'/'.te_base::escapeFilename($onesiteprefs['sitepref_name']).'.'.$template_extension;
			$fp = fopen($fname, 'w');

			// Conversion du CRLF vers le LF pour la compatibilité Unix
			fwrite($fp, te_base::escapeContent($onesiteprefs['sitepref_value']));
			fclose($fp);
			
			// Rendre chaque fichier disponible en écriture
			chmod($fname, 0666);

			// Modifier la date du fichier avec la date de modification du template
			touch($fname, $db->UnixTimeStamp($onesiteprefs['modified_date']));	
		
		}
	}
	
}
	
/* Exporter les préférences du site - Fin *********************************** */









/* Exporter les balises utilisateurs - Début ******************************** */

private static function ExportUDT($mod)
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
	
	if( count($udts) > 0)
	{

		foreach( $udts as $udt )
		{
		
			$udt = $uto->GetUserTag($udt) ;

			$fname = $cache_path.'/'.$subdir.'/'.te_base::escapeFilename($udt['userplugin_name']).'.'.$template_extension;
			$fp = fopen($fname, 'w');

			// Conversion du CRLF vers le LF pour la compatibilité Unix
			fwrite($fp, te_base::escapeContent($udt['code']));
			fclose($fp);
			
			// Rendre chaque fichier disponible en écriture
			chmod($fname, 0666);

			// Modifier la date du fichier avec la date de modification du template
			touch($fname, $db->UnixTimeStamp($udt['modified_date']));	
		
		}
		
	}

}
	
/* Exporter les balises utilisateurs - Fin ********************************** */









}
?>