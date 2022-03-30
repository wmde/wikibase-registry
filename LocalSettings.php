<?php
require 'PrivateSettings.php';

$wgLogo = 'https://upload.wikimedia.org/wikipedia/commons/3/3d/Wikibase_registry_terrible_logo.svg';

$wgDBserver = "mysql.svc:3306";
$wgDBname = "wikibase_registry";
$wgDBuser = "wikibase-reg-user";
// $wgDBpassword in PrivateSettings.php

$wgDebugLogGroups = array(
        'resourceloader' => '/var/log/mediawiki/resourceloader.log',
        'exception' => '/var/log/mediawiki/exception.log',
        'error' => '/var/log/mediawiki/error.log',
);

$wgShellLocale = "en_US.utf8";
$wgLanguageCode = "en";
$wgSitename = "Wikibase Registry";
$wgMetaNamespace = "Project";
$wgScriptPath = "/w";        // this should already have been configured this way
$wgArticlePath = "/wiki/$1";

$wgRCMaxAge = 365 * 24 * 3600;

$wgUseInstantCommons = true;

wfLoadSkin( 'Vector' );

require_once "$IP/extensions/Wikibase/vendor/autoload.php";
require_once "$IP/extensions/Wikibase/lib/WikibaseLib.php";
require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
require_once "$IP/extensions/Wikibase/repo/ExampleSettings.php";
require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
require_once "$IP/extensions/Wikibase/client/ExampleSettings.php";

$wgWBRepoSettings['conceptBaseUri'] = 'http://wikibase-registry.wmflabs.org/entity/';

wfLoadExtension( 'Nuke' );

wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);
$wgCaptchaQuestions = [
	'What is the 3rd letter of the capital of France?' => 'r',
	'What is the name of the wikimedia wikibase install' => 'wikidata',
	'What is Q64 on wikidata (in english)?' => 'berlin',
	'How many fingers does a hand have + 1?' => [ 6, 'six' ],
];
$wgCaptchaTriggers['create'] = true;

$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['writeapi'] = false;
$wgGroupPermissions['*']['createpage'] = false;
$wgGroupPermissions['*']['createtalk'] = false;

$wgGroupPermissions['Trusted'] = $wgGroupPermissions['user'];
$wgGroupPermissions['Trusted']['skipcaptcha'] = true;
$wgGroupPermissions['Trusted']['userrights'] = false;
$wgAddGroups['Trusted'][] = 'Trusted';

$wgGroupPermissions['user']['createpage'] = false;
$wgGroupPermissions['user']['move'] = false;
$wgGroupPermissions['user']['movefile'] = false;
$wgGroupPermissions['user']['move-categorypages'] = false;
$wgGroupPermissions['user']['move-subpages'] = false;
$wgGroupPermissions['user']['move-rootuserpages'] = false;
$wgGroupPermissions['user']['upload'] = false;

$wgNamespaceProtection[NS_MAIN] = [ 'autoconfirmed' ];
$wgNamespaceProtection[NS_USER] = [ 'autoconfirmed' ];
$wgNamespaceProtection[NS_USER_TALK] = [ 'autoconfirmed' ];
