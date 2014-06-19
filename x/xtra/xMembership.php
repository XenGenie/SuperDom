<?php
/**
 * @name Memberships
 * @desc Create Free and/or Paid Membership Permissions
 * @version v1.11.02.21.05.16
 * @author cdpollard@gmail.com
 * @price $50
 * @icon Ticket.png
 * @mini plane
 * @link membership
 * @see market
 * @todo
 */

	class xMembership extends Xengine{
		function dbSync(){
			// return array(
			// 	'Memberships' => array(

			// 	)
			// );
		}

		function index(){
			$this->set('memberships',$this->q()->Select('*','Memberships'));
		}

		function add(){
			if(isset($_POST)){
				unset($_POST['id']);
				$this->q()->Insert('Memberships',$_POST);
				$this->set('success',true)	;
			}
		}

		function subscribe(){

		}

		function load($id){
			$fields = $this->q()->Select('*','Memberships',array('id'=>$id));
			$this->out(array(
				'success' => true,
				'data' => $fields
			));
			exit;
		}

		function remove($id){
			$this->q()->Delete('Memberships',array(
				'id'=>$id
			));
			header("Location: /".APP_LOC."/membership");
		}

		function setPermit($id){
			$xtends = $this->getXTends();
			$run = new xAccess();
			$run->setPermit($id);
			$this->_SET = $run->_SET;
		}

		function setPerm($id){
			$xtends = $this->getXTends();
			$run = new xAccess();
			$run->setPerm($id);
			$this->_SET = $run->_SET;
		}

		function permit($id){
			$xtends = $this->getXTends();
			$run = new xAccess();
			$run->getDoors($id);
			$this->_SET = $run->_SET;
		}

	}

?>