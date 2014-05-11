<?php
if (!isset($gCms)) exit;

		
		// permissions
		$this->CreatePermission('Template Externalizer','Template Externalizer');


// create preferences with default values
$this->SetPreference("dev_mode", false);
$this->SetPreference("timeout", 30);
$this->SetPreference("chmod", "0777");
$this->SetPreference("cache_path", 'externalizer');
$this->SetPreference("stylesheet_extension", 'css');
$this->SetPreference("template_extension", 'html');
$this->SetPreference("udt_extension", 'php');

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('installed',$this->GetVersion()));
		
?>