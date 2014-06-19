<?php
/**
 * @name Wormhole
 * @desc Weave Web places into instant links shared between users
 * @version v0.1.11.03.01.10.00
 * @author cdpollard@gmail.com
 * @price $?
 * @see community
 * @link
 * @todo
 */

	class xWormhole extends Xengine{
		function isValidURL($url)
		{
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		}


		function mostVisited(){

			$q = $this->q();

	    	$q->mBy = array(
	    		'accessed' => 'DESC'
	    	);

	    	$q->setStartLimit(0,16);
	    	$orbs = $q->Select('*','UMeOrbs'," `user_id` = ".$_SESSION[user][id]." AND `cmd` LIKE '%http://%' ",'LEFT','LIKE');

	    	// Lets edit some of this data. like making thumbnails.
	    	if( !empty($orbs) ){
	    		foreach($orbs as $k => $v){
					$orbs[$k]['name'] = addslashes( strip_tags($v['name']) );
	    			if($v['pic'] == ''){
						// Is it a website?
						if( $this->isValidUrl($v['cmd']) ){
							//$v['url'] = base64_encode($v['cmd']);
							$orbs[$k]['pic'] = "http://www.umeos.com/os/api/shrink/".base64_encode($v['cmd']);

						}else{
						// Probably a local app then
							$orbs[$k]['pic'] = "/me/images/icons/$v[cmd]-big.png";
							unset($orbs[$k]);
						}


					}
	    		}
	    	}
	    	$this->set('orbs',$orbs);
		}

		function css($build){
			$q = $this->q();
			switch($build){
				case('domains'):
					$domains = $q->Select('domain','Wormholes');
					if(!empty($domains)){
						foreach($domains as $row => $cell){
							// Default Location

							$dom = parse_url($cell['domain']);

							$dom = ($dom['host']) ? $dom['host'] : $cell['domain'];

							$domain[$dom] = $dom;
						}
					}

					if(!empty($domain)){
						foreach($domain as $dom => $v){
							$favicon = "http://$dom/favicon";

							// File Types.
							$favicons['ico'] = '.ico';
							$favicons['png'] = '.png';
							$favicons['gif'] = '.gif';
							$favicons['jpg'] = '.jpg';
							$favicons['jpeg'] = '.jpeg';

							// Loop Check
							foreach($favicons as $i => $ico){
								if(!file_exists($favicon.$ico)){
									// Delete
									unset($favicons[$i]);
								}else{
									$favicons[$i] = $favicon.$ico;
									//file_put_contents($dir."favicon-".$dom.$ico,$getIco);
								}
							}

							// Favicon Found
							if(!empty($favicons)){
								$fav = $favicons;
								// Prefer GIF over PNG over ICO then w/e
								$icon = ($fav['gif']) 	? $fav['gif'] 	: null;
								$icon = ($icon) 		? $icon 		: ($fav['png']);
								$icon = ($icon) 		? $icon 		: ($fav[0]);

								$css .= "
			.x-favicon-$dom{
			background-image: url($favicons[0]) !important;
			}
			";

							}
						}
					}
					$dir = "$_SERVER[DOCUMENT_ROOT]/me/css/";
					if(!is_dir($dir)){
						mkdir($dir,0755,true);
					}
					file_put_contents($dir."domains.css",$css);

				break;
			}
			echo $css;
			exit;
		}
	}

?>