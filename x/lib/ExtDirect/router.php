<?php
//ini_set('display_errors', 0);

if(!isset($_SESSION['user']))
	session_start();

require_once('inc/API.php');
require_once('inc/Router.php');

### Edited for SDX
// Collects the call and uses the custom session for each app. 
if(isset($_POST['extAction'])){
	$call = $_POST['extAction'];
}else if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){
		$data = json_decode($GLOBALS['HTTP_RAW_POST_DATA']);
	if(is_array($data)){
		$call = $data[0]->action;
	}else{
		$call = $data->action;
	}
}



require('../x4deep/Xengine.php');
// this should alwasy be set but if its not, then execute api.php without outputting it

if(!isset($_SESSION['ext-direct-state-'.$call])) {
    $_POST['api'] = $call;
    ob_clean();
	ob_start();
    include('api.php');
    ob_end_clean();
}
### END EDITS


$api = new ExtDirect_API();
$api->setState($_SESSION['ext-direct-state-'.$call]);
   
$router = new ExtDirect_Router($api);
$router->dispatch();
ob_clean();
$router->getResponse(true); // true to print the response instantly