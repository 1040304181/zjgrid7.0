	<meta charset="UTF-8">
<?php
	$class1=$_REQUEST['class1'];
	$ID=$_REQUEST['ID'];
	$index=$_REQUEST['index'];
	$borrower_img = 'canvas/sign/'.$class1."/".md5($ID.'borrower').'.png';
	$borrowadmin_img = 'canvas/sign/'.$class1."/".md5($ID.'borrowadmin').'.png';
	$returnadmin_img = 'canvas/sign/'.$class1."/".md5($ID.'returnadmin').'.png';
	$sign_img='canvas/sign/sign.png';
	$table="zj_".$_GET['class1']."_register_form";

echo("<div style='border:1px solid #ff9900'>");

if (file_exists($borrower_img)) {
	echo "<span>借用人签名：</span><img class='signimg'  src='".$borrower_img." ' alt='请签名' />";
} else {
	echo "<span>借用人签名：</span><img class='unsignimg' src='".$sign_img." ' alt='请签名'   onclick='signapp(".$ID.",\"borrower\",".$index.")' />";
}
if (file_exists($borrowadmin_img)) {
	echo "<span>借用管理人签名：</span><img class='signimg'  src='".$borrowadmin_img." 'alt='请签名' />";
} else {
	echo 	"<span>借用管理人签名：</span><img class='unsignimg' src='".$sign_img." 'alt='请签名' onclick='signapp(".$ID.",\"borrowadmin\",".$index.")' />";
	}
if (file_exists($returnadmin_img)) {
	echo "<span>归还管理人签名： </span><img class='signimg'  src='".$returnadmin_img." ' alt='请签名'/>";
} else {
	echo 	"<span>归还管理人签名： </span><img class='unsignimg' src='".$sign_img." ' alt='请签名' onclick='signapp(".$ID.",\"returnadmin\",".$index.")'/>";
	}
//是否需要显示归还按钮
	require_once "connect/toolconnect.php";
	$id = intval(trim($_GET['ID']));
	$sql = "select * from ".$class1." where ID= {$id}";
	$rs = mysql_query($sql);
	$row = mysql_fetch_assoc($rs);
	if($row['sub']!=1) {
		echo 	"<a class='easyui-linkbutton' data-options=\"iconCls:'icon-edit' \" onclick=\"returnapp(".$ID.",'".$class1."')\">归还</a>";//不跳转直接改成连接
//		echo 	"<a class='easyui-linkbutton' data-options=\"iconCls:'icon-edit' \" onclick='returnapp(".$ID.",".$class1.")'>归还</a>";//不跳转直接改成连接
	}
	echo("<br>");
//显示照片
echo("借出时：<div style='border:1px solid #99cc66'>");
	$path = "./uploadfile/".$class1."/".$ID."/before";
	foreach(getfiles($path)as $key=>$val) {
		echo("<img class='evidenceimg' src=\"".$val."\" width=400px height=400px>");
	}
echo("</div>归还时：<div style='border:1px solid #0066ff'>");
	$path = "./uploadfile/".$class1."/".$ID."/after";
	foreach(getfiles($path)as $key=>$val) {
		echo("<img class='evidenceimg' src=\"".$val."\" width=400px height=400px>");
	}

echo("</div><font size='1' color='#ff9999'>图片点击放大</font></div>");
function getfiles($path){
   if(!is_dir($path)) return;
   $handle  = opendir($path);
   $files = array();
   while(false !== ($file = readdir($handle))){
    if($file != '.' && $file!='..'){
     $path2= $path.'/'.$file;
     if(is_dir($path2)){
     getfiles($path2);
     }else{
        if(preg_match("/\.(gif|jpeg|jpg|png|bmp)$/i", $file)){
        $files[] = $path.'/'.$file;
     }
     }
    }
   }
   return $files;
}
?>
<style>

.signimg:active{
	cursor: -webkit-zoom-in;
	height:90px;
	width:270px;
}
.signimg{
	cursor: -webkit-zoom-in;
height:30px;
width:90px;
}
.unsignimg{
	cursor:pointer;
	height:30px;
width:90px;
}
.evidenceimg{
	height:50px;
	width:50px;
}
.evidenceimg:active{
	height:300px;
	width:300px;
}
</style>
