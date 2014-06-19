<?php
/**
 * @name ToDo List
 * @desc Synchornize your Task-Lists Amongst your self and other Website Admins.
 * @version  v1.11.10.25.13.48
 * @author Xengine
 * @icon to-do-list.png
 * @mini square-o
 * @see domain
 * @link toDo
 * @todo
 */

	class xToDo extends Xengine{

		function dbSync(){ 
			return array(
				'ToDos' => array(
					'to_do' 		=> array('Type'=>'varchar(100)'),
					'describe' 		=> array('Type'=>'blob'),
					'date_added' 	=> array('Type'=>'int(16)'),
					'date_due' 		=> array('Type'=>'date'),
					'date_done' 	=> array('Type'=>'int(16)','Default'=>'0'),
					'assigned_by_id'=> array('Type'=>'int(8)'),
					'assigned_by'	=> array('Type'=>'varchar(25)'),
					'assigned_to_id'=> array('Type'=>'int(8)','Default'=>'-1'),
					'assigned_to'	=> array('Type'=>'varchar(100)'),
					'completed_by_id'=> array('Type'=>'int(8)'),
					'web_url'		=> array('Type'=>'varchar(255)'),
					'priority'		=> array('Type'=>'int(3)')
				)
			);
		}

		function clipboard(){}
		
		function autoRun($X){  
		
			if($X->Key['is']['admin']){ 

				$q = $X->q(); 
				// $q->mBy = array('priority'=>'ASC','date_added'=>'DESC');
				
				$todos = $q->Select('*','ToDos');
 				// $this->dump($todos); 
				return array(
					'to_dos'     => ($todos > 0) ? $todos : '',
					'COUNT_TODO' => count($todos)
				);

			}
		}

		function create(){
			$q = $this->q();

			if($_POST['to_do']){
				$q->Insert('ToDos',array(
					'to_do' 		=> $_POST['to_do'],
					'date_added'	=> time(),
					'date_due'		=> $_POST['date_due'],
					'assigned_to'	=> $_POST['assigned_to'],
					'assigned_by_id'=> $_SESSION['user']['id'],
					'assigned_by'	=> $_SESSION['user']['username']
				));
				$this->set('ERROR',$q->error);
				// Email everyone?
			}

			$q->mBy = array('priority'=>'ASC','date_added'=>'DESC');
			 
			
			return array(
				'to_dos' => $q->Select('*','ToDos',array(
					'date_done'	=> ''
				))
			);
		}

		function markDone(){
			$q = $this->q();
			if($_POST['id']){
				$q->Update('ToDos',array(
					'date_done'			=> time(),
					'completed_by_id'	=> $_SESSION['user']['id']
				),array(
					'id' => $_POST['id']
				));

				$task = $q->Select('*','ToDos',array(
					'id' => $_POST['id']
				));

				$task = $task[0];

				if(!empty($task) && $task['assigned_to_id'] != $task['assigned_by_id']){

					// Send report to
					$user = $q->Select('email,name,username','Users',array(
						'id'	=> $task['assigned_by_id']
					));
					$user = $user[0];

					$due = ($task['date_due']) ? $task['date_due'] : 'N/A';
					$address = $user['email'];
					$subject = "DONE: $task[to_do]";
					$message = "Assigned By: $user[name] $user[username],
	".$_SESSION['user']['username']." has completed the following Task: \"$task[to_do]\"

	$task[describe]

	Goal Date: $due
	-----------
	~ ToDoBot @ http://$_SERVER[HTTP_HOST]/@/toDo/details/$task[id]?html
	";
					mail($address, $subject, $message , "From: ToDoBot@$_SERVER[HTTP_HOST]");
				}



			}

			$this->set('markedDone' ,$_POST['id']);
		}

		function updateOrder(){
			$blox = $_GET['task'];
			$q = $this->q();
			function updateTask($q,$id,$weight=0){
				$q->Update('ToDos',array(
					'priority'	=> $weight
				), array('id'=>$id));
			}

			if(is_array($blox)){
				$i = 0;
				foreach($blox as $k => $v){
					updateTask($q,$v,$i);
					$i++;
				}
			}else{
				updateTask($q,$blox,0);
			}
			exit;
		}

		function getAdmins(){
			$admins = $this->q()->Select('username,id','Users',array(
				'power_lvl'=>9
			));

			$admins[] = array(
				'id' 		=> '-1',
				'username'	=> '----------'
			);

			$admins[] = array(
				'id' 		=> '-1',
				'username'	=> 'No One'
			);


			$admins[] = array(
				'id' 		=> 0,
				'username'	=> 'Everyone'
			);

			$this->set('admins',$admins);
			return $admins;
		}

		function assignTask(){

			$q = $this->q();
			if(isset($_POST['id']) && isset($_POST['user'])){
				$id 	= $_POST['id'];
				$user 	= $_POST['user'];
				$date 	= $_POST['date_due'];

				$data['assigned']	= false;

				if($user){
					$assigned = $q->Select('id, to_do','ToDos',array(
						'assigned_to_id'	=> $user,
						'id'			=> $id
					));

					if(!empty($assigned)){
						$data['assigned']	= $assigned;
					}
				}

				$q->Update('ToDos',array(
					'assigned_to_id'	=> $user,
					'date_due'			=> $date
				),array(
					'id'			=> $id
				));


				$this->set('data',$data);
			}
		}

		function sendReminder(){
			$q = $this->q();
			if(isset($_POST['id']) && isset($_POST['user'])){
				$id 	= $_POST['id'];
				$user 	= $_POST['user'];

				$where = ($user) ? array('id' => $user) : null;

				$where['power_lvl'] = 0;


				$user = $q->Select('email,name,username','Users',$where);

				$task = $q->Select('*','ToDos',array(
					'id' => $id
				));
				$task = $task[0];

				foreach($user as $k => $v){
					$this->sendTask($v,$task);
				}
			}
		}

		function sendTask($user,$task){
			$due = ($task['date_due']) ? $task['date_due'] : 'N/A';
			$address = $user['email'];
			$subject = "TODO: $task[to_do]";
			$message = "Hello $user[name] ($user[username]),
You have been assigned a Task: \"$task[to_do]\"

$task[describe]

Goal Date: $due
-----------
~ ToDoBot @ http://$_SERVER[HTTP_HOST]/@/toDo/details/$task[id]
";
			mail($address, $subject, $message , "From: ToDo@$_SERVER[HTTP_HOST]");
		}

		function index(){
			if(!isset($this->_SET['to_dos'])){
				$this->autoRun($this);
			}
		}
		
		function todos(){
			$this->index();
		}

		function details($id){
			$todo = $this->q()->Select('*','ToDos', array( 'id'=>$id ));
			$this->set('todo',$todo[0]);
			$mins = $this->getAdmins();
			foreach ($mins as $k => $v){
				$admins[$v['id']] = $v['username'];
			}
			$this->set('admins',$admins);
		}

		function saveDetails(){
			if(isset($_POST['form'])){
				$q = $this->q();
				$form = $_POST['form'];
				$old = $q->Select('to_do,assigned_to_id','ToDos',array(
					'id'=>$form['id']
				));
				$q->Update('ToDos',$form,array('id'=>$form['id']));
				$data['data'] = array(
					'to_do_id' 			=> $form['id'],
					'old_to_do' 		=> $old[0]['to_do'],
					'new_to_do' 		=> $form['to_do'],
					'assigned_to_id'	=> $form['assigned_to_id'],
					'old_assigned_to_id'=> $old[0]['assigned_to_id'],
				);
				$this->out($data);
			}
		}

		function deleteTask(){
			if(isset($_POST['id'])){
				$this->q()->Delete('ToDos',
					array('id'=>$_POST['id'])
				);
			}
		}
	}

?>