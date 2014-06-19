<?php
/**
 * @name Support Ticket
 * @desc Communicator to  the Ticketing System for SuperDomX. 
 * @version v0.12
 * @author cdpollard@gmail.com
 * @icon tickets.png
 * @mini money
 * @see support
 * @link supportTicket
 * @release beta
 * @todo
 */

	class xSupportTicket extends Xengine{
		
		var $_RPC = array(
			'user'    => 'xtiv' ,
			'pass'    => 'svnpass',
			'www'     => 'trac.xtiv.net/SuperDomX/login/xmlrpc'
		);

		public function index($call=null)
		{

		}
		public function rpc($call=null)
		{
			/*
				@TODO: We could check for permissions to send back, 
				then allow the JS to render admin tools. 
				SERVER SIDE auth still happens, so the client could hack the js to 
				render the tool, but they would be useless 
				as so long as their permissions don't allow it.
			*/

			if($call)
				return $this->tracRPC($call);
			else
				return array();
		}

		public function tracRPC($call,$p=false){
			$client = $this->initRPC();

			try {
				$this->_SET['params'] = array_values($this->_SET['params']);

				if($call == $this->_SET['params'][0]){
					unset($this->_SET['params'][0]);
				}
 
				// $this->dump($client);

				$data = (false != $p) ? $client->call($call,$this->_SET['params']) : $client->call($call);
				
				if(is_array($data)){
					$return = [];
					foreach ($data as $key => $value) {
						# code...
						$return[$key] = array(
							'id'    => $key,
							'value' => $value 
						);
					}
				}else {
					$return = $data;
				}

				return array(
					'success' => true, 
					'data'    => $return,
					'msg'	  => 'Success'
				);
			} catch (Zend_XmlRpc_Client_HttpException $e) {

				 $error = error_get_last();
				 $file = realpath($_SERVER['DOCUMENT_ROOT']);
				 $file = str_replace($file , '', $error['file']);

				 $e = array(
					'summary'     => FriendlyErrorType($error['type'])
						.' :: '.$error['message'].' :: '.$file.'#L'.$error['line'], 
					'description' => $error['message'].' :: '.'[source:trunk'.$file.'#L'.$error['line'].']
',
					'attr' => array(
						'type'      => 'defect',
						//'component' => 'x'.ucfirst($this->_SET['action']),
						'priority'  => 'trivial',
						'reporter'  => $_SESSION['user']['username'].'@'.$_SERVER['HTTP_HOST'],
						'keywords'  =>  $this->_SET['action'].'::'. $this->_SET['method']
					)
				);

				$this->reportSystemError($e);	
				//$this->dump($e->getMessage()); 
			 
			}
		} 

		public function tracRPCwParams($call,$params)
		{
			$client = $this->initRPC();
			return  $client->call($call,$params);
		}
		
		/**
		 * @remotable
		 * @formHandler
		 * @remoteName
		 */
		public function createSupportTicket($form)
		{
			return array(
				'success' => $this->tracRPCwParams('ticket.create',array(
					'summary'     => $form['ticket']['summary'], 
					'description' => $form['ticket']['description'],
					$form['ticket']['attr'],true
				))
			);
		}

		/**
		 * @remotable
		 * @remoteName
		 */
		function treeStore($id=0){
			$client = $this->initRPC();

			$milestones	 = $client->call('ticket.milestone.getAll');
			// $this->dump($id);

			$tree = [];

			if($id != 'root'){
				$tree = $client->call('ticket.query','milestone='.$milestones[$id-1]);
				 
				$multitracRPC = [];
				foreach ($tree as $key => $value) {
					$multitracRPC[$key] = array(
						'methodName' => 'ticket.get',
						'params'     => array($value)
					);
				}

				$ticket = $client->call('system.multicall',array($multitracRPC));

				$tree = [];
				foreach ($ticket as $key => $value) {
					$tree[$key] = array(
						'id'   => 'ticket-'.$value[0][0],
						'text' => $value[0][3]['summary'],
						'leaf' => true
					);
				}


			}else{
				foreach ($milestones as $key => $value) {
					$tree[$key] = array(
						'id'   => 1+$key,
						'text' => $value,
						'leaf' => false
					);
				}	
			} 
			return $tree;
		}

		private function get_arg(&$arg) {
			if (is_object($arg)) {
			    $arr = (array)$arg;
			    $args = array();
			    foreach($arr as $key => $value) {
			        if (strpos($key, chr(0)) !== false) {
			            $key = '';    // Private variable found
			        }
			        $args[] =  '['.$key.'] => '.get_arg($value);
			    }

			    $arg = get_class($arg) . ' Object ('.implode(',', $args).')';
			}
		}

		private function get_debug_print_backtrace($traces_to_ignore = 1,$x){
			    $traces = debug_backtrace();
			    $ret = array(); 
			    foreach($traces as $i => $call){
			        if ($i < $traces_to_ignore ) {
			            continue;
			        } 

			        $object = '';
			        if (isset($call['class'])) {
			            $object = $call['class'].$call['type'];
			            if (is_array($call['args'])) {
			                foreach ($call['args'] as &$arg) {
			                    $this->get_arg($arg);
			                }
			            }
			        }       

			        $file = (isset($call['file'])) ? str_replace(str_replace($x, '', dirname(__FILE__)), '/browser/trunk/', $call['file']) : '';

			        $file = ($file) ? ($file == '') ? '':'called @:
      * ['.$file.'#L'.$call['line'].']' : '';


			        	$args = null;
			        //$this->dump($call['args'][1]);
			   //      if(!empty($call['args'])){
						// $args = implode(', ', $call['args']);
						// echo '<pre>';
						// var_dump($call['args']);
			   //      }
			        

			        $ret[] = '    * ' // #'.str_pad($i - $traces_to_ignore, 3, ' ')
			        .$object
			        .$call['function']
			        .'('.$args.')'
			        .$file;
			    }
			  
			    return implode("\n",$ret);
			}

			/*
			Accepts an Array of reportable Data. 
		*/
		public function reportSystemError($ER)
		{
			// Look up to see if any errors match this one... already  error logged.
			// Most of these errors should be of the same name and origin	 
			$client = $this->initRPC();

			$multitracRPC[0] = array(
				// We may have already logged this Bug. 
				'methodName' => 'ticket.query',
				'params'     => array( "summary=".trim($ER['summary']) )
			);

			$multitracRPC[1] = array(
				// We may have already solved this Bug. 
				'methodName' => 'ticket.query',
				'params'     => array( "status=closed&summary=".trim($ER['summary']) )
			);			

// 			$bug    = $client->call('system.multicall',array($multitracRPC));  
// 			$new    = (empty($bug[0][0]) && empty($bug[1][0]));
// 			$closed = (!empty($bug[0][0]) && !empty($bug[1][0])); 

			 // ." 

			$ER['description'] .= '=== '.$ER['summary'].' ===
'; // ".$this->get_debug_print_backtrace(0,$this->_CFG['dir']['Xtra'])
			
			$ER['description'] .= '
{{{
#!NewsFlash 
>>' . date('l jS \of F Y h:i:s A').'
';
			foreach ($this->_debugReport as $key => $value) {
				$ER['description'] .= $value.'

';
			}

			$ER['description'] .= $this->lang($this->_LANG['TRAC']['BUG_REPORT'],$_SERVER).'
}}}
';
			$ER['attr'] = array(
				'type'      => 'defect',
				//'component' => 'x'.ucfirst($this->_SET['action']),
				'priority'  => 'trivial',
				'milestone' => 'Bee Hive',
				'reporter'  => $_SESSION['user']['username'].'@'.$_SERVER['HTTP_HOST'],
				//'milestone'  => 'Future',
				'keywords'  =>  $this->_SET['action'].'::'. $this->_SET['method']
			);

			// We already have that bug...
			if($new){
				// New Ticket 
				return $client->call('ticket.create',array(
					'summary'     => $ER['summary'], 
					'description' => $ER['description'], 
					$ER['attr'],true
				)); 
			}else if($closed) {
			// We only want to update the bug if we though we had solved it before, 
			// so in other words, REOPEN  
				$ER['attr']['action'] = 'reopen';
				$ER['attr']['status'] = 'reopen'; 
				// $ER['attr']['_ts'] = microtime(); 

				return $client->call('ticket.update',array(
					$bug[1][0][0], 
					$ER['description'],
					$ER['attr'],true
				));
			}
			ob_clean();
		}
	}
?>