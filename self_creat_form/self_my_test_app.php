<?php
	
 require_once "../connect/toolconnect.php";
	
 session_start(); 
 if(empty($_SESSION['user'])) {
		
 echo("<script>alert('归还信息填写不完整！'); </script>");
		
	header("Location: ../login.php");
		
 } 
function make_log($log_str) {
date_default_timezone_set("PRC");
	$log_file = "../log/" . date("Y") . "/" . date("m") . "/" . date("Y-m-d") . ".log";
	if (!file_exists(dirname($log_file))) {
		mkdir(dirname($log_file), 0700, true);
	}
	$content = $log_str;
	$content .= "\r\n\n";
	file_put_contents($log_file, date("Y-m-d H:m:s") . $content, FILE_APPEND);
}
$id= $mysqli ->real_escape_string(trim($_POST['ID']));
$ctr= $mysqli ->real_escape_string(trim($_GET['ctr']));
$my_name= $mysqli ->real_escape_string(trim($_POST['my_name']));
$my_file= $mysqli ->real_escape_string(trim($_POST['my_file']));
$my_some= $mysqli ->real_escape_string(trim($_POST['my_some']));
$my_biao= $mysqli ->real_escape_string(trim($_POST['my_biao']));
$my_note= $mysqli ->real_escape_string(trim($_POST['my_note']));
$my_love= $mysqli ->real_escape_string(trim($_POST['my_love']));
$temp_my_love="";
for($ii=0; $ii<sizeof($_POST['my_love']); $ii++) {
	$temp_my_love.=$_POST['my_love'][$ii].";;";
}
$my_lovea= $mysqli ->real_escape_string(trim($_POST['my_lovea']));
$my_loveb= $mysqli ->real_escape_string(trim($_POST['my_loveb']));
$temp_my_loveb="";
for($ii=0; $ii<sizeof($_POST['my_loveb']); $ii++) {
	$temp_my_loveb.=$_POST['my_loveb'][$ii].";;";
}
$my_lovec= $mysqli ->real_escape_string(trim($_POST['my_lovec']));
$my_time= $mysqli ->real_escape_string(trim($_POST['my_time']));
$sql_edit="update `self_my_test` set my_name='{$my_name}', my_file='{$my_file}', my_some='{$my_some}', my_biao='{$my_biao}', my_note='{$my_note}', my_love='{$temp_my_love}', my_lovea='{$my_lovea}', my_loveb='{$temp_my_loveb}', my_lovec='{$my_lovec}', my_time='{$my_time}' where ID = '{$id}'";
$sql_add3="INSERT INTO `self_my_test` ( `my_name`, `my_file`, `my_some`, `my_biao`, `my_note`, `my_love`, `my_lovea`, `my_loveb`, `my_lovec`, `my_time`)values('{$my_name}', '{$my_file}', '{$my_some}', '{$my_biao}', '{$my_note}', '{$temp_my_love}', '{$my_lovea}', '{$temp_my_loveb}', '{$my_lovec}', '{$my_time}')";
$sql = "select * from self_my_test where ID= {$id}"; 
$rs = $mysqli ->query($sql); 
$row = $rs ->fetch_assoc(); 
  
if($ctr=='add'){
 	if($row['ID']==$id){
		$log_str.="[my_test ==]请勿重复添加！";
		echo "<script>alert('请勿重复添加！');</script>";
	}else{
		if($mysqli ->query($sql_add3)) {	
			$log_str.="[my_test add]添加成功! sql_add3".$sql_add3;
			echo "<script>alert('添加成功！');</script>";
		}else{
			$log_str.="[my_test add]添加失败！ sql_add3".$sql_add3;
			echo "<script>alert('添加失败！');</script>";
		}
	}
}elseif($ctr=='edit'){
	if($mysqli ->query($sql_edit)) {
		$log_str.="[my_test edit]更新成功！! sql_edit".$sql_edit;
		echo "<script>alert('更新成功！');window.history.back();</script>$sql_edit";
	}else{
		$log_str.="[my_test edit]更新失败！! sql_edit".$sql_edit;
		echo "<script>alert('更新失败！');</script>";
	}
}
 $mysqli->close();
 make_log($log_str); 
?>