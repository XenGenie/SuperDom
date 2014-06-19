<?php
	/*
	 * Point to this file from root & enable Clean URL 
    
    	--- www.domain.com/index.php
    	require('x/x.engine.php');
	
	 --- .htaccess @ www.domain.com/.htaccess
    	<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteRule . ./index.php [L]
	</IfModule>	

	--- .htaccess @ www.domain.com/x/.htaccess
	DirectoryIndex ../index.php
	*/

	// Ready
	// @todo: Keep Being Awesome.
	require("cfg/cfg.lang.inc");
	require("cfg/cfg.x.inc");
	require('lib/x4deep/Xengine.php');

	// Set
	$X = new Xengine($cfg);
	
	// GO!
	$X->knock();
?>
