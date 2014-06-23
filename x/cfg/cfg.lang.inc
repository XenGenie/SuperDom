<?php
	$lang = array(
		'DB'		=> array(
			'ERROR' => array(
				'SQL'     => 'Database Error: {$sql}',
				'CONNECT' => 'Unable to Connect to the Database', 
			), 
		),
		'NOT_ADMIN' => 'Insufficent Privledges: You are not an Admin!',
		'404'       => '404 Not Found',
		'404msg'    => 'The page that you have requested could not be found.',
		'LOGIN'		=> array(
			'CREATE_ADMIN'  => 'Create a Super Admin',
			'ADMIN_CREATED' => 'Super Admin Created',
			'LOGIN_TITLE'   => 'Login',
			'LOGIN_BTN'     => 'Unlock',
			'ERROR' => array(
				'USERNAME' => '{$username} is not a valid Username',
				'UNIQUE'   => '{$username} has already been taken',
				'PASSWORD' => 'The password entered is incorrect',
				'CONFIRM'  => 'The passwords entered do not match.',
				'EMAIL'    => 'The email {$email} is not a valid Email Address',
				'SENDMAIL' => 'User {$username} Created, but Email Notice Failed to Be Sent.'
			),
			'LOGOUT'		=> array(
				'SUCCESS' => 'You have Logged Out', 
				'MSG'     => 'The System has been locked.'
			),
			'USERNAME' => 'Username',
			'PASSWORD' => '',
			'EMAIL'    => 'Email',
			'NEW_ADMIN_EMAIL_SUBJECT' => '{$HTTP_HOST} Administration Credentials', 
		),
		//'' => array('' => , ),
		'ADMIN'		=> array(
			'AXIS' => array(
				'ADD' => array(
					'TITLE' => "'Create an @xis Point?'",
					'MSG'   => "'Click <b><u>OK</u></b> to Add the <b style=\"color: red\">'+ $(click).attr('title') + '</b> icon to your <b style=\"color: green\">@xis</b>.'",
				)
			),
			// The 9 worlds/areas - Organize them here to have them rearranged on the Map/
			// 'AREAS'	=> array( 
			// 	'cronos'    => 'Chronicle', 
			// 	'construct' => 'Construct',
			// 	'market'    => 'Market',

			// 	'community' => 'Community',
			// 	'domain'    => 'Domain',
			// 	'navigate'  => 'Navigate',

			// 	'radius'    => 'Radius', 
			// 	'content'   => 'Storage', 
			// 	'support'   => 'Support'
			// ),
			'AREAS'	=> array( 

				'domain'    => 'Domain',
				
				'navigate'  => 'Navigate',
				'construct' => 'Construct',
				'cronos'    => 'Chronicles', 
				'content'   => 'Storage', 
				
				'market'    => 'Market',

				'community' => 'Community',

				'radius'    => 'Radius', 
				'support'   => 'Support'
			),
			'DESC'	=> array( 
				'cronos'    => '<em>Time</em> Sensitive Information', 
				'construct' => 'Tools & Materials for Building',
				'market'    => 'eCommerce will now always be easier!',

				'community' => 'Extend your Reach with your Community',
				'domain'    => 'Locks & Keys to the doors for your Domain',
				'navigate'  => 'Manage how users browse your domain',

				'radius'    => 'Strech your Immediate Circle of Influence', 
				'content'   => 'All the essential tools for managing your files', 
				'support'   => 'Did we miss something? Find Help & New Gadgets here.'
			)
		),
		'TRAC' => array(
			'BUG_REPORT' => '
=== GENERATED BUG REPORT ===
  * \'\'\'HTTP\'\'\'
	* HTTP_USER_AGENT : {$HTTP_USER_AGENT}
	* REQUEST_URI     : {$REQUEST_URI}
	* QUERY_STRING    : {$QUERY_STRING}
  * \'\'\'SERVER\'\'\'
	* HTTP_HOST       : {$HTTP_HOST}
	* SERVER_SOFTWARE : {$SERVER_SOFTWARE}
	* SERVER_NAME     : {$SERVER_NAME}
	* SERVER_ADDR     : {$SERVER_ADDR}
	* REMOTE_ADDR     : {$REMOTE_ADDR}
	* SERVER_ADMIN    : {$SERVER_ADMIN}
'
		)
	);
?>