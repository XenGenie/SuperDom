<?php
/**
 * @name Titan
 * @desc The Indepth Track-A-Nerd
 * @version v0.124
 * @author cdpollard@gmail.com
 * @price $100
 * @icon Network radar.png
 * @mini share-alt
 * @see radius
 * @link titan
 * @todo
 */

	class xTitan extends Xengine{

		function dbSync(){
			return array(
				'Timers'	=> array(
					'uuid' 			=> array('Type'=>'varchar(30)'),
					'name'			=> array('Type'=>'varchar(255)'),
					'totaltime' 	=> array('Type'=>'int(16)')
				)
			);
		}

		function createTimer(){
			$uuid = $_POST['uuid'];
			$q = $this->q();

			$timer_id = $q->Insert('Timers',array(
				'uuid' => $_GET['uuid'],
				'name' => $_GET['name'],
			));

			$this->set('timer_id', $timer_id);
			$this->set('success', true);
		}

		function listTimers(){
			$q = $this->q();

			$q->mBy = array('id'=>'desc');

			$timer = $q->Select('*','Timers',array(
				'uuid' => $_GET['uuid']
			));

			$this->set('sql',$q->mSql);

			$this->set('data',array('timer'=>$timer));
		}

		function editTimer(){

		}
	}

?>