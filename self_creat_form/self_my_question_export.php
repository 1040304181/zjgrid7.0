
<?php
include "../connect/toolconnect.php";
$rs = $mysqli ->query("select * from ".$_GET['class1'] );
$row = $rs ->fetch_row();
$content="姓名,年龄,简介,物资表,备注\n";
	while($row = $rs ->fetch_assoc()) {
	$content.=$row['my_name'].','.$row['my_age'].','.$row['my_some'].','.$row['my_biao'].','.$row['my_note']."\n";
	}
	$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/zjgrid/down/";
	$file_name=date().$_GET['class1'].".csv";
	$file_path=$file_sub_path.$file_name;
file_put_contents($file_path, $content);
//文件导出
	//用以解决中文不能显示出来的问题
	$file_name=iconv("utf-8","gb2312",$file_name);
	//首先要判断给定的文件存在与否
	if(!file_exists($file_path)){
	echo "没有该文件文件";
	return ;
	}
	$fp=fopen($file_path,"r");
	$file_size=filesize($file_path);
	//下载文件需要用到的头
	Header("Content-type: application/octet-stream");
	Header("Accept-Ranges: bytes");
	Header("Accept-Length:".$file_size);
	Header("Content-Disposition: attachment; filename=".$file_name);
	$buffer=1024;
	$file_count=0;
	//向浏览器返回数据
	while(!feof($fp) && $file_count<$file_size){
	$file_con=fread($fp,$buffer);
	$file_count+=$buffer;
	echo $file_con;
	}
	fclose($fp);
?>
