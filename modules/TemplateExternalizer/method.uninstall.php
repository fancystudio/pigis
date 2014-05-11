<?php
if (!isset($gCms)) exit;

// remove the permissions
$this->RemovePermission('Template Externalizer');
    
// remove preferences
$this->RemovePreference("dev_mode");
$this->RemovePreference("timeout");
$this->RemovePreference("cache_path");
$this->RemovePreference("stylesheet_extension");
$this->RemovePreference("template_extension");
$this->RemovePreference("udt_extension");
    
// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));


?>