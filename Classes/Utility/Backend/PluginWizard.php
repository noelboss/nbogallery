<?php

/**
 * Adds the Plugin Wizard to the Backend
 *
 * @author Noël Bossart
 */
class Tx_Nbogallery_Utilities_PluginWizard {

	/**
	 * Adds the wizard icon
	 *
	 * @param	array		Input array with wizard items for plugins
	 * @return	array		Modified input array, having the item for the plugin added.
	 */
	function proc($wizardItems)	{
		$wizardItems['plugins_tx_nbogallery_display'] = array(
			'icon'=>t3lib_extMgm::extRelPath('nbogallery').'Resources/Public/Icons/be_wizard.gif',
			'title'=>Tx_Extbase_Utility_Localization::translate("backend.wizard", "nbogallery", NULL),
			'description'=>Tx_Extbase_Utility_Localization::translate("backend.wizard.description", "nbogallery", NULL),
			'params'=>'&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=nbogallery_gallery'
		);  
		return $wizardItems;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nbogallery/Classes/Utilities/Backend/wizicon.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/nbogallery/Classes/Utilities/Backend/wizicon.php']);
}
?>