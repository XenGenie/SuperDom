<?php
/**
 * @author dev@domain.com
 * @name Language
 * @desc Change the Languauge on your Site.
 * @version v1(11.11.01@03:03)
 * @icon applications-education-language.png 
 * @mini language 
 * @link lang
 * @see domain
 * @todo 
 */
class xLang extends Xengine {

	// Adds a language setting to the users profile table. 
	function dbSync(){
			return array(
				'Users' => array(
					'xlang_default'	=> array('Type' => 'varchar(255)')
				)
			);
		}

	function autoRun($X){
		// Language Defaults to English.  
		
		$q = $this->q();
 
		
		// Get language Setting
		if($X->Key['is']['user']){
			$where['id'] = $_SESSION['user']['id'];
			$lang = $q->Select('xlang_default','Users',$where);
		}

		$c = 'config';
		if( empty($lang[0][0]) ){
		 	$lang = $q->Select("config_value",$c,array( "config_option" => 'lang_www')); 

			if( empty($lang) ){
				$lang = 'english';
			}else{
				$lang = $lang[0][0];
			}
		}else{
			$lang = $lang[0][0];
			
		}  

		$lang = $this->readLangDir($lang); 
		
		 

		// $this->dump($lang); 
		if($_SERVER['REQUEST_URI'] != '/.json'){
			// $X->dump($_SESSION);?
			 
			return array(
				'_LANG' => $lang
			); 

		}

		

		
		// Read File Directory for Language files.  
	}

	private function readLangDir($dir)
	{
		// We should only run this once 
		$langDir = XPHP_DIR.'/xLang/'.$dir.'/';

		//$this->dump(scandir(XPHP_DIR.'/xLang/'.$dir));

		if ($handle = opendir($langDir)) {
			$time = microtime(true); 
			$this->_comment("Loading Language Files..."); 

			while (false !== ($file = readdir($handle))) {
		        if ($file != "." && $file != ".." && !is_dir($file)) {
		            $ext = explode(".",$file); 


					$class = str_replace('.inc','',$file);
					$this->_comment($file);
	            
	            	$this->_comment("Loaded Language File ".$file);
 
	            	require_once($langDir.'/'.$file);
	            	$rc = new ReflectionClass($class);
					$doc = $rc->getDocComment();
					
	            	//$this->dump($doc);
					if($doc){
						$data =  trim(preg_replace('/\r?\n *\* */', ' ', $doc));
						preg_match_all('/@([A-Za-z0-9]+)\s+(.*?)\s*(?=$|@[A-Za-z0-9]+\s)/s', $data, $matches);
						$info = array_combine($matches[1], $matches[2]);
						$ext                                    = explode('.',$file); 

						$file = str_replace('.inc', '', str_replace('Lang', '', $file));
 
						

						if (class_exists($class)){
							$class = new $class;  
							$info = array_merge_recursive($info,$class->_LANG);
						}


						$files[strtoupper($file)] = $info;
					}	

		            if(strtolower($ext[count($ext)-1]) === 'inc'){
		            	
		            }
		        }
		    }
		    closedir($handle);
			//ksort($files);
			//$this->set('xphp_files',$files);
			//$this->_xtras = $this->_SET['xtras'] = $files;

			$time = round(microtime(true) - $time,5); 
			//$this->_comment("Loaded ".count($files)." Language Files in ".$time);
		} 
		
		return $files;
	}
}
?>