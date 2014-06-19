<?php
/**
 * @name Blog
 * @desc Keep Traffic informed by Blogging Day-to-Day Articles
 * @version v1.1|11.10.30@13.57
 * @author i@xtiv.net
 * @icon Diary.png
 * @mini book
 * @see cronos
 * @link blog
 * @todo
 * @alpha true
 */

	class xBlog extends Xengine{
		function dbSync(){
			return array(
				'News'	=>	'Blog',
				'Blog'	=>	array(
					'date'			=> array('Type'=>'datetime'),	
					'title'			=> array('Type'=>'varchar(255)'),
					'content'		=> array('Type'=>'blob'),
					'author'		=> array('Type'=>'varchar(50)'),
					'published'		=> array('Type'=>'datetime'),
					'last_edited' 	=> array('Type'=>'datetime'),
					'category' 		=> array('Type'=>'varchar(255)'),
					'tags'			=> array('Type'=>'blob'),
				)
			);
		}



		/**
		 * List News Items for both public and Admin.
		 * templates will give links to either, readmore, edit, etc.
		 */
		function index(){
			$this->set('WWW_PAGE','Blog');
			$this->q()->mBy = array('date'=>'DESC');
			$list = $this->q()->Select('*','Blog');
			$this->set('list',$list);
			
			$this->gridFields();
		}

		function article($id,$title=null,$date=null){
			$article = $this->q()->Select('*','Blog',array('id'=>$id));
			$this->set('article',$article[0]);
			$this->set('WWW_PAGE',$article[0]['title']);
			$this->set('PAGE_TITLE','Blog : '.$article[0]['title']);
		}

		function add(){
			if(isset($_POST['news'])){
				$_POST['news']['last_edited'] = date('Y-m-d H-i-s');
				if($_POST['news']['id'] > 0){
					$this->q()->Update('Blog',$_POST['news'],array('id'=>$_POST['news']['id']));
				}else{
					$_POST['news']['date'] = date('Y-m-d H-i-s');
					unset($_POST['news']['id']);
					$this->q()->Insert('Blog',$_POST['news']);
				}
				$this->set('success',true);
			}
		}

		function read(){
			$q = $this->q();
			$count = $q->Select('COUNT(id)','Blog');
			$count = $count[0]['COUNT(id)'];

			$start = ($_POST['start'])?$_POST['start']:0;
			$limit = ($_POST['limit'])?$_POST['limit']:25;

			if($_POST['sort']){
				$q->mBy = array($_POST['sort']=>$_POST['dir']);
			}
			$q->setStartLimit($start,$limit);

			$data = $q->Select('*','Blog');

			$data = (!empty($data)) ? $data : array();

			$this->out(array(
				'data'=>$data,
				'total'=>$count
			));
		}
		
		function gridFields($table="Blog"){
			$q = $this->q();
			
			
			$cols = $q->Q("SHOW COLUMNS FROM ".$q->PREFIX.$table);
			
			foreach($cols as $k => $v){
				if($v['Field'] != 'tags' && $v['Field'] != 'category'){
					$f[] = $v['Field'];	
				}
				
			}



			// Lets build the columns.
			foreach($f as $k => $v){
				//
				if($v != 'id' && $v != 'content'){
					$columns[] = array(
						'header' 	=> ucwords( str_replace('_',' ',$v) ),
						'dataIndex' => $v,
						'editable'  => ($v != 'id'),
						'id'		=> 'column_'.$v,
						'xtype'		=>	($v == 'date'|| $v == 'published' || $v == 'last_edited') ? 'datecolumn' : null,
						'format'	=>	($v == 'date'|| $v == 'published' || $v == 'last_edited') ? 'Y-m-d h-i-s a' : null
					);
				}
			}

			// set the datas

			$this->set('columns',	json_encode($columns)	);
			$this->set('fields',	json_encode($f)	);
		}
		
		function edit($id){
			$data = $this->q()->Select('*','Blog',array(
				'id' => $id
			));

			//$news['news'] = $data[0];
			foreach($data[0] as $k => $v){
				$news["news[$k]"] = $v;
			}

			$out = array(
				'success' => true,
				'data' 	=> $news
			);
			//$this->set('success',true);
			//$this->set('data',$news);
			//$this->out($out);
			header('Content-Type: text/javascript');
			echo json_encode($out);
			exit;
		}

		function delete($id=null){
			if($id > 0){
				$this->q()->Delete('Blog',array('id'=>$id));
			}
			header('Location: /@/blog');
		}
	}
?>