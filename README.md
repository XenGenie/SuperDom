Hello world!

Thank you for downloading SuperDom, how awesome are you!?

The idea behind superdom is to make a super cool, super easy engine for the web that anyone and everyone can make their own piece of heaven on the cloud.

The concept itself may be a big big but that's the idea! To build Kingdoms for those that have the umph to do so. SuperDom is meant to be free with the idea of other bits being able to be distributed with or without revenue. 

Stay tuned, this readme needs some updating!


-- Install:
// Make sure you have an .htaccess at the root level of your domain.
--- .htaccess ---
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /index.php [L] 
</IfModule>

// it should put index.php as the file that everything will get funnelled through, unless the actual requested file exists.
// ex: http://domain.com/index.php 