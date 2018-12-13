<?php
$dst_path = '4borrower.png';
$dst_path1 = '4borrower1.png';
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
//保留透明 设置标记以在保存 PNG 图像时保存完整的 alpha 通道信息
imagesavealpha($dst, true);
//打上文字
$font = './arial.ttf';//字体
$black = imagecolorallocate($dst, 0xf0, 0xf0, 0xf0);//字体颜色
imagefttext($dst, 13, 1, 20, 40, $black, $font, '1231');
//输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
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
imagepng($dst,$dst_path1);
imagedestroy($dst);
?>