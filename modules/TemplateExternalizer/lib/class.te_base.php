<?php
class te_base
{









/* Changer le mode de développement - Début ********************************* */

public static function ChangeStatus($mod)
{

	if (self::GetStatus($mod) == false)
		{
			return self::SetStatus($mod, true) ;
		} else {
			return self::SetStatus($mod, false) ;
		}
}

/* Changer le mode de développement - Fin *********************************** */









/* Retourner le status du mode de développement - Début ********************* */

public static function GetStatus($mod)
{

	return $mod->GetPreference("dev_mode") ;

}

/* Retourner le status du mode de développement - Fin *********************** */









/* Modifier le status du mode de développement - Début ********************** */

public static function SetStatus($mod, $status)
{

	if ($status == false)
	{
		self::DeleteCachePath($mod) ;
	}

	$mod->SetPreference("dev_mode", $status) ;
	return true ;

}

/* Modifier le status du mode de développement - Fin ************************ */









/* Modifier le CHMOD en écriture - Début ************************************ */

public static function SetCHMOD($mod, $chmod)
{

	$mod->SetPreference("chmod", $chmod) ;
	return true ;

}

/* Modifier le CHMOD en écriture - Fin ************************************** */









/* Récupérer le CHMOD en écriture - Début *********************************** */

public static function GetCHMOD($mod)
{

	return $mod->GetPreference("chmod") ;

}

/* Récupérer le CHMOD en écriture - Fin ************************************* */









/* Modifier l'extension des gabarits - Début ******************************** */

public static function SetTemplateExtension($mod, $extension)
{

	$mod->SetPreference("template_extension", $extension) ;
	return true ;

}

/* Modifier l'extension des gabarits - Fin ********************************** */









/* Modifier l'extension des feuilles de style - Début *********************** */

public static function SetStylesheetExtension($mod, $extension)
{

	$mod->SetPreference("stylesheet_extension", $extension) ;
	return true ;

}

/* Modifier l'extension des feuilles de style - Fin ************************* */









/* Modifier l'extension des balises utilisateur (UDT) - Début *************** */

public static function SetUDTExtension($mod, $extension)
{

	$mod->SetPreference("udt_extension", $extension) ;
	return true ;

}

/* Modifier l'extension des balises utilisateur (UDT) - Début *************** */









/* Chemin de dossier d'exportation - Début ********************************** */
public static function GetCachePath($mod)
{

	// Récupérer et traiter la préférence du dossier
	$cache_path = $mod->GetPreference("cache_path") ;
	
	// Si la préférence commence par un "/" alors l'enlever
	if (startswith($cache_path, DIRECTORY_SEPARATOR))
	{
		$cache_path = substr($cache_path, 1);
	}
	
	// Si la préférence termine par un "/" alors l'enlever
	if (endswith($cache_path, DIRECTORY_SEPARATOR))
	{
		$cache_path = substr($cache_path, -1, 1);
	}
	
	// Ajouter à la préférence le chemin complet
	$config = $mod->GetConfig() ;
	$cache_path = $config['root_path'] . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $cache_path ;
	return $cache_path ;

}
/* Chemin de dossier d'exportation - Fin ************************************ */









/* Création du dossier d'exportation - Début ******************************** */

public static function CreateBaseDir($mod)
{

	$cache_path = self::GetCachePath($mod) ;
	
	// Vérifier si le dossier existe, si non, alors le créer
  if (!file_exists($cache_path))
	{
    if(mkdir($cache_path))
		{
			$chmod = self::GetCHMOD($mod) ;
      chmod($cache_path, octdec($chmod));
    }
		else
		{
      $mod->DisplayErrorPage($id, $params, $returnid, $mod->Lang('unable_create_cache_path').$cache_path);
			return false ;
    }
  
	// Si le dossier existe, vérifier qu'il dispose des droits d'écriture
  }
	elseif(!is_writable($cache_path))
	{
    $mod->DisplayErrorPage($id, $params, $returnid, $mod->Lang('unable_write_cache_path').$cache_path);
		return false ;
  }
  
  // Réinitialiser le timeout
  self::ResetTimeOut($mod) ;
	
	// Création d'un fichier index.html vide
	self::CreateIndex($mod, $cache_path) ;
	
	return true ;
	
}

/* Création du dossier d'exportation - Fin ********************************** */









/* Création un sous-dossier du dossier d'exportation - Début **************** */

public static function CreateSubDir($mod, $dirname)
{

	$cache_path = self::GetCachePath($mod) ;
	$dirname = $cache_path . DIRECTORY_SEPARATOR . $dirname ;
	
	// Vérifier si le dossier existe, si non, alors le créer
  if (!file_exists($dirname))
	{
    if(@mkdir($dirname))
		{
			$chmod = self::GetCHMOD($mod) ;
      chmod($dirname, octdec($chmod));
    }
		else
		{
      $mod->DisplayErrorPage($id, $params, $returnid, $mod->Lang('unable_create_subdir').$dirname);
			return false ;
    }
  
	// Si le dossier existe, vérifier qu'il dispose des droits d'écriture
  }
	elseif(!is_writable($dirname))
	{
		$mod->DisplayErrorPage($id, $params, $returnid, $mod->Lang('unable_write_subdir').$dirname);
		return false ;
  }
	
	// Création d'un fichier index.html vide
	self::CreateIndex($mod, $dirname) ;
	
	return true ;
	
}

/* Création un sous-dossier du dossier d'exportation - Fin ****************** */









/* Créer d'un fichier index.html vide - Début ******************************* */
private static function CreateIndex($mod, $dirname)
{
	$dummy = $dirname.DIRECTORY_SEPARATOR.'index.html';
  if(!file_exists($dummy))
	{
		if(@touch($dummy))
		{
		} else
		{
			$mod->DisplayErrorPage($id, $params, $returnid,  $mod->Lang('unable_write_index'));
			return false ;
		}
	}
}
/* Créer d'un fichier index.html vide - Début ******************************* */









/* Vider le dossier d'exportation - Début *********************************** */
public static function DeleteCachePath($mod)
{
	$cache_path = self::GetCachePath($mod) ;
	@recursive_delete($cache_path) ;
}
/* Vider le dossier d'exportation - Fin ************************************* */









/* Récupérer la date de modification la plus récente - Début **************** */

public static function GetMostRecentEdit($mod)
{
	
	$cache_path = self::GetCachePath($mod) ;
	
	return @filemtime($cache_path);
	
}
	
/* Récupérer la date de modification la plus récente - Fin ****************** */









/* Vérifier le TimeOut - Début ********************************************** */

public static function CheckTimeOut($mod)
{
	
	$timeout = $mod->GetPreference('timeout') ;
	if ($timeout == 0)
	{
		return -1 ;
	}
	$most_recent_edit	= self::GetMostRecentEdit($mod) ;
	
	if (self::GetStatus($mod) == true)
	{
		$timeoutleft = $timeout*60 - (time() - $most_recent_edit) ;
	}
	else
	{
		$timeoutleft = 0 ;
	}

	if($timeoutleft <= 0 AND self::GetStatus($mod) == true)
	{
		self::SetStatus($mod, false);
		self::DeleteCachePath($mod);
		$mod->Audit(0, $mod->Lang('friendlyname'), $mod->Lang('dev_mode_timedout'));
	}

	return $timeoutleft ;
	
}
	
/* Vérifier le TimeOut - Fin ************************************************ */









/* Réinitialiser le TimeOut - Début ***************************************** */

public static function ResetTimeOut($mod)
{
	
	$cache_path = self::GetCachePath($mod) ;
	touch($cache_path);
	return true ;
	
}
	
/* Réinitialiser le TimeOut - Fin ******************************************* */









/* Traiter le nom du fichier - Début **************************************** */
public static function escapeFilename($fname)
{
	/* Merci à Mathieu Muths - www.airelibre.fr */
	$fname = cms_htmlentities($fname, ENT_IGNORE) ;

	return strtr($fname, ":+/?\\", "-----") ;
}
/* Traiter le nom du fichier - Fin ****************************************** */









/* Traiter le nom du fichier - Début **************************************** */
public static function escapeContent($content)
{
	return str_replace("\r\n", "\n", $content) ;
}
/* Traiter le nom du fichier - Fin ****************************************** */









}
?>