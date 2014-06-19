<?php 
/**
 * @name FileServer
 * @desc Pushes files out
 * @version v1.0.11.10.18.00.02
 * @author cdpollard@gmail.com
 * @see  domain
 * @link fileServer
 * @todo
 *
 */	
class xFileServer extends Xengine{
	function __construct($c){
		parent::__construct($c);
	}
	function js($lib,$file){ 
		$this->gzip('text/javascript',"js/$lib/".$file);
	}
	
	function css($file){
		$this->gzip('text/css','css/'.$file);
	}
	
	function phpThumb(){
		ob_clean();	
		ob_start("ob_gzhandler");
		echo file_get_contents($this->lib('phpThumb/phpThumb.php'));
		exit;
	}

	function gzip($type,$binFile){
		
		ob_clean();	
		ob_start("ob_gzhandler");
		$binFile = str_replace('~','/',$binFile); 
		header("Content-Type: $type");
		 
		echo file_get_contents($this->_CFG['dir']['bin'].'/'.$binFile);
		exit;
	}
	
	function directExt($class){
		$class 	= str_replace('.js','',$class);
		$_POST['api'] = $class;
		$this->lib('ExtDirect/api.php');
		exit;
	}
	
	function getTypeLoc($text,$type){
		switch($text){
			case('text'):
				if($type == ''){
					
				}
				return $type;
			break;
			case('type'):
				if($type){
					
				}
			break;
		}
	}
	
}
?>