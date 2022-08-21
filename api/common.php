<?php
	require_once './core/Medoo.php';
	//初始化配置
	$database = new \Medoo\medoo([ //数据库连接
	    'database_type' => 'mysql',
	    'database_name' => 'student',
	    // 'server' => '127.0.0.1',
	    'server' => 'localhost',
	    'port' => 3306,
	    'username' => 'root',
	    'password' => 'ROOT',
	    'charset' => 'utf8'
	]);