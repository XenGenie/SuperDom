<?php
/**
 * @name Quotes
 * @desc Database of Quotes
 * @version v1.11.07.22.22.31
 * @author didusineptus@aol.com
 * @price $25
 * @icon comments.png
 * @mini comments
 * @see community
 * @link quotes 
 * @table Quotes
 */

	class xQuotes extends Xengine {
		function dbSync(){
			return array(
				'QuoteBallots'	=>	array(
					'quote_id'	=> array('Type' => 'int(8)'),
					'user_id'	=> array('Type' => 'int(8)'),
					'rating'	=> array('Type' => 'int(1)'),
					'uuid'		=> array('Type' => 'varchar(255)'),	 
				),
				'Quotes'	=>	array(
					'last_modified'	=> array('Type' => 'timestamp'),
					'quote'			=> array('Type' => 'blob'),
					'by'			=> 'author',
					'author'		=> array('Type' => 'varchar(50)'),
					
					'tag_person'	=> 'maturity',
					'maturity'		=> array('Type' => 'varchar(25)'),
						
				
					'tag_place'		=> 'category',
					'category'		=> array('Type' => 'varchar(500)'),
					
					'tag_thing'		=> 'tags',
					'tags'			=> array('Type' => 'varchar(500)'),
					'favorited'		=> array('Type' => 'int(7)','Default'=>0 ),
					'votes'			=> array('Type' => 'int(8)','Default'=>0 ),
					'views'			=> array('Type' => 'int(8)','Default'=>0 ),
					'rating'		=> array('Type' => 'int(8)','Default'=>0 )
				)
			);
		}


		
		function create(){
			$this->add();	
		}
		
		function add(){
			$this->set('themex','@center');
			if( is_array($_POST['q']) ){

				$_POST['q']['last_modified'] = date('Y-m-d h:i:s');

				if($_POST['q']['id']){
					$id = $_POST['q']['id'];
					unset($_POST['q']['id']);
					$this->q()->Update('Quotes',$_POST['q'],array('id'=>$id) );
				}else{
					$this->q()->Insert('Quotes',$_POST['q']);
				}

				$success = ($this->q()->error) ? false : true;
				$this->set('success', $success);
				$this->set('error',$this->q()->error);
			}
		}

		function delete(){
			$json = json_decode($_POST['data'],true);
			$id = $json;

			$this->q()->Delete('Quotes',array(
				'id' => $id
			));
			$this->set('sql',$this->q()->mSql);
			$this->set('error',$this->q()->error);
		}


		function update(){
			if($_POST['data']){
				$json = json_decode($_POST['data'],true);
				$id = $json['id'];
				unset($json['id']);
				$this->q()->Update('Quotes',$json,array('id'=>$id));
				$success = ($this->q()->error) ? false : true;
				$this->set('success', $success);
				$this->set('error',$this->q()->error);
			}
		}

		function config(){
			$this->q()->Update('config',array(
				'config_value' => $_POST['config_value']
			),array(
				'config_option' => $_POST['config_option']
			));
			exit;
		}

		function read(){
			$q = $this->q();
			$count = $q->Select('COUNT(id)','Quotes');
			$count = $count[0]['COUNT(id)'];

			$start = ($_POST['start'])?$_POST['start']:0;
			$limit = ($_POST['limit'])?$_POST['limit']:25;

			if($_POST['sort']){
				$q->mBy = array($_POST['sort']=>$_POST['dir']);
			}
			$q->setStartLimit($start,$limit);

			$data = $q->Select('*','Quotes');

			$data = (!empty($data)) ? $data : array();

			$this->out(array(
				'data'=>$data,
				'total'=>$count
			));
		}

		function index(){
			$this->set('WWW_PAGE','Quotes');
			$default = $this->q()->Select('config_option','config',array(
				'config_option' => 'default_quotes_by'
			));
			if(empty($default)){
				$this->q()->Insert('config',array(
					'config_option' => 'default_quotes_by'
				));
			}

			// SQL Connection
			$q = $this->q();
			$this->set('BODY_VALIGN','top');
			// the fields that we want to see are...
			$data= $q->Select('*','Quotes');
			$fields = $data[0];

			if(!empty($fields)){
				foreach($fields as $k => $v){
				//	$f[] = $k;
				}
			}

			$cols = $q->Q("SHOW COLUMNS FROM ".$q->PREFIX."Quotes");
			foreach($cols as $k => $v){
				$f[] = $v['Field'];
			}



			// Lets build the columns.
			foreach($f as $k => $v){
				//
				if($v != 'id'){
					$columns[] = array(
						'header' 	=> ucwords( str_replace('_',' ',$v) ),
						'dataIndex' => $v,
						'editable'  => ($v != 'id'),
						'id'		=> 'column_'.$v,
						'xtype'		=>	($v == 'last_modified') ? 'datecolumn' : null
						//'format'	=>	($v == 'last_modified') ? 'D M jS Y' : null
					);
				}
			}

			// set the datas

			$this->set('columns',	json_encode($columns)	);
			$this->set('fields',	json_encode($f)	);

		}

		function vote($id,$value){
			// Capture Vote to system
			$q = $this->q();
			$tempid = $id;
			$id = array('id'=>$id);

			$q->Inc('Quotes','votes', 1, $id);
			$q->Inc('Quotes','rating',$value, $id);

			$this->set('isUser',$this->isUser());

			$id['user_id'] = ($_SESSION['user']['id']) ?  $_SESSION['user']['id'] : $_GET['uuid'];

			if($id['user_id']){
				$id['user_id'] = ($_SESSION['user']['id']) ?  $_SESSION['user']['id'] : 0;

				$empty = $q->Select('id','Quotes',$id);
				if( empty($empty) ){
					$q->Insert('QuoteBallots',array(
						'user_id' 	=> $id['user_id'],
						'quote_id'	=> $id['id'],
						'rating'	=> $value
					));
				}else{
					$id['quote_id'] = $id['id'];
					unset($id['id']);
					$q->Update('QuoteBallots',array(
						'rating' => $value
					),$id);
				}
			}else{
					$q->Insert('QuoteBallots',array(
						'user_id' 	=> 0,
						'quote_id'	=> $tempid,
						'rating'	=> $value
					));
			}
		}

		function bubble(){
			$this->random();



		}

		function random(){
			$q = $this->q();
			//$q->mBy = array('RAND()'=>'');
			$q->mBy = array('RAND()'=>'');
			$q->setStartLimit(0,1);


			$quote =  $q->Select('*','Quotes');
			//$quote =  $this->q()->Q('SELECT * FROM Quotes ORDER BY RAND() LIMIT 1');
			$id = $quote[0]['id'];

			$count = strlen($quote[0]['quote']);

			$count = str_word_count($quote[0]['quote']);

			$wpm = '40';

			$wpm = $count / $wpm * 60;


			$id = array('id' => $id);
			$q->Inc('Quotes','views',1, $id);

			$this->set('wpm',$wpm);

			$this->set('quote', $quote);
		}

		function myfavs($uuid=0){
			$uuid = ($uuid) ? $uuid  : $_SESSION['user']['id'];
			$q = $this->q();
			$qids = $q->Select('*','QuoteBallots',array(
				'user_id' => $_SESSION['user']['id']
			));

			if(!empty( $qids )){
				foreach($qids as $k => $v){
					if($v['rating'] > 2){
						$needle = ($needle) ? $needle." OR " : " ";
						$needle = $needle."id = '$v[quote_id]' ";
					}
				}
				$list = $q->Select('*','Quotes',$needle);
			}

			header('Content-Type: text/javascript');
			echo json_encode(array('data'=>$list));
			exit;
		}


		function edit($id){
			$q = $this->q();
			$quote = $q->Select('*','Quotes',array(
				'id' => $id
			));

			foreach($quote[0] as $k => $v){
				$data["q[$k]"] = $v;
			}

			$this->set('data',$data);
			$this->set('success',true);
		}
	}

?>