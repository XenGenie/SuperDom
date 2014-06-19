<?php
/**
 *
 * @name Costume-ize
 * @desc Allows for easy manipulation of web layout and style
 * @version v1.5(11.10.29@04:26)
 * @icon Brushes.png
 * @mini magic
 * @author i@xtiv.net
 * @see construct
 * @link layout
 * @todo stuud
 */

class xLayout extends Xengine {
		function dbSync(){
			$columns = array(
				'-moz-border-radius' 	=> array('Type'=>'varchar(50)'),
				'-webkit-border-radius' => array('Type'=>'varchar(50)'),
				'-moz-box-shadow' 		=> array('Type'=>'varchar(50)'),
				'-webkit-box-shadow' 	=> array('Type'=>'varchar(50)'),
				'box-shadow' 			=> array('Type'=>'varchar(50)'),
				'element' 				=> array('Type'=>'varchar(255)'),
				'state' 				=> array('Type'=>'varchar(40)'),
				'border' 				=> array('Type'=>'varchar(50)'),
				'border-radius' 				=> array('Type'=>'varchar(50)'),
				'background' 			=> array('Type'=>'blob'),
				'background-color' 		=> array('Type'=>'varchar(255)'),
				'background-attachment' => array('Type'=>'varchar(10)'),
				'background-image' 		=> array('Type'=>'blob'),
				'background-repeat' 	=> array('Type'=>'varchar(25)'),
				'background-position' 	=> array('Type'=>'varchar(25)'),
				'border-color' 			=> array('Type'=>'varchar(255)'),
				'border-style' 			=> array('Type'=>'varchar(20)'),
				'border-width' 			=> array('Type'=>'varchar(20)'),
				'color' 				=> array('Type'=>'varchar(15)'),
				'font' 					=> array('Type'=>'varchar(100)'),
				'font-size' 			=> array('Type'=>'varchar(10)'),
				'font-family' 			=> array('Type'=>'varchar(100)'),
				'font-style' 			=> array('Type'=>'varchar(10)'),
				'font-weight' 			=> array('Type'=>'varchar(10)'),
				'font-variant'			=> array('Type'=>'varchar(20)'),
				'margin' 				=> array('Type'=>'varchar(30)'),
				'padding' 				=> array('Type'=>'varchar(30)'),
				'z-index' 				=> array('Type'=>'varchar(10)'),
				'width' 				=> array('Type'=>'varchar(10)'),
				'height' 				=> array('Type'=>'varchar(10)'),
				'float' 				=> array('Type'=>'varchar(5)'),
				'display' 				=> array('Type'=>'varchar(20)'),
				'content' 				=> array('Type'=>'blob'),
				'counter-increment' 	=> array('Type'=>'varchar(5)'),
				'counter-reset' 		=> array('Type'=>'varchar(5)'),
				'cursor' 				=> array('Type'=>'varchar(15)'),
				'position' 				=> array('Type'=>'varchar(20)'),
				'left' 					=> array('Type'=>'varchar(7)'),
				'right' 				=> array('Type'=>'varchar(7)'),
				'bottom' 				=> array('Type'=>'varchar(7)'),
				'top' 					=> array('Type'=>'varchar(7)'),
				'opacity' 				=> array('Type'=>'varchar(7)'),
				'border-bottom' 		=> array('Type'=>'varchar(25)'),
				'border-bottom-color' 	=> array('Type'=>'varchar(10)'),
				'border-bottom-style' 	=> array('Type'=>'varchar(10)'),
				'border-bottom-width' 	=> array('Type'=>'varchar(10)'),
				'border-left' 			=> array('Type'=>'varchar(25)'),
				'border-left-color' 	=> array('Type'=>'varchar(10)'),
				'border-left-style' 	=> array('Type'=>'varchar(10)'),
				'border-left-width' 	=> array('Type'=>'varchar(10)'),
				'border-right' 			=> array('Type'=>'varchar(25)'),
				'border-right-color' 	=> array('Type'=>'varchar(10)'),
				'border-right-style' 	=> array('Type'=>'varchar(10)'),
				'border-right-width' 	=> array('Type'=>'varchar(10)'),
				'border-top' 			=> array('Type'=>'varchar(25)'),
				'border-top-color' 		=> array('Type'=>'varchar(10)'),
				'border-top-style' 		=> array('Type'=>'varchar(25)'),
				'border-top-width' 		=> array('Type'=>'varchar(25)'),
				'border-collapse' 		=> array('Type'=>'varchar(10)'),
				'border-spacing' 		=> array('Type'=>'varchar(10)'),
				'caption-side' 			=> array('Type'=>'varchar(7)'),
				'direction' 			=> array('Type'=>'varchar(7)'),
				'letter-spacing' 		=> array('Type'=>'varchar(10)'),
				'line-height' 			=> array('Type'=>'varchar(10)'),

				'empty-cells' 			=> array('Type'=>'varchar(7)'),

				'outline' 				=> array('Type'=>'varchar(20)'),
				'outline-color' 		=> array('Type'=>'varchar(10)'),
				'outline-style' 		=> array('Type'=>'varchar(10)'),
				'outline-width' 		=> array('Type'=>'varchar(10)'),
				'max-height' 			=> array('Type'=>'varchar(10)'),
				'min-height' 			=> array('Type'=>'varchar(10)'),
				'max-width' 			=> array('Type'=>'varchar(10)'),
				'min-width' 			=> array('Type'=>'varchar(10)'),

				'list-style' 			=> array('Type'=>'varchar(10)'),
				'list-style-image' 		=> array('Type'=>'varchar(255)'),
				'list-style-position' 	=> array('Type'=>'varchar(15)'),
				'list-style-type' 		=> array('Type'=>'varchar(25)'),
				'margin-bottom' 		=> array('Type'=>'varchar(25)'),
				'margin-left' 			=> array('Type'=>'varchar(25)'),
				'margin-right' 			=> array('Type'=>'varchar(25)'),
				'margin-top' 			=> array('Type'=>'varchar(25)'),
				'padding-bottom' 		=> array('Type'=>'varchar(25)'),
				'padding-left' 			=> array('Type'=>'varchar(25)'),
				'padding-right' 		=> array('Type'=>'varchar(25)'),
				'padding-top' 			=> array('Type'=>'varchar(25)'),
				'clear' 				=> array('Type'=>'varchar(10)'),
				'overflow' 				=> array('Type'=>'varchar(10)'),
				'overflow-x' 			=> array('Type'=>'varchar(10)'),
				'overflow-y' 			=> array('Type'=>'varchar(10)'),
				'quotes' 				=> array('Type'=>'varchar(10)'),

				'page-break-after' 		=> array('Type'=>'varchar(10)'),
				'page-break-before' 	=> array('Type'=>'varchar(10)'),
				'page-break-inside' 	=> array('Type'=>'varchar(10)'),
				'table-layout' 			=> array('Type'=>'varchar(7)'),
				'text-align' 			=> array('Type'=>'varchar(10)'),
				'text-decoration' 		=> array('Type'=>'varchar(50)'),
				'text-indent' 			=> array('Type'=>'varchar(10)'),
				'text-shadow' 			=> array('Type'=>'varchar(25)'),
				'text-transform' 		=> array('Type'=>'varchar(25)'),
				'vertical-align' 		=> array('Type'=>'varchar(10)'),
				'visibility' 			=> array('Type'=>'varchar(10)'),
				'white-space' 			=> array('Type'=>'varchar(10)'),
				'word-spacing' 			=> array('Type'=>'varchar(10)')
			);

			// Collects all themes and syncs tables with the above.
			$costumez = $this->q()->Select('table_name','costumez');
			//echo $q->error;
			if(!empty($costumez)){
				foreach($costumez as $k => $v){
					$tables["costume_$v[table_name]"] = $columns;
				}
				return $tables;
			}

		}


		function __construct(){
			$this->set('BODY_VALIGN','top');
			$this->set('WWW_PAGE','Layout');
		}

		function index(){
			// Lets get the style sheet list
			$q = $this->q();
			$q->setStartLimit(0,1);
			$styles = $q->Select('*','costume_adminzone');

			foreach($styles[0] as $k => $v){
				$props[$k] = '';
				$fields[] = $k;
			}
			$this->set('store_fields',json_encode($fields));
			$this->set('style_properties',json_encode($props,JSON_FORCE_OBJECT));
		}

		function edits(){
			$this->set('themex','@center');
		}

		function newStyle($name){
			$q = $this->q();
			$q->setStartLimit(0,1);
			$css = $q->Select('*','costume_adminzone');

			foreach($css[0] as $k => $v){
				$columns[$k] = '';
			}
			unset($columns['id']);
			$q->Insert("costume_$name",$columns);
			print_r($columns);
			echo "Made table costume_$name.<hr/>";
			exit;
		}

		function getElement(){
			$p = $_POST;

			$style 		= $p['style'];
			$element 	= $p['element'];
			$show_null 	= $p['show_null'];

			$q = $this->q();
			$css = $q->Select('*',"costume_$style",array(
				'element'=>$element
			));

			// didnt find anything, create it!
			if(empty($css)){
				$q->Insert("costume_$style",array(
					'element'=>$element
				));
				// lets at least get the headers...
				$q->setStartLimit(0,1);
				$css = $q->Select('*',"costume_$style",array(
					'element'=>$element
				));

			}
			$css = $css[0];

			foreach($css as $k => $v){
				$css[$k] = ($v == null) ? ' ' : $v;
			}


			unset($css['id']);
			//unset($css['element']);
			//unset($css['state']);

			$this->out(array('data'=>$css ));
		}

		function updateElement(){
			$this->q()->Update("costume_$_POST[costume]",$_POST['data'], array(
				'element' 	=> $_POST['element']
			));
			echo $this->q()->error;
			exit;
		}

		function getElements(){

			$this->q()->mBy = array('element'=>'ASC');

			if($_POST['query']){
				$where = array('element'=>$_POST['query']);

			}

			$costume = ($_SESSION['COSTUME']) ? $_SESSION['COSTUME'] : $this->CFG['www_costume'];
			
			$costumez = $this->q()->Select('id,element',"costume_".$costume,$where,'','LIKE');



			$this->set('data',$costumez);
		}

		function getThemes(){
			$costumez = $this->q()->Select('*','costumez');

			foreach($costumez as $k => $v){
				$themes['data'][$k] = array(
					'id' => $v['table_name'],
					'name' => $v['title']
				);
			}
			header('Content-Type: text/javascript');
			echo json_encode($themes);
			exit;
		}

		function newTheme($label,$copy=null){
			$q = $this->q();
			$label = str_replace("%20",' ',$label);
			$llabel = str_replace(" ",'',strtolower($label));
			if(!$copy){
				$copy = 'bdaysuite';
			}else{
				$doCopy = true;
			}

			// Copy Table
			$q->Q("CREATE TABLE ".$q->PREFIX."costume_$llabel LIKE ".$q->PREFIX."costume_$copy");

			// if Copy is null, dump table data.
			if($doCopy){
				$q->Q("INSERT ".$q->PREFIX."costume_$llabel SELECT * FROM ".$q->PREFIX."costume_$copy");
				$costume = $q->Select('*','costumez', array('table_name' => $copy) );
				$costume = $costume[0];
				unset($costume['id']);
			}

			$costume['table_name'] = $llabel;
			$costume['title'] = $label;

			$q->Insert('costumez',$costume);
			echo $q->error;
			exit;
		}

		function importCss(){

			require_once(LIBS_DIR.'/x4/cssparser.php');
			$css = new cssparser();

			$costume = $_POST['form']['www_costume'];
		 	$name 	= $_POST['form']['www_costume_name'];
			 
			
			$q = $this->q();

			if(!empty($_FILES)){
				foreach($_FILES as $file){
			        if (!empty($file['tmp_name'])) {
			            $this->mFile['size']	= $file['size'];
			            $this->mFile['type']	= $file['type'];
			        	$tmp 					= $file['tmp_name'];
			        	$this->mFile['path'] 	= $_SERVER['HTTP_HOST'];
			            $this->mFile['name'] 	= $file['name'];

			            $read = $tmp['cssfile'];
			            $read = file_get_contents($read);
			            $css->ParseStr($read);

			            foreach($css->css as $k => $v){
			            	if(empty($v)){
			            		unset($css->css[$k]);
			            	}else{
			            		$exist = $q->Select('id',"costume_$costume",array(
			            			'element' => $k
			            		));
			            		if(!empty($exist)){
			            			$q->Update("costume_$costume",$v,array(
				            			'id' => $exist[0]['id']
				            		));
				            		$import['updated'][] =  $k;
			            		}else{
			            			$v['element'] = $k;
			            			$q->Insert("costume_$costume",$v);
			            			$import['imported'][] =  $k;
			            		}
			            	}
			            }

			            //$this->set('uploaded',$import);
			            //$this->set('success',true);
			            // Uncomment the following line if you want to make the directory if it doesn't exist
			            /**
			             * we dont want to save the file in a dir tree...
			             * only the db holds that info. instead we change save the file as its md5 hash.
			             *
			            */





			            //move_uploaded_file($tmp,$this->mFile['src']);
			            //return $this->Index();
			        }
			    }
			    
			    echo json_encode(array(
			    	'success'=>true,
			    	'costume'=>$costume,
			    	'file'=>$this->mFile['name']
			    ));
		 		exit;
			    
			}

			/*$this->getCostumez();
			foreach($this->_SET['costumez'] as $k => $v){
				$costumez[$k] = $v['title'];
			}*/
			//$this->set('costume_options',$costumez);
			
		}


		function editor(){

			$q = $this->q();

			// the fields that we want to see are...
			$q->setStartLimit(0,1);


			$fields = $q->Select('*','costume_adminzone');
			$fields = $fields[0];

			$i = 0;
			foreach($fields as $k => $v){
					$f[] = $k;
				$i++;
			}

			// Lets build the columns.
			foreach($f as $k => $v){
				//
				switch($v){
					case('id'):

					break;
					case('element'):
						$columns[] = array(
							'header' 	=> $v,
							'dataIndex' => $v,
							'width'		=> 125,
							'locked' => true,
							'editable'  => true,
							'id'		=> $v
							//'format'	=>	($v == 'last_modified') ? 'D M jS Y' : null
						);
					break;
					case('state'):
						$columns[] = array(
							'header' 	=> $v,
							'dataIndex' => $v,
							'width'		=> 45,
							'locked' => true,
							'editable'  => true,
							'id'		=> $v
							//'format'	=>	($v == 'last_modified') ? 'D M jS Y' : null
						);
					break;
					case('background-image'):
						$columns[] = array(
							'header' 	=> $v,
							'dataIndex' => $v,
							'editable'  => true,
							'id'		=> $v
							//'format'	=>	($v == 'last_modified') ? 'D M jS Y' : null
						);
					break;
					default:
						$columns[] = array(
							'header' 	=> $v,
							'dataIndex' => $v,
							'editable'  => true,
							'id'		=> $v
							//'format'	=>	($v == 'last_modified') ? 'D M jS Y' : null
						);
					break;
				}



			}

			// set the datas
			$this->set('columns',	json_encode($columns)	);
			$this->set('fields',	json_encode($f)	);
		}

		function css($act){
			$q = $this->q();

			switch($act){
				case('read'):
					if($_POST['costume']){
						$where = array();

						if($_POST['element']){
							$where = array( 'element' => $_POST['element'] );
						}

						$data = $q->Select('*',"costume_$_POST[costume]","element LIKE '%$_POST[element]%' ");

						foreach($data as $r => $c){
							
							$r['locked'] = true; 
							
						}
						
						$_SESSION['COSTUME'] = $_POST['costume'];
						$this->set('data',$data);
					}
				break;

				case('create'):
				break;

				case('update'):

					$update = json_decode($_POST['data'],true);
					$z = $_POST['costume'];
					$id = array('id'=>$update['id']);

					unset($update['id']);

					$q->Update('costume_'.$z,$update,$id);

					$this->set('ERROR',$q->error);
					$this->set('success',(!$q->error));
				break;

				case('destroy'):
				break;

				default:
				break;
			}
		}

		function adminBar(){


		}

	}
?>