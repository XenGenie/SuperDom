<?php
	class FileUpIndex extends SuperDomX{
		var $mFile;
		var $uploaded;
		var	$Files;


		/**
		 * Does uploads for deskdrops.
		 */
		function deskDropUpload(){

			foreach($_FILES as $k => $v){
	    		foreach($v['tmp_name'] as $i => $file){
		    		$tmp = $file;

		    		// User Upload Directory
		    		$user = ($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
		    		$dir = "/^/$_SERVER[HTTP_HOST]/".$user."/";

		    		// Make Dir!
		    		if(!is_dir($_SERVER['DOCUMENT_ROOT'].$dir)){
		    			mkdir($_SERVER['DOCUMENT_ROOT'].$dir, 0755, true);
		    		}

		    		$src =  $dir . md5_file($tmp);
		            move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].$src);

		            $_POST['user_id'] 	= $_SESSION['user']['id'];


					$this->mFile = array(
						'src'  => $_SERVER['DOCUMENT_ROOT'].$src,
						'real' => htmlentities( urlencode($v['name'][$i]) ),
						'name' => $v['name'][$i],
						'size' => $v['size'][$i]
					);


					$this->Index();
	    		}
	    	}
		}

		/**
		 * This function works for Uploadify As is... No reason to change... yet.
		 */
		function upload(){
			global $_POST;
			$_POST['folder'] = str_replace('/umeos','',$_POST['folder']);
			$_POST['folder'] = str_replace('/root/infinite-home/','',$_POST['folder']);

			if (!empty($_FILES)) {
				foreach($_FILES as $file){
			        if (!empty($file['tmp_name'])) {
			            $this->mFile['size']	= $file['size'];
			            $this->mFile['type']	= $file['type'];
			        	$tmp 					= $file['tmp_name'];
			        	$this->mFile['path'] 	= ($_POST['user_id']) ? $_SERVER['HTTP_HOST'].'/'. $_POST['user_id'] : $_SERVER['HTTP_HOST'] ;
			            $this->mFile['name'] 	= $file['name'];
			            $this->mFile['md5'] 	= md5_file($tmp);
			            $this->mFile['real'] 	= htmlentities(urlencode($this->mFile['name']));
			            $this->mFile['loc'] 	= '/^/'.$this->mFile['path'] .'/'. $this->mFile['md5'];
			            $this->mFile['src'] 	=  str_replace('//','/',$_SERVER['DOCUMENT_ROOT'].$this->mFile['loc']);
			            // Uncomment the following line if you want to make the directory if it doesn't exist
			            /**
			             * we dont want to save the file in a dir tree...
			             * only the db holds that info. instead we change save the file as its md5 hash.
			             *
			            */

			            if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/^/')){
			            	mkdir($_SERVER['DOCUMENT_ROOT'].'/^/', 0755, true);
			            }

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
	        $ext = pathinfo($this->mFile['src']);
			if($ext['filename']){
				$ext = $ext['extension'];
			}

			if(!$ext){
				$ext = explode('.',$this->mFile['name']);
				$ext = $ext[count($ext)-1];
			}

			$sql->Delete('FileUploads',array(
				'file_md5'		=> md5_file($this->mFile['src']),
	        	'file_own'  	=> $_POST['user_id'],
				'file_parent'  	=> $_POST['folder']
			));

			$sql->Insert('FileUploads',array(
	        	'file_real'		=> str_replace(".$ext","",$this->mFile['real']),
	        	'file_name'		=> str_replace(".$ext","",$this->mFile['name']),
	            'file_path'		=> $_SERVER['HTTP_HOST'],
				'file_parent'	=> str_replace('/{$toBackDoor}/','',$_POST['folder']),
	            'file_size'  	=> $this->mFile['size'],
				'file_farm'  	=> $_SERVER['HTTP_HOST'],
	        	'file_ext'  	=> $ext,
	        	'file_own'  	=> $_POST['user_id'],
	        	'file_added'  	=> time(),
	        	'file_md5'		=> md5_file($this->mFile['src']),
			));

			$this->Files[$this->mFile['name']] = $this->mFile['src'];

			$local = str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->mFile['src']);
			$this->uploaded = ( $this->uploaded ) ? $this->uploaded .'|'.$local : $local;

	        return true;
		}
	}
?>