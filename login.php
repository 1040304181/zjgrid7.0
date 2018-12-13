<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>华能新能源</title>
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/icon.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="js/easyui-lang-zh_CN.js"></script>
</head>
<body>
	<?php
	session_start();
	include "connect/toolconnect.php";
	if(isset($_SESSION['user'])){
	?>
		<div id="result" >
		<p><strong><?php echo( $_SESSION['user']);?></strong>，1恭喜您登录成功！</p>
		<p>您这是第<span><?php echo( $_SESSION['login_counts']);?></span>次登录本站。</p>
		<p>上次登陆本站的时间是：<span><?php echo( date('Y-m-d H:i:s',$_SESSION['login_time']));?> </span></p>
		<a href='javascript:void(0)' id="logout"   >【退出1】</a>
	   </div>
	<?php }else{
		echo( "<a href='javascript:void(0)' id='loginbt'>请登录</a>");
	}?>
<!--  登录-->
	<div id="logindlg" class="easyui-dialog" title="Basic Dialog" data-options="iconCls:'icon-save'" style="width:400px;height:200px;padding:10px">
		<form id="ff"  enctype="multipart/form-data">
			<table>
				<tr>
					<td>用户名</td>
					<td><input name="username" id="username" type="text"   class="easyui-validatebox" data-options="required:true,missingMessage:'请填写登录名'"></input></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type = "password" type="text" name = "userpwd" id = "userpwd" class="easyui-validatebox" data-options="required:true,missingMessage:'请填写密码'"/></td>
				</tr>
				<tr>
					<td></td>
					<td><a class="easyui-linkbutton" iconcls="icon-ok" href="javascript:void(0)" id="login">登录</a></td>
				</tr>
			</table>
		</form>
	</div>
<script type="text/javascript" >
$(function(){
//		关闭登录对话框
//		$('#logindlg').window('close');
	//	打开登录对话框
		$('#loginbt').click( function () {
		$('#logindlg').window('open');

	})
		//保障页面加载完毕后程序方可运行
	$('#login').click(function () {
		login();
	})

	$('#logout').click(function () {
		logout();
	})
})
	//ajax 提交
	function login(){
		var user = $("#username").val();
		var pass = $("#userpwd").val();
		if(user==""){
			$("#username").focus();
			return false;
		}
		if(pass==""){
			$("#userpwd").focus();
			return false;
		}
		//ajax异步提交
		$.ajax({
			type: "POST",   //post提交方式默认是get
			url: "login_do.php?action=login",
			data: {"user":user,"pass":pass},
			dataType: "json",
			success: function(json){
				if(json.success==1){
//					location.reload();//刷新当前页面
					parent.location.reload();//刷新父对象
				}else{
					$("#msg").remove();
					return false;
				}
			}
		});
		$('#logindlg').window('close');
	}
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




