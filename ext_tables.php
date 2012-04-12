<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Gallery',
	'Gallery'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Gallery');

t3lib_extMgm::addLLrefForTCAdescr('tx_nbogallery_domain_model_gallery', 'EXT:nbogallery/Resources/Private/Language/locallang_csh_tx_nbogallery_domain_model_gallery.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_nbogallery_domain_model_gallery');
$TCA['tx_nbogallery_domain_model_gallery'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Gallery.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_nbogallery_domain_model_gallery.gif'
	),
);

if (TYPO3_MODE == 'BE') {  
	// Add Wizard Icon
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['Tx_Nbogallery_Utilities_PluginWizard'] = t3lib_extMgm::extPath($_EXTKEY).'Classes/Utility/Backend/PluginWizard.php';

	// Add tables on Pages:
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbogallery_domain_model_gallery'][0]['fList'] = 'title,folder';
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables']['tx_nbogallery_domain_model_gallery'][0]['icon'] = TRUE;
}

?>