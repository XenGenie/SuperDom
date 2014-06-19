<?php
/**
 * @author XtIV
 * @name Upload
 * @desc Upload Files to the Web Server
 * @version v1.11.07.24.03.35
 * @icon cloud-upload-icon.png
 * @mini  cloud-upload
 * @link upload
 * @see content
 * @license
 */
	class xUpload extends Xengine{
		function dbSync(){
			return array(
				'FileUploads'		=> array(
					'file_real'		=> array('Type' => 'varchar(255)'),
					'file_name'		=> array('Type' => 'varchar(255)'),
					'file_path'		=> array('Type' => 'varchar(100)'),
					'file_parent'	=> array('Type' => 'int(12)'),
					'file_size'		=> array('Type' => 'int(20)'),
					'file_ext'		=> array('Type' => 'varchar(10)'),
					'file_own'		=> array('Type' => 'int(8)'),
					'file_added'	=> array('Type' => 'int(11)'),
					'file_md5'		=> array('Type' => 'varchar(100)'),
					'file_farm'		=> array('Type' => 'varchar(100)'),
					'file_ip'		=> array('Type' => 'varchar(50)'),
				),
				'FileUploadDirs'	=> array(
					'text'			=> array('Type' => 'varchar(100)'),
					'iconCls'		=> array('Type' => 'varchar(50)'),
					'parent_id'		=> array('Type' => 'int(7)','Default'=>0 ),
					'user_id'		=> array('Type' => 'int(7)','Default'=>0 )
				)
			);
		}
		function newFolder(){
			$new = array(
				'text' 		=> $_POST['text'],
				'parent_id' => ($_POST['parent_id'] == 'source' ) ? '' : $_POST['parent_id'],
				'user_id'	=> $_SESSION['user']['id']
			);

			$q = $this->q();

			$is = $q->Select('id','FileUploadDirs',array('id'=>$_POST['node_id']));

			if(!empty($is)){
				$q->Update('FileUploadDirs', $new, array('id'=>$_POST['node_id']) );
				$id = $_POST['node_id'];
			}else{
				$q->Insert('FileUploadDirs',$new);
				$id = mysql_insert_id($this->q()->mConn);
			}

			$this->set('node',array(
				'success' => true,
				'text'  => $new['text'],
				'id'	=> $id
			));
		}

		function index(){

		}
		/**
		 * Handles uploading avatars for users.
		 */
		function avatar(){
			$location = APP_DIR.'/';
			require_once(HTML_DIR.'/@/upload/FileUpIndex.php');

			$f = new FileUpIndex();
			$f->upload();
			$this->q()->Update('Users',array('picture_src' => $f->mFile['loc'] ),array('id'=>$_POST['user_id']));

			$respond['success'] = true;
			$respond['file'] = '/^/'.$f->mFile['path'].'/'.$f->mFile['md5'] ;

			//$this->out($respond);
			echo '{success:true, file:'.json_encode(	'/^/'.$f->mFile['path'].'/'.$f->mFile['md5']).'}';
			exit;
		}

		function uploadFile(){

		}


		function userBg(){
			session_start();
			$_POST['folder'] = 'Wallpaper';

			$f = new FileUpIndex();
			$file = $f->mFile['src'];
			$sql = $this->q();
			$sql->mBy = array(
				'file_added' => 'desc'
			);

			$sql->Update('Users',array('bg_img' => '/^/'.$_POST['user_id'].'/'.$f->mFile['md5']),array('id'=>$_POST['user_id']));

			echo '{success:true, file:'.json_encode('/^/'.$f->mFile['path'].'/'.$f->mFile['md5']).'}';
			exit;


		}

		function getUserBgs(){
			$bgs = $this->q()->Select('*','InfiniteFiles',array(
				'file_path' => 'Wallpaper',
				'file_own'	=> $_SESSION['user']['id']
			));

			if(!empty($bgs)){
				foreach($bgs as $k => $v){
					$files[] = array(
						'name' 	=> $v['file_name'],
						'file'	=> "/^/$v[file_own]/$v[file_md5]",
		    			'src'	=> "$_SERVER[DOCUMENT_ROOT]/^/$v[file_own]/$v[file_md5]"
					);
				}
			}

			echo json_encode(array('data'=>$files));
			exit;
		}

		function dropFile(){
			if($_POST['data'] && $_POST['drop']){
				$this->q()->Update('FileUploads',array(
					'file_parent'=> $_POST['drop']
				),array(
					'id'	=> $_POST['data']
				));
				exit;
			}
		}

		function dropFolder(){
			if($_POST['data'] && isset($_POST['drop'])){
				$this->q()->Update('FileUploadDirs',array(
					'parent_id'=> $_POST['drop']
				),array(
					'id'	=> $_POST['data']
				));
				echo 1;
				exit;
			}
		}

		function jsonFiles(){
			$dir = ($_POST['dir'] == 'source') ? '' : $_POST['dir'];

			$q =$this->q();
			$q->setStartLimit(0,50);

			if($dir){
				$q->mBy = array('file_added'=>'DESC');
				$files = $q->Select('*','FileUploads',array(
					'file_parent' => $dir,
				));
			}else{
				$trash = $q->Select('*','FileUploadDirs',array('text'=>'Trash'));
				$sql = $q->mSql;
				$this->set('error',$q->error);
				$trash = $trash[0]['id'];
				$q->mBy = array('file_added'=>'DESC');
				$files = $q->Select('*','FileUploads',array('file_parent'=>$trash),'LEFT','!=');
			}



			$this->out(array(
				'sql'	=> $sql,
				'data' => ($files) ? $files : array()
			));
		}


	    function tree(){
	    	$node = $_POST['node'];
	    	$node = ($node == 'source') ? '' : $node;
	    	$node = str_replace('dir-','',$node);

	    	$q = $this->q();

	    	$q->mBy= array('text'=>'ASC');

	    	$dirs = $q->Select('*','FileUploadDirs',array(
    			'parent_id' => $node
    		));

    		$folders = array();

    		if(empty($dirs) && $node == 0){
    			$folders = array(
					array('text'=>'Audio', 'iconCls'=>'x-icon-16x16-volume_loud','parent_id'=>''),
    				array('text'=>'Documents','iconCls'=>'x-icon-16x16-documents','parent_id'=>''),
    				array('text'=>'Images','iconCls'=>'x-icon-16x16-images','parent_id'=>''),
					array('text'=>'Video', 'iconCls'=>'x-icon-16x16-movie_grey','parent_id'=>''),
					array('text'=>'Trash', 'iconCls'=>'x-icon-16x16-bin_closed','parent_id'=>'')

    			);
    			foreach($folders as $k => $v){
    				$q->Insert('FileUploadDirs',$v);
    			}
    			$this->tree();
    			exit;
    			$this->upload(true);
    			$q->mBy= array('text'=>'ASC');
    			$dirs = $q->Select('*','FileUploadDirs',array(
	    			'parent_id' => $node
	    		));
    		}

	    	foreach($dirs as $k => $v){
    			$folders[] = array(
    				'text' 	  => $v['text'],
    				'iconCls' => $v['iconCls'],
    				'id'	  => 'dir-'.$v['id'],
    			);
    		}

    		$this->out($folders);
	    }

	    function thumb($id){
	    	$q = $this->q();
	    	$f = $q->Select('*','FileUploads',array('id'=>$id));
	    	//print_r($f);
			if(!empty($f)){
				$f = $f[0];
				//$path = explode('/',$f['file_path']);
				//print_r($f);
				//echo $f['file_name'];
				$ext = $f['file_ext'];
				//print_r($ext);
				$t = trim(strtolower($ext));
				$_GET['q'] = '100';

				// set thumb to icon file.
				$file = "/bin/images/icons/thumbs/$t.ico";
				$_GET['f'] = 'ico';
				$pics = array('jpg','gif','ico','png','jpeg','tif','svg');
				//$_GET['f'] = ($t == 'pdf') ? 'jpg' : $t;
				// if file is a pic.
				header('Content-Type: image/x-icon');
				foreach($pics as $e){
					if($t == $e){
						//header('Content-Type: image/'.$t);
						$_GET['f'] = ($t == 'pdf') ? 'jpg' : $t;

						$user_dir = ($f['file_own']) ? $f['file_own'].'/' : '';

						$farm 	= ($f['file_farm']) ? "http://$f[file_farm]" : '';
	    				$file  	= "$farm/^/$f[file_path]/$user_dir"."$f[file_md5]";

	    				$file = str_replace("http://".HTTP_HOST,DOC_ROOT,$file);
	    				$file = str_replace("http://www.".HTTP_HOST,DOC_ROOT,$file);

						$_GET['zc'] = (isset($_GET['zc'])) ? $_GET['zc'] : 1;
						if($_GET['zc']){
							$_GET['w'] = (!isset($_GET['w'])) ? 127 : $_GET['w'] ;
							$_GET['h'] = (!isset($_GET['h'])) ? 127 : $_GET['h'] ;
						}

						// set thumb as file
					}
				}

				// if(!file_exists(DOC_ROOT.$file)){
				//	$file = '/bin/images/icons/thumbs/01.ico';
				//	$_GET['f'] = 'ico';
				// }
				$_GET['src']= $file;

				$type = ($_GET['f'] == 'ico') ? 'x-icon' : $_GET['f'];
				$type = ($_GET['f'] == 'jpg') ? 'jpeg' : $_GET['f'];


    			header('Content-Type: image/'.$type);
				readfile("http://$_SERVER[HTTP_HOST]/@/libs/phpThumb/phpThumb.php?".http_build_query($_GET));
				exit;
				//$_GET['w'] = $_GET['h'] = 75;
				//$_GET['f'] = 'png';


			}else{
				$id = explode('-',$_GET['id']);
				$f = $q->Select('*','FileUploadDirs',array('id'=>$id[1]));
				unset($_GET['id']);
				$img = array(1=>'jpg',2=>'jpeg',3=>'png',4=>'gif');

				$_GET['src'] = $_SERVER['DOCUMENT_ROOT'].'/os/me/thumbs/dir.ico';

				foreach($img as $k => $v){
					$folder_img = $_SERVER['DOCUMENT_ROOT'].'/^'.$f[0]['path'].'/'.$f[0]['text'].'/folder.'.$img[$k];
					if(file_exists($folder_img)){
						$_GET['src'] = $folder_img;
					}else{

					}
				}
				//$_GET['fltr'][]= 'wmt|'.substr($f[0]['text'],0,7).';30x75;';

				$_GET['f'] = 'ico';
				$_GET['q'] = '100';
			}


			//print_r($_GET);
			 //require(LIBS_DIR."/phpThumb/phpThumb.php");
			exit;
	    }





		function stats(){
	    	if(!$_SESSION['user']){
	    		return null;
	    	}
	    	$q = $this->q();

	    	$id = ($_POST['id'] > 0) ? array('file_parent'=>$_POST['id']) : null;

	    	$f = $q->Select('file_ext,file_size','FileUploads', $id);

	    	$json = array();
	    	$response =array();
	    	if(!empty($f)){
		    	foreach($f as $k => $v){
		    		$type = strtolower($v['file_ext']);
		    		$json[$type] += $v['file_size'];
		    	}
		    }

	    	foreach($json as $k => $v){
	    		$size = $this->bytesToSize1024($v);
	    		$response[] = array(
	    			'type'=>"$k($size)",
	    			'bytes'=>$v
	    		);
	    	}
	    	$this->out($response);
	    }

	    function getFileById($id){
	    	$file = $this->q()->Select('*','FileUploads',array('id'=>$id));
	    	$f	  = $file[0];

	    	$farm = ($f['file_farm']) ? "http://$f[file_farm]" : DOC_ROOT;
	    	$dir  =	"$farm/^/$f[file_path]";
	    	// Uploaded Owned By User
	    	$user = ($f['file_own']) ? "$f[file_own]/" : "";

	    	$f['raw_file'] = "$dir/$user$f[file_md5]";
			return $f;
	    }

	    function download($id){
	    	$f = $this->getFileById($id);

			ob_clean();
		    flush();
			header('Content-Description: File Transfer');
		    header("Content-Type: application/octet-stream");
		    header('Content-Disposition: attachment; filename='.$f['file_name'].'.'.$f['file_ext']);
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    //header("Cache-Control: private",false); // required for certain browsers
		    header('Pragma: public');
		    header("Content-Length: $f[file_size]");

		    readfile($f['raw_file']);
			exit;
	    }

		function view($id){
	    	$f = $this->getFileById($id);
			// header('Content-Description: File Transfer');
		    // header("Content-Type: application/octet-stream");
		    // header('Content-Disposition: attachment; filename='.$f['file_name'].'.'.$f['file_ext']);
		    // header('Content-Transfer-Encoding: binary');
		    // header('Expires: 0');
		    // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    // header("Cache-Control: private",false); // required for certain browsers
			// header('Pragma: public');
		    header("Content-Length: $f[file_size]");
		    ob_clean();
		    flush();
		    readfile($f['raw_file']);
			exit;
	    }

	    /**
	     * Uploads Files from desk drop apps
	     */
	    function deskDrop(){
	    	set_time_limit(0);
	    	// Desk Drop uploads files
	    	// Uploading Files!
	    	if(!empty($_FILES)){
				$timestamp = $_POST['timestamp']; 	# Important to logic!
				if(!$_POST['folder']){
					$q = $this->q();
					// Directory ID Is not given - get the users attachment directory.
					$attach_dir = $q->Select('id','FileUploadDirs',array(
						'text' 		=> 'Attachments',
						'parent_id' => 0,
						'user_id'	=> $_SESSION['user']['id']
					));

					// Default Attach dir not found - make it.
					if(empty($attach_dir)){
						$attach_dir = $q->Insert('FileUploadDirs',array(
							'parent_id' => 0,
							'text'		=> $_POST['dir'],
							'iconCls'	=> 'x-icon-16x16-attach',
							'user_id'	=> $_SESSION['user']['id']
						));
					}else{
						$attach_dir = $attach_dir[0]['id'];
					}

					// Specifies the folder for the next part.
					$_POST['folder'] = $attach_dir;

				}

 				require_once(HTML_DIR.'/@/upload/FileUpIndex.php');
				$f = new FileUpIndex();
				$f->deskDropUpload();

				$_SESSION['deskDrops'][$timestamp] = $f->Files;
				echo $f->uploaded;
		    	exit;
	    	}
	    }

	    function sessionFiles(){
	    	$this->out($_SESSION['deskDrops']);
	    }
	}
?>