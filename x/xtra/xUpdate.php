<?php
/**
 * @name neXus
 * @desc Sleep easy   by keeping your Domain updated with stable nightly builds
 * @version v1.11.10.22.00.28
 * @author i@xtiv.net
 * @icon health.png
 * @mini empire
 * @see  support
 * @link update
 * @todo
 * @license
 */
	define('CORE_DOMAIN','http://Xengine.com');
	set_time_limit(360);
	class xUpdate extends Xengine{

		function dbSync(){
			$table['RemoteDomains']['domain']['Type'] 		= 'varchar(256)';
			$table['RemoteDomains']['expires']['Type'] 		= 'datetime';
			$table['RemoteDomains']['installed']['Type'] 	= 'datetime';
			//$table['RemoteUpdateLogs'] = array();
			$table['config']['config_option']['Type'] 		='varchar(255)';
			$table['config']['config_value']['Type'] 		='varchar(255)';

			return $table;
		}

		/*function autoRun($sDom){
			if($sDom->AREA51 && $sDom->IS_ADMIN){	// is in backend & logged in
				//echo $this->SET['CFG'][''last_check''];
				if($_SESSION['updates']['last_check']){
					$time = time() - $_SESSION['updates']['last_check'];
					if( $time > (60 * 60) ){
						$this->countUpdates();
					}else{
						$this->set('expired',				$_SESSION['xUpdate']['expired']);
						$this->set('remote_xphp_files',		$_SESSION['xUpdate']['remote_xphp_files']);
						$this->set('remote_costumez',		$_SESSION['xUpdate']['remote_costumez']);
						$this->set('remote_blox',			$_SESSION['xUpdate']['remote_blox']);
						$this->set('remote_a_portal',		$_SESSION['xUpdate']['remote_a_portal']);

						$this->getXTends();
						$this->getBlox();
						$this->getAdminPortal();

						if(method_exists($this,'getCostumez')){
							$this->getCostumez();
						}

						$this->set('updates',$_SESSION['updates']['count']);
					}
				}else{
					$this->countUpdates();
				}
			}

			if($_SESSION['runUpdate']['xphp']){
				foreach($_SESSION['runUpdate']['xphp'] as $k => $v){
					$encode = base64_encode($v);
					unset($_SESSION['runUpdate']['xphp'][$k]);
					header("Location: /@/update/updateXPhp/$encode");
				}
			}

			if(isset($_GET['downloadXCore'])){
				//$this->downloadCore();
			}
		}
*/
		function readContents($function){
			$me  = array(
				'host'		=> $_SERVER['HTTP_HOST'],
				'user' 		=> $_SESSION['user']['username']
			);
			$key 	= base64_encode( json_encode($me) );
			set_time_limit(1000);
			return file_get_contents( CORE_DOMAIN."/update/$function/?returnJson&key=$key");
		}

		function install(){
			$this->index();
		}

		function syncDb(){
			$this->syncDbTables();

			return array(
				'success' => true,
				'msg'     => "Xtras & Databases Have been Synced"
			);
		}

		function countUpdates(){
			$count = 0;
			// Report all PHP errors
			error_reporting(-1);
			$remote = $this->readContents('giveUpdates');
			
			 utf8_encode($remote);
			
			$remote = JSON::Decode($remote,true);
			  
			 
			
			$this->getXTends();
			$this->getBlox();
			$this->getAdminPortal();

			if(method_exists($this,'getCostumez')){
				$this->getCostumez();
			}

			// Lets check for updates!
			$update = $this->_SET['xphp_files'];
			if(!empty($update)){
				foreach($update  as $k => $v){
					if(isset($remote['xphp_files'][$k]['version']) && $v['version'] != $remote['xphp_files'][$k]['version']){
						$count++;
					}
				}
			}

			$update = $this->_SET['costumez'];
			if(!empty($update)){
				foreach($update as $k => $v){
					if(isset($remote['costumez'][$k]['version']) && $v['version'] != $remote['costumez'][$k]['version']){
						$count++;
					}
				}
			}

			$update = $this->_SET['blox'];
			if(!empty($update)){
				if(!empty($remote['blox'])){
					foreach($remote['blox'] as $k => $v){
						if($v != $remote['blox'][$k]){
							$count++;
						}
					}
				}
			}

			$update = $this->_SET['a_portal'];
			if(!empty($remote['a_portal'])){
				foreach($remote['a_portal'] as $k => $v){
					if($v != $update[$k]){
						$count++;
						$directory = explode('/',$k);
						unset($directory[count($directory)-1]);
						$this->mkParents(HTML_DIR,$directory);
					}
				}
			}



			$_SESSION['updates']['count'] = $count;
			$_SESSION['updates']['last_check'] = time();

			$this->set('updates',$count);
			return $remote;
		}

		function index(){
			//$xphp = $this->getXTends();
			
			function mkParents($dir,$directory){
				$this_dir = implode('/',$directory);
				unset($directory[count($directory)-1]);
				$parent_dir = implode('/',$directory);

				if(!file_exists($dir.$parent_dir)){
					mkParents($dir,$directory);
				}else{
					if(!file_exists($dir.$this_dir)){
						mkdir($dir.$this_dir);
					}
				}

			}

			$remote = $this->countUpdates();
			$this->getSQLs();

			$q = $this->q();
			$q->Backup(XPHP_DIR.'/xBackup/'.$_SERVER['HTTP_HOST'].'~'.date('Y-m-d@h-i-s').'~'.$q->db['database'].'.sql');


			if(method_exists($this,'syncDbTables')){
				$this->syncDbTables();
			}



			$this->set('sync',true);
			// To Slow!
			// $this->getBinFiles();

			if(!empty($remote['bin_files'])){
				foreach($remote['bin_files'] as $k => $v){
					$directory = explode('/',$k);
					unset($directory[count($directory)-1]);
					mkParents(BIN,$directory);

					$remote_md5 	= $remote['bin_files'][$k];

					if(!file_exists(BIN.$k) || $remote_md5 != md5_file(BIN.$k)){
						$get = str_replace(' ','%20',$k);
						$file = file_get_contents(CORE_DOMAIN.'/bin'.$get);
						try{
							file_put_contents(BIN.$k,$file);
						}catch(Exception $e){

						}
					}else{
						unset($remote['bin_files'][$k]);
					}
				}
			}

			// $this->getLibs();

			if(!empty($remote['lib_files'])){
				foreach($remote['lib_files'] as $k => $v){

					$directory = explode('/',$k);
					unset($directory[count($directory)-1]);
					mkParents(LIBS_DIR,$directory);

					$remote_md5 = $remote['lib_files'][$k];

					if(!file_exists(LIBS_DIR.$k) || $remote_md5 != md5_file(LIBS_DIR.$k)){
						$get = base64_encode($k);
						$latest =  base64_decode($this->readContents("giveLib/$get"));
						$md5 = $this->readContents("giveLib/$get/md5");

						# make sure the download went ok!
						if( md5($latest) === $md5 ){
							# Run the Update!
							$success = file_put_contents(LIBS_DIR.$k,$latest);
						}else{
							$success = false;
						}
					}else{
						unset($remote['lib_files'][$k]);
					}
				}
			}


			$this->set('expired',				$remote['expired']);
			$this->set('remote_sqleton_version',$remote['sqleton_version']);
			$this->set('remote_xphp_files',		$remote['xphp_files']);
			$this->set('remote_costumez',		$remote['costumez']);
			$this->set('remote_blox',			$remote['blox']);
			$this->set('remote_a_portal',		$remote['a_portal']);


			$this->set('LATEST_VERSION',	$remote['Xengine']['version']);
			$this->set('LAST_UPDATE',date('y/m/d@H:i',filemtime(APP_DIR.'/index.php')));
		}


		/**
		 * getBin returns a md5 hash value of all files and sub files in the set directory.
		 * @param $dir 	Directory to Check.
		 * @param $update .pass an array to collect many directories
		 */
		function getBin($dir,$update=null){
			if($checked[$dir]){		// Don't Check again!
				return $update;
			}
			$a_dir = BIN.$dir;
			// Blox Files
			if(is_dir($a_dir)){
				$html = scandir($a_dir);
				if(!empty($html)){
					foreach($html as $k => $v){
						$file = $a_dir.'/'.$v;
						if(!is_dir($file)){
							//$info = pathinfo($file);
							// Encode the contents
							if($v === 'Thumbs.db'){
								unlink($file);
							}else{
								$update[$dir.$v] = md5_file($file);
							}
						}else{
							if( $v[0] != '.' ){
								// recursive
								$update = $this->getBin($dir.$v.'/',$update);
							}
						}
					}
					return $update;
				}
			}else{
				mkdir($a_dir);
			}
			$checked[$dir] = true;
		}

		function getBinFiles($host=null){


			function check4Bin($loc,$files,$class){
				$file = file($loc,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				if( !empty($file) ){


					foreach($file  as $l => $v){
						$bin_loc = 'http://bin.Xengine.com';
						if( substr( $v , 0, strlen($bin_loc) ) == $bin_loc ){

						// If file == '/bin*';
							$bin = substr( dirname($v) , strlen($bin_loc) , strlen($v) ).'/';
							$files = $class->getBin($bin , $files);
						}
					}
				}
				return $files;
			}

			# ALL Images!
			$files = $this->getBin('/images/');

			# Javascript jQuery
			$files = $this->getBin('/js/jq/',$files);

			# X4 JS Files
			$files = $this->getBin('/js/x4/',$files);
			$files = $this->getBin('/js/ux/',$files);

			# Dynamic Drive Stuff
			$files = $this->getBin('/js/dynamicdrive/',$files);

			# Check Public and Private JS for local includes.
			$files 	= check4Bin("http://$host/@/xphp/xWwwSetup/js.txt", $files, $this);
			$files 	= check4Bin("http://$host/@/xphp/xWwwSetup/public_js.txt", $files, $this);

			$this->set('bin_files',$files);
			return $files;
		}

		function getLibs(){



			function getLib($dir,$update=null){
				$a_dir = LIBS_DIR.$dir;
				// Blox Files
				if(is_dir($a_dir)){
					$html = scandir($a_dir);
					if(!empty($html)){
						foreach($html as $k => $v){
							$file = $a_dir.'/'.$v;
							if(!is_dir($file)){
								//$info = pathinfo($file);
								// Encode the contents
								$update[$dir.$v] = md5_file($file);
							}
						}

					}
				}else{
					mkdir($a_dir);
				}
				return $update;
			}

			$files = getLib('/');
			$files = getLib('/x4/',$files);
			$files = getLib('/ux/',$files);
			$files = getLib('/ExtDirect/',$files);
			$files = getLib('/ExtDirect/inc/',$files);
			$files = getLib('/ExtDirect/cache/',$files);
			$files = getLib('/phpThumb/',$files);
			$files = getLib('/phpThumb/fonts/',$files);

			$files = getLib('/getID3/',$files);
			$files = getLib('/'.SMARTY_V.'/',$files);
			$files = getLib('/'.SMARTY_V.'/libs/',$files);
			$files = getLib('/'.SMARTY_V.'/libs/plugins/',$files);
			$files = getLib('/'.SMARTY_V.'/libs/sysplugins/',$files);
			$files = getLib('/'.SMARTY_V.'/',$files);

			$files = getLib('/clickheat/',$files);


			if( !file_exists(LIBS_DIR.'/clickheat/cache') ){
				mkdir(LIBS_DIR.'/clickheat/cache');
			}

			if( !file_exists(LIBS_DIR.'/clickheat/logs') ){
				mkdir(LIBS_DIR.'/clickheat/logs');
			}

			$scan = scandir(LIBS_DIR.'/clickheat');
			foreach($scan as $k => $file){
				if( is_dir(LIBS_DIR.'/clickheat/'.$file) && $file != '.' && $file != '..' && $file != 'cache' && $file != 'logs'){
					$files = getLib('/clickheat/'.$file.'/',$files);
				}else if($file == 'cache'){

				}
			}
			$files = getLib('/clickheat/images/flags/',$files);



			$this->set('lib_files',$files);
			return $files;
		}


		function giveXCore($md5=false){
			$latest = file_get_contents(APP_DIR.'/index.php');
			ob_start('ob_gzhandler');
			if($md5 != 'md5'){
				$this->logUpdate();
				echo base64_encode($latest);
			}else{
				echo md5($latest);
			}
			exit;
		}

		function updateXCore(){
			# get the latest version
			$latest =  base64_decode($this->readContents("giveXCore"));
			$md5 = $this->readContents("giveXCore/md5");

			# make sure the download went ok!
			if( md5($latest) === $md5 ){
				# Run the Update!
				$success = file_put_contents(APP_DIR.'/index.php',$latest);
			}else{
				$success = false;
			}
			$this->set('SUCCESS',$success);
		}


		function giveUpdates(){
			$log = $this->logUpdate();
			// If A Key is NOT Found - lets make sure their xUpdate Script is up-to-date
			if(!isset($_GET['key'])){
				// Show this update script as the only update!
				$this->set('xphp_files',array(
					'xUpdate.php' => 'New'
				));
			} else {
				// Check Again DB for Upgrade Access
				$log['host'];
				if($log['host']){
					$host = $this->q()->Select('*','RemoteDomains',array(
						'domain' => $log['host']
					));
					if(!empty($host)){
						$this->getXTends();
						$this->getCostumez();
						$this->getBlox();
						$this->getAdminPortal();
						$this->getBinFiles($log['host']);
						$this->getLibs();
					}else{
						$this->q()->Insert('RemoteDomains',array(
							'domain' => $log['host'],
							'installed' => date("Y-m-d H:i:s A"),
							'expires'	=> date("Y-m-d H:i:s A",  mktime(0, 0, 0, date("m"),   date("d"),   date("Y")+1))
						));
						$this->set('expired','Configured Domain for the First Time, Run again.');
					}
				}
			}
		}

		function logUpdate(){
			$log = ( isset( $_GET['key']) ) ? json_decode( base64_decode($_GET['key']),true) : array() ;
			 
			$log['ip']   = ($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : ($_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
			$uri = explode('/?',$_SERVER['REQUEST_URI']);
			
			$log['request'] = str_replace('/update/','',$uri[0]);
			$log['time']   = time();
			$this->q()->Insert('RemoteUpdateLogs',$log);
			return $log;
		}

		function mkParents($dir,$directory){
			$this_dir = implode('/',$directory);
			unset($directory[count($directory)-1]);
			$parent_dir = implode('/',$directory);

			if(!file_exists($dir.$parent_dir)){
				mkParents($dir,$directory);
			}else{
				if(!file_exists($dir.$this_dir)){
					mkdir($dir.$this_dir);
				}
			}

		}

		function getDir($dir,$update=null){

			$a_dir = HTML_DIR.$dir;
			// Blox Files
			$html = scandir($a_dir);
			if(!empty($html)){

				foreach($html as $k => $v){
					$file = $a_dir.'/'.$v;
					$info = pathinfo($file);

					if(isset($info['extension'])){
						$ex = strtolower($info['extension']);
						// Check for HTML file.
						if($ex == 'html' || $ex == 'js' || $ex == 'css' || $ex == 'jpg' || $ex == 'png' || $ex == 'gif' || $ex == 'jpeg' ){
							// Encode the contents
							$update[$dir.$v] = md5(base64_encode(file_get_contents($file)));
						}
					}
					
				}
				return $update;
			}
		}

		function getAdminPortal(){
			// Blox Directory


			$update = $this->getDir('/');
			$update = $this->getDir('/@/',$update);
			$update = $this->getDir('/~themex/@panel/',$update);
			$update = $this->getDir('/~themex/@panel/desktop/',$update);
			$update = $this->getDir('/~themex/@panel/desktop/css/',$update);
			$update = $this->getDir('/~themex/@panel/desktop/images/',$update);
			$update = $this->getDir('/~themex/@panel/desktop/images/taskbar/black/',$update);
			$update = $this->getDir('/~themex/@panel/desktop/js/',$update);

			$update = $this->getDir('/~themex/bdaysuite/',$update);
			$update = $this->getDir('/~themex/planejain/',$update);
			$update = $this->getDir('/~extjs/',$update);


			$this->set('a_portal',$update);
		}

		function updatePortal($base64){
			$defile = base64_decode($base64);

			unset($_SESSION['xUpdate']['remote_a_portal'][$defile]);
			$_SESSION['updates']['count']--;


			$latest =  base64_decode($this->readContents("givePortal/$base64"));
			$md5 	= $this->readContents("givePortal/$base64/md5");
			# make sure the download went ok!
			if( md5($latest) === $md5 ){
				file_put_contents(APP_DIR.'/html'.$defile,$latest);
				$this->set("UPDATED",$defile);
			}
		}

		function givePortal($base64,$md5=false){
			// Decode the filename
			$filename = base64_decode($base64);	// xModule

			$latest = file_get_contents(APP_DIR.'/html'.$filename);

			ob_start('ob_gzhandler');
			if($md5 != 'md5'){
				$this->logUpdate();
				echo base64_encode($latest);
			}else{
				echo md5($latest);
			}
			exit;
		}



		function updateCostume($costume){
			unset($_SESSION['xUpdate']['costumez'][$costume]);
			$_SESSION['updates']['count']--;

			// Connect to core and download theme.
			$remote =  base64_decode($this->readContents("giveCostume/$costume"));

			$json 	= json_decode($remote,true);
			$data 	= $json['data'];

			$message = '<hr/>';
			foreach($data as $k => $v){


				/*$element = $this->q()->Select('element',"costume_$costume",array(
					'element' => $v['element'],
					'state' => $v['state']
				));*/

				$element = $this->q()->Delete("costume_$costume",array(
					'element' => $v['element'],
					'state' => $v['state']
				));

				$message .= "$v[element]:$v[state]<br/>";

				unset($v['id']);

				$this->q()->Insert("costume_$costume",$v,array(
					'element' => $v['element'],
					'state' => $v['state']
				));
				/*if( empty($element) ){
					$this->q()->Insert("costume_$costume",$v,array(
						'element' => $v['element'],
						'state' => $v['state']
					));
				}else{
					$this->q()->Update("costume_$costume",$v,array(
						'element' => $v['element'],
						'state' => $v['state']
					));
				}*/

				$message .= $this->q()->error;
			}
			unset($data['costume']['id']);

			$this->q()->Update('costumez',$json['costume'],array(
				'table_name' => $costume
			));

			$this->set('message',"Updated ".$json['costume']['table_name'].$message);
		}

		function giveCostume($costume,$md5=false){

			$data['costume'] = $this->q()->Select('*',"costumez",array('table_name' => $costume));
			$data['costume'] = $data['costume'][0];
			$data['data'] = $this->q()->Select('*',"costume_$costume");

			# Hash them and give those as well...
			$json = json_encode($data);

			ob_start('ob_gzhandler');
			header('Content-Type: text/javascript');
			if($md5 != 'md5'){
				echo base64_encode($json);
				$this->logUpdate();
			}else{
				echo md5($json);
			}
			exit;
		}

		function updateXPhp($base64){
			$defile = base64_decode($base64);

			unset($_SESSION['xUpdate']['xphp_files'][$defile]);
			$_SESSION['updates']['count']--;

			$classname = lcfirst(str_replace('.php','',substr($defile,1)));

			$latest = base64_decode( $this->readContents("giveXPhp/$base64") );
			$md5 	= $this->readContents("giveXPhp/$base64/md5");
			# make sure the download went ok!
			if( md5($latest) === $md5 ){
				$update = json_decode($latest,true);
				foreach($update as $k => $v){
					if(!is_array($v)){
						// Core file update
						file_put_contents(XPHP_DIR.'/'.$k,base64_decode($v));
						$updated[] = '/'.$k;
					}else{
						// We should check for the dir
						$tempdir = HTML_DIR.'/'.$k.'/'.$classname;
						if(!is_dir($tempdir)){
							mkdir($tempdir,0700);
						}
						// Lets loop through the files...
						foreach($v as $file => $contents){
							$classname{0} = strtolower($classname{0});

							$putfile = $tempdir.'/'.$file;
							$updated[] = str_replace(HTML_DIR,'',$tempdir).'/'.$file;

							file_put_contents($putfile,base64_decode($contents));
						}
					}
				}
				$success = true;
				# Run the Update!
			}else{
				$success = false;
			}
			// We should output the data and be on our way...
			$this->set('SUCCESS',$success);
			$this->set('UPDATED',$updated);
		}

		function giveXPhp($base64,$md5=false){
			// Decode the filename
			$filename = base64_decode($base64);						// xModule

			// Store its contents.
			$update[$filename] = base64_encode(file_get_contents(XPHP_DIR.'/'.$filename));

			// Lets get our template name.
			$tempname = str_replace('.php','', substr($filename,2));
			$tempname = strtolower(substr($filename,1,1)).$tempname;


			// Admin dir of templates
			$a_dir = HTML_DIR.'/'.APP_LOC.'/'.$tempname;
			if(is_dir($a_dir)){
				// Get files.
				$a_templates = scandir($a_dir);
				if(!empty($a_templates)){
					foreach($a_templates as $k => $v){
						$file = $a_dir.'/'.$v;
						$info = pathinfo($file);
						// Check for HTML file.
						if($info['extension']){
							// Great! Lets grab it
							$update[APP_LOC][$v] = base64_encode(file_get_contents($file));
						}
					}
				}
			}

			// Pub dir of templates
			/** not sure if we want this feature yet.
			 */
			$a_dir = HTML_DIR.'/'.PUBLIC_LOC.'/'.$tempname;
				if(is_dir($a_dir)){
					// Get files.
					$a_templates = scandir($a_dir);
					if(!empty($a_templates)){
						foreach($a_templates as $k => $v){
							$file = $a_dir.'/'.$v;
							$info = pathinfo($file);
							// Check for HTML file.
							if($info['extension']){
								// Great! Lets grab it
								$update[PUBLIC_LOC][$v] = base64_encode(file_get_contents($file));
							}
						}
					}
				}



			# Hash them and give those as well...
			$latest = json_encode($update);
			ob_start('ob_gzhandler');
			if($md5 != 'md5'){
				$this->logUpdate();
				echo base64_encode($latest);
			}else{
				echo md5($latest);
			}
			exit;
		}





		function updateBlox($base64){
			// Decode the file name
			$defile =	base64_decode($base64);

			unset($_SESSION['xUpdate']['a_portal'][$defile]);
			$_SESSION['updates']['count']--;

			// Decode the contents of the output from the core
			$latest = base64_decode($this->readContents("giveBlox/$base64"));

			// Get the MD5 from the Core
			$md5 	= $this->readContents("giveBlox/$base64/md5");

			// makes sure the download went ok!
			if( md5($latest) === $md5 ){
				file_put_contents(HTML_DIR.'/~blox/'.$defile,$latest);
				$this->set('UPDATED',$defile);
			}
		}

		function getBlox(){
			// Blox Directory
			$a_dir = HTML_DIR.'/~blox/';

			// Blox Files
			$blox = scandir($a_dir);

			if(!empty($blox)){
				foreach($blox as $k => $v){
					$file = $a_dir.'/'.$v;
					$info = pathinfo($file);

					// Check for HTML file.
					if(strtolower($info['extension']) == 'html'){
						// Encode the contents
						$update[$v] = md5_file($file);
					}
				}
			}
			$this->set('blox',$update);
		}

		function giveBlox($base64,$md5=false){
			// Decode the filename
			$filename = base64_decode($base64);						// xModule

			// Store its contents.
			$latest = file_get_contents(HTML_DIR.'/~blox/'.$filename);


			if($md5 != 'md5'){
				ob_start('ob_gzhandler');
				$this->logUpdate();
				echo base64_encode($latest);
			}else{
				echo md5($latest);
			}
			exit;
		}

		function giveLib($base64,$md5=false){
			// Decode the filename
			$filename = base64_decode($base64);						// xModule

			// Store its contents.
			$latest = file_get_contents(LIBS_DIR.$filename);

			if($md5 != 'md5'){
				ob_start('ob_gzhandler');
				$this->logUpdate();
				echo base64_encode($latest);
			}else{
				echo md5($latest);
			}
			exit;
		}

		function addons(){
			$this->countUpdates();
			$this->set('count_blox',count($this->_SET['blox']));
			$this->set('count_costumez',count($this->_SET['costumez']));
			$this->set('count_xphp_files',count($this->_SET['xphp_files']));

		}

		function paid(){
			$this->q()->Insert('PayPalIPN',$_POST);

		}

		function moreX(){
			$remote = $this->readContents('giveUpdates');
			$remote = json_decode($remote,true);

			$this->inc('ux/paypal.inc.php');

			$cats['all'] = 'All';
			$this->set('WWW_TITLE','Addons');
			foreach($remote['xphp_files'] as $k => $v){
				$cats[$v['see']] = ucfirst($v['see']);

				$button 				= new PayPalButton;
				$button->accountemail 	= $v['author'];
				$button->custom 		= time();
				$button->target 		= "_blank";
				$button->currencycode 	= 'USD';
				$button->class 			= 'paypalbutton';
				$button->askforaddress 	= false;

				if($v['price']){
					$button->buttontext = "Buy to Install";
				}


				$button->return_url 	= 'http://'.HTTP_HOST.'/@/update/updateXPhp/'.base64_encode($v['file']);
				$button->ipn_url 		= 'http://'.HTTP_HOST.'/@/update/paid/ipn';
				$button->cancel_url 	= 'http://'.HTTP_HOST.'/cancel';
				//Items
				$button->AddItem(
					$v['name'].'~ Xenginetension',
					'1',
					$v['price'],
					"sdx-$v[see]-$v[link]");
				//Output
				ob_start();
				$button->OutputButton();
				$button = ob_get_contents();
				ob_end_clean();
				if($remote['xphp_files'][$k]['release'] != 'alpha'){
					$remote['xphp_files'][$k]['button'] = $button;
					$remote['xphp_files'][$k]['time'] = $button;
				}else{
					unset($remote['xphp_files'][$k]);
				}

			}
			$this->set('cats',$cats);
			$this->set('xtends',$remote['xphp_files']);

		}

		function getSQLs(){
			// Return array with needed updates.
			$upSQL = new updateSql();
			$updates = $upSQL->runCheck();
			$this->set('sqlUpdates',$updates);
		}

		function upSql($fun=false){

			$upSQL = new updateSql();
			$this->set('message', $upSQL->$fun(true) );
		}
	}

	class JSON
	{
	    public static function Encode($obj)
	    {
	        return json_encode($obj);
	    }
	   
	    public static function Decode($json, $toAssoc = false)
	    {
	        $result = json_decode($json, $toAssoc);
	        switch(json_last_error())
	        {
	            case JSON_ERROR_DEPTH:
	                $error =  ' - Maximum stack depth exceeded';
	                break;
	            case JSON_ERROR_CTRL_CHAR:
	                $error = ' - Unexpected control character found';
	                break;
	            case JSON_ERROR_SYNTAX:
	                $error = ' - Syntax error, malformed JSON';
	                break;
	            case JSON_ERROR_NONE:
	            default:
	                $error = '';                   
	        }
	        if (!empty($error))
	            throw new Exception('JSON Error: '.$error);       
	       
	        return $result;
	    }
	}
	
	/*
	 * This class checks against the database for any updates it should preform.
	 */
	class updateSql extends xUpdate{
		var $updates;	// Array full of update data.
		function runCheck(){
			//$this->update0001(false);
			$this->update0002(false);
			$this->update0003(false);
			$this->update0004(false);
			$this->updateOptIn0001(false);
			return $this->updates;
		}



		/*
		 * Turns `users` table to `Users`
		 */
		function update0001($sync){
			if(!$sync){
				$table = $this->q()->Q('show tables like "users"');
				if(!empty($table)){
					$this->updates['update0001'] = 'Updates Users Table';
				}
				return false;
			}else{
				$this->q()->Q('ALTER TABLE users RENAME TO Users');
				$this->set('message',$this->q()->error);
			}
		}

		/*
		 * adds `first_name` `last_name` `newsletter` colums to `Users`
		 */
		function update0002($sync){
			// taken out!
		}

		/*
		 * adds `email` `last_name` `newsletter` colums to `Users`
		 */
		function update0003($sync){
			if(!$sync){
				$table = $this->q()->Select('email','Users');
				if(empty($table)){
					$this->updates['update0003'] = 'Add Users Email ';
				}
				return false;
			}else{
				$q = $this->q();
				$q->Q("ALTER TABLE `Users` ADD (
					`email` varchar(75))
				");
				$this->set('message',$q->error);
				//header('Location: /@/update/updateXCore');
			}
		}

		function update0004($sync){
			$q = $this->q();
			if(!$sync){
				$q->setStartLimit(0,1);
				$table = $q->Select('*','costumez');
				if(isset($table[0]['table'])){
					$this->updates['update0004'] = 'Update Costume Table';
				}
				return false;
			}else{
				$q->Q('ALTER TABLE costumez CHANGE `table` table_name varchar(255)');
				$this->set('message',$q->error);
				$_SESSION['runUpdate']['xphp'] = array('xLayout.php','xUpdate.php');
			}
		}

		function updateOptIn0001($sync){
			$q = $this->q();
			if(!$sync){
				$q->setStartLimit(0,1);
				$table = $q->Q('show tables like "OptInPages"');
				if(!empty($table)){
					$d = $q->Select('thank_you','OptInPages');

					if( $q->error ){
						$this->updates['updateOptIn0001'] = 'Adds Thank You Table';
						return false;
					}
				}
			}else{
				$q->Q("ALTER TABLE `OptInPages` ADD ( `thank_you` blob ) ");
				$this->set('message',$q->mSql.$q->error);
			}
		}
	}
?>