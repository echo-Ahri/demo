<?php
	require_once './common.php';

	$input['stu_name'] = $_POST['stu_name'];
	$input['stu_class'] = $_POST['stu_class'];
	$input['stu_jz'] = $_POST['stu_jz'];
	$input['rx_time'] = $_POST['rx_time'] ? strtotime($_POST['rx_time']) : '';
	$input['remark'] = $_POST['remark'];
	$input['create_time'] = time();

	$info = $database->get("student", "id", [
	    "stu_name" => $input['stu_name'],
	    "stu_jz" => $input['stu_jz'],
	]);
	if($info){
		echo json_encode(['status' => 0, 'msg' => '当前学生家长已经存在了']);
		exit();
	}

	$res = $database->insert("student", $input);
	if($res){
		echo json_encode(['status' => 1, 'msg' => '添加信息成功']);
		exit();
	}

	echo json_encode(['status' => 0, 'msg' => 'error']);
	exit();

