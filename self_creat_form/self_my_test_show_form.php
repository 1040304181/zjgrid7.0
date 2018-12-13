<meta charset="UTF-8"> 
<?php 
$ID=$_REQUEST['ID']; 
$index=$_REQUEST['index']; 
$class1=$_REQUEST['class1']; 
 
	//是否需要显示归还按钮 
require_once "../connect/toolconnect.php"; 
$id = intval( $mysqli ->real_escape_string(trim($_GET['ID']))); 
$sql = "select * from ".$class1." where ID= {$id}"; 
$rs = $mysqli ->query($sql); 
$row = $rs ->fetch_assoc(); 
if($row['sub']!=1) { 
	echo 	"<a class='easyui-linkbutton' data-options=\"iconCls:'icon-edit'\" onclick=\"returnapp(".$ID.",'".$class1."')\">编辑</a>";//不跳转直接改成连接 
} 
	echo("<br>"); 
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
