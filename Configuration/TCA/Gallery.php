<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_nbogallery_domain_model_gallery'] = array(
	'ctrl' => $TCA['tx_nbogallery_domain_model_gallery']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, folder,sortby,sortdirection',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, folder,sortby,sortdirection,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_nbogallery_domain_model_gallery',
				'foreign_table_where' => 'AND tx_nbogallery_domain_model_gallery.pid=###CURRENT_PID### AND tx_nbogallery_domain_model_gallery.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'sortby' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.sortby',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.filename', 'filename'),
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.filesize', 'filesize'),
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.modified', 'modified'),
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.created', 'created'),
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.size', 'size'),
				),
			),
		),
		'sortdirection' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.sortdirection',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.asc', 'ASC'),
					array('LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.desc', 'DESC'),
				),
			),
		),
		'folder' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:nbogallery/Resources/Private/Language/locallang_db.xml:tx_nbogallery_domain_model_gallery.folder',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'folder',
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/pics',
				'show_thumbs' => '1',
				'size' => '3',
				'maxitems' => '200',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'disable_controls' => 'upload'
			),
		),
	),
);

?>