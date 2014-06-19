<?php
/**
 * @name Forums
 * @desc
 * @version v0.11.04.19
 * @author cdpollard@gmail.com
 * @icon cork.png
 * @mini fire-extinguisher
 * @price $?
 * @see community
 * @link forums
 * @todo
 */

	class xForums extends Xengine{

		function dbSync(){
			return array(
				// Shows how we can update the Users table anywhere...
				'Users' => array(
					'user_posts'	 	=> array('Type' => 'int(7)'),
				),

				'BulletinCats' => array(
					'text'				=> array('Type'=>'varchar(50)'),
					'description'		=> array('Type'=>'varchar(255)'),
					'iconCls'			=> array('Type'=>'varchar(30)'),
					'weight'			=> array('Type'=>'int(2)'),
				),

				'BulletinTopics' => array(
					'topic_title'		=> array('Type'=>'varchar(255)'),
					'topic_author'		=> array('Type'=>'varchar(25)'),
					'topic_author_id'	=> array('Type'=>'int(8)'),
					'topic_timestamp'	=> array('Type'=>'int(12)'),
					'topic_views'		=> array('Type'=>'int(8)'),
					'topic_replies'		=> array('Type'=>'int(8)'),
					'forum_id'			=> array('Type'=>'int(8)'),
					'topic_category'	=> array('Type'=>'varchar(255)'),
					'topic_publish'		=> array('Type'=>'varchar(5)'),
					'last_post'			=> array('Type'=>'int(12)'),
					'last_poster'		=> array('Type'=>'varchar(25)'),
					'last_poster_id'	=> array('Type'=>'int(8)'),
					'topic_icon'		=> array('Type'=>'varchar(100)'),
					'topic_announcement'=> array('Type'=>'date'),
					'topic_sticky'		=> array('Type'=>'date'),
					'excerpt'			=> array('Type'=>'varchar(500)'),
				),
				'BulletinPosts' => array(
					'datetime'	=> array('Type'=>'datetime'),
					'publish'	=> array('Type'=>'varchar(5)'),
					'isTopic'	=> array('Type'=>'int(1)'),
					'topic_id'	=> array('Type'=>'mediumint(8)'),
					'category'	=> array('Type'=>'varchar(255)'),
					'title'		=> array('Type'=>'varchar(255)'),
					'html'		=> array('Type'=>'blob'),
					'user_id'	=> array('Type'=>'int(8)'),
				),
				'BulletinForums'=> array(
					'text'	=> array('Type'=>'varchar(255)'),
					'qtip'	=> array('Type'=>'varchar(500)'),
					'rules'	=> array('Type'=>'blob'),
					'leaf'	=> array('Type'=>'varchar(5)'),
					'icon'	=> 'iconCls',
					'iconCls'	=> array('Type'=>'varchar(255)'),
					'sub_forum'	=> 'parent_id',
					'parent_id'	=> array('Type'=>'int(8)'),

					'weight'	=> array('Type'=>'int(2)'),
				)
			);
		}

		function index(){
			/*$forum_icons = scandir(DOC_ROOT.'/'.ICON_16);
			foreach($forum_icons as $k => $v){
				if(substr($v,0,1) == '.'){
					unset($forum_icons[$k]);
				}else{
					$icons[$v] = $v;
				}
			}
			$this->set('forum_icons',$icons);*/
		}

		function categories(){

	    	$find = $_POST['query'];
	    	$cats = $this->q()->Select('id, text','BulletinForums',
    		array('text' => $find ),'LEFT','LIKE');

	    	/* Adds child forums

	    	$forums = $q->Select('id,text,cat_id','BulletinForums');

	    	 foreach($cats as $i => $row){
	    		$drop_down[]= array(
	    			'text' => $row['text'],
	    			'id' => $row['id']
	    		);
	    	 	foreach($forums as $x => $data){
	    			if($data['cat_id'] == $row['id']){

	    				$data['id'] = $data['cat_id'].'-'.$data['id'];
	    				unset($data['cat_id']);
	    				$data['leaf'] = true;
	    				$data['threads'] = 1;
	    				$data['totalPosts'] = 1;
	    				$cats[$i]['expanded'] = true;
	    				$cats[$i]['children'][] = $data;
	    			}else{
	    				//unset($cats[$i]);
	    			}
	    		}
	    	}
	    	*/
	    	echo $q->error;
	    	$this->out($cats);
		}

		/**
		 * @remotable
		 */
		function loadDetails($id){
			$id = str_replace('forum-','',$id);
			$forum = $this->q()->Select('*','BulletinForums',array('id'=>$id));
			return array(
				'success' => true,
				'data'	=> $forum[0]
			);
		}

		/**
		 * @remotable
		 * @formHandler
		 */
		function saveDetails($f){
			$f = $this->cleanExtF($f);
			$id 	= str_replace('forum-','',$f['id']);
			$q = $this->q();
			return array(
				'success' => $q->Update('BulletinForums',$f,array(
					'id' => $id
				)),
				'error'		=> $q->error,
				'mSql'		=> $q->mSql
			);
		}

		/**
		 * @remotable
		 */
		function newForum($text,$parent,$node){
			$q = $this->q();

			$parent = str_replace('forum-','',$parent);

			$node = explode('-',$node);
			if($node[0] == 'xnode'){
				$success = $id = $q->Insert('BulletinForums',array(
					'text'	=> $text,
					'parent_id'	=> $parent
				));
			}else{
				$id = $node[1];
				$success = $q->Update('BulletinForums',array(
					'text'	=> $text,
					'parent_id'	=> $parent
				),array(
					'id' => $id
				));
			}
			return array(
				'success'	=> $success,
				'id'		=> $id,
				'sql'		=> $q->mSql,
				'text'	=> $text,
				'node'		=> implode('-',$node),
				'error'		=> $q->error
			);
		}

		/**
		 * @remotable
		 */
		function tree($id){
			$q = $this->q();

			$q = $this->q();
	    	if($id == "forum-root"){
		    	$find = $_POST['query'];
		    	$q->mBy = array('weight'=>'ASC');
		    	$cats = $q->Select('*','BulletinCats');

		    	if(empty($cats)){
		    		$cats[] = array(
		    			'text'			=> 'General',
		    			'description'	=> '',
		    			'weight'		=> '0',
		    			'iconCls'		=> ''
 		    		);
		    		$q->Insert('BulltinCats',$cats[0]);
		    	}


		    	$q->mBy = array('weight'=>'ASC','text'=>'ASC');
		    	$forums = $q->Select('*','BulletinForums');

		    	foreach($cats as $i => $row){
		    		$drop_down[]= array(
		    			'text' => $row['text'],
		    			'id' => 'cat-'.$row['id']
		    		);
		    	 	foreach($forums as $x => $data){
		    			if($data['parent_id'] == $row['id']){
		    				$data['id'] = 'forum-'.$data['id'];
		    				unset($data['parent_id']);

		    				$data['leaf'] = ($data['leaf'] == 'true') ? true : false;
		    				$data['threads'] = 1;
		    				$data['totalPosts'] = 1;
		    				$cats[$i]['expanded'] = true;
		    				$cats[$i]['children'][] = $data;
		    			}else{
		    				//unset($cats[$i]);
		    			}
		    		}
		    	}
				return $cats;
	    	}else{
	    		$id = str_replace('forum-','',$id);
	    		$forums = $q->Select('*','BulletinForums',array('parent_id'=>$id));

	    		if(!empty($forums)){
		    		foreach($forums as $k => $forum){
		    			$forums[$k]['leaf'] = ($forum['leaf']) ? true : false;
		    			$forums[$k]['id'] = 'forum-'.$forums[$k]['id'];
		    			$forums[$k]['iconCls'] = 'x-icon-16x16-'.$forums[$k]['iconCls'];
		    			$forums[$k]['allowDrag'] = true;
		    			$forums[$k]['allowDrop'] = true;
		    		}
	    		}
				$this->set('forums',$forums);
	    		return $forums;
	    	}



		}

		/**
		 * @remotable
		 */
		function moveNode($data,$drop){
			$drop = ($drop == 'root') ? 0 : $drop;


			$this->q()->Update('BulletinForums',array(
				'parent_id'=> $drop
			),array(
				'id'	=> $data
			));
			return array('success'=>true);
		}

		/**
		 * @remotable
		 */
		function deleteForum($id){
			$q = $this->q();

			$id = str_replace('forum-','',$id);

			$dbt = 'BulletinForums';

			$where = array('id'=>$id);

			$forum = $q->Select('parent_id',$dbt,$where);
			$q->Delete('BulletinForums',$where);

			$children = $q->Select('id',$dbt,array('parent_id' => $id));
			if(!empty($children)){
				foreach($children as $k => $v){
					$q->Update($dbt,array(
						'parent_id' => $forum[0]['parent_id']
					),array(
						'id'=>$v['id']
					));
				}
			}

			$children = $q->Select('id','BulletinTopics',array('forum_id' => $id));
			if(!empty($children)){
				foreach($children as $k => $v){
					$q->Update($dbt,array(
						'forum_id' => $forum[0]['parent_id']
					),array(
						'id'=>$v['id']
					));
				}
			}

			return array(
				'success'=>true,
				'error'	=> $q->error
			);
		}

		/**
		 * @remotable
		 */
		function getTopics($forum_id, $start, $limit){
			$f = str_replace('forum-','',$forum_id);
			$q = $this->q();

			$q->mBy = array(
				'topic_sticky'=>'DESC',
				'last_post'=>'DESC'
			);

			$q->setStartLimit($start,$limit);

			if($forum_id == "latest"){
				$topics = $q->Select('*','BulletinTopics',array(
					'topic_publish'	=>'true'
				));
			}else{
				$topics = $q->Select('*','BulletinTopics',array(
					'forum_id'		=>$f,
					'topic_publish'	=>'true'
				));
			}



			if(empty($topics)){
				$topics = array();
			}else{
				foreach($topics as $k => $topic){
					// figure icon
					$icon 	= ($topics[$k]['topic_replies'] > 5) ? 'folder_hot' : 'folder';
					$icon 	= ($topics[$k]['topic_sticky']) 	 ? 'folder_sticky' : $icon ;
					$icon 	= ($topics[$k]['topic_announcement']) ? 'folder_announce' : $icon ;

					$new 	= ($_SESSION['user']['user_lastvisit'] < $topics[$k]['last_post']) ? '_new' : '';

					if($new){
						switch($icon){
							case('folder'):
								$topics[$k]['topic_color'] = '#41BB3E';
							break;
							case('folder_hot'):
								$topics[$k]['topic_color'] = '#a93b3b';
							break;
							case('folder_sticky'):
								$topics[$k]['topic_color'] = '#f8f057';
							break;
							case('folder_announce'):
								$topics[$k]['topic_color'] = '#f8f057';
							break;
						}
					}else{
						$topics[$k]['topic_color'] = '#2075BF';
					}

					// output icon
					//$topics[$k]['topic_icon'] = "<img style='border: 1px solid black;' align='absmiddle' src='/me/images/HoGNight/".$icon.$new.".gif' />";
				}
			}

			$this->set('topics',$topics);

			return array(
				'success' => true,
				'data'	=> $topics,
				'total' => $q->mCountAll,
				'error'	=> $q->error,
				'sql'	=> $q->mSql
			);
		}

		/**
		 * @remotable
		 * @formHandler
		 */
		function saveTopic($f){
			$q = $this->q();

			$f['datetime']	= date('Y-m-d H:i:s');
			$f['user_id']	= (!$f['user_id']) ? $_SESSION['user']['id'] : $f['user_id'];

			if($f['id'] != ''){
				// Save Post to bulletin.
				$q->Update('BulletinPosts',$this->cleanExtF($f),array('id'=>$f['id']));
				$q->Update('BulletinTopics',array(
					'topic_title' 		=> $f['title'],
					'topic_timestamp' 	=> time(),
					'topic_publish'		=> $f['publish'],
					'last_poster'		=> $_SESSION['user']['username'],
					'excerpt'			=> strip_tags($f['html']),
				),array('id'=>$f['topic_id']));
			}else{
				// Save Post to bulletin.

				$forum_id = $this->getForumId($q,$f['category']);
				$q->Inc('Users','user_posts',1,array('id'=>$f['user_id']));
				$q->Insert('BulletinTopics',array(
					'topic_title' 		=> $f['title'],
					'topic_author_id' 	=> $f['user_id'],
					'topic_author'		=> $_SESSION['user']['username'],
					'topic_category' 	=> $f['category'],
					'topic_timestamp' 	=> time(),
					'last_post' 		=> time(),
					'last_poster'		=> $_SESSION['user']['username'],
					'excerpt'			=> strip_tags($f['html']),
					'topic_publish'		=> $f['publish'],
					'forum_id'			=> $forum_id
				));
				$f['topic_id'] = mysql_insert_id($q->mConn);
				$f['isTopic'] = 1;
				$q->Insert('BulletinPosts',$this->cleanExtF($f));

			}

			return array(
				'success' 	=> ($q->error == "") ? true : false,
				'error'		=> $q->error,
				'data'		=> $f,
				'sql'		=> $q->mSql,
			);
		}

		/**
		 * @remotable
		 */
		function loadTopic(){
			$q = $this->q();
			$user = $q->Select('*','BulletinPosts',array(
				'user_id'	=>	$_SESSION['user']['id'],
				'publish' => 'false'
			));
			$user = $user[0];

			/*
			$data = $q->Select(array(
					'BulletinPosts'=>array('*'),
			    	'People'=>array('first_name','last_name','email'),
		    	),array(
		    		'Tickets'=>'assigned_to',
		    		'People'=>'id'
		    	)
		    	);
			*/

			return array(
				"success"=>true,
				"data"=>$user
			);
		}

		/**
		 * @remotable
		 */
		function loadPost($id){
			$q = $this->q();
			$post = $q->Select('*','BulletinPosts',array(
				'id' =>	$id
			));
			$post = $post[0];
			return array(
				"success"=>true,
				"data"=>$post
			);
		}

		/**
		 * @remotable
		 * @formHandler
		 */
		function savePost($f){
			$q = $this->q();
			$q->Update('BulletinPosts',$this->cleanExtF($f),array('id'=>$f['id']));
			if($f['isTopic']){
				$q->Update('BulletinTopics',array(
					'topic_title' 		=> $f['title']
				),array('id'=>$f['topic_id']));
			}

			return array(
				"success"=>true,
				"data"=>$f
			);
		}


		function saveCategory($q,$text){
			$r = $q->Select('*','BulletinForums',array('text'=>$text));
			if(empty($r)){
				$q->Insert('BulletinForums',array(
					'text' => $text
				));
			}
		}

		function getForumId($q,$text){
			$r = $q->Select('id','BulletinForums',array('text'=>$text));
			$r = $r[0]['id'];
			return $r;
		}


		/**
		 * @remotable
		 * @formHandler
		 */
		function saveReply($f){
			$q = $this->q();
			$f['datetime']	= date('Y-m-d H:i:s');
			$f['user_id']	= $_SESSION['user']['id'];
			$f['publish']	= 'true';
			$f['topic_id'] = str_replace('topic-','',$f['topic_id']);
			$q->Insert('BulletinPosts',$this->cleanExtF($f));
			$f['post_id'] = mysql_insert_id($q->mConn);

			$q->Inc('BulletinTopics','topic_replies',1,array('id'=>$f['topic_id']));
			$q->Inc('Users','user_posts',1,array('id'=>$f['user_id']));

			$q->Update('BulletinTopics',array(
					'last_post'=>time(),
					'last_poster'=> $_SESSION['user']['username']
			),
				array( 'id'=>$f['topic_id'] )
			);


			return array(
				'success' => true,
				'data' 	=> $f,
				'sql' =>$q->mSql,
				'error' =>$q->error,
			);
		}

		/**
		 * @remotable
		 */
		function quickReply($id,$html,$title){
			return $this->saveReply(array(
				'topic_id' 	=> $id,
				'html'		=> $html,
				'title'		=> $title
			));
		}

		function topic($id){
			$q = $this->q();

			$topic 	= $q->Select('*','BulletinTopics',array('id'=>$id));
			$q->mBy = array('datetime'=>'asc');
			$posts 	= $q->Select('*','BulletinPosts',array('topic_id'=>$id));

			$this->set('topic',$topic[0]);
			$this->set('posts', $posts);
			$this->set('isAdmin', $this->IS_ADMIN);
			$this->set('user_id', $_SESSION['user']['id']);
			$this->set('topic_info', $topic[0]);
			$this->set('topic_path', $title);
		}
	}
?>