<?php
	$location = '../../../libs/x4/';
	require_once($location.'SuperDomX.php');
	$SDX->inc('FileUpIndex.php')
	set_time_limit(0);


	$f = new FileUpIndex();
	$f->upload();
	echo $f->mFile['src'];
	exit;
?>