
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
				),
				//
				'blox_quest' 	=> array(
					'quest' 	=> array('Type'=>'varchar(255)'),
					'blox'		=> array('Type'=>'varchar(50)'),
					'params'	=> array('Type'=>'blob'), 
					'online'	=> array('Type'=>'boolean','Default'=>true)
				)

			);
		}



		/**
		 	@name qBlox
		 	@desc Parses all the extras to look for which functions act as a blox.		 	
		**/

		public function qBlox($cat=null,$class=null,$method=null)
		{

			 
			// WE need all the xtras 
			$xtras = $this->getXtras();


			$blox = array();

			// lets check to see which ones have comment functions.
			// to make the function into a blox; add the @blox variable & use the lang variable in your lang file.
			// ex: @blox my1stblox
			//

			// Toy Blox 1 - Static Blox

			// if the @blox comment is set; add it to the default blox set.
 		
 			// exit;
			foreach ($xtras as $x => $b) {

				if( ($cat == null || $b['see'] == $cat)  ){
					$rClass = new ReflectionClass($b['class']); 
					
					if ( $class != null && $class != $rClass->name )  
						continue;

					$rMethods = $rClass->getMethods();
	                foreach($rMethods as $rMethod) {
	                    $doc = $rMethod->getDocComment();
	                    if($doc){

	                    	$data =  trim(preg_replace('/\r?\n *\* */', ' ', $doc));
	                    	$data =  trim(preg_replace('/\t?\t *\* *\* *\/* */', '', $doc));

							preg_match_all('/@([a-z]+)\s+(.*?)\s*(?=$|@[a-z]+\s)/s', $data, $matches);
							$info = array_combine($matches[1], $matches[2]);

							if( isset($info['blox']) && ($method == null || $method == $info['name'] ) ){
								$blox[$rClass->name][$info['name']]= $info;
							}

							  
	              		}
	                }
				}
					
				

				

                

               

			}
 
			$this->set('blox',$blox );

			return $blox; 
			// Toy Blox 2 - Custom Blox
			// These blox are stored in the database and mainly consist of custom html, js, and css code.





			// Toy Blox 3 - neXus Door Blox

			// Toy Blox 4  - These Blox are an array of other blox togeth 



			# code...
		}


		function autoRun($sDom){
			// Does this need to run - everytime!?
			
			// if(!$sDom->AREA51){
			// 	$q = $this->q();
			// 	$q->mBy = array('weight'=>'ASC');
			// 	$blox = $q->Select('*','blox');
			// 	$this->set('blox',$blox);
			// }

			if($sDom->Key['is']['admin']){

				$quest = strtolower(str_replace('%20', '-', $_SERVER['REQUEST_URI']));


				$q = $this->q();

				

				$qBlox = $this->qBlox();

$blox 	= $q->Select('*','blox_quest',array(
					'quest' => $quest.'*'
				));

				foreach ($blox as $r => $c) {
					$t = explode('-', $c['blox']);
					$rBlox[$t[0]][$t[1]] = $qBlox[$t[0]][$t[1]];
					$rBlox[$t[0]][$t[1]]['id'] = $c['id'];
				}

$blox 	= $q->Select('*','blox_quest',array(
					'quest' => $quest
				));

				foreach ($blox as $r => $c) {
					$t = explode('-', $c['blox']);
					$rBlox[$t[0]][$t[1]] = $qBlox[$t[0]][$t[1]];
					$rBlox[$t[0]][$t[1]]['id'] = $c['id'];
				}

				

// 				 var_dump($rBlox);
// exit;
				// $qBlox  = $this->qBlox() ;

				$this->set('qBlox', $this->qBlox() );
				$this->set('blox', $rBlox );
			}

			if(isset($_POST['bloxSwitch'])){
				return $this->bloxSwitch($_POST['bloxSwitch']);
			}

		}

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
		/**

		**/

		public function bloxDelete($id)
		{
			if($this->Key['is']['admin']){
				return array(
					'success' => $this->q()->Delete('blox_quest',array(
						'id' => $id
					))
				);
			}
		}

		public function bloxStar($id, $quest)
		{
			if($this->Key['is']['admin']){
				 
				return array(
					'success' => $this->q()->Update('blox_quest',array(
						'quest' => ($quest == '/') ? $quest.'*' : $quest.'/*'
					),array(
						'id' => $id
					))
				);
			}
		}

		public function bloxSwitch($blox)
		{
			if($blox['online'] == 'star'){
				$blox['online'] = 1;
				$id = $this->bloxSwitch($blox);
				$this->bloxStar($id['id'],$blox['quest']); 
			}

			# Admins Only...
			if($this->Key['is']['admin']){
				$q = $this->q();
				
				// Get the Navi Request
				$isLink = $q->Select('linktothe','navi_heylisten',array(
					'quest' => $blox['quest']
				));



				if(empty($isLink)){
					$q->Insert('navi_heylisten',array(
						'quest' 	=> $blox['quest'],
						'linktothe' => 'blox'
					));
				} 

				$blox['online'] = ($blox['online'] == 'true' )? true : false;


				$findQuest = $q->Select('id','blox_quest',array(
					'quest' => $blox['quest'],
					'blox' 	=> $blox['blox']
				));

				if(empty($findQuest)){ 
					$id = $q->Insert('blox_quest',$blox);

				}else{

					$q->Update('blox_quest',$blox,$findQuest[0]);
					$id = intval($findQuest[0]['id']);
				}


				return array(
					'success' => true,
					'id' =>  $id, 
				);
			}
		}

		/**
			@name portal
			@blox Portal
			@icon ge fa-spin 
			@desc Pull another page as a blox.
			
		**/
		public function portal()
		{
			# code...
		}

		/**
			@name custom
			@blox jsFiddle
			@desc Easily Import a JS file Link into Your Website!
			@icon jsfiddle
		**/
		public function custom()
		{

			return array(
				'jsfiddle' => file_get_contents('http://jsfiddle.net/3njag/2/show/')
			);
			# code...
		}

		/**
			@name html
			@blox HTML
			@desc Simple Easy to use Custom Code Blox
			@icon html5
		**/
		public function html()
		{
			# code...cus
		}

		/**
			@name css3
			@blox CSS
			@desc Simple Easy to use Custom Code Blox
			@icon css3
		**/
		public function css3()
		{
			# code...
		}

		/**
			@name javascript
			@blox Javascript
			@desc Simple Easy to use Custom Code Blox
			@icon code
		**/
		public function javascript()
		{
			# code...
		}

	}

?>