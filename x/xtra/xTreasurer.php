<?php
/**
 * @name Treasurer
 * @desc Control how $$ is collected
 * @version v0.124
 * @author XTiv
 * @icon cash_register.png
 * @mini credit-card
 * @see market
 * @link treasurer/paypal
 * @todo
 * @formHandler
 */
	class xTreasurer extends Xengine{
		/**
		 * @remotable
		 */
		function loadPaypal(){
			$CFG = $this->readConfigs();

			return array(
				'success' => true,
				'data' => array(
					'PAYPAL_EMAIL' => $CFG['PAYPAL_EMAIL']
				)
			);
		}

		/**
		 * @remotable
		 * @formHandler
		 */
		function submit($f){

			$this->setConfig('PAYPAL_EMAIL',$f['PAYPAL_EMAIL']);
			return array(
				'success' => true,
				'data'	=> $f,
				'errors' => $errors
			);
		}

		function paypal(){
			if($this->IS_ADMIN){



			}
		}
	}
?>