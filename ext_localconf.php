<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Mopolo.' . $_EXTKEY,
	'Frontend',
	array(
		'Product' => 'list, show, new, create, edit, update, delete',

	),
	// non-cacheable actions
	array(
		'Product' => 'create, update, delete',

	)
);
