<?php
if (!isset($gCms)) exit;

	/*---------------------------------------------------------
	   Upgrade()
	   If your module version number does not match the version
	   number of the installed module, the CMS Admin will give
	   you a chance to upgrade the module. This is the function
	   that actually handles the upgrade.
	   Ideally, this function should handle upgrades incrementally,
	   so you could upgrade from version 0.0.1 to 10.5.7 with
	   a single call. For a great example of this, see the News
	   module in the standard CMS install.
	  ---------------------------------------------------------*/
		$current_version = $oldversion;
		switch($current_version)
		{
			case '2.0':
			case '2.0.1':
			case '2.0.2':
			case '2.0.3':
			case '2.0.4':
			case '2.0.5':
			case '2.0.6':
				$this->SetPreference("chmod", "0777");
				$this->SetPreference("cache_path", 'externalizer');
				break ;
			case '2.0.8':
				$this->SetPreference("udt_extension", 'php');
				break ;
		}
		
		// put mention into the admin log
		$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('upgraded',$this->GetVersion()));

?>