<?php
/**
 * @name SiteMap
 * @desc Control the Quick Nav, Main Menu, and Site Map of your website.
 * @version v1.0.1
 * @author i@xtiv.net
 * @icon Sign direction.png
 * @mini sitemap
 * @link navigation
 * @see navigate
 * @todo
 * @beta
 */

	class xNavigation extends Xengine{
		function dbSync(){
			return array(
				'public_shortcuts' => array(
					'text'		=>	'title',
					'title'		=>	array('Type' => 'varchar(255)'),
					'description'=>	array('Type' => 'varchar(255)'),
					'link'		=>	array('Type' => 'varchar(255)'),
					'icon'		=>	array('Type' => 'varchar(255)'),
					'weight'	=>	array('Type' => 'int(1)')
				),
				'admin_shortcuts'	=> array(
					'text'        =>	'title',
					'title'       =>	array('Type' => 'varchar(255)'),
					'description' =>	array('Type' => 'varchar(255)'),
					'link'        =>	array('Type' => 'varchar(255)'),
					'icon'        =>	array('Type' => 'varchar(255)'),
					'weight'      =>	array('Type'=>'int(2)'),
					'user_id'     =>  array('Type'=>'int(8)'),
					'toolbar'     => 	array('Type'=>'int(1)'),
					'top'         =>  array('Type'=>'int(4)'),
					'left'        =>  array('Type'=>'int(4)')
				),
				'public_main_menu' =>array(
					'text'    =>	'title',
					'title'   =>	array('Type' => 'varchar(255)'),
					'checked' =>	array('Type' => 'boolean','Default'=>1),
					
					'iconCls' =>	array('Type' => 'varchar(255)'),
					'link'    =>	array('Type' => 'varchar(255)'),
					'parent'  =>  	array('Type' => 'int(5)'),
					'href'    =>	array('Type' => 'varchar(255)'),
					'weight'  =>	array('Type'=>'int(1)')
				),
				'navigation' => array( 
					'title'		=>	array('Type' => 'varchar(255)'),
					'parent'	=>	array('Type' => 'int(3)'), 
					'icon'		=>	array('Type' => 'varchar(255)'),
					'img'		=>	array('Type' => 'varchar(255)'),
					'weight'	=>	array('Type' => 'int(2)'),
					'active'	=>  array('Type' => 'int(1)','Default'=>'0')
				),
				'navi_heylisten' => array( 
					'quest' 	  		=>	array('Type' => 'varchar(255)'),
					'linktothe'        	=>	array('Type' => 'varchar(25)'), 
					'online'        	=>	array('Type' => 'boolean') 
				)
			);
		}


		 

		/**
			@name navbar
			@blox Navigation
			@desc Every page needs a navigator to help others know where to go.
			@icon space-shuttle
		**/
		public function navbar()
		{
			# code...
		}

		/**
			@name breadcrumb
			@blox Breadcrumbs
			@desc This blox breaks down the navigation making a trail home.
			@icon road
		**/
		public function breadcrumb()
		{
			# code...
		}

		function __construct($c){
			parent::__construct($c);
			// Recycle sql connection
			
		}
		/**
		 * autoRun functions run with webpage loads.
		 */
		function autoRun($X){
			//$this->set('shortcuts',$this->getShortcuts());
			//$this->set('admin_menu',$this->mkAdminMenu());

			//$this->set('MENU_MAIN',$this->getPrimaryMenu());
			//$this->set('MENU_SITE',$this->getSiteMap());

			if($X->atBackDoor && $X->Key['is']['content'] === 'html'){ 
				
				$axis_icons = $this->getAxis();
				$this->getXtras();

				$admin_menu = $this->mkAdminMenu(); 

				$top_ten = [];	
				if($X->atSideDoor == false){ 
					$top_ten = $X->q()->Q("SELECT 
						request_call  as link,
						count(user_id) as count 
					FROM ".$X->q()->PREFIX."page_visits
					WHERE user_id = '1' 
					GROUP BY request_call
					ORDER BY count desc");  
					
// 					$top_ten = $X->q()->Select("
// 						request_call as link,
// 						count(user_id) as count
// 						",
// 						"page_visits",
// 						"user_id = 1 GROUP BY request_call ORDER BY count desc"
// 					);
					//$top_ten = null;

					$xtras = $X->getXtras(); 
					// Glue the results with the Icons.
					if(!empty($top_ten)){
						foreach ($top_ten as $k => $v) {
							$php = 'x'.ucfirst($v['link'].'.php');
						
							if(isset($xtras[$php])){
								$top_ten[$k]['mini'] = $xtras[$php]['mini'];
								$top_ten[$k]['name'] = $xtras[$php]['name'];
								$top_ten[$k]['desc'] = $xtras[$php]['desc'];
								$top_ten[$k]['link'] = $xtras[$php]['link'];
							}
						
							if(empty($top_ten[$k]['mini'])){
								unset($top_ten[$k]);
							}
						}
						
						$top_ten = array_values($top_ten);
						// Trim to 10.
						foreach ($top_ten as $key => $value) {
							if($key >= 10){
								unset($top_ten[$key]);
							}
						}
					}
						
				}  

				// If there are no Icons no the Desktop. Show the 'tutorial page.'

				// @TODO: Update this so that it goes to where it should...
				// if(empty($axis_icons) && $X->_SET['action'] == 'index'){
				// 	return array(
				// 		'action' => 'wwwSetup',
				// 		'method' => 'worldmap',
				// 		'tutor' => true,
				// 		'top_ten'    => $top_ten,
				// 		'axis_bar'   => $this->getAxis(1),
				// 		'admin_menu' => $admin_menu
				// 	);
				// }

				return array(
					'tutor'      => empty($axis_icons),
					'admin_menu' => $admin_menu,
					'top_ten'    => $top_ten,
					'axis_bar'   => $this->getAxis(1)
				);
			} else {


				// $uri   = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']); 
				// $path  = str_replace($uri , '', $_SERVER['REQUEST_URI']);
				// $path  = str_replace('%20', ' ', $path);

				$quest = parse_url($_SERVER['REQUEST_URI']);
				$quest['paths'] = explode('/', str_replace('%20', ' ', $quest['path']) );
				$this->set('quest', $quest) ;


				// var_dump($quest);
				// exit();

				$quest = strtolower(str_replace('%20', '-', $quest['path']));

				$link = $X->q()->Select("*","navi_heylisten", array(
					'quest' => $quest
				));

				if(!empty($link)){
					$this->Key['heylisten'] = $link[0];

					switch ($link[0]['linktothe']) {
						case 'blox':
							$b = $X->q()->Select('*','blox_quest',array(
								'quest' => $quest,
								'online' => 1
							));
							$this->set('oBlox',$b); 
						# code...
						break;
						
						default:
						# code...
						break;	
					} 
				}

				return $this->manaTree();
			}
			
		}

		/**
		 * @remotable
		 */
		function getAxis($toolbar = '0'){
			if(false === $this->Key['is']['user'])
				return array();
			
			$q = $this->q();


			$q->mBy = array('weight'=>'ASC');


			return $q->Select('*','admin_shortcuts',array(
				'user_id'             => $_SESSION['user']['id'],
				'COALESCE(toolbar,0)' => $toolbar
			));
		}

		/**
		 * @remotable
		 */
		function updateIconCords($id,$x,$y){
			$q = $this->q();
			return array(
				'success' => $q->Update('admin_shortcuts',array(
						'top'	=> $y,
						'left'	=> $x
				), array('id'=>$id))
			); 
		}

		/**
		 * @remotable
		 */
		function updateIconOrder($icons){ 
			$i = 1;
			$q = $this->q();
			foreach($icons as $k => $v){

				if($v != 'dummy-drop-cut' && $v != 'trash-bin' && $v != 'key-axis' && $v != 'www-map' ){
					$v = str_replace('-', '/', $v);

					$q->Update('admin_shortcuts',array(
						'weight'	=> $i
					), array('link'=>$v));
					$i++;
				} 
			}
		}

		function mkAdminMenu(){ 
			$area = $this->_LANG['ADMIN']['AREAS'];

			// Prepare our array
			foreach ($area as $key => $value) {
				$area[$key] = [];
			}

			// Uses the structure from the lang to organize default areas...
			foreach($this->_xtras as $k => $v){
				$area[$v['see']][] = $v;
			}  

			// Give the Area a Label
			foreach ($area as $key => $value) {
				$area[$key]['area'] = $this->_LANG['ADMIN']['AREAS'][$key];
				$area[$key]['desc'] = $this->_LANG['ADMIN']['DESC'][$key];
			}


			return $area;
		}

		function save($id=0){
			if($_POST['form']['id'] || $id){
				$id = ($id) ? $id : $_POST['form']['id'];
				$this->q()->Update('public_main_menu',$_POST['form'],array(
					'id' => $id
				));
				$this->set('success',true);
			}else{
				$this->q()->Insert('public_main_menu',$_POST['form']);
			}
		}

		function delete($id){

			$q = $this->q();

			$parent = $q->Select('parent','public_main_menu',array('id'=>$id));
			$q->Update('public_main_menu',array(
				'parent' => $parent[0]['parent']
			),array(
				'parent' => $id
			));

			$q->Delete('public_main_menu',array(
				'id'=>$id
			));

		}

		function index($sub=null){
			$this->menu($sub); 
			return $this->manaTree();
		}

		/**
		  @name manaTree
		  @desc Returns the Navigation 
		  @var navi = active links deku = offline links.
		**/
		function manaTree(){
			$navi = $this->heyNavi(1);
			$deku = $this->heyNavi(0);
			$this->set('navi',$navi);
			return array(
				'navi' => ( empty($navi) ) ? 0 : $navi, 
				'deku' => ( empty($deku) ) ? 0 : $deku,
				// 'sql'	=> $this->q()->mSql,
				'admin_menu' => $this->mkAdminMenu()
			);
		}

		function heyNavi($on=null){
			$q = $this->q();
			

			// Debugging code: 
			// $q->Update('navigation',array(
			// 	'parent' => 0
			// ),array(
			// 	'active' => 0
			// ));


			$q->mBy = 'ORDER BY weight ASC';

			

			return $q->Select('*','navigation',array(
				'active' => $on
			));
		}

		function growBranch($n,$p=0,$active=true){
			$q = $this->q();
			$w = 0;
			foreach ($n as $k => $v) {
				$q->Update('navigation',array(
					'weight' => $w,
					'parent' => $p,
					'active' => $active
				),array(
					'id' => $v['id']
				));
				$w++;

				if($v['children']){
					$this->growBranch($v['children'],$v['id'],$active);
				}
				# code...
			}
		}

		function updateNest()
		{
			$on  =  $_POST['on']; 
			$off = $_POST['off']; 

			$this->growBranch($on);
			$this->growBranch($off,0,false); 

			return array(
				'post' => $_POST
			);
		}

		function load($id=null){
			
			$q = $this->q();
			
			
			$data = $q->Select('*',
				'public_main_menu',
			array('id'=>$id )
			);

			foreach($data[0] as $k => $v){
				$content["form[$k]"] = $v;
			}

			//unset($content['content[content]']);

			$out = array(
				'success' => true,
				'data' 	=> $content
			);
			header('Content-Type: text/javascript');
			echo json_encode($out);
			exit;
		}

		 
		
		function menu($sub=0){
			 //// Prepare Shortcuts /////////////
			# Open DB Connection
			$q = $this->q();


			$q->Update('public_main_menu',array(
				'parent' => '0'
			),array(
				'parent' => 'null'
			));

			# Prepary Query, organized by weight.
			$q->mBy = array('weight'=>'ASC');
			
			# Get & Set Data
			$sub = ($sub) ? $sub : 0;
			////////////////////////////////////


			$this->set('menu_items',$q->Select('*','public_main_menu',array(
				'parent' => $sub,
			)));
		}

		function dropLink(){
			$q = $this->q();
			
			$id['id'] = $_POST['id'];
			unset($_POST['id']);
			
			$q->Update('public_main_menu', $_POST, $id); 
			
			$this->out( array( 'success' => true ));
		}
		
		function checked (){
			
			$q = $this->q();
			
			$id['id'] 	= $_POST['id'];  
			$update 	= array('checked' => ('false' != $_POST['checked']) ? 1 : 0);
			
			$q->Update('public_main_menu', $update, $id);
			
			$this->out(array(
				'success' => true,
				'sql'=>$q->mSql
			));
			
		}
		


		function loadTree($id=0){
			
			
			$id = ($_POST['node']) ? $_POST['node'] : $id;
			$id = str_replace('link-','',$id);
			
			$this->menu($id);
			
			foreach($this->_SET['menu_items'] as $k => $v){
				$this->_SET['menu_items'][$k]['text'] = $v['title']; 
				$this->_SET['menu_items'][$k]['id'] = 'link-' . $this->_SET['menu_items'][$k]['id'];
				$this->_SET['menu_items'][$k]['link'] = $this->_SET['menu_items'][$k]['href'];
				//$this->_SET['menu_items'][$k]['href'] = '';
				$this->_SET['menu_items'][$k]['checked'] = ($this->_SET['menu_items'][$k]['checked']) ? true : false;
				$this->_SET['menu_items'][$k]['iconCls'] = 'x-icon-16x16-link';
			}
			
			$this->out($this->_SET['menu_items']); 
		}
		
		function getPrimaryMenu(){
			/**
			 * PrimaryMenu consists of main pages and links.
			 *
			 */

			//// Prepare Shortcuts /////////////
			# Open DB Connection
			$q = $this->Q;
			# Prepary Query, organized by weight.
			$q->mBy = array('weight'=>'ASC');
			# Get & Set Data
			////////////////////////////////////
			$menu  = $q->Select('*',"public_main_menu");

			if(!empty($menu)){
				foreach($menu as $k => $v){
					$parent = $v['parent'];
					//$main[$parent][] = $v;
				}
			}

			return $menu;

		}

		/**
		 * QuickMenu consists of the main links of the website.
		 *
		 */
		function getShortcuts(){
			//// Prepare Shortcuts /////////////
			# Open DB Connection
			$q = $this->Q;
			# Prepary Query, organized by weight.
			$q->mBy = array('weight'=>'ASC');
			# Get & Set Data
			////////////////////////////////////
			return $q->Select('*',$this->area51('admin','public')."_shortcuts");
		}

		function getSiteMap(){
			/**
			 * The site maps contains all PUBLIC locations
			 * This should consist of the directories and its contents
			 */

			# Get all the xtensions
			$xphps = scandir(XPHP_DIR);

			foreach($xphps as $k => $v){
				$dir = lcfirst(substr($v,1));		// Clean the class Name.
				$html_dir = HTML_DIR.'/'.PUBLIC_LOC.'/'.$dir;
				if( file_exists($html_dir) && $v != '.' && $v != '..' ){
					// Now lets scan these files
					$htmls = scandir($html_dir);
					if(!empty($htmls)){
						foreach($htmls as $html){
							if($html != '.' && $html != '..'){
								$site[$dir][] = str_replace('.html','',$html);
							}
						}
					}
				}
			}
			// We should have an array $site['xModule'] = array[]
			return $site;
		}

		/**
		 * @remotable
		 */
		function tree(){	 

			return $this->q()->Select('*',"public_main_menu");;
		}


		/**
		 * @remotable
		 */
		function updateOrder(){
			$nodes = unserialize($_POST['nodes']);  
			$q = $this->q();
			foreach($nodes as $k => $v){
				$q->Update('public_main_menu',array(
						'weight'	=> $k
				), array('id'=>$v)); 
			}
			$this->set('success',true); 
			$this->set('order',$nodes);
		}

		function newLink(){
			$q = $this->q();

			$t = $_POST['title'];

			if( !empty($t) ){
				$r = $q->Select('id','navigation',array(
					'title' => $t,
					'parent' => 0
				));

				// if( !empty($r) ){
				// 	return array(
				// 		'success' 	=> false,
				// 		'error' 	=> 'That Page already exists at the Ground level.'
				// 	); 
				// }else{
					
				// }

				$r = $q->Insert('navigation',$_POST);
				return array(
					'success' => true,
					'row'=> $r,
					'error'=> $q->error 
				);
			}



			
		}

	}



?>
