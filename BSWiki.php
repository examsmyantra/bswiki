<?php
/**
* BS Wiki
*
* @file
* @ingroup Skins
* @author Mayank Tiwari, Rishav Chhajer, ExamsMyantra (https://www.examsmyantra.com)
* @license Released under Open Source MIT for more on license read License.md under root directory
*/

if(!defined('MEDIAWIKI')){
	die('This is an extension to the MediaWiki package and cannot be run standalone.');
}

$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'BS Wiki',
	'namemsg' => 'bswiki',
	'version' => '1.0.0',
	'url' => 'https://www.mediawiki.org/wiki/Skin:Bswiki',
	'author' => '[https://twitter.com/tiwarimayank24 Mayank Tiwari], [https://twitter.com/Rishavchhajer Rishav Chhajer], [https://twitter.com/examsmyantra ExamsMyantra]',
	'descriptionmsg' => 'bswiki-desc',
	'license' => 'MIT'
);

$wgValidSkinNames['bswiki'] = 'BSWiki';

$wgAutoloadClasses['SkinBSWiki'] = __DIR__.'/BSWiki.skin.php';
$wgMessagesDirs['BSWiki'] = __DIR__.'/i18n';

$wgResourceModules['skins.bswiki.style'] =  array(
	'position' => 'top',
	'styles' => array(
		'bswiki/resources/css/bootstrap.min.css',
		'bswiki/resources/css/socicon.css',
		'bswiki/resources/css/bswiki.less'
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory']
);

$wgResourceModules['skins.bswiki.js'] = array(
	'position' => 'top',
	'scripts' => array(
		'bswiki/resources/js/bootstrap.min.js',
		'bswiki/resources/js/bswiki.js'
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory']
);
