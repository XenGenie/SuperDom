<?php
	// This file gets hit at the root of the domain.
	// ex: http://domain.com/index.php 
	/*
	--- .htaccess ---
		<IfModule mod_rewrite.c>
			RewriteEngine On
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteCond %{REQUEST_FILENAME} !-d
			RewriteRule . /index.php [L] 
		</IfModule>
	*/

	ini_set('display_errors', 1);
	require('./x/x.engine.php'); 		
?>