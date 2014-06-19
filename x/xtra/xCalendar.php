<?php 
/**
 * @name Calendar 
 * @desc A calendar that tracks everything
 * @version v1.0.11.04.04.612
 * @author XTiv
 * @icon Calender Month.png
 * @mini calendar
 * @price $20
 * @see cronos
 * @link calendar
 * @todo
 * @beta true
 */

	
	class xCalendar extends Xengine{
		
		function getEvents(){
			$this->set('evts',$this->q()->Select('*','CalendarEvents',array(
				'user_id' =>  $_SESSION['user']['id']
			)));
		}

		public function index($value='')
		{
			# code...
		}
		
		function event($action){
			$q = $this->q();
			$user_id = $_SESSION['user']['id'];
			$rec = $_POST['rec'];
			switch($action){
				case('add'):
					$rec['user_id'] = $user_id; 
					$q->Insert('CalendarEvents',$rec);
				break;
				case('update'):
					$q->Update('CalendarEvents',$rec,array(
						'id' => $rec['id']
					));
				break;
				case('delete'):
					$q->Delete('CalendarEvents',$rec,array(
						'id' => $rec['id']
					));
				break;
			}
		}
	}


?>