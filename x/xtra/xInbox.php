<?php
/**
 * @name MailBox
 * @desc Allows users to send and recieve emails right from your website!
 * @version v1.0.11.03.01.08.02
 * @author cdpollard@gmail.com
 * @icon MailFront.png
 * @mini envelope
 * @see domain
 * @link inbox
 * @todo
 */

class xInbox extends Xengine {
	var $id = 'inbox-';
	var $sender;
	var $recipient;
	var $subject;
	var $headers=array();
	var $attachments=array();

	function dbSync(){
		return array(
			'InboxContacts'	=> array(
				'email'		=> array('Type'=>'varchar(255)'),
				'name_first'=> array('Type'=>'varchar(255)'),
				'name_last'	=> array('Type'=>'varchar(255)'),
				'user_id'	=> array('Type'=>'int(8)')
			),
			'InboxPrivateMessages'	=> array(
				'box'			=>  array('Type'=>'varchar(100)'),
				'user_id'		=>  array('Type'=>'int(8)'),
				'fromaddress'	=>  array('Type'=>'varchar(255)'),
				'toaddress'		=>  array('Type'=>'varchar(255)'),
				'ccaddress'		=>  array('Type'=>'varchar(255)'),
				'bccaddress'	=>  array('Type'=>'varchar(255)'),
				'Date'			=>  array('Type'=>'datetime'),
				'Subject'		=>  array('Type'=>'varchar(255)'),
				'message'		=>  array('Type'=>'blob'),
				'Unseen'		=>  array('Type'=>'varchar(1)','Default'=>'U')
			)
		);
	}
/*
	function __construct(){
		if(!class_exists('Imap')){
			$this->lib('x4/imap.php');
		}
	}*/

	function pm($touser,$from,$subject,$message){
		$touser = urldecode($touser);
		$from = urldecode($from);
		$subject = urldecode($subject);
		$message = urldecode($message);


		// Handles Placement of PMs
		$q = $this->q();

		// Get The Users ID!s
		if( is_int($touser) ){
			$where = array('id'=>$touser);
		}else{
			$where = ($this->isValidEmail($touser)) ? array('email'=>$touser) : array('username'=>$touser);
		}

			$user = $q->Select('id,email','Users',$where);
			$user_id = empty($user) ? 0 : $user[0]['id'];


		// "Send the Message"
		$q->Insert('InboxPrivateMessages',array(
			'box'		=> 'inbox',
			'fromaddress' => $from,
			'message'	=> $message,
			'Subject'	=> $subject,
			'user_id'	=> $user_id,
			'toaddress'	=> $user[0]['email'],
			'Unseen'	=> 'U',
			'Date'		=> date('Y-m-d h:i:s',time())
		));
		$this->set('errors',$q->error);
		$this->set('success','Message Sent!');
	}



	/*function autoRun(){
		// Sends All Qued Outgoing Messages
		$q = $this->q();

		$datetime = date->timezone(DATE_ATOM, time());
		$outgoing = $q->Select('*','InboxPrivateMessages',"Date < DATE($datetime)");

		if(!empty($outgoing)){
			foreach($outgoing as $r => $c){
				$this->Mailer($c['fromaddress'],$c['toaddress'],$c['Subject'],$c['message']);
				$this->send();

				$q->Update('InboxPrivateMessages',array(
					'box'=>'sentbox'
				),array(
					'id' => $c['id']
				));
			}
		}

	}
*/
	function index(){

	}

	function getContacts(){
		$this->out(array());
	}

	function saveEmail($box='savebox'){
		$P = $_POST;
		$this->q()->Insert('InboxPrivateMessages',array(
			'fromaddress'	=> $P['fromaddress'],
			'toaddress'		=> $P['toaddress'],
			'ccaddress'		=> $P['ccaddress'],
			'bccaddress'	=> $P['bccaddress'],
			'Date'			=> $P['Date'],
			'Subject'		=> $P['Subject'],
			'message'		=> $P['message'],
			'user_id'		=> $_SESSION['user']['id'],
			'box'			=> $box
		));
		$this->set('success',true);
		$this->set('email',$P);
	}

	function Mailer($sender,$recipient,$subject,$message){
		// validate incoming parameters
		if(!preg_match("/^.+@.+$/",$sender)){
			trigger_error('Invalid value for email sender.');
		}
		if(!preg_match("/^.+@.+$/",$recipient)){
			trigger_error('Invalid value for email recipient.');
		}
		if(!$subject||strlen($subject)>255){
			trigger_error('Invalid length for email subject.');
		}
		if(!$message){
			trigger_error('Invalid value for email message.');
		}
		$this->sender=$sender;
		$this->recipient=$recipient;
		$this->subject=$subject;
		$this->message=$message;
		// define some default MIME headers
		$this->headers['MIME-Version']='1.0';
		$this->headers['Content-Type']='multipart/mixed;boundary="MIME_BOUNDRY"';
		$this->headers['From']='<'.$this->sender.'>';
		$this->headers['Return-Path']='<'.$this->sender.'>';
		$this->headers['Reply-To']=$this->sender;
		$this->headers['X-Mailer']='PHP 4/5';
		$this->headers['X-Sender']=$this->sender;
		$this->headers['X-Priority']='3';
	}
	// create text part of the message
	function buildTextPart(){
		return "--MIME_BOUNDRY\nContent-Type: text/html; charset=utf-8\nContent-Transfer-Encoding: quoted-printable\n\n\n".$this->message."\n\n";
	}
	// create attachments part of the message
	function buildAttachmentPart(){
		if(count($this->attachments)>0){
			$attachmentPart='';
			foreach($this->attachments as $k => $attachment){
				$attachment = file_get_contents($attachment);
				$fileStr=chunk_split(base64_encode($attachment));
				$attachmentPart .= "--MIME_BOUNDRY\nContent-Type: ".$this->getMimeType($k)."; name=".basename($k)."\nContent-disposition: attachment\nContent-Transfer-Encoding: base64\n\n".$fileStr;

			}
			return $attachmentPart;
		}
	}
	// create message MIME headers
	function buildHeaders(){
		foreach($this->headers as $name=>$value){
			$headers[]=$name.': '.$value;
		}
		return implode("\n",$headers)."\nThis is a multi-part message in MIME format.\n";
	}
	// add new MIME header
	function addHeader($name,$value){
		$this->headers[$name]=$value;
	}
	// add new attachment
	function addAttachment($filename,$attachment){
		if(!file_exists($attachment)){
			trigger_error('Invalid attachment.',E_USER_ERROR);
		}
		$this->attachments[$filename]=$attachment;
	}
	// get MIME Type of attachment
	function getMimeType($attachment){
		$nameArray=explode('.',basename($attachment));
		switch(strtolower($nameArray[count($nameArray)-1])){
			case 'jpg':
			$mimeType='image/jpeg';
			break;
			case 'jpeg':
			$mimeType='image/jpeg';
			break;
			case 'gif':
			$mimeType='image/gif';
			break;
			case 'txt':
			$mimeType='text/plain';
			break;
			case 'pdf':
			$mimeType='application/pdf';
			break;
			case 'csv';
			$mimeType='text/csv';
			break;
			case 'html':
			$mimeType='text/html';
			break;
			case 'htm':
			$mimeType='text/html';
			break;
			case 'xml':
			$mimeType='text/xml';
			break;
		}
		return $mimeType;
	}
	// send email
	function send(){
		$to=$this->recipient;
		$subject=$this->subject;
		$headers=$this->buildHeaders();
		$message=$this->buildTextPart().$this->buildAttachmentPart()."--MIME_BOUNDRY--\n";
		$sent = mail($to,$subject,$message,$headers);
		if(!$sent){
			trigger_error('Error sendind email.',E_USER_ERROR);
		}
		return $sent;
	}

	function getMailboxes(){
		 $q = $this->q();
		 $boxes = $q->Select('server_username,id','EmailServers',array(
            'user_id'=>$_SESSION['user']['id']
         ));
         $this->set('data',$boxes);
	}

	/**
	 * @remotable
	 */
	function deleteBox($id){
		//$id = $_POST['id'];
		$this->q()->Delete('InboxServers',array(
			'server_username'=> str_replace('tab-inbox-','',$id),
			'user_id'	=> $_SESSION['user']['id']
		));
		$this->set('success',true);
	}
	/**
	 * @remotable
	 * @formHandler
	 */
	function sendEmail($form=false){

		$q = $this->q();
		$form = $_POST ;

		$boxes = $q->Select('server_username','EmailServers',array(
            'server_username'	=> $form['from'],
		  	'user_id'			=> $_SESSION['user']['id']
        ));

        if(!empty($boxes)){
			$form['from'] = $boxes[0]['server_username'];
        }


		//$imap = new Imap($form['from'],'INBOX');
		$headers = null;

		// To send HTML mail, the Content-type header must be set

		// Additional headers

		$form['message'] = $form['message']."<hr/>Sent From $_SERVER[HTTP_HOST]";

		$this->Mailer($form['fromaddress'],$form['toaddress'],$form['Subject'],$form['message']);

		//$headers .= "To: $form[to] \r\n";
		$this->headers['Cc']	= $form['ccaddress'];
		$this->headers['Bcc']	= $form['bccaddress'];
		$this->headers['Date']	= date( 'r' );

		$timestamp = $form['timestamp'];
		// 	add some attachments
		//$this->addAttachment('file1.gif');
		//$this->addAttachment('file2.gif');

		if(!empty($_SESSION['deskDrops'][$timestamp])){
			foreach($_SESSION['deskDrops'][$timestamp] as $k => $attachment){
				$this->addAttachment($k,$attachment);
			}
		}

	    $_SESSION['deskDrops'] = null;


		// send MIME email
		$sent = $this->send();
		//$sent = imap_mail($form['to'],$form['subject'],$form['msg'],$headers,$form['cc'],$form['bcc']);


		$this->out(array(
			'success'=> $sent,
			'form'	=> $form,
			'time'	=> date('m/d/y @ h:i:s a')
		));
	}

	function sendPm($user,$subject,$msg){

	}

	/**
	 * Gets users Tree Containing First their own, followed by friends.
	 * @remotable
	 */
	function getBoxes($id=null){
		session_start();
		$id = (!$id) ? $_POST['node'] : $id;

		$tree = array();

		if($id == 'root'){




			array_push($tree, array(
				'id'		=> 'inbox-pm',
				'text'		=> 'Local Mailbox',
				'iconCls'	=> 'x-icon-16x16-mailbox',
				'expanded'	=> false,
				'leaf'		=> false
            ));


            $q = $this->q();

            $boxes = $q->Select('*','InboxServers',array(
            	'user_id'=>$_SESSION['user']['id']
            ));

            if(!empty($boxes)){
            	foreach($boxes as $k => $v){
	            	$icon = explode('@',$v['server_username']);

	            	switch($icon[1]){
	            		case('gmail.com'):
	            			$icon = 'gmail';
	            		break;
	            		case('hotmail.com'):
	            			$icon = 'msn';
	            		break;
	            		case('yahoo.com'):
	            			$icon = 'yahoo';
	            		break;
	            		default:
	            			$icon = 'email';
	            		break;
	            	}

			    	$s = $v;


					// Store as much info into our session!.
					// It sould be in the user name...

					$email_box = $s['server_username'];
					$key = sha1($_SESSION['user']['id']);
					$s['server_pass'] = $this->_mdecrypt($s['server_pass'],$key);

					$session = array(
						'mSvr'	=> $s['server_address'],
						'mPort'	=> $s['server_port'],
						'mUser'	=> $s['server_username'],
						'mPop'	=> $s['server_type'],
						'mPass'	=> $s['server_pass'],
						'mSsl'	=> ( $s['server_ssl'] ) ? 'ssl' : '',
					);

					$_SESSION['imap'][$email_box] = $session;

					//$imap = new Imap($email_box,'INBOX');

					//$recent = ($imap->status->recent) ? $imap->status->recent.'/' : '';
					// '<b>'.$recent.$imap->status->unseen.'</b>) '.

            		array_push($tree, array(
						'id'		=> 'inbox-'.$v['server_username'],
						'text'		=> $v['server_username'],
						'iconCls'	=> 'x-icon-16x16-'.$icon,
						'expanded'	=> false,
						'leaf'		=> false
		            ));
            	}
            }

            array_push($tree, array(
				'id'		=> 'inbox-new',
				'text'		=> '<b><i>Open Email Account</i></b>',
				'iconCls'	=> 'x-icon-16x16-box_add',
				'expanded'	=> true,
				'leaf'		=> true
            ));


			return $tree;
		}else if($id == 'inbox-pm'){
			array_push($tree, array(
				'id'		=> 'inbox-pm-inbox',
				'text'		=> 'Inbox',
				'iconCls'	=> 'x-icon-16x16-mailbox',
				'expanded'	=> false,
				'leaf'		=> true
            ));


            array_push($tree, array(
				'id'		=> 'inbox-pm-outbox',
				'text'		=> 'Out Box',
				'iconCls'	=> 'x-icon-16x16-time',
				'expanded'	=> true,
				'leaf'		=> true
            ));

            array_push($tree, array(
				'id'		=> 'inbox-pm-sentbox',
				'text'		=> 'Sent',
				'iconCls'	=> 'x-icon-16x16-mail_dark_right',
				'expanded'	=> false,
				'leaf'		=> true
            ));


            array_push($tree, array(
				'id'		=> 'inbox-pm-draftbox',
				'text'		=> 'Drafts',
				'iconCls'	=> 'x-icon-16x16-mail_light_stuffed',
				'expanded'	=> false,
				'leaf'		=> true
            ));


            array_push($tree, array(
				'id'		=> 'inbox-pm-savebox',
				'text'		=> 'Saved',
				'iconCls'	=> 'x-icon-16x16-mail_dark_stuffed',
				'expanded'	=> true,
				'leaf'		=> true
            ));





			return $tree;
		}else{
			// Users Custom Box
			$id = str_replace('inbox-','',$id); // Strip all redunat ids.


	    	if(!class_exists('Imap')){
				$this->inc('imap.php');
			}
			$q = $this->q();
			$settings = $q->Select('*','InboxServers',array(
	    		'server_username'=>$id,
				'user_id' => $_SESSION['user']['id']
	    	));

    	    $s = $settings[0];
			// Store as much info into our session!.
			// It sould be in the user name...

			$email_box = $s['server_username'];
			$key = sha1($_SESSION['user']['id']);

			$s['server_pass'] = $this->_mdecrypt($s['server_pass'],$key);

			$session = array(
				'mSvr'	=> $s['server_address'],
				'mPort'	=> $s['server_port'],
				'mUser'	=> $s['server_username'],
				'mPop'	=> $s['server_type'],
				'mPass'	=> $s['server_pass'],
				'mSsl'	=> ( $s['server_ssl'] ) ? 'ssl' : '',
			);

			$_SESSION['imap'][$email_box] = $session;

			$_SESSION['imap']['time'] = time();



			$this->imap[$email_box]['inbox'] = $imap = (!$this->imap[$email_box]['inbox']) ? new Imap($email_box,'INBOX',true) : $this->imap[$email_box]['inbox'];

			if(!$imap->connected && imap_last_error() != null){
				return array(
					'error'	=> $q->error,
//					'sql'	=> $q->mSql,
					'success' => false
				);
			}else{
				return $imap->getBoxes('*') ;
			}

			//return $this->getEmailBox($id);
		}
    }

//$input - stuff to decrypt
	//$key - the secret key to use

	function _mdecrypt($input,$key){
        $input = str_replace("\n","",$input);
        $input = str_replace("\t","",$input);
        $input = str_replace("\r","",$input);
        $input = trim(chop(base64_decode($input)));
		$td = mcrypt_module_open ('tripledes', '', 'ecb', '');
        $key = substr(md5($key),0,24);
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
		mcrypt_generic_init ($td, $key, $iv);
		$decrypted_data = mdecrypt_generic ($td, $input);
		mcrypt_generic_deinit ($td);
		mcrypt_module_close ($td);
		return trim(chop($decrypted_data));
    }

    /**
     * @remotable
     */
    function getBox($id,$email){
    	$box = array();
    	if($email == 'root'){
	    	$email = explode('-',$id);
	    	unset($email[0]);
	    	$email = implode('-',$email);
	    	$id = 'INBOX';
    	}else if($email == 'inbox-pm'){


    		$box = str_replace("$email-",'',$id);
    		$q = $this->q();

    		$q->mBy = array('id'=>'DESC');

    		$box = $q->Select('*','InboxPrivateMessages',array(
    			'user_id'	=>	$_SESSION['user']['id'],
    			'box'		=>	$box
    		));

    		if(!empty($box)){
    			foreach($box as $k => $v){
    				$box[$k]['Msgno'] = $v['id'];
    			}
    		}

    		$tot = count($box);
    	}else{
	    	$email = explode('-',$email);
	    	unset($email[0]);
	    	$email = implode('-',$email);

	    	$id = str_replace($email.'-','',$id); 	// Strip all redunat ids.

	    	if($email){
	    		$this->imap[$email]['inbox'] = $imap = (!$this->imap[$email]['inbox']) ? new Imap($email,$id) : $this->imap[$email]['inbox'];
//	    		$imap = new Imap($email,$id,true);
	    		$box = $imap->getBox($id);
				$tot = imap_num_msg($imap->mBox);
	    	}

    	}

		return array(
			'total'		=> $tot,
			'data'		=> $box
		);
    }
/**
 * @remotable
 *
 */
    function deleteMsg($id,$mailbox){
		if($mailbox == 'inbox-pm'){
			$this->q()->Delete('InboxPrivateMessages',array(
				'id'		=> $id,
				'user_id'	=> $_SESSION['user']['id']
			));
		}else{
			$mailbox = explode('-',$mailbox);
			$box = ($mailbox[0] == 'inbox') ? 'inbox' : $mailbox[count($mailbox)-1];
			$mailbox = implode("-",$mailbox);
			$mailbox = str_replace($box.'-','',$mailbox);
			$mailbox = str_replace('-'.$box,'',$mailbox);
			$imap = new Imap($mailbox,$box);
			$success = imap_delete($imap->mBox, $id);

		}

		return array(
			'msg' 	=> 	'Deleted Message!',
				'title' =>	'Success'
		);
    }

    /**
     * @remotable
     */
	function readMsg($id,$email,$box) {
		//$imap = new Imap($email,$box);
		$box = str_replace($email."-",'',$box);

		$this->imap[$email][$box] = $imap = (!$this->imap[$email][$box]) ? new Imap($email,$box) : $this->imap[$email][$box];
		$box = $imap->getMsg($id);
		return $box;
    }

    function getEmailBox($email){
    	$settings = $this->q()->Select('*','EmailServers',array(
    		'server_username'=>$email
    	));

    	$s = $settings[0];
		session_start();
		$_SESSION['imap']['mSvr']	= $s['server_address'];
		$_SESSION['imap']['mPort']	= $s['server_port'];
		$_SESSION['imap']['mUser']	= $s['server_username'];
		$_SESSION['imap']['mPop']	= $s['server_type'];
		$_SESSION['imap']['mPass']	= $s['server_pass'];
		$_SESSION['imap']['mSsl']	= ($s['server_ssl']) ? 'ssl' : '';

		$tree = array();
	    array_push($tree, array(
			'id'		=> 'inbox-pm-savebox',
			'text'		=> $s['server_address'],
			'iconCls'	=> 'x-icon-16x16-mail_dark_stuffed',
			'expanded'	=> true,
			'leaf'		=> true
		));
		array_push($tree, array(
			'id'		=> 'inbox-pm-savebox',
			'text'		=> $s['server_username'],
			'iconCls'	=> 'x-icon-16x16-mail_dark_stuffed',
			'expanded'	=> true,
			'leaf'		=> true
		));


    }

    /**
	 * Gets users Tree Containing First their own, followed by friends.
	 * @remotable
	 */
	function getUserTree($id){ //$id = username || username-docs
    	$x = explode('-',$id);
		$q = $this->q();

		switch(count($x)){
			case(1):
				$t = $this->sessTree($id);
				$out = array();
				if(!empty($t)){
					foreach($t as $k =>$v){
						array_push($out, array(
							'id'	=> $k,
							'text'	=> $v['name'],
							'iconCls'=> $v['icon'],
							'leaf'	=>false
						));
					}
				}

				return $out;
			break;

			default:
				return $this->getDirTree($id);
			break;
		}
    }

 	function sessTree($id){
 		if(empty($_SESSION[$this->id."tree-$id"])){
			$q = $this->q();
 			$t = $q->Select('tree','Infinite',array('user_id'=>$id));
			$_SESSION[$this->id."tree-$id"] = $t[0]['tree'];
 		}
		$t = json_decode($_SESSION[$this->id."tree-$id"],true);

	 	if($id == $_SESSION['user']['id']){
			$_SESSION['home-tree'] = $_SESSION["tree-$id"];
		}
		return $t;
    }

	function buildTree($id){

		$q = $this->q();
		$c = explode('-',$id);

		$u = $q->Select('id','Infinite',array('user_id'=>$_SESSION['user']['id']));

		if($u[0]['id'] == null && count($c) == 1 ){
			$defaults = $this->getDefaults($id);
			$t = json_encode($defaults);
			$q->Insert('Infinite',array(
				'user_id'=>$id,
				'tree' => $t
			));
		}

	}

    function getUsers(){
    	$out = array();
    	array_push($out, array(
            'id'	=> ($_SESSION["PATH"] == $_SESSION["user"])? 'home' : $_SESSION["PATH"],
            'text'	=> $_SESSION["PATH"],
    		'expanded'=>true,
			'iconCls'=>'x-icon-16x16-home_green',
            'leaf'=>false
		));

		$q = new MySql();
		$fri = $q->Select("user_friends","Users",array('user_name_nick'=>$_SESSION['PATH']));
		if(!empty($fri[0]['user_friends'])){
			$fri = $fri[0]['user_friends'];
			$fri = unserialize($fri);
			//$fri = json_encode($fri);
			//$fri = json_decode($fri);
			//$f = sort($fri,SORT_STRING);
			foreach($fri as $k => $end){
				array_push($out, array(
	        	    'id'	=> $end,
	        	    'text'	=> $end,
					'iconCls'=>'x-icon-16x16-drive_user',
	        	    'leaf'=>false
				));
			}
		}
		return $out;
    }

    function addBud($f,$formHandler=true){
    	$q = new MySql();
    	$u = $q->Select("Count(id),user_name_nick",'Users',array(
    		'user_email'=>$f['email'],
    		'user_name_nick'=>$f['name']
    	),null,'=','OR');

    	if($u[0]['Count(id)'] > 0){
    		$bud = $u[0]['user_name_nick'];
    		$response['success'] = true;
    		$response['user'] = $bud;
    		$m = $q->Select('user_friends','Users',array('id'=>$_SESSION['user-id']));
    		if($m[0]['user_friends'] != ""){
    			$f = unserialize($m[0]['user_friends']);
    			if(!in_array($bud,$f)){
    				array_push($f,$bud);
    			}else{
    				$response['success'] = false;
    				$response['reason'] = 'User already in buddy list!';
    			}
    		}else{
    			$f = array($bud);
    		}
    		natcasesort($f);
    		$q->Update('Users',array(
				'user_friends' => serialize($f)
			),array('id'=>$_SESSION['user-id'])
			);
    	}else{
    		$response['success'] = false;
    		$response['reason'] = "User NOT Found!";
    	}
    	return $response;
    }

	/**
	 * @remotable
	 */
    function getPath($path,$o){
    	$q = $this->q();
    	$q->mBy['file_name'] = 'ASC';

    	$out = array();

    	$q->mBy['text'] = 'ASC';

    	$files = $q->Select(array(
    		"InfiniteFolders"=>array(
    			'id',
    			'text',
    			'path'
    		)
    	),"InfiniteFolders",array('path'=>$path));

    	if(!empty($files)){
	    	foreach($files as $k => $v){
	    		array_push($out, array(
	    			'id'=>'folder-'.$v['id'],
	    			'name'=>$v['text'],
	    			'path'=>$v['path'],
	    			'size'=>'0',
	    			'real'=>$v['txt'],
	    			'ext'=>'dir'
	    		));
	    	}

    	}

    	$q->mBy['file_name'] = 'ASC';

    	$files = $q->Select(array(
    		"InfiniteFiles"=>array(
    			'id',
    			'file_name'=>'name',
    			'file_path'=>'path',
    			'file_real'=>'safe',
    			'file_size'=>'size',
    			'file_ext'=>'ext'
    		)
    	),"InfiniteFiles",array('InfiniteFiles.file_path'=>$path));
    	if(!empty($files)){
		    foreach($files as $k => $v){
		    	array_push($out, array(
		    		'id'=>$v['id'],
		    		'name'=>$v['name'],
		    		'path'=>$v['path'],
		    		'size'=>$v['size'],
		    		'real'=>$v['safe'],
		    		'ext'=>$v['ext']
		    	));
		    }
    	}	//echo $q->error;
    	return $out;
    }



    function getDirTree($id){
    	$dir = explode('-',$id);

    	if(count($dir) != 2){
    		$find = $id;
    	}else{
	    	switch($dir[1]){
	    		case('mail'):
	    			require_once('Email.php');
	    			$e = new Email();
	    			return $e->boxes('*');
	    		break;
	    	}

    		$long = array(
				'docs' => 'Documents',
				'pics' => 'Pictures',
				'mp3s' => 'Music',
				'vids' => 'Videos'
			);

			$find = '/'.$dir[0].'/'.$long[$dir[1]];
    	}




    	$q = new MySql();
    	$q->mBy['text'] = 'ASC';
    	$t = $q->Select('*','InfiniteFolders',array('parent'=>$id));



    	$out = array();
	   	if(!empty($t)){
	    	foreach($t as $k => $v){
				array_push($out, array(
		            'id'	=> $_SESSION['user']['id'].'-'.$v['id'],
		            'text'	=> $v['text'],
					'iconCls'=>'x-icon-16x16-folder_modernist',
		            'leaf'=>false
				));
			}
	   	}else{
			return null;
		}



		//$t = $q->Select('*','InfiniteFolders',array());
		return $out;
    }





    function fileDetails($f,$formHandler=true){
    	$q = new MySql();

    	// Update SQL

    	// Rename File loc!

    	try{
    		$dir = "$_SERVER[DOCUMENT_ROOT]/files/$f[loc]";
    		$dir = str_replace('//','/',$dir);
    		$dir = str_replace('\\','',$dir);
    		$old = "$dir/$f[o_name].$f[ext]";
    		$new = "$dir/$f[name].$f[ext]";

    		rename($old,$new);
    		$real = htmlentities(urlencode($f['name']));
			$q->Update('Files',array(
				'file_name'=>$f['name'],
	    		'file_real'=>$real
			),
	    		array('id'=>$f['id'])
	    	);
    		$response['success'] = true;
    		$response['sql_error'] = $q->error;
    		$response['sql'] = $q->mSql;
    	}catch(Exception $e){
    		$response['success'] = false;
    		$response['reason'] = 'Failed to rename!';
    	}



		$response['f'] = $f;



    	return $response;
    }

    function delFile($ids){
    	$response['success']	= false;

    	$ids = explode(',',$ids);
    	$response['data']= $ids;

    	$q = new MySql();

    	foreach($ids as $id){
    		$f = $q->Select(array(
    			'Files'=>array('id','file_path','file_name','file_ext')
    		),'Files',array('id'=>$id));

    		$f = $f[0];
    		$old = "$_SERVER[DOCUMENT_ROOT]/files$f[file_path]/$f[file_name].$f[file_ext]";

    		$dir = explode('/',$f['file_path']);
    		if($dir[2] == 'Trash'){
    			// Already in trash, delete!
    			try{
    				unlink($old);
    				$q->Delete('Files',array('id'=>$f['id']));
    				$q->Delete('Trash',array('file_id'=>$f['id']));
    				$response['success']	= true;
					$response['move_to']	= 'deleted!';
    			}catch(Exception $e){
    				$response['success']	= false;
					$response['reason']	= 'Failed: '.$e->getMessage();
    			}
    		}else{
	    		$trash = "$_SERVER[DOCUMENT_ROOT]/files/$_SESSION[user]/Trash";

	    		if(!file_exists($trash)){
	                mkdir($trash, 0755, true);
	            }

				$new = $trash.'/'.$f['file_name'].'.'.$f['file_ext'];

				if(rename($old,$new)){
		    		$path = $_SESSION['user'].'/Trash';
					$q->Update('Files',array(
		    			'file_path' => '/'.$path
		    		),array('id'=>$id));
		    		$response['success']	= true;
					$response['move_to']	= 'moved to: '.$path;

					$q->Insert('Trash',array(
						'file_path'=>$f['file_path'],
						'file_id'=>$id
					));


		    	}else{
		    		$response['reason']	= 'Move failed';
		    	}
    		}


    	}


    	return $response;
    }

    function restore($id){
    	if(!$id){
    		return array('success'=>false,'reason'=>'Failed to get File id.');
    	}
    	$q = new MySql();
    	$ids = explode(',',$id);
    	$response['data']= $ids;

    	$q = new MySql();
	    	foreach($ids as $id){


	    	$t = $q->Select('*','Trash',array('file_id'=>$id));
	    	$f = $q->Select('*','Files',array('id'=>$id));
	    	$t = $t[0];
	    	$f = $f[0];
	    	$old = "$_SERVER[DOCUMENT_ROOT]/files$f[file_path]/$f[file_name].$f[file_ext]";
	    	$new = "$_SERVER[DOCUMENT_ROOT]/files$t[file_path]/$f[file_name].$f[file_ext]";
	    	if(rename($old,$new)){
	    		$q->Update('Files',array('file_path'=>$t['file_path']),array('id'=>$id));
	    		$q->Delete('Trash',array('file_id'=>$id));
	    		$response['success']	= true;
				$response['move_to']	.= "<br/> $f[file_name] restored to: $t[file_path]";
	    	}else{
	    		$response['reason']	= 'Move failed';
	    		$response['success']	= false;
	    	}
	    }
    	return $response;
    }

    /**
     * @remotable
     */
    function newFolder($dir,$v,$o,$path,$id=null){
    	$q = $this->q();

    	if($o == "New Folder" && $v != null){
	    	$f = $q->Select('Count(id)','InfiniteFolders',array(
	    		'path'=>$dir,
	    		'text'=>$v
	    	));

	    	if($f[0]['Count(id)']>0){
		    	return array(
		    		'success'=>false,
		    		'reason'=>"A Folder name $v already exists"
		    	);
	    	}
	    	$path = str_replace('/root/infinite-home/','',$path);
	    	$path = explode('/',$path);
	    	$path = $path[(count($path)-1)];
	    	$q->Insert('InfiniteFolders',array(
	    		'text' => $v,
	    		'path'  => $dir,
	    		'parent'  => $path,
	    		'uid' => $_SESSION['user']['id']
	    	));
	    	$id = $_SESSION['user']['id'].'-'.mysql_insert_id();

    		return array(
	    		'success'=>true,
	    		'name' => $v,
		    	'path'  => $dir,
	    		'id' => $_SESSION['user']['id'].'-'.mysql_insert_id(),
	    		'uid' => $_SESSION['user']['id'].'-'.$v
    		);
    	}else if($id){
    		// Rename folder.
    		$f = $q->Select('Count(id)','InfiniteFolders',array(
	    		'path'=>$dir,
	    		'text'=>$v
	    	));

	    	if($f[0]['Count(id)']>0){
		    	return array(
		    		'success'=>false,
		    		'reason'=>"$v already exists in $dir"
		    	);
	    	}

    		$q->Update('InfiniteFolders',array(
    			'text'=>$v
    		),array(
    			'text'=>$o,
    			'path'=>$dir
    		));

    		return array(
    			'success'=>true,
    			'name' => $v,
    			'path'  => $dir,
    			'id' => $id
    		);
    	}






    }

    function stats(){
    	if(!$_SESSION['user']){
    		return null;
    	}
    	$q = new MySql();
    	$f = $q->Select(array(
    		'Files'=>array('file_ext'=>'Type','file_size'=>'Bytes')
    	),'Files',array('file_own'=>$_SESSION['user']));

    	$json = array();
    	$response =array();
    	if(!empty($f)){
	    	foreach($f as $k => $v){
	    		$json[$v['Type']] += $v['Bytes'];
	    	}
	    }


    	foreach($json as $k => $v){
    		$response[] = array(
    			'type'=>$k,
    			'bytes'=>$v

    		);
    	}

    	//$response['data'] = $response;

    	return $response;
    }


    function getDefaults($user){
    	$default[$user.'-rate'] = array(
		'name'=>'Top Rated',
		'public'=>true,
		'icon'=>'x-icon-16x16-star_boxed_full',
		'items'=>array(),
		);
		$default[$user.'-docs'] = array(
			'name'=>'Documents',
			'public'=>true,
			'icon'=>'x-icon-16x16-documents',
			'items'=>array(),
		);
		/*
		$default[$user.'-mail'] = array(
			'name'=>'Email',
			'public'=>false,
			'icon'=>'x-icon-16x16-mail_light',
			'items'=>array(),
		);
		*/
		$default[$user.'-favs'] = array(
			'name'=>'Favorites',
			'public'=>true,
			'icon'=>'x-icon-16x16-heart',
			'items'=>array(),
		);
		/*
		$default[$user.'-rsss'] = array(
			'name'=>'Feeds',
			'public'=>true,
			'icon'=>'x-icon-16x16-ticket',
			'items'=>array(),
		);*/
		$default[$user.'-mp3s'] = array(
			'name'=>'Music',
			'public'=>true,
			'icon'=>'x-icon-16x16-music_cd_blue_note',
			'items'=>array(),
		);

		$default[$user.'-pics'] = array(
			'name'=>'Pictures',
			'public'=>true,
			'icon'=>'x-icon-16x16-image_cultured',
			'items'=>array(),
		);
		$default[$user.'-vids'] = array(
			'name'=>'Videos',
			'public'=>true,
			'icon'=>'x-icon-16x16-movie_blue_film_strip',
			'items'=>array(),
		);

		$default[$user.'-webs'] = array(
			'name'=>'Websites',
			'public'=>true,
			'icon'=>'x-icon-16x16-link',
			'items'=>array(),
		);
		$default[$user.'/trash'] = array(
			'name'=>'Trash',
			'public'=>true,
			'icon'=>'x-icon-16x16-bin_empty',

			'items'=>array(),
		);
		return $default;
    }
	/**
	 * @remotable
	 */
	function moveFile($drag,$drop){
		// Move teh files!
		// Not really, just update the db to the new path id.

		$q = $this->q();
		$q->Update('InfiniteFiles',array(
			'file_path'=>$drop
		),array('id'=>$drag));

		return array(
			'drag'=>$drag,
			'drop'=>$drop,
			'success'=>true
		);
	}


	/**
	 * @remotable
	 */
	function loadSettings($email){
		$e['server']	= 'imap.gmail.com';
		$e['port']		= '993';
		$e['ssl']		= 'on';
		$e['imap']		= 'on';

		return array(
			'success'=>true,
			'data'=>$e
		);
	}



	/**
	 * @remotable
	 * @formHandler
	 */
	function newAccount($f){
		$q = $this->q();

		$f['pass'] = base64_decode($f['pass']);
		$md5_64 = base64_encode( md5( session_id() ) );
		$f['pass'] = str_replace($md5_64,'',$f['pass']);
		$f['pass'] = base64_decode($f['pass']);

		$key = sha1($_SESSION['user']['id']);

		$f['pass'] = $this->_mencrypt($f['pass'],$key);

		// We don't want to save their password! Only the encryption.
		$q->Insert('InboxServers',array(
			'server_username'	=> $f['email'],
			'server_address'	=> $f['server'],
			'server_port'		=> $f['port'],
			'server_ssl'		=> $f['ssl'],
			'server_pass'		=> $f['pass'],
			'server_iv'			=> $iv,
			'server_type'		=>($f['pop'])?'pop':'imap',
			'user_id'	=>$_SESSION['user']['id']
		));

		return array(
			'success'=>true,
			'sql'=>$q->mSql,
			'msg'=>$q->msg
		);
	}

	// $input - stuff to encrypt
	// $key - the secret key to use

	function _mencrypt($input,$key){
        $input = str_replace("\n","",$input);
        $input = str_replace("\t","",$input);
        $input = str_replace("\r","",$input);
        $key = substr(md5($key),0,24);
		$td = mcrypt_module_open ('tripledes', '', 'ecb', '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size ($td), MCRYPT_RAND);
		mcrypt_generic_init ($td, $key, $iv);
		$encrypted_data = mcrypt_generic ($td, $input);
		mcrypt_generic_deinit ($td);
		mcrypt_module_close ($td);
		return trim(chop(base64_encode($encrypted_data)));
	}


}
?>