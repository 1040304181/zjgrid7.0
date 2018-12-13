<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/easyui_themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./css/easyui_themes/icon.css">
	<script type="text/javascript" src="./js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="./js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="./js/easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="./js/datagrid-filter.js"></script>
</head>
<body >
<div class='top'>
	<img src="./img/1.png" style ="float:left" height="60" border="0" alt=""></img><h1 style ="float:left">四川分公司</h1>
	<div id="result" style ="float:right">
	<?php
	session_start();
	include("connect/toolconnect.php");
	if(isset($_SESSION['user'])){
	?>
	<strong><?php echo($_SESSION['user']);?></strong>，恭喜您登录成功！<a href='javascript:void(0)' id="logout"   >退出</a>

	<?php }else{
		echo("<a href='javascript:void(0)' onClick=\"openTabA('登录','login.php')\" >请登录</a>");
	}?>
	</div>
<script type="text/javascript" >
$(function(){
//		关闭登录对话框
	$('#logout').click(function () {
		logout();
	})
})
	function logout(){
		$.ajax({
			type:"post",
			dataType: "json",
			url:"login_do.php?action=logout",
			success: function(json){
				if(json.logout==1){
					parent.location.reload();
				}else{
					$("#msg").remove();
					return false;
				}
			}
		});

	};
</script>
</body>
</html>
