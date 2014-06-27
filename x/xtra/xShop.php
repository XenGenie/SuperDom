<?php
/**
 * @name Shop
 * @desc Online Web Shop
 * @version v1.0(14.06.09@02:00)
 * @author i@xtiv.net
 * @price $100
 * @icon shop-icon.png
 * @mini shopping-cart
 * @see market
 * @link shop
 * @todo
 * @delta
 */

	class xShop extends Xengine{
	var $importDir = '/xShop/files/';
	var $shelvesDir = '/xShop/shelves/';
		
		function dbSync(){
			return array(
				'shop_inventory_item'	 => array(
					'name'			=>	array('Type' => 'varchar(255)'),
					'sku'			=>	array('Type' => 'varchar(100)'),
					'viewed'		=>	array('Type' => 'int(8)'),
					'held'			=>	array('Type' => 'int(8)'), 
					'sold'			=>	array('Type' => 'int(8)'),
					'returned'		=>	array('Type' => 'int(8)'),
					'price'			=>	array('Type' => 'varchar(255)'),
					'stock'			=>	array('Type' => 'int(8)'),
					'tags'			=>	array('Type' => 'blob'),
					'rating'		=>  array('Type' => 'int(12)'),
					'votes'			=>  array('Type' => 'int(8)'),
					'first_added'	=> array('Type' => 'datetime'),
					'last_updated'	=> array('Type' => 'datetime'),
					'last_sold'		=> array('Type' => 'datetime'),
					'first_sold'	=> array('Type' => 'datetime')
				),
				'shop_inventory_pics' => array(
					'src'			=>	array('Type' => 'varchar(255)'),
					'item_id'		=>	array('Type' => 'varchar(255)'),
					'dimension'		=>	array('Type' => 'varchar(2)'),
				),
				'shop_inventory_attributes' => array(
					'item_id'		=>	array('Type' => 'int(8)'),
					'option'		=>	array('Type' => 'varchar(255)'),	
					'value'			=>	array('Type' => 'varchar(255)'), 
				), 
				// 'shop_orders'	=> array(
					 
				// ),
				// 'shop_settings'	=> array(
				// 	'config_value'		=>	array('Type' => 'blob'),
				// 	'config_option'		=>	array('Type' => 'varchar(255)')
				// ),
				// 'shop_customers' =>array( 
					
				// )
			);
		}
		
		/**
			@name catalog
			@blox Shop Catalog
			@desc Simple Easy to use Custom Code Blox
			@icon book
		**/
		public function catalog()
		{
			# code...
		}

		function index(){
			$f = array('label','price','stock','sold','id');
			$this->set('inventory_attr',	json_encode($f)	);
			
		}
 

		function upload($uploading){
			if($uploading==true){
				//error_reporting(E_ALL | E_STRICT);
				$this->lib('jQueryUploadHandler/UploadHandler.php');
				$upload_handler = new UploadHandler();
				exit;
			}

		}		

		function import()
		{
			if($_POST['shelf']){
				return $this->addToShelf($_POST);
			}else{
				return array('shelf' => $this->scanImgs() );
			}
		}

		private function addtoShelf($p){
			// Find the images that match the sku.
			$files = $this->scanImgs();
			$files = $files['files'];

			// Find Only the Files that match the sku
			foreach ($files as $key => $value) {
				if(!strstr($value, $p['shelf']['sku'])){
					unset($files[$key]);
				}
			}

			if( !is_dir(XPHP_DIR.$this->shelvesDir) ){
				mkdir(XPHP_DIR.$this->shelvesDir);
			}

			$dir = XPHP_DIR.$this->shelvesDir.$p['shelf']['sku'];
			if( !is_dir($dir) ){
				mkdir($dir);
				$count = 1;
			}else{
				$count = scandir($dir);
				$count = count($count);
			}




			// Attempt to add to the Database 

			$q = $this->q();
			$get = $q->Select('id','shop_inventory_item', array(
				'sku' => $p['shelf']['sku']
			));
			if(empty($get)){ 
				$add = $q->Insert('shop_inventory_item',$p['shelf']);
			}else{
				$add = $q->Update('shop_inventory_item',$p['shelf'],array(
					'sku' =>  $p['shelf']['sku']
				));
			}


			if($add ){
				// Move / Rename the images.
				$i=$count;


				$new_file = implode(',', $p['shelf']);

				foreach ($files as $key => $value){
					$file = XPHP_DIR.$this->importDir.$value;

					$ext = explode('.', $value);
					$ext = $ext[count($ext)-1];

					

					rename($file, $dir."/".$new_file.",($i).$ext");				
					$i++;
				}

			}

			

			// Count how many images
 
			return array(
				'success' => $add,
				'post' => $_POST,
				'files' => $files,
				'dir' => $dir,
				'error' => $q->error
			);
		}
 
		private function scanImgs()
		{
			function parseFileName($item,$i,$value){ 
				$cost 	=  $item[count($item)-1];
				unset($item[count($item)-1]);

				$sku 	=  $item[count($item)-1];
				unset($item[count($item)-1]);

				$name = implode(' ', $item);

				$filename = [$name,$sku,$cost];

				//echo rename ( $dir.$value , $dir.'../'.$filename.'.jpg');
				$hash = str_replace(' ', '-', $name);
				$type[$hash] = $name;
				return array(
					'name' => $name, 
					'sku' => $sku,
					'cost' => $cost, 
					'pic'  => $value,
					'hash' => $hash
				);
			}


			$dir    = XPHP_DIR.'/xShop/files/';
			$files = scandir($dir,0); 

			$start = ($_GET['start']) ? $_GET['start'] : 0;
			$limit = ($_GET['limit']) ? $_GET['limit'] : 10;

			foreach ($files as $key => $value) {	// Amethyst Light R85 $133 (2).JPG 
				
				if($value != '.' && $value != '..'){
					$item = explode('.', $value); 		// [Amethyst Light R85 $133 (2)] [JPG] 
					$item = $item[0]; 			  		// Amethyst Light R85 $133 (2) 
					$item = explode(' ', $item);		// [Amethyst] [Light] [R85] [$133] [(2)] 
					
					if($item[count($item)-1] == ''){
						unset($item[count($item)-1]);
					}

					if(strstr($item[count($item)-1], '$')){ 
						$item = parseFileName($item,1,$value);
						$shelf[$item['sku']] = $item; 
					} else {
						// $item = parseFileName($item,2);
						// $shelf[$item['sku']] = $item;
					}
				}


			}

			$shelf = array_slice($shelf,$start,$limit);	

			foreach ($shelf as $key => $value) {
				//echo rename ( $dir.$value , $dir.'../'.$filename.'.jpg');
				$type[$value['hash']] = $value['name'];
				# code...
			}

			$this->set('shelf',$shelf);

			# code...
			return array(
				'shelf' => $shelf,
				'files'	=> $files
			);
		}

		function jumbotron(){
			// Pull the Jumbotron from somewhere online... That way we can keep the DOCs updated for all...?			
		}

		function topX(){
			$dir    = XPHP_DIR.'/xShop/files/';
			$files = scandir($dir,0); 

			$this->set('topX',array(
				'import' => count($files)-2
			));

		}

		function wizardItem(){
			
		}

		function shelves()
		{
			# code...
		}

		function brick(){
			
		}

		function readImgDir(){

			
		if ($handle = opendir('./img/shop')) {
		    echo "Directory handle: $handle\n";
		    echo "Entries:\n";

		    /* This is the correct way to loop over the directory. */
		    while (false !== ($entry = readdir($handle))) {

		    	$item = explode(' ', $entry);

		        ?>

			        <div class="product large">
						<div class="media">
						<?php echo $entry;?>
							<a href="product.html" title="product title">
								<img src='img/shop/<?php echo $entry;?>' alt="product title" data-img="product-1" class="img-responsive" />
							</a>
							<span class="plabel">just in</span>				
						</div>
						<div class="details">
							<p class="name">
								<a href="product.html">
									<?php echo $item[0];	?>
								</a>
							</p>
							<p class="price"><!-- <span class="cur">$</span> --><span class="total"><?php echo $item[2];	?></span></p>
							<a href="" class="details-expand" data-target="details-0001">+</a>
						</div>
						<div class="details-extra" id="details-0001">
							<form class="form-inline" action="#">
								<div>
									<label>Quantity</label>	
									<input type="text" class="input-sm form-control quantity" value="1">
								</div>
								<div>
									<label>Size</label>
									<select class="input-sm form-control size">
										<option>S</option>
										<option>M</option>
										<option>L</option>										
									</select>
								</div>
							</form>
							<button class="btn btn-bottom btn-atc qadd">Add to cart</button>			
						</div>
					</div>

		        <?php 
		    }
 

		    closedir($handle);
		}

			
		}


		function inventory(){
			
		}
	}

?>