<?php 
/**
 * @name Content
 * @desc Provides an easy method for adding extra content to any page.
 * @version v1.0(11.11.04@23:43)
 * @author XTiv
 * @icon document_pen.png
 * @mini file-text-o
 * @see construct
 * @link content
 * @table Content
 */

	class xContent extends Xengine{
		function dbSync(){
			$columns['Content']['url']['Type'] = 'varchar(255)';
			$columns['Content']['title']['Type'] = 'varchar(255)';
			$columns['Content']['content']['Type'] = 'blob';
			$columns['Content']['video_link']['Type'] = 'varchar(255)';
			return $columns;
		}
		
		function autoRun($X){
			// Get the content for the page.
			$url = substr($_SERVER['REQUEST_URI'],1);
			if(empty($url)){
				$url = 'index';
			}

			
			//$content = $X->Q->Select( '*','Content',array('url'=>$url) );
			
			if(!empty($content)){
				$content = $content[0];
				$this->set('PAGE_CONTENT',$content['content']);
				$this->set('PAGE_TITLE',$content['title']);	
			}
		}
	
		function jsonPages(){
			$q = $this->q();
			$pages = $q->Select('title, id,url','Content');
			$this->out(array(
				'data' => ($pages) ? $pages : array()
			));
		}
		
		function index(){
			// List Contents
			$this->set('content',$this->q()->Select('*','Content'));
			
			$f[] = 'title';
			$f[] = 'id';
			$f[] = 'url';

			$this->set('fields',	json_encode($f)	);
			$this->set('nodes',		$f);
			
		}
		
		function add(){
			if( $_POST['page']['id'] != 0) {
				$this->q()->Update('Content',$_POST['page'],array(
					'id' => $_POST['page']['id']
				));
				$this->set('success',true);
			}else{
				unset($_POST['page']['id']);
				$this->q()->Insert('Content',$_POST['page']);
				$this->set('success',true);
			}
		}
		
		function create($id=null){ 
			if($id){ // Editing content
				$page = $this->q()->Select('*','Content', array('id' => $id) );
				$this->set('page',  $page[0]);
			}
		}
		
		function edit($id){
			$data = $this->q()->Select('*','Content',array(
				'id' => $id
			));
			
			foreach($data[0] as $k => $v){
				$content["page[$k]"] = $v;
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
		
		function delete($id=null){
			if($id > 0){
				$this->q()->Delete('Content',array('id'=>$id));
			}
			header('Location: /@/content');
		}
		
		function getContentTree(){
			require(XPHP_DIR.'/xNavigation.php');
			$this->set('sitemap',xNavigation::getSiteMap());
		}
	}
?>