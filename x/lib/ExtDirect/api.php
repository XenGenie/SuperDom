<?php

// Include ExtDirect PHP Helpers
require_once('inc/API.php');
require_once('inc/CacheProvider.php');

$cache = new ExtDirect_CacheProvider(LIBS_DIR.'/ExtDirect/cache/api_cache.txt');
$api = new ExtDirect_API();

$call = ($_POST['api']) ? $_POST['api'] : 'Inbox';
$api->setRouterUrl('/x/lib/ExtDirect/router.php'); // default
$api->setCacheProvider($cache);
$api->setNamespace("$$");
$api->setDescriptor("$$.APIDesc");
$api->setDefaults(array(
    'autoInclude'   => true,
    'basePath'      => XPHP_DIR
));

$path = XPHP_DIR."/$call.php";

if(file_exists($path)) {    
    require_once($path);
}

$api->add(
    array(
        $call
    )
);

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 22 Dec 2012 05:00:00 GMT");
$_SESSION['ext-direct-state-'.$call] = $api->getState();

ob_clean();

$api->output();

/* example of what you can do
// Include ExtDirect PHP Helpers
require_once('ExtDirect/API.php');
require_once('ExtDirect/CacheProvider.php');

// Including one Class myself just for testing purposes
require_once('classes/UserAction.php');


$cache = new ExtDirect_CacheProvider('cache/api_cache.txt');
$api = new ExtDirect_API();

$api->setRouterUrl('router.php'); // default
$api->setCacheProvider($cache);
$api->setNamespace('Ext.ss');
$api->setRemoteAttribute('@remotable'); // default
$api->setFormAttribute('@formHandler'); // default
$api->setDefaults(array(
    'autoInclude' => true,  // if you want to use this you have to make sure that your classes (without the prefix)
                            // are named consistent with the filename and that only one class exists in each file.
    'basePath' => 'classes'
));

$api->add(
    array( // an array with all the classnames.
        'LoginAction' => array('prefix' => 'Test_'), // you can set settings for individual classes 
        'SubscriptionAction', 
        'TeamAction' => array('subPath' => 'Subfolder'), // you can specify classes in a subfolder
        'TemplateAction', 
        'TicketAction', 
        'UserAction' => array('autoInclude' => false)
    ), array( // settings for this batch of classes
        'prefix' => '' // you could use this if your classes have a prefix, defaults to empty string
    )
);

$api->output();
*/