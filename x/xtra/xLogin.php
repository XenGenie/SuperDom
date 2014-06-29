<?php
/**
 * @author heylisten@xtiv.net
 * @name Login
 * @desc Handles the logic of authentication to the website
 * @version v1(11.11.01@03:03)
 * @icon key.png
 * @mini key
 * @link login/newAdmin
 * @see domain
 * @todo
 */
class xLogin extends Xengine {
		function __construct($c){
			parent::__construct($c); // IMPORTANT!!!
			
			$this->set('SUPER_ADMIN',false);
			$q = $this->q();

			$SUPER_ADMIN = $q->Select('id','Users',array(
				'power_lvl' 	=> 9
			));

			// If there fails to be a super-admin - we need to make one!
			if( empty($SUPER_ADMIN) ){
				$this->set('login_title','Add a Admin Account');
				$this->set('login_message','Enter a Username/Password Combo to Continue');
			}else{
				$this->_SET['SUPER_ADMIN'] = $SUPER_ADMIN[0]['id'];
			}
		}

		// The Site allows login anywhere, as so long as autorun is running...
		function autoRun($X){
			// Whenever we find the POST Login Set, we run the Login Procedure. 

			if(isset($_POST['login']) && is_array($_POST['login']))
				return $this->login($_POST['login']['username'],$_POST['login']['password']);
			else if($this->Key['is']['user']){
				$this->set('user',$_SESSION['user']);
			}
			
			
		}

		private function getUserByName($user,$cols = 'id'){
			$u = $this->Q->Select($cols,'Users',array(
				'username' 	=> $user
			));
			return $u[0];	
		}

		/**
		 * @remotable
		 */
		private function login($username,$password){			
			$u = $this->getUserByName($username,'id,username,email,password,hash,power_lvl');
			// Username Not Found
			if(empty($u)){
				// This Might be the first user ever.

				$super = $this->Q->Select('id','Users', array(
					'power_lvl' => 9
				));

				$super = ( empty($super) ) ? false : true ;


				if( empty($super) ){
					$_POST['login']['power_lvl'] = 9;
					$this->insertUser($_POST['login']);
					return array('success'=>true);
				}else{
					return array(
						'success' => FALSE,
						'error'   => eval('return "'.$this->_LANG['LOGIN']['ERROR']['USERNAME'].'";')
					);	
				}
			}else{
				$hash = sha1( md5( base64_encode($u['email'].$password) ) );
				$pass = md5( sha1( $password ) );

				// FAILED
				if($hash !== $u['hash'] && $pass !== $u['password']){
					if($u['hash'] == '' && $pass === $u['password']){
						$this->Q->Update('Users',array(
							'hash' => $hash
						),array(
							'id' => $u['id']
						));
						return $this->login($username,$password);
					}

					return array(
						'success' => FALSE,
						'error'   => $this->_LANG['LOGIN']['ERROR']['PASSWORD']
					);
				}else{
					$this->setUser($u);

					$this->Q->Update('Users',array(
						'last_login' => time()
					),array(
						'id' => $u['id']
					));

					if($u['power_lvl'] === 9)
						$this->syncDbTables();

					return array(
						'success' => TRUE 
					);
				}
			}
			return false;
		}

		function logout(){
			unset($_SESSION['user']);
			$this->set('login_title','You Have Been Successfully Logged Out');
			$this->set('login_message','Goodbye');
		}

		function setEmail($time){
			if($time == $_SESSION['setEmail']['time']){
				$this->set('setEmail',true);
				$this->set('username',$_SESSION['setEmail']['username']);

				if($_POST['email']){
					$this->q()->Update('Users',array(
						'email' => $_POST['email']
					),array(
						'id'	=>	$_SESSION['setEmail']['user_id']
					));
					header("Location: /");
				}
			}else{
				echo 'Not Allowed.';
				exit;
			}
		}

		function index(){
			
		}

		private function insertUser($user)
		{
			$hash = sha1( md5( base64_encode($user['email'].$user['password']) ) );
			$pass = md5(sha1($user['password']));
			return $this->Q->Insert('Users',array(
				'email'     => $user['email'],
				'username'  => $user['username'],
				'password'  => $pass,
				'hash'      => $hash,
				'power_lvl' => $user['power_lvl']
			));
		}
		/**
		 * @remotable
		 * @formHandler
		 * @remoteName
		 */
		function newAdmin($form=false,$error=false){
			$success = false;
			$L       = $this->_LANG['LOGIN'];

			if(isset($form['username'])){
				// Form has been posted. lets check values...
				// Server Side Form Checking... 
				$_SESSION['newAdminForm'] = $form;
				$error = $this->validateNewUserForm($form);

				if(!$error){

					if(!$this->insertUser($form)){
						$error = $this->Q->error;
					}else{


						$success = true;
						$to = $form['email'];
						foreach($form as $k => $v){
							$form['msg'] = str_replace("$".$k,$v,$form['msg']);
						}

						$message = wordwrap($form['msg'],70);
						$headers = 'From: noreply@'.str_replace('www.', '', $_SERVER['HTTP_HOST']). "\r\n" .'X-Mailer: PHP/' . phpversion();

						$form['mail'] = $message;	
						if( !mail($to, $subject, $message, $headers) ){
							$error = $this->lang($this->_LANG['LOGIN']['ERROR']['SENDMAIL'],$form);
						}
					}
				}
			}else{
				$form = (!isset($_SESSION['newAdminForm'])) ? array(
					'username' => $L['USERNAME'], 
					'password' => '', 
					'email'    => $L['EMAIL'] ,
					'subject'  => $this->lang($L['NEW_ADMIN_EMAIL_SUBJECT'],$_SERVER)
				) : $_SESSION['newAdminForm'];
				unset($_SESSION['newAdminForm']);
			}

			return array(
				'success'  => $success,
				'error'    => urldecode($error),
				'username' => $form['username'],
				'password' => $form['password'], 
				'confirm'  => $form['confirm'],
				'email'    => $form['email'],
				'subject'  => $form['subject']
			);
		}

		function usernameIsUnique($username)
		{
			return (0 === count($this->q()->Select(
				'*','Users',array(
					'username' => $username
				))
			));
		}

		private function validateNewUserForm($form)
		{
			// These all the required fields.
			foreach (['username','password','confirm','email'] as $key => $value) {
				if($value == 'username'){
					if(!$this->usernameIsUnique($form['username'])){
						return $this->lang($this->_LANG['LOGIN']['ERROR']['UNIQUE'],$form);
					}		
				}
				if ($form[$value] === ''){
					return ucfirst($value) . " Required";
				}
			}

			if(!$this->is_email($form['email'],true))
				return $this->lang($this->_LANG['LOGIN']['ERROR']['EMAIL'],$form);
	
			// Requists passed.
			// Check to make sure pass and confirm are the same.
			if($form['password'] !== $form['confirm'])
				return $this->_LANG['LOGIN']['ERROR']['CONFIRM'];
		}

		function setUser($user){
			$unset = ['password','hash'];
			
			$_SESSION['user'] = $user;
			$_SESSION['user']['secret'] = md5($user['username'].$user['password']);

			foreach ($unset as $k => $v) 
				if( isset($_SESSION['user'][$v]) )
					unset($_SESSION['user'][$v]);

			foreach($_SESSION['user'] as $k => $v){
				setcookie("user[$k]",$v);
			}
		}

		function checkUserX($user){
			$x = $this->getXTends();
			foreach($x as $k => $v){
				$Link = str_replace('.php','',$k);
				$Link = strtolower(substr($Link,1));
				if($Link == strtolower($user)){
					return false;
				}
			}
			return true;
		}

		function register(){
			$form = $_POST['form'];
			$q = $this->q();

			$error = $this->validateNewUserForm($form);

			$this->set('error',$error);

			if(!$error){

				$exist = $q->Select('*','Users',array(
					'username'	=> $form['username'],
					'email'		=> $form['email']
				),'','=','OR');

				# Create new user
				 
				if(empty($exist) && $this->checkUserX($form['username']) ){
					# Check user name against xtensions
					$form['hash'] 		= sha1(md5(base64_encode($form['email'].$form['password'])));
					$form['password'] 	= md5(sha1($form['password']));
					$form['power_lvl'] 	= 1;
					unset($form['confirm']);

					$q->Insert('Users',$form);
					$this->setUser($form);

					//header('Location: /'.$form['username']);
				}else{
					$exist = $exist[0];
					$error = "Invalid Username - Please choose another";

					if($form['email'] == $exist['email'] ){
						$error = "A user with this email already exists!";
					}

					if($form['username'] == $exist['username'] ){
						$error = "The Username, $form[username], Is Not Available.";
					}

					$this->set('error',$error);
				}

			}

			//


			$this->set('WWW_PAGE','Create Your Free Account Now');
			$this->set('PAGE_TITLE','Create Your Free Account Now');
			return array(
				'success' => (empty($error)),
				'error'   => $q->error,
				'form'    => $form
			);
		}

	}
?>