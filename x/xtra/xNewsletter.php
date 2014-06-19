<?php
/**
 * @name NewsLetter
 * @desc Send a Newsletter with site content
 * @version v0.1.09.30.06.23
 * @author cdpollard@gmail.com
 * @price $40
 * @icon News.png
 * @mini bullhorn
 * @see cronos
 * @link newsletter
 * @todo
 */

	class xNewsletter extends Xengine{
		function autoRun(){

		}
		function installSql(){
			// Check for table.
			$table = $this->q()->Q('show tables like "Newsletters"');
			if(empty($table)){
				// Install Table!
				$this->q()->Q("CREATE TABLE `Newsletters`
					(`id` int not_null AUTO_INCREMENT,
					`title` char(50),
					`content` blob,
					`date` varchar(10),
					`sent` int,
					PRIMARY KEY (id))
				");
			}
		}
		/**
		 * List News Items for both public and Admin.
		 * templates will give links to either, readmore, edit, etc.
		 */
		function index(){
			$this->q()->mBy = array('date'=>'DESC');
			$list = $this->q()->Select('*','Newsletters');
			$this->set('list',$list);
		}

		function article($id,$title=null,$date=null){
			$article = $this->q()->Select('*','Newsletters',array('id'=>$id));
			$this->set('article',$article[0]);
			$this->set('PAGE_TITLE','Newsletters');
		}

		function add($send=false){
			$this->installSql();
			if(isset($_POST['news'])){
				if($send){
					$_POST['news']['sent'] = 1;
				}

				if($_POST['news']['id'] > 0){
					$this->q()->Update('Newsletters',$_POST['news'],array('id'=>$_POST['news']['id']));
					$this->set('success',true);
				}else{
					unset($_POST['news']['id']);
					$this->q()->Insert('Newsletters',$_POST['news']);
					$this->set('success',true);
				}

				if($send == 1){
					$this->sendLetter($_POST['news']);
				}

			}

		}

		function sendLetter($news){

			// Get list of everyone.
			$users = $this->q()->Select('id,email,username,first_name,last_name','Users',array(
				'newsletter' => 1
			));

			// Send to people who have yet to recieve this.
			if(!empty($users)){
				foreach($users as $k => $v){
					$bcc = ($bcc) ? ', '.$v['email'] : $v['email'] ;
				}
			}

			// multiple recipients

			// subject
			$subject = $news['title'];

			// message
			$message = "
			<html>
			<head>
			  <title>$news[title]</title>
			</head>
			<body>
			  $news[content]
			</body>
			</html>
			";

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Additional headers
			$host = $_SERVER['HTTP_HOST'];
			//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			$headers .= "From: $host Newsletter <newsletter@$host>" . "\r\n";
			//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
			$headers .= "Bcc: $bcc" . "\r\n";

			// Mail it
			mail("newsletter@$host", $subject, $message, $headers);


			// Get list of everyone who has recieved this letter.

			$this->set('success',true);
			$this->set('sent',true);

		}


		function edit($id){
			$data = $this->q()->Select('*','Newsletters',array(
				'id' => $id
			));

			//$news['news'] = $data[0];
			foreach($data[0] as $k => $v){
				$news["news[$k]"] = $v;
			}

			$out = array(
				'success' => true,
				'data' 	=> $news
			);
			//$this->set('success',true);
			//$this->set('data',$news);
			//$this->out($out);
			echo json_encode($out);
			exit;
		}

		function delete($id=null){
			if($id > 0){
				$this->q()->Delete('Newsletters',array('id'=>$id));
			}
			header('Location: /@/newsletter');
		}

		function addUserEmail(){

			$q = $this->q();

			$user = $q->Select('id','Users',array(
				'email' => $_POST['email']
			));

			if(!empty($user[0])){ 
				return array(
					'success' => false,
					'error' => 'That email already exists in our database.'
				);				
			}else{ 
				$_POST['last_login'] = time();

				return array(
					'success' => true,
					'msg' => $q->Insert('Users',$_POST)
				);				
			}

		}

	}

?>