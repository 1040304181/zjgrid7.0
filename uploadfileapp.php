<?php
	$fileName = $_FILES['file']['name'];
	$type = $_FILES['file']['type'];
	$size = $_FILES['file']['size'];
	$fileAlias = $_FILES["file"]["tmp_name"];
	$path=dirname($_SERVER['SCRIPT_FILENAME'])."/uploadfile/".$_GET["class"]."/".$_GET["id"]."/".$_GET["method"]."/";
	if(!file_exists($path)){  // 判断存放文件目录是否存在
		mkdir($path,0777,true);
	} 
	   if(file_exists($picName)){
		echo "<font color='#FF0000'>同文件名已存在！</font>";
		exit;
	 }
	if(!is_uploaded_file($fileAlias)){  
		echo "<font color='#FF0000'>文件未上传！</font>";
		exit;
	}
	if(!move_uploaded_file($fileAlias, $path.$fileName)) {
		echo("文件移动失败！".$path.$fileName."  ");
	}
	echo 'fileName: '.$fileName.', fileType: '.$type.', fileSize: '.($size / 1024) . 'KB, id: '.$_GET["id"];
function console_log($data)  
{  echo("<script>console.log('".$data."');</script>");
}
?>