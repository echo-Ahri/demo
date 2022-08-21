<?php
	require './core/Upload.php';

	$config['path'] = './uploads/imgs';
	$upload = new \uploads\Uploads(); 
	$res = $upload->uploadFile(); 
	echo json_encode($res);
	exit();