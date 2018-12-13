<?php
$data =$_POST['data'];
$id =$_POST['ID'];
$class1 =$_POST['class1'];
$person =$_POST['person'];
$encoded_image = explode(",", $data)[1];
$decoded_image = base64_decode($encoded_image);
$filename="sign/".$class1."/".md5($id.$person).".png";
//判断目录是否存在，否则创建
	$path=dirname($_SERVER['SCRIPT_FILENAME'])."/sign/".$class1;
echo($path);
	if(!file_exists($path)){  // 判断存放文件目录是否存在
		mkdir($path,0777,true);
	} 
//返回的数据
echo $filename;
file_put_contents($filename, $decoded_image);	
//在图片上添加水印防伪
	//创建图片的实例
	$dst = imagecreatefromstring(file_get_contents($filename));
	//保留透明 设置标记以在保存 PNG 图像时保存完整的 alpha 通道信息
	imagesavealpha($dst, true);
	//打上文字
	$font = './arial.ttf';//字体
	$black = imagecolorallocate($dst, 0xf5, 0xf5, 0xf5);//字体颜色
	imagefttext($dst, 15, 1, 20, 180, $black, $font, md5($id.$person));
	//输出图片
	list($dst_w, $dst_h, $dst_type) = getimagesize($filename);
	switch ($dst_type) {
		case 1://GIF
			header('Content-Type: image/gif');
			imagegif($dst);
			break;
		case 2://JPG
			header('Content-Type: image/jpeg');
			imagejpeg($dst);
			break;
		case 3://PNG
			header('Content-Type: image/png');
			imagepng($dst);
			break;
		default:
			break;
	}
	imagepng($dst,$filename);
	imagedestroy($dst);

?>
