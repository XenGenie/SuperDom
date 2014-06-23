
<?php
/**
 * @name Blox
 * @desc Building your Domain blox by blox
 * @version v1.0.11.10.21.18.02
 * @author i@xtiv.net
 * @icon blueprint4.png
 * @mini cubes
 * @see construct
 * @link blox
 * @alpha true
 * @todo
 */

	class xBlox extends Xengine{
		function dbSync(){
			return array(
				'blox' => array(
					'name'      => array('Type'=>'varchar(255)'),
					'describe'  => array('Type'=>'varchar(255)'),
					'enabled'   => array('Type'=>'varchar(255)'),
					'area'      => array('Type'=>'varchar(255)'),
					'weight'    => array('Type'=>'int(2)'),
					'blox_file' => array('Type'=>'varchar(255)'),
					'blox_code' => array('Type'=>'blob'),
					'icon'      => array('Type'=>'varchar(255)')
				),
				'blueprints' => array(
					'blueprint_body'            => array('Type'=>'blob'),
					'blueprint_label'           => array('Type'=>'varchar(100)'),
					'blueprint_architect'       => array('Type'=>'varchar(50)'),
					'blueprint_architect_email' => array('Type'=>'varchar(255)'),
					'blueprint_domain_origin'   => array('Type'=>'varchar(255)')
				)
			);
		}

		 

		/*function autoRun($sDom){
			// Does this need to run - everytime!?
			
			if(!$sDom->AREA51){
				$q = $this->q();
				$q->mBy = array('weight'=>'ASC');
				$blox = $q->Select('*','blox');
				$this->set('blox',$blox);
			}
		}
*/
		/**
		 * create read update delete!
		 * @param $id
		 */
		
		function create($id=0){
			// SQL connection
			$q = $this->q();
			
			$this->set('id',$id);
			
			if(isset($_POST['form'])){
				// Update Existing Record
				if($id){
					//echo $_POST['form']['blox_code'];
					$q->Update('blox',$_POST['form'],array('id'=>$id));
					$this->set('form',$_POST['form']);
					echo $q->error;
				// New Record!	
				}else{	
					$q->Insert('blox',$_POST['form']);
					// header("Location: /@/blox");
				}
			}else{
				$blox_dir = HTML_DIR.'/~blox/';
				$blox = scandir($blox_dir);

				foreach($blox as $k => $v){
					if(!is_dir($blox_dir.$v)){
						$v = str_replace('.html','',$v);
						$blox_files[$v] = $v;
					}
				}

				$this->set('blox_files',$blox_files);

				if($id){
					$edit = $q->Select('*','blox', array('id'=>$id) );
					$this->set('form',$edit[0]);
				}
			}
		}
		
		/**
		 * read blox data
		 */
		function read(){
			$blox_dir = HTML_DIR.'/~blox/';
			$blox = scandir($blox_dir);

			foreach($blox as $k => $v){
				if(!is_dir($blox_dir.$v)){
					$v = str_replace('.html','',$v);
					//$blox_files[$v] = $v;
					
					$blox[$k] = array(
						'id' => $v,
						'name' => ucwords(str_replace('_',' ',$v))
					);
					
				}
			}

			$this->set('data',$blox);
		}
		
		/**
		 * update blox data
		 */
		function update($p){
			//$this->create($p);
		}
		
		/**
		 * delete blox data
		 */
		function delete(){
			
		}
		
		/**
		 * @remotable
		**/
		public function blueprintTree(){
			$q = $this->q();
			$b = $q->Select('*','blueprints');

			foreach ($b as $k => $value) {
				# code...
				$b[$k]['text'] = $b[$k]['blueprint_label'];
				$b[$k]['leaf'] = true;
				$b[$k]['iconCls']  = 'x-icon-16x16-blueprint-0';
			}

			return $b;
		}


		/**
		 * @remotable
		**/
		public function blueprint($CRUD,$A=false)
		{
			$q = $this->q();
  
			switch ($CRUD) {
				case 'create':  
					if($A->id < 1){
						$r = $q->Insert('blueprints',$A);						
					}else{

						$this->blueprint('update',$A);  
					}
				break;
				case 'read':
					if(false == $A){
						$r = $q->Select('*','blueprints');

						foreach ($b as $k => $value) {
							# code...
							$r[$k]['text'] = $b[$k]['blueprint_label'];
							$r[$k]['leaf'] = true;
							$r[$k]['iconCls']  = 'x-icon-16x16-blueprint-0';
						} 
					}else{ 
						$r = $q->Select('*','blueprints',array(
							'id' => $A->id
						));
						$r = $r[0]; 
					}
					
				break;
				case 'update':
					$r = $q->Update('blueprints',(array) $A,array(
						'id'=>$A->id 
					));
				break;
				case 'delete':
					$r = $q->Delete('blueprints',$A);
				break;
				default:
					return false;
				break;
			}
			return array(
				'success' => ($q->error == ''),
				'data'    => $r,
				'error'   => $q->error
			);
		}

		function readProp(){
			
			$this->set('blox','boing');
			
			
			$str = "{ label: 'Property Grid',  grouping: false,  autoFitColumns: true,  productionQuality: true,  created: new Date(),   tested: false,  version: 0.8, borderWidth: 2 }";
			
			$data = json_decode($str);
			 
			
			$this->set('data',$str);
			
		}
		
		function index(){
			$q = $this->q();
			$q->mBy = array('weight'=>'ASC');
			return array(
				'xBlox' => $q->Select('*','blox')
			);
		}
		function blue(){
			$this->dandd();	
		}
		function dandd(){
			$q = $this->q();
			$q->mBy = array('weight'=>'ASC');
			$this->set('xBlox',$q->Select('*','blox'));
		}
		
		 
		function stylibs(){
			// This organizes both a js batch file and css...
			
			
			
			
		}
		
		function updateOrder($area){
			$blox = $_GET['blox'];

			$q = $this->q();
			function updateBlox($q,$id,$area,$weight=0,$enabled=true){
				$q->Update('blox',array(
					'area' 		=> $area,
					'enabled'	=> ($enabled) ? 1 : 0,
					'weight'	=> $weight
				), array('id'=>$id));

			}

			switch($area){
				default:
					if(is_array($blox)){
						$i = 0;
						foreach($blox as $k => $v){
							updateBlox($q,$v,$area,$i);
							$i++;
						}
					}else{
						updateBlox($q,$blox,$area,0);
					}
				break;
				case('disabled'):
					if(is_array($blox)){
						$i = 0 ;
						foreach($blox as $k => $v){
							updateBlox($q,$v,'disabled',$i,false);
						}
					}else{
						updateBlox($q,$blox,'disabled',0,false);
					}
				break;
			}
			echo "Order Saved @ ".date('h:i:s a');
			die();
		}

		public function jumbotron($value='')
		{
			
		}

		public function topX($value='')
		{
			
		}
	}

?>