<?php 
/**
 * 
 * @author XtIV
 * @name Denied 
 * @desc Provides a simple method for displaying unauthroized pages
 * @version v0.11.06.12 
 * @icon Signal stop.png
 * @mini ban
 * @see navigate
 * @link 
 * @todo
 */
class xDenied extends Xengine{
		function __construct(){
			$this->set('themex','@center');
		}
		/*
		 * This file should do some logic about being denied.
		 * We should record the error as well as tell the user why.
		 * This file should hold all the logic for that.
		 */
		function index($request=null,$reason=null){
			$reason = urldecode($reason);
			$this->set('reason',$reason);
			
			if($q = $this->q()){
				$q->Insert('Logs',array(
					'request'	=> $request,
					'username' 	=> $_SESSION['user']['username'],
					'user_id' 	=> $_SESSION['user']['id'],
					'reason' 	=> $reason,
					'timestamp' => time()
				));	
			}
			
		}
	}
?>