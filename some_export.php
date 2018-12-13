<?php 
//可更新为phpexcel
header("Content-type:text/html;charset=utf-8"); 
//文件生成
	//得到数据
	require_once "connect/toolconnect.php"; 
	$class1=$_GET['class1'];
	$rs = mysql_query("select * from ".$class1);//需要注意bug
//$content="ID,toolname,type,num,cause,borrowtime,borrower,tel,borrowadmin,deadline,returntime,returnadmin,mortgage,note\n";
$content="序号,名称,编号,型号,数量,事由,借用时间,借用人,电话,借用管理人,最后期限,归还时间,归还人,归还管理人,抵押,备注,是否归还\n";

	while($row = mysql_fetch_assoc($rs)) {
	$content.=$row['ID'].','.$row['name'].','.$row['NO'].','.$row['type'].','.$row['num'].','.$row['cause'].','.$row['borrowtime'].','.$row['borrower'].','.$row['tel'].','.$row['borrowadmin'].','.$row['deadline'].','.$row['returntime'].','.$row['returner'].','.$row['returnadmin'].','.$row['mortgage'].','.$row['note'].','.$row['sub']."\n";
	}	
	$file_sub_path=$_SERVER['DOCUMENT_ROOT']."/zjgrid/down/";
	$file_name=date().$class1.".csv";
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