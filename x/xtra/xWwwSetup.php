<?php
/**
 * @author i@xtiv.net
 * @name www Setup
 * @desc Setup 'Out-of-the-Box' www Settings
 * @version  v1(11.01.11@17.44)
 * @icon Tools.png
 * @mini wrench
 * @see construct
 * @link wwwSetup
 * @todo Make an interface!
 */
class xWwwSetup extends Xengine {

	function __construct($c){
		parent::__construct($c);
	}

	function dbSync(){
		return array(
			'costumez' => array(
				'title' 		=> array('Type'=>'varchar(50)'),
				'version' 		=> array('Type'=>'varchar(50)'),
				'table_name' 	=> array('Type'=>'varchar(50)'),
				'author' 		=> array('Type'=>'varchar(50)'),
				'credits_url' 	=> array('Type'=>'varchar(255)'),
				'thumbnail' 	=> array('Type'=>'varchar(255)'),
				'preview_img' 	=> array('Type'=>'varchar(255)'),
				'describe' 		=> array('Type'=>'varchar(1000)')
			)
		);
	}

	function watchtowerFeed(){
		
	}

	function readConfigs(){
		if($q = $this->q()){
			$config = $q->Select('*','config');

	    	foreach($config as $k => $v){
	    		$this->set($v['config_option'],$v['config_value']);
	    		$CFG[$v['config_option']] = $v['config_value'];
	    	}
	    	$this->set('CFG',$CFG);
	    	return $CFG;	
		}else{
			$this->set('www_costume_admin','adminzone');
			$this->set('www_themex_admin','@panel');
		}
	}	

	function autoRun($X){
		// Read a file containing domains, add to list if not in it.
		// @TODO: The purpose here is to be able to setup different domains on a single install of superdom
		$icons = ['16','24','32','48','64','128','256','512'];
		foreach ($icons as $k => $v) {
			$this->_SET['ICON'][$v] = $this->_CFG['dir']['icons'].'/'.$v.'x'.$v.'/';
		}

		$this->_SET['ICON']["A"] = $this->_CFG['dir']['icons'].'/admin/';

		if($q = $X->Q){
			$config = $X->Q->Select('*','config');
	    	foreach($config as $k => $v){
	    		$configs[$v['config_option']] = $v['config_value'];
	    		$this->set($v['config_option'],$v['config_value']);
	    	}
	    	$this->set('CONFIG',$configs);





		}else{
			$this->set('www_costume_admin','adminzone');
			$this->set('www_themex_admin','@panel');
		}

		$style = ($X->atBackDoor) ? $this->_SET['www_costume_admin'] : $this->_SET['www_costume'];
		
		$this->_SET['HTML']['HEAD']['STYLE'] = $this->style($style);
		
		// function addDom($file){
		// 	file_put_contents($file, HTTP_HOST."\n", FILE_APPEND | LOCK_EX);
		// }

		// $file = XPHP_DIR.'/xWwwSetup/web_doms';
		// if(is_file($file)){
		// 	$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		// 	$flagged = false;
		// 	foreach($lines as $num => $line){
		// 		if(!$flagged){
		// 			$flagged = (HTTP_HOST == trim($line)) ? true : $flagged;
		// 		}
		// 	}
		// 	if(!$flagged){
		// 		addDom($file);
		// 	}
		// }else{
		// 	addDom($file);
		// }

		return $this->_SET;
	}

	public function dump($var)
	{
		$this->set('var',$var);
	}

	public function style($area='users'){
		if($q = $this->q()){
				
			// Get all the elements
			$q->mBy = array('id'=>'ASC');
			$q->setStartLimit(0,1000);

			// ok... we have a db file. but do we have a db!?
			$elements = $q->Select('*','costume_'.$area);

			$styles = null;

			if(is_array($elements)){
				foreach($elements as $k => $v){
					$attr = array();
					ksort($v);

					// Build the Attributes
					foreach($v as $key => $value){
						if($key != 'element' && $key != 'id' && $key != 'state'){
							if(trim($value) !== ''){
								$attr[] = array(
									'key' => $key,
									'value' => $value
								);
							}
						}
					}

					if(!empty($attr)){

						//Build the Style
						$styles[] = array(
							'element' 	=> strtolower($v['element']),
							'state' 	=> $v['state'],
							'attr'		=> $attr
						);
					}

				}
			}

			// Assign the styles to template
			return $styles;
		}
	}

	function worldmap(){ 
		$fmtime = filemtime($this->_CFG['dir']['cfg'].'/cfg.x.inc');

		// Make sure these are set...
		$check = ['site_name','site_moto','site_copyright'];
		foreach ($check as $key => $value) {
			if(!isset($this->_SET['CONFIG'][$value])){
				$cfg = explode('_', $value);
				$cfg = strtoupper($cfg[1]);
				$this->_SET['CONFIG'][$value] = $this->_SET['_LANG']['XWWWSETUP']['CONFIG']['SITE'][$cfg];  
			}
		}
 


		return array(
			'SDX_INSTALL' => date ("F d Y", $fmtime), 
			'users'       => $this->getTotalUsers(),
			'visits'      => $this->getTotalVisits(),
			'hits'        => $this->getTotalHits(),
			'tutor' 	 => $_GET['tutor']
		);
	}
	
	function home(){
		return array(
			'SDX_INSTALL' => time(),
			'users' => 0,
			'visits' => 0,
			'hits' => 0
		);
	}
	

	/**
	 * @remotable
	 */
	function returnX($x,$f=null){
		$xphp = $this->getXTends();
		return array('success'=>true,'x'=>$xphp['x'.ucfirst($x).'.php']);
	}
	
	/**
	 * @remotable
	 */
	function loadSettings(){
		$config = $this->q()->Select('*',
			'config'
		);
		if(empty($config)){
			$form = array();
		}else{
			foreach($config as $k => $v){
				$form['config['.$v['config_option'].']'] = $v['config_value'];
			}
		}

		return array('success'=>true,'data'=>$form);
	}

	/**
	 * @remotable
	 * @formHandler
	 * @remoteName
	 */
	public function saveSettings($form=null){

		if(isset($_POST['config'])){


			if(!empty($_FILES['config']['name']['site_logo'])){



				//$_POST['config']['site_logo'] = $_FILES['site_logo']['name'];
				$logo_path = XPHP_DIR."/xWwwSetup/logo/";

				if(!file_exists($logo_path)){
					mkdir($logo_path);
				}

				$target_path = $logo_path.$_SERVER['HTTP_HOST'];


				if(!file_exists($target_path)){
					mkdir($target_path);
				}

				if(!empty($_FILES)){
					ob_start();
						echo "<pre>";
						print_r($_FILES);
						echo "</pre>";
					$out = ob_get_contents();
					ob_end_clean();
					file_put_contents($target_path.'/log.txt', $out);
					foreach($_FILES as $f => $v){ 
						//file_put_contents($target_path.'/log.txt', $f.'~'.$v['name'], FILE_APPEND);
						//file_put_contents($target_path.'/log.txt', $f.'~'.$v['tmp_name'], FILE_APPEND);
					}
				}else{
					file_put_contents($target_path.'/log.txt', 'EMPTY', FILE_APPEND);
				}

				$target_path = $target_path . '/' . basename($_FILES['config']['name']['site_logo']);
				move_uploaded_file($_FILES['config']['tmp_name']['site_logo'], $target_path);

				$form['config']['site_logo'] = $_POST['config']['site_logo'] = "http://$_SERVER[HTTP_HOST]".str_replace($_SERVER['DOCUMENT_ROOT'],'',$target_path);
			}

			$q = $this->q(); 

			foreach($_POST['config'] as $k => $v){
				$option = $q->Select('*','config',array(
					'config_option'=> $k
				));

				if( empty($option) ){
					$q->Insert('config',array(
						'config_value' => $v,
						'config_option'=> $k
					));
				} else {
					$q->Update('config',array(
						'config_value' => $v
					),array(
						'config_option'=> $k
					));
				} 
			} 
		}

		return array(
			'success'=>true,
			'data'=> $form,
			//'msg'=>'Success!',
			//'title'=>'Did it!'
		) ;

		//$this->cleanExtForm($form);
	}


	

	/**
	 * @remotable
	 */
	function addIconToBar($id){
		$q = $this->q();
		return array(
			'success' => $q->Update('admin_shortcuts',
				array('toolbar'	=> true), 
				array('id'=>$id)
			)
		);
	}



		/**
		 * @remotable
		 */
		function switchIcon($file,$text){
			$x = $this->getXtras();
			$x = $x[$file];
			$q = $this->q();

			if($text){
				$q->Delete('admin_shortcuts',array(
					'icon'		=> $x['icon'],
					'user_id'	=> $_SESSION['user']['id']
				));
				$el = $q->Insert('admin_shortcuts',array(
					'title'       => $text,
					'icon'        => $x['icon'],
					'link'        => $x['link'],
					'description' => $x['desc'],
					'user_id'     => $_SESSION['user']['id']
				));
			}else{
				$el = $q->Delete('admin_shortcuts',array(
					'icon'=> $x['icon'],
					'user_id'	=> $_SESSION['user']['id']
				));
			}



			return array(
				'success' => $el
			);
		}

		/**
		 * @remotable
		 */
		function removeIcon($id){
			return array(
				'success' => $this->q()->Delete('admin_shortcuts',array(
					'id'=> $id,
					'user_id'	=> $_SESSION['user']['id']
				))
			);
		}

		function index(){
			if(isset($_POST['config'])){
				if(!empty($_FILES['site_logo']['name'])){
					$_POST['config']['site_logo'] = $_FILES['site_logo']['name'];

					$logo_path = XPHP_DIR."/xWwwSetup/logo/";
					if(!file_exists($logo_path)){
						mkdir($logo_path);
					}

					$target_path = $logo_path.$_SERVER['HTTP_HOST'];


					if(!file_exists($target_path)){
						mkdir($target_path);
					}
					$target_path = $target_path . '/' . basename( $_FILES['site_logo']['name']);
					move_uploaded_file($_FILES['site_logo']['tmp_name'], $target_path);

					$_POST['config']['site_logo'] = "http://$_SERVER[HTTP_HOST]/".str_replace($_SERVER['DOCUMENT_ROOT'],'',$target_path);

				}

				$q = $this->q();

				foreach($_POST['config'] as $k => $v){
					$option = $q->Select('*','config',array(
						'config_option'=> $k
					));

				if( empty($option) ){
					$q->Insert('config',array(
						'config_value' => $v,
						'config_option'=> $k
					));
				} else {
					$q->Update('config',array(
						'config_value' => $v
					),array(
						'config_option'=> $k
					));
				}


				}
				$this->set('success','Configuration Updated!');
			}
			$this->getCostumez();
			foreach($this->_SET['costumez'] as $k => $v){
				$costumez[$k] = $v['title'];
			}

			$this->set('costume_options',$costumez);
		}

		function getCostumez(){
		    $q = $this->q();
		    $costumez = $q->Select('*','costumez');
		    if(!empty($costumez)){
		        foreach($costumez as $k => $v){
		                $data[$v['table_name']] = $v;
		        }
		        $this->set('costumez',$data);
		    }
		}

		function install(){
			ini_set('display_errors', 1);
			$ERROR['msg'] =false;
			$ERROR['no'] =false;
			$this->_comment("Installing Xengine Go");

			$DB = array(
				'host'     => $_SERVER['HTTP_HOST'],
				'database' => 'Xengine',
				'user'     => 'username',
				'pass'     => '',
				'prefix'   => 'sdx' 
			);

			if(isset($_POST['DB'])){

				$DB = array_merge($DB,$_POST['DB']);
				
				$DB['pass'] = "";

				$this->_comment("Database Info Entered, Attempting Connection");
				
			 	$this->db = $_POST['DB'];
				//
				try{
					$mysqli = new mysqli($this->db['host'], $this->db['user'], $this->db['pass'],$this->db['database']);
					/*
					 * This is the "official" OO way to do it,
					 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
					 */
					if ($mysqli->connect_error) {
					    throw new Exception(('Connection Error (#' . $mysqli->connect_errno . ') '. $mysqli->connect_error), 1);
					} else if(!file_exists(DB_CFG)){
						$this->buildConfig();

						$q = $this->q();
						$this->_comment("Connection Success");
						
						// Check for install already .....
						$data = $q->Select('*','config');
						
					// Here we Install the Basic SQL Tables.
						if(empty($data)){
							$q->ImportSql($this->_CFG['dir']['libs']."/x4deep/db.install.sql");
						}

						header('Location: /'.$this->_CFG['dir']['backdoor']);	
					}
				}catch(Exception $e){
					$ERROR['msg'] = $e->getMessage();
					$ERROR['no']	= $mysqli->connect_errno;

				}
			}

			$this->_comment("Need DB Info to Continue");
			
			$this->_SET['HTML']['HEAD']['TITLE'] = 'Click the Green Button to Continue...';

			return array(
				'DB' => $DB,
				'ERROR' => $ERROR
			);
		}
		/**
		 *  This builds extjs css style icons from images
		 *  found in the icon folder
		 */
		function buildCss($dir='/images/icons',$subDir=false){
			if ($handle = opendir(BIN.$dir)) {
				$echo = [];
			    $css = null;

    			while (false !== ($file = readdir($handle))) {
			        // recrusive..
    				if ($file != "." && $file != "..") {

    					if(is_dir(BIN.$dir.'/'.$file)){
	    					$css .= $this->buildCss($dir.'/'.$file,$file);
	    				}else{
	    					$dir = str_replace('..','',$dir);
	    					$file = explode(".",$file);
	    					$filename = strtolower(str_replace(')', '', str_replace('(', '', str_replace(' ','_',$file[0]))));

$echo[$subDir.'-'.$filename] = ".x-icon-$subDir-$filename {
	background-image: url('/bin$dir/$file[0].$file[1]') !important;
	border: 0px;
}
";	


	    				}
			        }
			    }

			    ksort($echo);
			    foreach ($echo as $key => $value) {
			    	# code...
			    	$css .= $value;
			    }

			    closedir($handle);
			}else{
				$this->dump($dir);	
			}


			file_put_contents(BIN.'/css/'.$_SERVER['HTTP_HOST'].'-icons.css',$css);
			if($subDir == false){

			}else{
				echo "$dir Done!<hr/>";
				return $css;
			}
 
		}


		function buildConfig(){
			// Lets build our data config File!
			$time = time();
			$put = "<?php /* AUTOBUILT */
	";
			foreach($this->db as $key => $value){
				/// Shhhh base64 the password.

				if($key == 'pass'){
					for($i=0; $i<count($this->mainDomain()); $i++){
						$value = base64_encode($value);
					}
				}

				$put .= '$this->db'."['$key'] = '$value';
	";
			}

			$time = time() - $time;
			// $put .= "/* Hashed in $time seconds */";
			$put .= "?>";

			file_put_contents(DB_CFG,$put);

			/* use this later...
			 if(file_exists(DB_CFG)){
				// Lets Read Our Config Array
				require(DB_CFG);
				// Should load us up with a $cfg['']
			 }
			 */
		}

		function buildJs($option=null){
			$js_txt_file 	= XPHP_DIR."/xWwwSetup/js.txt";
			$js_min_md5 	= "$js_txt_file.md5";
			$js_min_file 	= BIN."/js/minified/js_min.js";

			$public_js_txt_file = XPHP_DIR."/xWwwSetup/public_js.txt";
			$public_js_min_md5 = "$public_js_txt_file.md5";
			$public_js_min_file = BIN."/js/minified/public_js_min.js";

			if($option == 'delete'){
				unlink($public_js_min_file);
				unlink($js_min_file);
				header("Location: /@/wwwSetup/buildJs");
			}

			if(isset($_POST['js_txt'])){
				file_put_contents($js_txt_file,$_POST['js_txt']);
				$file = $js_min_file;

				// Base Files
				$files = file($js_txt_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				// Build Files
				require_once(LIBS_DIR."/JsMinify.php");
				$min = new JsMinify();
				$min->js_file = $js_min_file;
				$min->md5_file = $js_min_md5;
				$min->minify($files);

				$this->set('SUCCESS','Successfully Built Minified JS file!');
				$this->set('TIME',time() - $this->TIME);
				//header('Location: /os/build.php?pass=xt4');
			}

			if(isset($_POST['public_js_txt'])){
				file_put_contents($public_js_txt_file,$_POST['public_js_txt']);
				$file = $public_js_min_file;

				// Base Files
				$files = file($public_js_txt_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				// Build Files
				$min->js_file = $public_js_min_file;
				$min->md5_file = $public_js_min_md5;
				$min->minify($files);

				//$this->set('SUCCESS','Successfully Built Minified JS file!');
				//$this->set('TIME',time() - $this->TIME);
				//header('Location: /os/build.php?pass=xt4');
			}


			if(file_exists($js_min_file)){
				$this->set('last_build_time',date('m-d-y h:i:sA',filemtime($js_min_file)));
				$this->set('js_min_size',round(filesize($js_min_file)/1024));
				$this->set('js_min_file',str_replace($_SERVER['DOCUMENT_ROOT'],'',$js_min_file));
			}

			if(file_exists($public_js_min_file)){
				$this->set('last_pub_build_time',date('m-d-y h:i:sA',filemtime($public_js_min_file)));
				$this->set('pub_js_min_size',round(filesize($public_js_min_file)/1024));
				$this->set('pub_js_min_file',str_replace($_SERVER['DOCUMENT_ROOT'],'',$public_js_min_file));
			}


			$js_txt = file_get_contents($js_txt_file);
			$this->set('js_txt',$js_txt);

			$public_js_txt_file = file_get_contents($public_js_txt_file);
			$this->set('public_js_txt_file',$public_js_txt_file);

		}

		function installed(){
			function getDom($dom){
				$host = "http://$dom";
				return json_decode(file_get_contents("$host/?json"),true);
			}

			$db_doms = $this->q()->Select('domain','RemoteDomains');
			if(!empty($db_doms)){
				foreach($db_doms as $k => $v){
					if($v['domain'] != 'localhost'){
						$dom = str_replace('www.','',$v['domain']);


						$doms[$dom] = getDom($dom);

						$web_doms = trim(file_get_contents("http://$dom/@/xphp/xWwwSetup/web_doms"));

						$web_doms = explode("\n",$web_doms);
						if(!empty($web_doms)){
							foreach($web_doms as $num => $line){
								$line = trim(str_replace('www.','',$line));
								$doms[$line] = getDom($line);
							}
						}
					}
				}
				$this->set('doms',$doms);
			}
		}
	}
?>