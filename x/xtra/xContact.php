<?php
/**
 * @name Guestbook
 * @desc Contact Manager system for website feedback and the like
 * @version v1.11.10.25.12.53
 * @author i@xtiv.net
 * @icon address-book.png
 * @mini paw
 * @see community
 * @link contact
 * @todo
 *
 */

	class xContact extends Xengine{
		function dbSync(){
			return array(
				'feedback'=>array()
			);
		}


		/*function __construct(){
			$this->area51();
		}*/


		function autoRun($sDom){
			$q = $sDom->q();
			/*$msgs = $q->Select('id','feedback',array(
				'replied' => 0
			));

			$count = count($msgs);
			$this->set('COUNT_INBOX',$count);*/
		}

		function sendEmail(){
			// We should be getting our data from the post

			$p = $_POST;
			$q = $this->q();
			$q->Update('feedback',array(
				'reply_from' => $_POST['from'],
				'reply' 	=> $_POST['message'],
				'replied' 	=> 1
			),array('id'=>$_POST['id']));

			$this->set('success',mail($p['reply_to'],$p['subject'],$p['message'],"From: $p[from]"));
		}


		function index(){
			$this->set('WWW_PAGE','Contacts');

			$door = $this->DOOR.'Door';
			$this->$door();


		}

		function frontDoor(){
			$P = $_POST;
			if(isset($P['message'])){
				$q = $this->q();
				$P['timestamp'] = time();
				$q->Insert('feedback',$P);
				$this->set('email_sent',true);
				// Lets prepare the data

				$admins = $q->Select('*','Users', array('power_lvl'=>9) );
				foreach($admins as $k => $v){
					$q->Insert('InboxPrivateMessages',array(
						'Date' 			=> date('Y-m-d h-i-s'),
						'Subject' 		=> $P['subject'],
						'message' 		=> "$P[message]
Name: $P[name]
State: $P[state]
Phone: $P[phone]",
						'fromaddress' 	=> $P['email'],
						'user_id'		=> $v['id'],
						'box'			=> 'inbox'
					));
				}


				// Email it
				// Store it in our DB as well.
				// Set a thank you confimation.
			}
		}



		function backDoor(){
			// Create a list of the feedback list
			$q = $this->q();
			$this->set('BODY_VALIGN','top');
			$feedback  = $q->Select('*','feedback',array(
				'replied'=>0
			));

			$feedback = (!empty($feedback)) ? $feedback : array();

			$this->set('feedback',$feedback);

			$this->set('email',$_SESSION['user']['email']);
		}

	}

?>