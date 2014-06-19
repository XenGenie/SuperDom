<?php 
/**
 * @name xTensions
 * @desc Xtend what your site can do.
 * @version v0.1.12.13.13.01
 * @author XTiv
 * @see domain
 * @link xtend
 * @todo
 */

	class xXtend extends Xengine{
		function __construct(){
			$this->set('WWW_PAGE','xTend');			
		}
		
		function index(){
			$this->set('BODY_VALIGN','top');
			
			$xphp = $this->getXTends();
			
			foreach($xphp as $k => $v){
				$class = str_replace('.php','',$k);
				$loc = lcfirst(substr($class, 1));
				
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
							}	
							
							
							
						}	
					}
					
					$xphp[$k]['front_doors'] = $a_a;
				}
				
				
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
							}
						}
					}	
					$xphp[$k]['back_doors'] = $a;
				}
				
				
				
				
				
			}
			
			$this->set('xphp_local',$xphp);
			$this->set('xphp_local_json',json_encode($xphp));
		}
		
		
		
	}

?>