<?php 
/**
 * @name Events
 * @desc Schedule dates and reacurring events
 * @version v0.13
 * @author XTiv
 * @icon 
 * @see cronos
 * @link events
 * @todo
 */

	class xEvents extends Xengine{
		function index(){
			
		
			function check4Bin($loc){
				$file = file($loc);
				if( !empty($file) ){
					
					foreach($file  as $l => $v){
						
						if( substr( $v , 0, strlen(REPO) ) == REPO ){
						// If file == '/bin*';
							$bin = substr( dirname($v) , strlen(REPO) , strlen($v) );
							echo $bin;
							//$files = getBin($bin ,$files);		
						}	
					}	
				}
				
				return $files;	
			}
			$files = array();
			print_r(check4Bin('http://thotbubbles.com/@/xphp/xWwwSetup/public_js.txt',$files));
			print_r(check4Bin('http://thotbubbles.com/@/xphp/xWwwSetup/js.txt',$files));
			exit;
		}
	}

?>