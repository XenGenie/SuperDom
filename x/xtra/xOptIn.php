<?php
/**
 * @name Lead Magnet
 * @desc Easily Create 'Opt-In' Squeeze Pages
 * @version v1.11.11.01.07.20
 * @author glare@gmail.com
 * @price $300
 * @icon MagnetRedBlue.png
 * @see radius
 * @mini magnet
 * @link optIn
 * @license
 * @todo
 */

	class xOptIn extends Xengine{
		var $D;

		function __construct(){
			####################################################
			## DEFINED SHORTCUTS TO DATABASE TABLES - Dont EDIT! ####
			####################################################
			$d = $this;									####
			$d->DBLMH		 	= 'LeadMagnetHeadlines';	####
			$d->DBLMD	 		= 'LeadMagnetDrips';		####
			$d->DBLME 			= 'LeadMagnetEmails';		####
			$d->DBLMO		 	= 'LeadMagnetOptIns';		####
			$this->D = $d;									####
			####################################################
		}


		function dbSync(){
			return array(
				'LeadMagnetHeadlines'	=>	array(
					'optin_id'			=> array('Type' => 'int(6)'),
					'headline'			=> array('Type' => 'varchar(500)'),
					'page_views'		=> array('Type' => 'int(7)','Default'=>0 ),
					'conversions'		=> array('Type' => 'int(7)','Default'=>0 )
				),

				'LeadMagnetTypes'	=>	array(
					'type'				=> array('Type' => 'int(6)'),
				),

				'LeadMagnetEmails'	=>	array(
					'optin_id'			=> array('Type' => 'int(6)'),
					'from_address'		=> array('Type' => 'varchar(50)'),
					'subject'			=> array('Type' => 'varchar(255)'),
					'email_content'		=> array('Type' => 'blob'),
					'day_in_chain'		=> array('Type' => 'int(5)'),
					'user_id'			=> array('Type' => 'int(8)')
				),
				'LeadMagnetDrips'	=>	array(
					'optin_id'			=> array('Type' => 'int(6)'),
					'email_address'		=> array('Type' => 'varchar(50)'),
					'email_optin_time'	=> array('Type' => 'int(10)'),
					'last_email_drip'	=> array('Type' => 'int(6)')
				),
				## Rename ##
				'OptInPages'		=> 'LeadMagnetOptIns',
				############
				'LeadMagnetOptIns' => array(
					'program_title'				=> array('Type' => 'varchar(255)'),
					'conversions'				=> array('Type' => 'int(7)'),
					'url' 						=> array('Type' => 'varchar(255)'),
					'headline' 					=> array('Type' => 'varchar(255)'),
					'embed_type' 				=> array('Type' => 'varchar(25)'),
					'video' 					=> array('Type' => 'varchar(255)'),
					'video_autostart' 			=> array('Type' => 'varchar(5)'),
					'video_display_controls' 	=> array('Type' => 'varchar(5)'),
					'video_width' 				=> array('Type' => 'varchar(5)'),
					'video_height'				=> array('Type' => 'varchar(5)'),
					'content' 					=> array('Type' => 'blob'),
					'html_code' 				=> array('Type' => 'blob'),
					'optin_msg' 				=> array('Type' => 'blob'),
					'email' 					=> array('Type' => 'varchar(255)'),
					'name' 						=> array('Type' => 'varchar(5)'),
					'name_last'					=> array('Type' => 'varchar(5)'),
					'phone'						=> array('Type' => 'varchar(5)'),
					'username'					=> array('Type' => 'varchar(5)'),
					'password'					=> array('Type' => 'varchar(5)'),
					'submit_txt' 				=> array('Type' => 'varchar(255)'),
					'arrow_txt' 				=> array('Type' => 'varchar(255)'),
					'privacy' 					=> array('Type' => 'varchar(500)'),
					'alert_text'				=> array('Type' => 'varchar(255)'),
					'theme' 					=> array('Type' => 'varchar(255)'),
					'thank_you' 				=> array('Type' => 'blob'),
					'thank_you_headline'		=> array('Type' => 'varchar(255)'),
					'thank_you_url'				=> array('Type' => 'varchar(255)'),
					'thank_you_timeout'			=> array('Type' => 'int(4)'),
					'email_signature'			=> array('Type' => 'blob'),
					'bullet_caption'			=> array('Type' => 'blob'),
					'bullet_1'					=> array('Type' => 'varchar(200)'),
					'bullet_2'					=> array('Type' => 'varchar(200)'),
					'bullet_3'					=> array('Type' => 'varchar(200)'),
					'bullet_4'					=> array('Type' => 'varchar(200)'),
					'bullet_5'					=> array('Type' => 'varchar(200)'),
					'bullet_6'					=> array('Type' => 'varchar(200)'),
					'bullet_7'					=> array('Type' => 'varchar(200)'),
					'bullet_8'					=> array('Type' => 'varchar(200)'),
					'bullet_9'					=> array('Type' => 'varchar(200)'),
					'bullet_10'					=> array('Type' => 'varchar(200)'),
					'bullet_align'				=> array('Type' => 'varchar(10)'),
					'bullet_style_type'			=> array('Type' => 'varchar(20)'),
					'bullet_style_position'		=> array('Type' => 'varchar(8)'),
					'bullet_image'				=> array('Type' => 'varchar(255)'),
					'seo_keywords' 				=> array('Type' => 'varchar(2000)'),
					'seo_desc'	 				=> array('Type' => 'varchar(1000)'),
					'seo_page_title'			=> array('Type' => 'varchar(255)'),
					'paypal_price'				=> array('Type' => 'int(5)'),
					'paypal_item'				=> array('Type' => 'varchar(255)'),
					'paypal_on'					=> array('Type' => 'varchar(5)'),
					'weight'					=> array('Type' => 'int(3)'),
					'aim_type'					=> array('Type' => 'varchar(15)')
				)
			);
		}


/*		function autoRun($x){
			$this->dripEmails();

			// Get the content for the page.
			$url = substr($_SERVER['REQUEST_URI'],1);

			if(empty($url)){
				$url = 'index';
			}else{
				$url = parse_url($url) ;
				$url = $url['path'];
				$url = ($url == 'index/index') ? 'index' : $url;
			}

			# Spaces get Transposed into %20, reconvert
			$url = str_replace("%20"," ",$url);

			//$url = str_replace("+"," ",$url);


			# Check for contact matching requested url
			$content = $this->q()->Select( '*',$this->D->DBLMO,array('url'=>$url) );

			if(!empty($content)){

				$content = $content[0];

				if($content['video']){
					$w = ($content['video_width']) ? $content['video_width'] : 500;
					$h = ($content['video_height']) ? $content['video_height'] : 375;
					$autostart = ($content['video_autostart'] == "true") ? true : false;
					if( strpos($content['video'], 'http://') ){
						$content['video'] = 'http://'.str_replace('http://','',$content['video']);
					}

					$youtube = $this->embedYouTubeLink($content['video'],$w,$h,$autostart);

					if($youtube != false || $content['html_code']){
						//$content['html_code'] = $this->embedYouTubeLink($content['html_code'],$w,$h,true);
						$content['html_code'] = $youtube.$content['html_code'];
					}
				}

				if($content['paypal_item']){
					$this->inc('ux/paypal.inc.php');
					$button = new PayPalButton;
					$cfg = $this->readConfigs();
					$button->accountemail = $cfg['PAYPAL_EMAIL'];
					$button->custom = time();
					$button->target = "_blank";
					$button->currencycode = 'USD';
					$button->class = 'paypalbutton';
					$button->askforaddress = true;

					$button->onsubmit = " $('#optin_form').submit(); return checkForm(document.getElementById('optin_form'));";

					$button->buttontext = $content['submit_txt'];

					$url = 'http://'.HTTP_HOST.'/'.$content['url'];
					$button->return_url 	= $url.'/?success';
					$button->ipn_url 		= $url.'/?ipn';
					$button->cancel_url 	= $url.'/?cancel';

					//Items
					$button->AddItem(
						$content['paypal_item'],
						'1',
						$content['paypal_price'],
						'LM-'.$content['id']);
					//Output
					ob_start();
					$button->OutputButton();
					$button = ob_get_contents();
					ob_end_clean();
					$this->set('buynow',$button);
				}


				$this->set('PAGE_CONTENT',$content['content']);
				$this->set('PAGE',$content);
				$this->style($content['theme']);

				$this->q()->mBy = array('page_views'=>'ASC');
				$this->q()->setStartLimit(0,1);
				$headlines = $this->q()->Select( '*',$this->D->DBLMH,array('optin_id'=>$content['id']) );
				if(!empty($headlines)){
					//$rand = rand(0, count($headlines) - 1 );
					$headline = $headlines[0];

					if($_SESSION['user']['power_lvl'] < 9){
						$this->q()->Update($this->D->DBLMH,array(
							'page_views' => 1 + $headline['page_views']
						),array(
							'id' => $headline['id']
						));
					}



					$this->set('PAGE_TITLE',$headline['headline']);
					$this->set('HEADLINE_ID',$headline['id']);
				}else{
					$this->set('PAGE_TITLE',$content['headline']);
				}

			}else{
				$area = explode('/',$url);
				//$this->set('PAGE_TITLE',ucfirst($area[0]));
			}

			if($_GET['theme']){
				$this->style($_GET['theme']);
			}

			$P = $_POST;
			// A Submission has been Made!
			if(isset($P['optin_id'])){

				$this->set('PAGE_TITLE',$content['thank_you_headline']);

				$q = $this->q();
				$P['timestamp'] = time();

				$isNew = $q->Select('email','Users',array(
					'email' => $P['email']
				));

				// New User
				if( empty($isNew) ){
					$q->Insert('Users',array(
						'email' 		=> $P['email'],
						'name'			=> $P['name'].' '.$P['name_last'],
						'username'		=> $P['username'],
						'last_active'	=> time(),
						'newsletter'	=> 1
					));
				}

				// *
				//  * This is where we should pull all the optin emails
				//  * and set them up to be sent out via mailbox.
				//  * @var array
				 
				$q->mLimit = null;
				$q->mBy = array('id'=>'ASC');
				$drips = $q->Select('*',$this->D->DBLME,array(
					'optin_id' 		=> $P['optin_id']
				));

				if(!empty($drips)){
					// We Place each drip in the users outbox -
					foreach($drips as $r => $c){
						$plus = ($c['day_in_chain']) ? ($c['day_in_chain'] * 24 * 60 * 60) : 0;
						$stamp = time() + $plus;
						$q->Insert('InboxPrivateMessages',array(
							'message'		=> $c['email_content'],
							'fromaddress'	=> $c['from_address'],
							'bccaddress'	=> $c['from_address'],
							'Subject'		=> $c['subject'],
							'toaddress'		=> $P['email'],
							'box'			=> 'outbox',
							'user_id'		=> $c['user_id'],
							'Date'			=> date(DATE_ATOM, $stamp)
						));
						$user_id = $c['user_id'];
					}

				}

				//$q->Insert('feedback',$P);

				$notification = "<i>This is an automated email from Lead Magnet Generator.<br/>

The following Lead has been attracted to your Magnet: <br/></i>
<h1>$content[headline]</h1>
<b>$P[name_first] $P[name_last] $P[email] $P[phone]</b> <br/>
<br/><br/>
Check your Outbox to view any pending messages they will be receiving from you automatically.
<br/>
--
Lead Magnet Team ";

				// Send A Notification to their Inbox
				$q->Insert('InboxPrivateMessages',array(
					'message' 		=> $notification,
					'fromaddress'	=> $P['email'],
					'Subject'		=> 'Your Magnet Attracted A Lead',
					'date'			=> Date('Y-m-d h-i-s'),
					'box'			=> 'inbox',
					'user_id'		=> $user_id
				));

				$headline = $q->Select('conversions',$this->D->DBLMH,array('id'=>$P['headline']));

				$headline = $headline[0];

				$this->q()->Update($this->D->DBLMH,array(
					'conversions' => 1 + $headline['conversions']
				),array(
					'id' =>	$P['headline']
				));


				$this->set('email_sent',true);
				// Lets prepare the data
				// Email it
				// Store it in our DB as well.
				// Set a thank you confimation.
			}
		}

*/		function index(){
			$q = $this->q();
			$q->mBy = array('url'=>'ASC');

			$pages = $q->Select('*',$this->D->DBLMO);

			$pages = (!empty($pages)) ? $pages : array();

			$this->set('optinBoxes',$pages);

				// Lets get the style sheet list

			$q->setStartLimit(0,1);
			$styles = $q->Select('*','costume_adminzone');

			foreach($styles[0] as $k => $v){
				$props[$k] = '';
				$fields[] = $k;
			}
			$this->set('store_fields',json_encode($fields));
			$this->set('style_properties',json_encode($props,JSON_FORCE_OBJECT));

			$q->setStartLimit(0,100);
			$costumez = $q->Select('*','costumez');

			foreach($costumez as $k => $v){
				$themes[ $v['table'] ] = $v['title'];
			}

			$this->set('themes',$themes);

			//$f[] = 'program_title';
			$f[] = 'id';
			$f[] = 'url';

			$f[] = 'conversions';
			$this->set('fields',	json_encode($f)	);
			$this->set('nodes',		$f);

			$ff = array('file_name','file_md5','file_parent','file_path','id');
			$this->set('file_fields',	json_encode($ff)	);
			$this->set('file_nodes',	$ff	);


			$f = array('day_in_chain','subject','from_address','email_content','id');
			$this->set('email_fields',	json_encode($f)	);


			// Lets build the columns.
			foreach($f as $k => $v){
				//s
				if($v != 'id' && $v != 'email_content'){
					$columns[] = array(
						'header' => ucwords( str_replace('_',' ',$v) ),
						'id'		=> $v,
						'dataIndex'	=> $v
					);
				}

			}

			$this->set('email_columns',	json_encode($columns)	);


			$f = array('headline','page_views','conversions','conversion_rate','id');
			$this->set('headlines_fields',	json_encode($f)	);


			// Lets build the columns.
			$columns = null;
			foreach($f as $k => $v){
				//s
				if($v != 'id' && $v != 'email_content'){
					$columns[] = array(
						'header' => ucwords( str_replace('_',' ',$v) ),
						'id'		=> $v,
						'dataIndex'	=> $v
					);
				}

			}

			$this->set('headlines_columns',	json_encode($columns)	);







		}

		function jsonHeadlines($id=null){
			$q =$this->q();

			$where = ($id) ? array('optin_id'=>$id) : null;
			$q->mBy = array('page_views'=>'DESC');
			$headlines = $q->Select('*',$this->D->DBLMH,$where);

			if(!empty($headlines)){
				foreach($headlines as $k => $v){
					$headlines[$k]['page_views'] = 0 + $v['page_views'];
					$headlines[$k]['conversions'] = 0 + $v['conversions'];
					//
					if($v['page_views'] && $v['conversions'] ){
						$headlines[$k]['conversion_rate'] =  floor(100 / ($v['page_views'] / $v['conversions'])).'%';
					}else{
						$headlines[$k]['conversion_rate'] = '0%'  ;
					}


				}
			}


			$this->out(array(
				'data' => ($headlines) ? $headlines : array()
			));
		}

		function jsonFiles(){
			$dir = ($_POST['dir'] == 'source') ? '' : $_POST['dir'];

			$q =$this->q();
			$q->setStartLimit(0,50);
			$q->mBy = array('file_added'=>'DESC');
			if($dir){
				$files = $q->Select('*','FileUploads',array('file_parent'=>$dir));
			}else{
				$files = $q->Select('*','FileUploads');
			}
			$this->out(array(
				'data' => ($files) ? $files : array()
			));
		}

		function jsonPages(){
			$q =$this->q();

			$q->mBy = array('weight'=>'ASC','url'=>'ASC');
			$pages = $q->Select('program_title, id,url',$this->D->DBLMO);
			echo $q->error;
			$this->out(array(
				'data' => ($pages) ? $pages : array()
			));

		}

		function jsonDrips($id){
			$q =$this->q();

			$f[] = 'id';
			$f[] = 'day_in_chain';
			$f[] = 'subject';
			$f[] = 'from_address';
			$f[] = 'email_content';


			$q->mBy = array('day_in_chain'=>'asc');
			
			$pages = $q->Select(implode(',',$f) ,$this->D->DBLME,array(
				'optin_id' => $id
			));

			//$pages = $q->Select('program_title, id,url',$this->D->DBLMO);
			$this->out(array(
				'data' => ($pages) ? $pages : array()
			));
		}

		function addHeadline(){
			if( $_POST['id'] != 0 ) {
				$this->q()->Update($this->D->DBLMH,array(
					'headline'	=> $_POST['headline']
				),array(
					'id' => $_POST['id']
				));
				$this->set('success',true);
			}else{
				unset($_POST['form']['id']);
				$this->q()->Insert($this->D->DBLMH,array(
					'headline' => $_POST['headline'],
					'optin_id'	=> $_SESSION['optin_id']
				));
				$this->set('success',true);
				$_POST['id'] = mysql_insert_id($this->q()->mConn);
			}
			$this->set('POST',$_POST['form']);
			$this->set('error',$this->q()->error);
		}


		/**
		 * @remotable
		 * @formHandler
		 */
		function add($form){
			$form = $this->cleanExtF($form);

			if( $form['id'] != 0 ) {

				function checkBox($box){
					return ($box == 'on') ? 'on' : 'off';
				}

				if(isset($form['optin_msg'])){
					$form['phone'] 		= checkBox($form['phone']);
					$form['name'] 		= checkBox($form['name']);
					$form['email']	 	= checkBox($form['email']);
					$form['name_last'] 	= checkBox($form['name_last']);
					$form['username'] 	= checkBox($form['username']);
					$form['password'] 	= checkBox($form['password']);
				}






				$this->q()->Update($this->D->DBLMO,$form,array(
					'id' => $form['id']
				));

				$this->set('success',true);
			}else{
				unset($form['id']);
				$this->q()->Insert($this->D->DBLMO,$form);
				$this->set('success',true);
				$form['id'] = mysql_insert_id($this->q()->mConn);
			}
			$this->set('POST',$form);
			return array(
				'success'	=> ($this->q()->error) ? false : true,
				'error' 	=> $this->q()->error
			);
		}

		/**
		 * @remotable
		 */
		function edit($id){
			 
			$_SESSION['optin_id'] = $id;
			$data = $this->q()->Select('*',$this->D->DBLMO,array(
				'id' => $id
			));

			foreach($data[0] as $k => $v){
				$content[$k] = $v;
			}

			//unset($content['content[content]']);

			return array(
				'success' => true,
				'data' 	=> $content
			);
		}

		function create($id=null){
			$this->set('success',($this->q()->error)? false: true);



			if($id == 0){
				unset($_POST['link']['id']);
				$this->q()->Insert( $this->D->DBLMO,$_POST['form'] );
			}else{
				$_POST['form']['phone'] 	= ($_POST['form']['phone'] == 'on') ? 'on' : 'off';
				$_POST['form']['name'] 		= ($_POST['form']['name']) ? 'on' : 'off';
				$_POST['form']['name_last'] = ($_POST['form']['name_last']) ? 'on' : 'off';
				$_POST['form']['username'] 	= ($_POST['form']['username']) ? 'on' : 'off';
				$_POST['form']['password'] 	= ($_POST['form']['password']) ? 'on' : 'off';

				$this->q()->Update( $this->D->DBLMO,$_POST['form'],array('id'=>$id) ) ;
				$this->set('error',$this->q()->error);
			}
		}

		function delete($id=null){
			if($id > 0){
				$this->q()->Delete($this->D->DBLMO,array('id'=>$id));
			}
			exit;
		}

		function deleteHeadline(){
			$this->q()->Delete($this->D->DBLMH,array('id'=>$_POST['id']));
			$this->set('success',true);
		}


		function addDrip(){
			if( $_POST['form']['id'] != 0 ) {
				$this->q()->Update($this->D->DBLME,$_POST['form'],array(
					'id' => $_POST['form']['id']
				));
				$this->set('success',true);
			}else{
				unset($_POST['form']['id']);
				$this->q()->Insert($this->D->DBLME,$_POST['form']);
				$this->set('success',true);
				$_POST['form']['id'] = mysql_insert_id($this->q()->mConn);
			}
			$this->set('POST',$_POST['form']);
			$this->set('error',$this->q()->error);
		}

		function deleteDrip(){
			$this->q()->Delete($this->D->DBLME,array('id'=>$_POST['id']));
			$this->set('success',true);
		}

		function editDrip(){

			if($_POST['id'] == ''){
				$this->q()->Insert($this->D->DBLME,array(
					'day_in_chain'	=> $_POST['day_in_chain'],
					'from_address' 	=> $_POST['from_address'],
					'subject' 		=> $_POST['subject'],
					'email_content' => $_POST['email_content'],
					'optin_id' 		=> $_POST['optin_id'],
					'user_id'		=> $_SESSION['user']['id']
				));
				$this->set('success',true);
			}else{
				$this->q()->Update($this->D->DBLME,array(
					'day_in_chain'	=> $_POST['day_in_chain'],
					'from_address' 	=> $_POST['from_address'],
					'subject' 		=> $_POST['subject'],
					'email_content' => $_POST['email_content'],
					'user_id'		=> $_SESSION['user']['id']
				),array(
					'id' => $_POST['id']
				));
				$this->set('success',true);
			}


		}
		function dripEmails(){
			$q = $this->q();
			$drips = $q->Select('*',$this->D->DBLMD);

			$now = time();
			if(!empty($drips)){
				foreach($drips as $k => $v){
					$emails = $q->Select('*',$this->D->DBLME,array(
						'optin_id' => $v['optin_id']
					));

					$signature = $q->Select('email_signature',$this->D->DBLMO,array(
						'id' => $v['optin_id']
					));

					$signature = $signature[0]['email_signature'];

					$time_since = $now - $v['email_optin_time'];
					$days = floor((($time_since / 60) / 60) / 24);

					if(!empty($emails)){
						foreach($emails as $key => $val){
							if($days >= $val['day_in_chain'] && $v['last_email_drip'] <= $val['day_in_chain'] ){
								if($v['last_email_drip'] !== $val['day_in_chain']){
									$to = $v['email_address'] ;
									$subject = $val['subject'];
									$message = $val['email_content']."
--
$signature
$_SERVER[HTTP_HOST]
";

									$headers  = 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

									// Additional headers
									$headers .= 'From: '. $val['from_address']  . "\r\n";
									//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
									$headers .= 'Bcc: '. $val['from_address'] . "\r\n";

									// Mail it
									mail($to, $subject, $message, $headers);
									$q->Update($this->D->DBLMD,array(
										'last_email_drip' => $val['day_in_chain']
									),array(
										'id' => $v['id']
									));
								}
							}
						}
					}

				}
			}
		}


	    function upload($action){
	    	$node = $_POST['node'];
	    	$node = ($node == 'source') ? '' : $node;
	    	$node = str_replace('dir-','',$node);

	    	$q = $this->q();
	    	$dirs = $q->Select('*','FileUploadDirs',array(
    			'parent_id' => $node
    		));

    		$folders = array();

    		if(empty($dirs) && $node == ''){
    			$folders = array(
					array('text'=>'Images','iconCls'=>'x-icon-16x16-image','parent_id'=>''),
					array('text'=>'Audio', 'iconCls'=>'x-icon-16x16-volume_loud','parent_id'=>''),
					array('text'=>'Video', 'iconCls'=>'x-icon-16x16-movie_blue','parent_id'=>''),
					array('text'=>'Trash', 'iconCls'=>'x-icon-16x16-bin','parent_id'=>'')

    			);
    			foreach($folders as $k => $v){
    				$q->Insert('FileUploadDirs',$v);
    			}
    			$this->upload(true);
    		}else{
    			foreach($dirs as $k => $v){
    				$folders[] = array(
    					'text' 	  => $v['text'],
    					'iconCls' => $v['iconCls'],
    					'id'	  => 'dir-'.$v['id'],
    				);
    			}
    		}
    		$this->out($folders);
	    }

	    function copyMagnet(){
	    	$id 	= $_POST['id'];
	    	$url 	= $_POST['url'];

	    	$this->set('url',$url);


	    	$success = false;

	    	if($id && $url){

	    		$q = $this->q();
	    		/* COPY EVERYTHING FROM THE MAGNET TO A NEW MAGNET!
	    		 * Headlines
	    		 * Content
	    		 * Drip Emails
	    		*/

	    		function removeId($table){
	    			if(!empty($table)){
		    			foreach($table as $k => $v){
		    				unset($table[$k]['id']);
		    			}
	    			}
	    			return $table;
	    		}

	    		function replaceCell($table,$column,$value){
	    			if(!empty($table)){
		    			foreach($table as $k => $v){
		    				$table[$k][$column] = $value;
		    			}
	    			}
	    			return $table;
	    		}

	    		# Get Content.
	    		$content 	= removeId($q->Select('*',$this->D->DBLMO,array(
	    			'id'	=> $id
	    		)));
	    		$content = $content[0];
	    		$content['url'] = $url;

	    		# Insert Copy
	    		$newId = $q->Insert($this->D->DBLMO,$content);

	    		# Get Headlines
	    		$headlines 	= removeId($q->Select('*',$this->D->DBLMH,array(
	    			'optin_id'	=> $id
	    		)));

	    		# Copy & Paste Headlines
	    		$headlines = replaceCell($headlines,'optin_id',$newId);
	    		$headlines = replaceCell($headlines,'page_views',0);
	    		$headlines = replaceCell($headlines,'conversions',0);

	    		if(!empty($headlines)){
		    		foreach($headlines as $k => $v){
		    			$q->Insert($this->D->DBLMH,$v);
		    		}
	    		}

	    		# Get Drips
	    		$drips 		= removeId($q->Select('*',$this->D->DBLME,array(
	    			'optin_id'	=> $id
	    		)));

	    		# Copy & Paste Headlines
	    		$drips = replaceCell($drips,'optin_id',$newId);

	    		$this->set('id',$newId);

	    		if(!empty($drips)){
		    		foreach($drips as $k => $v){
		    			$q->Insert($this->D->DBLME,$v);
		    		}
	    		}

	    		$success = true;
	    	}
	    	$this->set('success',$success);
	    }

	    function updateOrder(){
	    	$i = 0;
	    	$magnets = $_GET['node'];
	    	$q = $this->q();
	    	foreach($magnets as $k => $v){
	    		$q->Update($this->D->DBLMO,array(
					'weight'	=> $i
				), array('id'=>$v));
	    		$i++;
			}
	    }

	}
?>