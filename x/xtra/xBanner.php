<?php
/**
 * @name Banners
 * @desc Dynamic Banners for Specify Effects.
 * @version v0.1.08.23.03.01
 * @author cdpollard@gmail.com
 * @icon billboard.png
 * @mini desktop
 * @price $5
 * @see navigate
 * @link banner
 * @todo
 */


	class xBanner extends Xengine{
		 
		/*
		 * List banners.
		 */
		function index(){
			$banners = $this->q()->Select('*','Banners');
			$this->set('banners',$banners);
		}

		function delete($id){
			$banner = $this->q()->Select('*','Banners',array('id'=>$id));
			$banner = $banner[0];
			$this->q()->Delete('Banners',array('id'=>$id));

			$this->set('success','Deleted Banner '.$banner['title']);
		}

		function add(){
			if($_POST['banner']){
				// We need to upload the file to the web as well...
				$target_path = XPHP_DIR."/xBanner";
				if(!is_dir($target_path)){
					mkdir($target_path);
				}
				$filename =  basename( $_FILES['banner-photo']['name']);
				$target_path = $target_path . '/'.$filename;
				move_uploaded_file($_FILES['banner-photo']['tmp_name'], $target_path);

				$_POST['banner']['target_path'] = $filename;
				$this->q()->Insert('Banners',$_POST['banner']);

				$this->set('success',true);
				if($this->q()->error){
					$this->set('success',false);
					$this->set('error',$this->q()->error);
				}
				echo '{success:true, file:'.json_encode($_FILES['banner-photo']['name']).'}';
				exit;
			}
		}

		function buildXml(){
			$banners = $this->q()->Select('*','Banners');
			foreach($banners as $k => $b){
				$photos .= "<photo path='http://$_SERVER[HTTP_HOST]/@/xphp/xBanner/$b[target_path]' link='http://$_SERVER[HTTP_HOST]$b[url]' ></photo>
";
			}

			$contents = "<?xml version='1.0'?>
	<jpgrotator>
		<parameters>
			<rotatetime>7</rotatetime>
			<randomplay>false</randomplay>
			<shownavigation>false</shownavigation>
			<transition>fade</transition>
		</parameters>

		<photos>
			$photos
		</photos>
	</jpgrotator>
";

			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/jpgrotator.xml',$contents);
			$this->set('buildXml',$contents);
		}

		/**
		@name carousel
		@blox Billboard
		@icon image
		@desc Rotate through Images, each having its own caption & destination
		**/
		public function carousel($value='')
		{
			# code...
		}

		/**
			@name landmark
			@blox Landmark
			@desc Every great website deserves A Professionally Sexy Coverpage
			@icon flag
		**/
		public function landmark()
		{
			# code...
		}
	}

?>