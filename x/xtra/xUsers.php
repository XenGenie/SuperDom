<?php
/**
 *
 * @author XtIV
 * @name Users
 * @desc User Management
 * @version v1.0.11.10.25.01.17
 * @icon Contacts2.png
 * @mini users
 * @link users
 * @see community
 * @todo
 */
	class xUsers extends Xengine{
		function dbSync(){
			return array(
				'Users' => array(
					'hash'	 		=> array('Type' => 'varchar(255)'),
					'username' 		=> array('Type' => 'varchar(255)'),
  					'password'		=> array('Type' => 'varchar(255)'),
  					'power_lvl'		=> array('Type' => 'varchar(255)'),
  					'email'			=> array('Type' => 'varchar(255)'),
  					'bday'			=> array('Type' => 'date'),
  					'last_login' 	=> array('Type' => 'varchar(255)'),
  					'last_active' 	=> array('Type' => 'varchar(255)'),
  					'last_location'	=> array('Type' => 'varchar(255)'),
  					'online'		=> array('Type' => 'int(11)'),
  					'newsletter'	=> array('Type' => 'int(11)'),
  					'name'			=> array('Type' => 'varchar(255)'),
  					'picture_src'	=> array('Type' => 'varchar(255)')
				)
			);
		}

		function autoRun($sdx){
			$q = $sdx->q();

			// Get the content for the page.
			$url = substr($_SERVER['REQUEST_URI'],1);

			$parts = explode('/',$url);

			// Is this a user name?
			$user = $q->Select('*','Users', array('username'=>$parts[0]) );

			if(!empty( $user )){

				// Run User Page.
				$this->set('PAGE_CONTENT',"Welcome !");
				$this->set('PAGE_TITLE',$user[0]['username']);
				$this->set('PAGE',$content);
				$sdx->getXTends();
				// Look for User Extensions in Mods
				// user.html - contains config for users for module.
				foreach($sdx->xphp_files as $k => $v){
					$dir = substr($v['file'],1);
					$dir = lcfirst($dir);
					$dir = str_replace('.php','',$dir);
					$file = HTML_DIR.'/'.PUBLIC_LOC.'/'.$dir.'/user.html';

					if(file_exists($file) ){
						$user_x[$v['see']][$dir] = $v;
					}

				}

				$sdx->set('user_x',$user_x);
			}


		}

		function index(){
			$this->set('WWW_PAGE','Users');
			// SQL Connection
			$q = $this->q();
			$this->set('BODY_VALIGN','top');
			// the fields that we want to see are...
			$q->setStartLimit(0,1);
			$fields = $q->Select('*','Users');
			$fields = $fields[0];
			unset($fields['hash']);

			foreach($fields as $k => $v){
				$f[] = $k;
			}
			$start = ($_POST['start'])?$_POST['start']:0;
			$limit = ($_POST['limit'])?$_POST['limit']:0;

			$q->mLimit = null;
			$all_users = $q->Select(implode(',',$f) ,'Users');

			// Lets build the columns.
			foreach($f as $k => $v){
				//
				$columns[] = array(
					'header' => ucwords( str_replace('_',' ',$v) ),
					'id'		=> $v
				);


			}

			// set the datas
			$this->set('columns',	json_encode($columns)	);
			$this->set('fields',	json_encode($f)	);
			$this->set('all_users',	json_encode($all_users)	);

			$this->set('users',	$all_users);
		}

		function avatar($username){

			$picture = "./bin/images/icons/48x48/user.png";

			$user = $this->q()->Select('picture_src','Users',array(
				'username'	=> $username
			));

			if($user[0]['picture_src'] != ''){
				$picture = $user[0]['picture_src'];
			}

			//
			echo file_get_contents($picture);
			exit;
		}

	}

?>