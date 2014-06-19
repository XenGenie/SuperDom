<?php
/**
 *
 * @author XtIV
 * @name Database
 * @desc Easily Backup, Download & Restore the Database!
 * @version v1.11.07.25.05.120
 * @icon database4.png
 * @mini database
 * @see content
 * @link backup
 * @todo
 */
	class xBackup extends Xengine {
		var $BACKUP_DIR;

		/**
		 * @desc Backs Up data roughly every 24 hours - deletes old stuff.
		 */
		
/*		function autoRun(){
			# Clean old dir of files...
			$back_dir = XPHP_DIR.'/xBackup/';
			$old_dir = scandir($back_dir);
			if(!empty($old_dir )){
				foreach($old_dir as $k => $f){
					if(!is_dir(XPHP_DIR.'/xBackup/'.$f)){
						$ext = explode('.',$f);
						if( strtolower($ext[count($ext)-1]) == 'sql' ){
							unlink(XPHP_DIR.'/xBackup/'.$f);
						}
					}
				}
			}

			# Clean outdated sql backups.
			$back_dir = $back_dir.WWWLESS_HOST;
			$new_dir = scandir($back_dir);

			$expire 	= 31 * (24 * (60 * 60)); 	// Month - Soon to implement options...
			$now 		= time();

			if(!empty($new_dir)){
				foreach($new_dir as $k => $f){
					if(!is_dir($back_dir.'/'.$f)){
						$file_time 	= filemtime($back_dir.'/'.$f);
						if( ($now - $file_time) > $expire){
							unlink($back_dir.'/'.$f);
						}else{
							$newest = ($file_time > $newest) ? $file_time : $newest;
						}
					}
				}
			}

			// Auto Matically Saves a backup each day.... 
			// This can cause a user to expierce a single long load time...
			// Should suggest to the user to allow backps...
			if($now - $newest > (60*60*24)){
				$this->q()->Backup($this->BACKUP_FILE);
			}
		}
*/
		function __construct(){
			$this->BACKUP_DIR = XPHP_DIR.'/xBackup/'.WWWLESS_HOST;
			if(!is_dir($this->BACKUP_DIR)){
				mkdir($this->BACKUP_DIR, 0755, true);
			}
			$this->BACKUP_FILE = $this->BACKUP_DIR.'/'.HTTP_HOST.'~'.$this->q()->db['database'].'~'.date('Y-m-d@h-i-s').'.sql';
		}

		function index( ){
			$this->set('WWW_PAGE','Backup');
	    	$this->CONTENT_TITLE = 'Backup Your Database';




	    }

	    public function download($base64=null){
	    	if($base64 == null){
	    		$q = $this->q();
	    		$file = $q->Backup();
	    		$filename = $this->BACKUP_FILE;
	    	}else{
	    		$filename = base64_decode($base64);
	    		$file = file_get_contents($this->BACKUP_DIR .'/'.$filename);
	    	}
	    	/**
	    	 * @FIXME: This needs some sort of user authority check, as a directly link allows a download.
	    	 */
	    	ob_start('gz_handler');
			header('Content-type: application/txt');
			header("Content-Disposition: attachment; filename={$filename}");
			echo $file;
			exit;
			// Thats all we wanted to do. Stop the engine!
	    }

	    public function restore($base64){
	    	$_POST['runBackup'] = true;
	    	
	    	$time = time();
	    	
	    	$file = $this->BACKUP_DIR .'/'.base64_decode($base64);
	    	
	    	$q = $this->q();
	    	
	    	$key = substr(md5($q->db['host'].$q->db['user'].$q->db['database']),0,5);
	    	$key = "#$key#";
	    	
	    	$this->backup(true,false);
	    	$q->ImportSql($file,$key);
	    	
	    	
	    	
	    	$this->set('CONTENT_TITLE','Database Has been Restored in '.$time-time().' seconds');
	    	$this->set('date_time',date('D, M jS Y \<\b\r\/\> h:i:sA',filemtime($file)) );
	    	if($q->error){
	    		$this->set('error',$q->error);	
	    	}
	    	

	    }

	    public function delete($base64,$confirm){
	    	$_POST['base64'] 	= $base64;
	    	$_POST['sql_file'] 	= $this->BACKUP_DIR.'/'.base64_decode($base64);


	    	$confirm = (isset($confirm)) ? true : false;

	    	if(!$confirm){
	    		$this->CONTENT_TITLE = 'Are You Sure You want to Delete this File!';
	    	}else{
	    		$this->CONTENT_TITLE = 'Successfully Removed Backup From Archives';
	    		$this->set('confirm',true);
	    		unlink($_POST['sql_file']);
	    	}
	    }

	    public function backup($backup=false,$relocate=true){
	   		$this->set('BODY_VALIGN','top');
	    	$this->set('WWW_PAGE','Backup');
	   		$q = $this->q();
	    	$this->CONTENT_TITLE = 'Database Backed upped!';
	    	$file = $this->BACKUP_FILE;

	   		if($backup && $relocate){
				$q->Backup($file);
				header("Location: ".str_replace($_SERVER['DOCUMENT_ROOT'],'',APP_DIR).'/backup/backup');
			}

	    	if(isset($_POST['runBackup'])){
				$q->Backup($file);
				$this->CONTENT_TITLE = 'Database Backed upped to '.$file;
			}else{
				$this->CONTENT_TITLE = 'Database BackUps';
			}

	    	if ($handle = opendir($this->BACKUP_DIR)) {
			    while (false !== ($file = readdir($handle))) {
			        if ($file != "." && $file != "..") {
			            $ext = explode(".",$file);
			            if($ext[count($ext)-1] == 'sql'){
			            	$files[filemtime($this->BACKUP_DIR.'/'.$file)] = array(
			            		'file' 	=> $file,
			            		'size'	=> floor(( filesize($this->BACKUP_DIR.'/'.$file) /1024 ))."KB",
			            		'time'  => date('D, M jS Y @ h:i:sA',filemtime($this->BACKUP_DIR.'/'.$file))
			            	);
			            }

			        }
			    }
			    closedir($handle);
			}

			if(!empty($files)){
				krsort($files);

				$this->set('files',$files);
			}
	    }

	}
?>