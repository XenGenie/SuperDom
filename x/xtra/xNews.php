<?php 
/**
 * @name Blog 
 * @desc Keep Traffic informed by Blogging Blog Articles
 * @version v0.1.12.30.04.06
 * @author cdpollard@gmail.com
 * @see radius
 * @link blog
 * @todo
 */

	class xNews extends Xengine{
		
		
		/**
		 * List News Items for both public and Admin. 
		 * templates will give links to either, readmore, edit, etc.
		 */ 
		function index(){
			$this->set('WWW_PAGE','Blog');
			$this->q()->mBy = array('date'=>'DESC');
			$list = $this->q()->Select('*','Blog');
			$this->set('list',$list);
			
		}

		function article($id,$title=null,$date=null){
			$article = $this->q()->Select('*','Blog',array('id'=>$id));
			$this->set('article',$article[0]);
			$this->set('WWW_PAGE',$article[0]['title']);
			$this->set('PAGE_TITLE','Blog : '.$article[0]['title']);
		}
		
		function add(){
			if(isset($_POST['news'])){
				if($_POST['news']['id'] > 0){
					$this->q()->Update('Blog',$_POST['news'],array('id'=>$_POST['news']['id']));
					$this->set('success',true);	
				}else{
					unset($_POST['news']['id']);
					$this->q()->Insert('Blog',$_POST['news']);	
					$this->set('success',true);	
				}
			}
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
			header('Location: /@/news');
		}
	}
?>