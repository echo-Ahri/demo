<?php
	// require './core/Upload.php';

	// var_dump($_FILES);
	echo json_encode($_FILES);
	echo json_encode($_POST);
	// var_dump(file_get_contents('php://input'));
	exit();

	$config['path'] = './uploads/imgs';
	$upload = new \uploads\Uploads(); 
	$res = $upload->uploadFile(); 
	echo json_encode($res);
	exit();