<?php
/**
 * @author dev@domain.com
 * @name New Xtra
 * @desc A one liner that tells everyone about what this xtra can do!
 * @version v1(11.11.01@03:03)
 * @icon newxtra.png svg!
 * @link newXtra/customindex
 * @see domain
 * @todo
 * @mini newextra.png
 */
class xTra extends Xengine {
	function customindex($urlparam1, $urlparam2, $etc){
		// Also available through $this->Q;		
		$q = $this->q();

		// Example of Hard-Coded Admin or User Only privledges.
		$k = $this->Key['is']; 	
		if( true === $k['admin'] || true === $k['user'] ){
			$table = (true !== $k['admin']) ? 'users' : 'admins';
			$r = array(
			'data' 	=> $q->Select('portal', $table ,array(
				'id' => $_SESSION['user']['id']
			)),		
			'success' => (!$q->error) ? true : false,
			'error'	  => (!$q->error) ? null : $this->Q->error
			); 

			

		} else {		
			$r = array(
				// 'data' => null,		
				'success' => false,
				'error'	  => 'Not Logged In',
				'action'  => 'login',
				//'method'  => 'login' 
			);
		}
		
		return $r;
	}
}
?>
