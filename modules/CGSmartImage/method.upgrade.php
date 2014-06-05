<?php

$cache_path = $this->GetPreference('cache_path');
if( !$cache_path || startswith($cache_path,'/') ) {
  $cache_path = 'uploads/_CGSmartImage';
  $this->SetPreference('cache_path',$cache_path);
  audit('',$this->GetName(),'Invalid cache path reset to uploads/_CGSmartImage on upgrade');
}
?>