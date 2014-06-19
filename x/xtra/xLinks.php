<?php
/**
 * @name Links
 * @desc Organize other relating links
 * @version v1.0.11.02.18.23.08.00
 * @author XTiv
 * @icon earth.png
 * @mini link
 * @see navigate
 * @link links
 * @todo
 *
 */

	class xLinks extends Xengine{
		function dbSync(){
			return array(
				'Links' => array(
					'title' 	=> array('Type'=>'varchar(255)'),
					'url' 		=> array('Type'=>'varchar(500)'),
					'weight' 	=> array('Type'=>'int(2)'),
				)
			);

		}

		function index(){
			$q = $this->q();
			$q->mBy = array('weight' => 'ASC');

			$links = $q->Select('*','Links') ;
			if(!empty($links)){
				foreach($links as $k => $v){
					$links[$k]['url64'] = base64_encode($v['url']);
				}
			}


			$this->set('links',$links);

			$f[] = 'title';
			$f[] = 'url';
			$f[] = 'url64';
			$f[] = 'id';

			$this->set('fields',	json_encode($f)	);
			$this->set('nodes',		$f);

		}
		function add($id=null){
			$this->set('success',($this->q()->error)? false: true);
			if($id == 0){
				unset($_POST['link']['id']);
				$this->q()->Insert( 'Links',$_POST['link'] );
			}else{
				$this->q()->Update( 'Links',$_POST['link'],array('id'=>$id) ) ;
				$this->set('error',$this->q()->error);
			}

		}

		function delete($id=null){
			if($id > 0){
				$this->q()->Delete('Links',array('id'=>$id));
			}
			header('Location: /@/links');
		}

		function updateOrder(){
	    	$i = 0;
	    	$magnets = $_GET['node'];
	    	$q = $this->q();
	    	foreach($magnets as $k => $v){
	    		$q->Update('Links',array(
					'weight'	=> $i
				), array('id'=>$v));
	    		$i++;
			}
	    }

	}

?>