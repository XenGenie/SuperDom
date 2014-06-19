<?php
/**
 * @name Feeds
 * @desc Manage RSS Feeds
 * @version v0.03
 * @author XTiv
 * @icon Billboard-Feed-icon.png
 * @mini rss
 * @see radius
 * @link rss
 * @todo
 */

	class xRss extends Xengine{
		function read(){
			$request = $_GET['out'];
			$count = explode('/',$request);
			$count = count($count);
			if($count == 1){
				$request .= '/index';
			}
			$link = "http://$_SERVER[HTTP_HOST]/$request/?returnJson";
			echo $file =  $contents = file_get_contents($link);
			exit;
		}

		function autorun($sdx){
			/*$q = $this->q();
			$feed = $q->Select('*','RssFeeds',array(
				'url'=> $sdx->mCall
			));

			if(!empty($feed)){
				$feed 	= $feed[0];
				$this->inc('magpierss/rss_fetch.inc');
				$rss	= fetch_rss($feed['link']);
				$this->set('rss',$rss->items );
			}
*/
		}

		function add(){
			$feed = $_POST['feed'];
			$q = $this->q();
			unset($feed['id']);

			$q->Insert('RssFeeds',$feed);
			$this->set('success',true);
		}

		function index(){

			$q = $this->q();

			$feeds = $q->Select('*','RssFeeds');
			$this->set('feeds',$feeds);



			//$this->inc('magpierss/rss_fetch.inc');
			//$url = "http://lifesuxscumfuk.blogspot.com/feeds/posts/default";
			//$rss= fetch_rss($url);
			//$this->set('rss',$rss->items );


		}
	}

?>