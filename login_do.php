<?php
session_start();
include ('connect/toolconnect.php');
$action = $_GET['action'];
if ($action == 'login') { // 登录
	$user = $mysqli -> real_escape_string(trim($_POST['user']));
	$pass = $mysqli -> real_escape_string(trim($_POST['pass']));

	if (empty($user)) {
		echo('用户名不能为空');
		exit;
	}
	if (empty($pass)) {
		echo('密码不能为空');
		exit;
	}
	$md5pass = md5($pass); //密码使用md5加密
	$query = "select id,username,password,login_time,login_ip,login_counts from user where username='$user'";
	if ($result = $mysqli -> query($query)) {
		$row = $result -> fetch_assoc();
		$ps = $md5pass == $row['password'];
		$result -> free();
	}

	if ($ps == 1) {
		$counts = $row['login_counts'] + 1;
		$_SESSION['user'] = $row['username'];
		$_SESSION['login_time'] = date('Y-m-d H:i:s', $row['login_time']);
		$_SESSION['login_counts'] = $counts;
		$ip = get_client_ip(); //获取登录IP
		$logintime = time();
		$rs = $mysqli -> query("update user set login_time='$logintime',login_ip='$ip',login_counts='$counts'");
		if ($rs) {
			$arr['success'] = 1;
			$arr['msg'] = '登录成功！';
			$arr['user'] = $_SESSION['user'];
			$arr['login_time'] = $_SESSION['login_time'];
			$arr['login_counts'] = $_SESSION['login_counts'];
		} else {
			$arr['success'] = 0;
			$arr['msg'] = '登录失败';
		}
	} else {
		$arr['success'] = 0;
		$arr['msg'] = '用户名或密码错误！';
	}
	$mysqli -> close();
	echo(json_encode($arr)); //输出json数据
} elseif ($action == 'logout') { // 退出
	unset($_SESSION);
	session_destroy();
	$arr['logout'] = 1;
	echo(json_encode($arr));
}

function get_client_ip() {
	$ip = $_SERVER['REMOTE_ADDR'];
	return($ip);
}

