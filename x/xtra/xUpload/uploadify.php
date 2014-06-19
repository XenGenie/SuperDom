<?php 
require('../../index.php');
class FileUpIndex extends Xengine{
	var $mFile;
	function __construct(){
		global $_POST;
		session_start();
		$_POST['folder'] = str_replace('/umeos','',$_POST['folder']);
		$_POST['folder'] = str_replace('/root/infinite-home/','',$_POST['folder']);
		
		
		if (!empty($_FILES)) {
			foreach($_FILES as $file){
		        if (!empty($file['tmp_name'])) {
		            $this->mFile['size']	= $file['size'];
		            $this->mFile['type']	= $file['type'];
		        	$tmp 					= $file['tmp_name'];
		        	$this->mFile['path'] 	= $_SERVER['HTTP_HOST'];
		            $this->mFile['name'] 	= $file['name'];
		            $this->mFile['md5'] 	= md5_file($tmp);
		            $this->mFile['real'] = htmlentities(urlencode($this->mFile['name']));
		            $this->mFile['src'] =  str_replace('//','/',$_SERVER['DOCUMENT_ROOT'].'/^/'.$this->mFile['path']) .'/'. $this->mFile['md5'];
		            // Uncomment the following line if you want to make the directory if it doesn't exist   
		            /**
		             * we dont want to save the file in a dir tree... 
		             * only the db holds that info. instead we change save the file as its md5 hash.
		             * 
		            */ 
		            $path = $_SERVER['DOCUMENT_ROOT'].'/^/'.$this->mFile['path'];
		            $path = str_replace('//','/',$path);
		            if(!file_exists($path)){
		            	mkdir($path, 0755, true);   
		            }
		            
		            move_uploaded_file($tmp,$this->mFile['src']);
		            return $this->Index();
		        }
		    }
		}else{
			return false;
		}
	}	
	
	function Index(){
        $sql = $this->q();
        session_start();
        $ext = pathinfo($this->mFile['src']);
		if($ext['filename']){
			$ext = $ext['extension'];
		}
		if(!$ext){
			$ext = explode('.',$this->mFile['name']);
			$ext = $ext[count($ext)-1];
		}

		$sql->Delete('FileUploads',array(
			'file_name'		=> str_replace(".$ext","",$this->mFile['name']),
			'file_path'		=> $_POST['folder'],
			'file_ext'  	=> $ext
		));	
		
		$sql->Insert('FileUploads',array(
        	'file_real'		=> str_replace(".$ext","",$this->mFile['real']),    
        	'file_name'		=> str_replace(".$ext","",$this->mFile['name']),
            'file_path'		=> $_SERVER['HTTP_HOST'],
			'file_parent'	=> str_replace('/@/','',$_POST['folder']),
            'file_size'  	=> $this->mFile['size'],
        	'file_ext'  	=> $ext,
        	'file_own'  	=> $_POST['user_id'],
        	'file_added'  	=> time(),
        	'file_md5'		=> md5_file($this->mFile['src']),
		));
        return true;
	}
}

	$f = new FileUpIndex();
	echo $f->mFile['src'];
	exit;

?>