<?php
/**
 * @name Training
 * @desc Get Quality Assistance from Offical Support.
 * @version v0.12
 * @author cdpollard@gmail.com
 * @icon Traffic cone.png
 * @mini graduation-cap
 * @see support
 * @link supportTraining
 * @release beta
 * @todo
 */

	class xSupportTraining extends Xengine{
		var $trac = array(
			'user'    => 'xtiv' ,
			'pass'    => 'svnpass',
			'url'     => 'trac.xtiv.net/SuperDomX'
		);

		function index(){
			//phpinfo();

			$this->lib('Zend/Loader.php');

			$z = new Zend_Loader();
			$z->loadClass('Zend_Http_Client');
			$z->loadClass('Zend_XmlRpc_Client');
			//$this->lib('Zend/XmlRpc/Client.php');
			$t = $this->trac;

			$client = new Zend_XmlRpc_Client("http://$t[user]:$t[pass]@$t[url]/login/xmlrpc");

			try {
 
				// $client = new Zend_Http_Client("http://$t[user]:$t[pass]@$t[url]/login/xmlrpc");
				// $response = $client->request();

			   //	 $client->call('bar', array($arg1, $arg2));
				$httpClient = $client ->getHttpClient(); 
				$httpClient->setAuth($t['user'], $t['pass'], Zend_Http_Client::AUTH_BASIC);
				$client->setHttpClient($httpClient);

				$trac   = $client->getProxy();
				 
				// echo $trac->getPageHTML('WikiStart');
				$this->dump($client->call('wiki.getAllPages'));
			 
			} catch (Zend_XmlRpc_Client_HttpException $e) {
				 $this->dump($e->getMessage());
			    // $e->getCode() returns 404
			    // $e->getMessage() returns "Not Found"
			 
			}

			
		}

		function FAQ(){

		}

		function specialTicket(){
			
		}

		function suggestionBox(){

		}

		function bugNet(){

		}



	}
?>