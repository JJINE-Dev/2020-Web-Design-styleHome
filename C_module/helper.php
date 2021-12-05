<?php

use App\{DB, Session};

function view ($page, $data = []) 
{
    extract($data);
    include_once VIEW . "/" . "/header.php";
    include_once VIEW . "/" . $page . ".php";
    include_once VIEW . "/" . "/footer.php";
}

function session()
{
	return new Session();
}

function user()
{
	return session()->get('user', true);
}

function upload($file) {
	$filename = $file['name'];
	if($filename == ''){
		back("사진을 선택해주세요.");
	}

	$filename = time() . "_" . $filename;
	move_uploaded_file($file['tmp_name'], __UPLOAD . __DS . $filename);
	return $filename;
}

function ajaxValidation($datas) {
	foreach ($datas as $key => $data) {
		if(trim($data) == ''){
			returnJSON(["msg" => '누락된 항목이 있습니다.', "result" => false]);
		}
	}

	return $datas;
}

function validation($datas)
{
	foreach ($datas as $key => $data) {
		if(trim($data) == ''){
			back('누락된 항목이 있습니다.', 'alert');
		}
	}

	return $datas;
}


function redirect($url, $msg, $type = 'msg')
{
	session()->set($type, $msg);
	header("location: $url");
	exit;
}

function back($msg, $type = 'error')
{
	session()->set($type, $msg);
	echo "<script>history.back()</script>";
	exit;
}

function output($str)
{
	return str_replace(' ', '&nbsp;', str_replace('\n', '<br>',htmlentities($str)));
}

function returnJSON($obj)
{
	echo json_encode($obj, JSON_UNESCAPED_UNICODE);
	exit;
}