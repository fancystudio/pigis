<?php
if (!isset($gCms)) exit;

if (! $this->CheckAccess())
{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
}









/* Déclaration de l'entête des onglets - Début ****************************** */

if (!empty($params['active_tab'])) {
  $tab = $params['active_tab'] ;
} else {
  $tab = 'utilisation';
}
echo $this->StartTabHeaders();

echo $this->SetTabHeader('utilisation',$this->Lang('tabUtilisation'), ($tab == 'utilisation')?true:false);
echo $this->SetTabHeader('parametres',$this->Lang('tabParametres'), ($tab == 'parametres')?true:false);

echo $this->EndTabHeaders();

/* Déclaration de l'entête des onglets - Fin ******************************** */









/* Déclaration du contenu des onglets - Début ******************************* */

echo $this->StartTabContent();

echo $this->StartTab('utilisation', $params);
include(dirname(__FILE__).'/defaultadmin.tab.utilisation.php');
echo $this->EndTab();

echo $this->StartTab('parametres', $params);
include(dirname(__FILE__).'/defaultadmin.tab.parametres.php');
echo $this->EndTab();

echo $this->EndTabContent();

/* Déclaration du contenu des onglets - Fin ********************************* */

?>