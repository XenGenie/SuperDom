<?php
/**
 * @name Access
 * @desc Manage Access to who, where and when.
 * @version v0.1.12.14.20.171
 * @author cdpollard@gmail.com
 * @icon Keychain2.png
 * @mini lock
 * @link access
 * @see domain
 * @release alpha
 * @todo
 * @alpha true
 */

	class xAccess extends Xengine{
		function dbSync(){
			return array(
				'AccessPermits' => array(
					'membership_id'	=> array('Type' => 'int(3)'),
					'xtension'		=> array('Type'	=> 'varchar(25)'),
					'open'			=> array('Type'	=> 'int(1)','Default'=>0),
				),
				'AccessPermissions' => array(
					'membership_id'	=> array('Type' => 'int(3)'),
					'xtension'		=> array('Type'	=> 'varchar(25)'),
					'door'			=> array('Type'	=> "enum('front','back')"),	//
					'room'			=> array('Type'	=> 'varchar(25)'),
					'open'			=> array('Type'	=> 'int(1)','Default'=>0),
				)
			);
		}

		function __construct($sdx=null){
			$this->sdx = $sdx;
		}

		public function autoRun($X)
		{
			$door = $X->_CFG['dir']['sidedoor'];
			$goto = ($X->atSideDoor) ? str_replace("$door/", '', $this->url['path']) : $this->url['path'];


			
			if($this->Key['is']['admin']){ 
				$this->set('admin_menu',$this->mkAdminMenu());
			}


			return $this->enterKey($goto);
		}

		/*
			This will autodirect anyone trying to access the admin panel to the login
		*/
		private function enterKey($goto)
		{		
			if($this->atBackDoor)
			{
				$this->_comment("Entering through Back Door");
				# Entering Through the 'Back Door' 
				if($this->Key['is']['user']){		
					if(!$this->Key['is']['admin']) 
					{	
						// Handle Users without Permission
						return array(
							'action' => 'access',
							'method' => 'deny',
							'params' => array( $this->uri, $this->_LANG['NOT_ADMIN'] )
						);
					}else{
						// We have yet to determine if we are an admin... - but we need to know if a Super Admin exist. 
						return array(
							'SUPER_ADMIN' => $this->hasSuperAdmin()
						);
					}
				} else {		
				// User not Logged In! 
					// Put everything on hold until this is resolved.   
					// This Xtra will Attempt to Log them in 

					return array(
						'action'      => 'login',
						'method'      => 'index', 
						'SUPER_ADMIN' => $this->hasSuperAdmin(),
						'after_login' => "/".$goto
					);
				}
			}
		}

		private function hasSuperAdmin(){
			$super = $this->Q->Select('id','Users', array(
				'power_lvl' => 9
			));

			$super = ( empty($super) ) ? false : true ;

			return $super;
		}

		function deny($request=null,$reason=null){
			$reason = urldecode($reason);
			
			if($q = $this->q()){
				$q->Insert('Logs',array(
					'request'	=> $request,
					'username' 	=> $_SESSION['user']['username'],
					'user_id' 	=> $_SESSION['user']['id'],
					'reason' 	=> $reason,
					'timestamp' => time()
				));	
			} 
			return array(
				'request' => $request,
				'reason'  =>$reason
			);
		}

		function db($request=null,$reason=null){
			return array(
				'request' => $request,
				'reason'  => urldecode($reason)
			);
		}

		function getDoors($id=0){
			$xphp 	= $this->getXTends();
			$q 		= $this->q();

			$this->set('memberships',$q->Select('*','Memberships'));

			foreach($xphp as $k => $v){
				$class = str_replace('.php','',$k);
				$loc = lcfirst(substr($class, 1));

				$permits = $q->Select('open','AccessPermits',array(
					'xtension'		=> $class,
					'membership_id'	=> $id
				));

				$xphp[$k]['open'] = $permits[0]['open'];

				// Find all the @_@ files
				$a_aLoc = HTML_DIR.'/'.PUBLIC_LOC.'/';
				if(is_dir($a_aLoc.$loc)){
					$a_a = scandir($a_aLoc.$loc);
					if(!empty($a_a)){
						foreach($a_a as $n => $f){
							if(is_dir($a_aLoc.$loc.'/'.$f)){
								unset($a_a[$n]);
							}

							$f = str_replace('.html','',$f);

							if(!method_exists($class,$f)){
								unset($a_a[$n]);
							}else{
								$a_a[$n] = str_replace('.html','',$f);

								$permits = $q->Select('open','AccessPermissions',array(
									'xtension'		=> $class,
									'door'			=> 'front',
									'room'			=> $a_a[$n],
									'membership_id'	=> $id
								));

								$a_a[$n] = array(
									'room' 	=> $f,
									'open'	=> $permits[0]['open']
								);
							}
						}
					}
					$xphp[$k]['front_doors'] = $a_a;
				}

				if($id){
					// Find all the @ files
					$aLoc = HTML_DIR.'/'.APP_LOC.'/';
					if(is_dir($aLoc.$loc)){
						$a = scandir($aLoc.$loc);
						if(!empty($a)){
							foreach($a as $n => $f){
								if(is_dir($aLoc.$loc.'/'.$f)){
									unset($a[$n]);
								}

								$f = str_replace('.html','',$f);

								if(!method_exists($class,$f)){
									unset($a[$n]);
								}else{
									$a[$n] = str_replace('.html','',$f);

									$permits = $q->Select('open','AccessPermissions',array(
										'xtension'		=> $class,
										'door'			=> 'back',
										'room'			=> $a[$n],
										'membership_id'	=> $id
									));

									$a[$n] = array(
										'room' 	=> $f,
										'open'	=> $permits[0]['open']
									);
								}
							}
						}
						$xphp[$k]['back_doors'] = $a;
					}
					$membership = $q->Select('*','Memberships',array('id'=>$id));
					$this->set('membership',$membership[0]);
					$this->set('membership_id',$id);
				}

				if(empty($xphp[$k]['back_doors']) && empty($xphp[$k]['front_doors'])){
					unset($xphp[$k]);
				}

			}

			$this->set('xphp_local',$xphp);
			$this->set('xphp_local_json',json_encode($xphp));
		}

		function index(){
			$this->getDoors(0);
		}

		function notFound($error_no,$msg){
			$this->set('error',$error);
			$this->set('msg',$msg);
		}

		function setPermit($id=0){
			if(!empty($_POST)){
				$q = $this->q();
				$install = $q->Select('id','AccessPermits',array(
					'xtension' => $_POST['xtension'],
					'membership_id'	=> $id
				));

				if(!empty($install)){
					$q->Update('AccessPermits',array(
						'xtension'	=> $_POST['xtension'],
						'open'		=> $_POST['open'],
						'membership_id'	=> $id
					),array(
						'id'		=> $install[0]['id']
					));
				}else{
					$q->Insert('AccessPermits',array(
						'xtension'	=> $_POST['xtension'],
						'open'		=> $_POST['open'],
						'membership_id'	=> $id
					));
				}

			}
			$_POST['time'] = str_replace('0.','o',microtime());
			$_POST['time'] = str_replace(' ','',$_POST['time'] );
			$this->json_out($_POST);
		}

		function setPerm($id=0){
			if(!empty($_POST)){
				$q = $this->q();
				$install = $q->Select('id','AccessPermissions',array(
					'xtension' => $_POST['xtension'],
					'door'		=> $_POST['door'],
					'room'		=> $_POST['room'],
					'membership_id'	=> $id
				));

				if(!empty($install)){
					$q->Update('AccessPermissions',array(
						'xtension'	=> $_POST['xtension'],
						'door'		=> $_POST['door'],
						'room'		=> $_POST['room'],
						'open'		=> $_POST['open'],
						'membership_id'	=> $id
					),array(
						'id'		=> $install[0]['id']
					));
				}else{
					$q->Insert('AccessPermissions',array(
						'xtension'	=> $_POST['xtension'],
						'door'		=> $_POST['door'],
						'room'		=> $_POST['room'],
						'open'		=> $_POST['open'],
						'membership_id'	=> $id
					));
				}
				echo $q->error;
			}
			$_POST['time'] = str_replace('0.','o',microtime());
			$_POST['time'] = str_replace(' ','',$_POST['time'] );
			$this->json_out($_POST);
		}

	}

?>