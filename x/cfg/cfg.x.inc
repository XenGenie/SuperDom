<?php
	/*
		Configuration File For Xengine
	*/
	// ini_set('display_errors', 1);

	$cfg = array(
	'bots_list'	=>	array(
			"Google"   =>"Googlebot",
			"Yahoo"    =>"Slurp",
			"Bing"     =>"bingbot"
			/*You can add more bots here*/
		), 
		'dir'	=> array(
			'backdoor' => 'x',			// Virtual Directory Where the Location you want to access the admin panel.	
			'frontdoor'=> 'b',
			'sidedoor' => 'html',		// used by the site and other sister sites to just the html of a page.
			'Xtra'     => 'x/xtra',		// Locations of the Modules
			'bin'      => 'bin',		// Directory of the Bin 
			'icons'    => '/bin/images/icons',
			'cfg'      => $_SERVER['DOCUMENT_ROOT'].'/x/cfg',		// Directory of the Bin 
			'html'     => 'x/html',	
			'libs'     => $_SERVER['DOCUMENT_ROOT'].'/x/lib',	// Location 
			'thumb'    => 'phpThumb'
		),
		'db'    => 'MySql',
		'debug' => array(
			'on'      => true,
			'cache'   => false,
			'runtime' => microtime(true)
		),
		'html' => array(
			'public'  => 'frontdoor', 
			'private' => 'watchtower', 
		),
		
		'lang'	=>	$lang,
		'SMARTY_V' 	=> 'smarty3114'
	);
?>