<?php
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
	require('../../../index.php');
	
	class FileUpCheck extends SuperDomX{
		function check(){
			$this->fileArray = array();
			
			$q = $this->q();
			foreach ($_POST as $key => $value) {
				if ($key != 'folder') {
					
					$name 	= explode('.',$value);
					$ext 	= $name[count($name)-1];
					unset($name[count($name)-1]);
					
					$name 	= implode('.',$name);
					$folder = str_replace("/{$toBackDoor}/",'',$_POST['folder']);
					
					$exists = $q->Select('*','FileUploads',
						array(
							'file_parent'	=> $folder,
							'file_name'		=> $name,
							'file_ext'		=> $ext
						)
					);
					
					
					
					//$size = 'null';
					
					if (!empty($exists)) {
						$size = $this->bytesToSize1024($exists[0]['file_size']);			
						$this->fileArray[$key] = $value; // "\"$name.$ext\" ~ ($size)";
					}else{
						
					}
				}
			}		
		}
	}
	$f = new FileUpCheck();
	$f->check();
	if(empty($f->fileArray)){
		echo '{}';
		exit;
	}
	echo $f->out($f->fileArray);
	exit;	
?>