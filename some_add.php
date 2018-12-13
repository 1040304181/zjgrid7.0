<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/icon.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="js/easyui-lang-zh_CN.js"></script>
	<script src="js/uploadfile.js"></script>
	<link rel="stylesheet" href="css/fileupdemo.css"/>

</head>
	<title>新增</title>
<body>
	<?php

$url=$_GET['class1'];
switch($_GET['class1']) {
	case 'tool':
		$title="工器具";
	break;
	case 'key':
		$title="钥匙";
	break;
	case 'spare':
		$title="备品备件";
	break;
	case 'document':
		$title="资料";
	break;
	case 'other':
		$title="其他";
	break;
}
	require_once "connect/toolconnect.php";
	$rs = mysql_query("select * from {$url}");
	//总记录数
	$newnums = mysql_num_rows($rs)+1;

?>

<div class="easyui-panel" title="<?php  echo($title);?>借用登记表借用" style="padding:20px 20px;">
	<div style ="float:left">
		<form id="<?php echo $url;?>" name="<?php echo $url;?>" method="POST" action="some_app.php?class1=<?php  echo($_GET['class1']);?>">
			<table width="450" border="1px">
			<tbody>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="ID">序号</label></td>
					<td width="350"><input name="ID" type="text" id="ID" size="40" class="tb" readonly="true" value=" <?php echo $newnums;?>"></td>
				</tr>
				<tr>
					<td width="100" bgcolor="#009999"><label for="name">名称</label></td>
					<td ><input name="name" type="text" id="name" size="40"class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100" bgcolor="#009999"><label for="NO">编号</label></td>
					<td ><input name="NO" type="text" id="NO" size="40"class="easyui-validatebox tb" data-options="validType:'integ'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="type">型号规格</label></td>
					<td><input name="type" type="text" id="type" size="40"class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="num">借用数量</label></td>
					<td><input name="num" type="text" id="num" size="40"class="easyui-validatebox tb" data-options="required:true,validType:'integ'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="unit">单位</label></td>
					<td><input name="unit" type="text" id="unit" size="40"class="easyui-validatebox tb" data-options="required:true,validType:'length[1,6]'"></td>
				</tr>

				<tr>
					<td width="100"  bgcolor="#009999"><label for="cause">用途</label></td>
					<td><input name="cause" type="text" id="cause" size="40"class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="borrowtime">借用时间</label></td>
					<td><input id="borrowtime"  name="borrowtime" required="required"  editable="false"  class=" easyui-datetimebox"  ></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="borrower">借用人</label></td>
					<td   ><input name="borrower" type="text" id="borrower" size="40" class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999" ><label for="tel">借用人电话</label></td>
					<td><input name="tel" type="text" id="tel" size="40"  value = "<?php echo $row['tel'];?>"class="easyui-validatebox tb" data-options="required:true,validType:'mobile'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="borrowadmin">借用管理人</label></td>
					<td ><input name="borrowadmin" type="text" id="borrowadmin" size="40" class="easyui-validatebox tb"  data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="deadline">最后期限</label></td>
					<td><input id="deadline"   name="deadline" class="easyui-datetimebox"  editable="false"  data-options="required:true, validType:'equaldDate[\'#borrowtime\']'"></td>
				</tr>
				<tr>
					<td width="100"  bgcolor="#009999"><label for="mortgage">抵押</label></td>
					<td><input name="mortgage" type="text" id="mortgage" size="40" class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'"></td>
				</tr>
				<tr>
					<td width="100" height="105"  bgcolor="#3399ff"><label for="note">检验及备注</label></td>
					<td><textarea name="note" cols="43" rows="5" id="note"  class="easyui-validatebox tb" data-options="required:true,validType:'length[2,500]'" onKeyDown="textCounter(note,remLen,500);" onKeyUp="textCounter(note,remLen,500);"></textarea>
					<br>您还可以输入:<input name="remLen" type="text" value="500" size="1" readonly="readonly"> 个字符 </td>
				</tr>
			</tbody>
			</table>
			<input type="hidden"  name="ctr" value="add">
			<div style="text-align:center;padding:5px 0">
				<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">提交</a>
			</div>
		</form>
	</div>
	<div class="imgdiv" style ="float:left;border:1px;">
	<h1>借出照片</h1>
		<div class="up_load_file">
		</div>
	</div>

</div>
</body>
</html>
<script>
//文件上传控件初始化
		$('.up_load_file').uploadfile({
			url : "uploadfileapp.php?id=<?php echo $newnums;?>&method=before&class=<?php  echo($_GET['class1']);?>",
			width : 700,
			height : 100,
			canDrag : true,
			canMultiple : true,
			success: function (fileName,fileType) {
				alert(fileName + '上传成功 fileType='+fileType);
			},
			error: function (fileName) {
				alert(fileName + '上传失败');
			},
			complete : function () {
				alert('所有文件上传完毕');
			}
		});
//建立一個可存取到該file的url
function getObjectURL(file) {
	var url = null ;
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}
function textCounter(field, countfield, maxlimit) {
	// 函数，3个参数，表单名字，表单域元素名，限制字符；
	if (field.value.length > maxlimit)
	//如果元素区字符数大于最大字符数，按照最大字符数截断；
	field.value = field.value.substring(0, maxlimit);
	else
	//在记数区文本框内显示剩余的字符数；
	countfield.value = maxlimit - field.value.length;
}
//提交按钮
function submitForm(){
	$('#<?php echo $url;?>').form('submit');
}
//增加列表
var file_to=1;
function add_file()
{
	//添加一行
	$("#fileList").append("<input id='file_"+file_to+"' type='file' name='upfile[]'/>");
	 //添加删除按钮
	$("#fileList").append('<input type="button" value="删除" onclick="del_file('+file_to+')" id="file_del_'+file_to+'" >');
	//添加换行
	 $("#fileList").append('<br id="file_br_'+file_to+'"/>');
	 file_to++;

}
//删除列表
function del_file(file_id)
{
	$("#file_"+file_id).remove();
	$("#file_del_"+file_id).remove();
	$("#file_br_"+file_id).remove();
}
function DateDiff(sDate1, sDate2){  //sDate1和sDate2是2002-12-18格式
	var aDate, oDate1, oDate2, iDays;
	aDate = sDate1.split("-");
	oDate1 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);  //转换为12-18-2002格式
	aDate = sDate2.split("-");
	oDate2 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);
	iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 /24);  //把相差的毫秒数转换为天数
	return iDays;
}
(function($) {

	//验证扩展
	$.extend($.fn.validatebox.defaults.rules, {
		mobile: {
			validator: function (value, param) {
				return /^(?:13\d|14\d|15\d|18\d|19\d)-?\d{5}(\d{3}|\*{3})$/.test(value);
			},
			message: '手机号码不正确'
		},
		tel:{
			validator:function(value,param){
				return /^(\d{3}-|\d{4}-)?(\d{8}|\d{7})?(-\d{1,6})?$/.test(value);
			},
			message:'电话号码不正确'
		},
		mobileAndTel: {
			validator: function (value, param) {
				return /(^([0\+]\d{2,3})\d{3,4}\-\d{3,8}$)|(^([0\+]\d{2,3})\d{3,4}\d{3,8}$)|(^([0\+]\d{2,3}){0,1}13\d{9}$)|(^\d{3,4}\d{3,8}$)|(^\d{3,4}\-\d{3,8}$)/.test(value);
			},
			message: '请正确输入电话号码'
		},
		money:{
			validator: function (value, param) {
				return (/^(([1-9]\d*)|\d)(\.\d{1,2})?$/).test(value);
			 },
			 message:'请输入正确的金额'

		},
		mone:{
			validator: function (value, param) {
				return (/^(([1-9]\d*)|\d)(\.\d{1,2})?$/).test(value);
			 },
			 message:'请输入整数或小数'

		},
		integ:{
			validator:function(value,param){
				return /^[+]?[0-9]\d*$/.test(value);
			},
			message: '请输入整数'
		},
		range:{
			validator:function(value,param){
				if(/^[1-9]\d*$/.test(value)){
					return value >= param[0] && value <= param[1]
				}else{
					return false;
				}
			},
			message:'输入的数字在{0}到{1}之间'
		},
		minLength:{
			validator:function(value,param){
				return value.length >=param[0]
			},
			message:'至少输入{0}个字'
		},
		maxLength:{
			validator:function(value,param){
				return value.length<=param[0]
			},
			message:'最多{0}个字'
		},
		//select即选择框的验证
		selectValid:{
			validator:function(value,param){
				if(value == param[0]){
					return false;
				}else{
					return true ;
				}
			},
			message:'请选择'
		},
		idCode:{
			validator:function(value,param){
				return /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(value);
			},
			message: '请输入正确的身份证号'
		},
		loginName: {
			validator: function (value, param) {
				return /^[\u0391-\uFFE5\w]+$/.test(value);
			},
			message: '登录名称只允许汉字、英文字母、数字及下划线。'
		},
		equalTo: {
			validator: function (value, param) {
				return value == $(param[0]).val();
			},
			message: '两次输入的字符不一至'
		},
		equaldDate: {
			validator: function (value, param) {
				var start = $(param[0]).datetimebox('getValue');  //获取开始时间
				return value > start;                             //有效范围为当前时间大于开始时间
			},
			  message: '最后期限应大于借用时间!'                     //匹配失败消息
		},
		Dategap: {
			validator: function (value, param) {
				var start = $(param[0]).datetimebox('getValue');  //获取开始时间
					return DateDiff(value, start) < 30;                             //时间间隔不能大于30天
			},
			  message: '借出时间不能大于30天!'                     //匹配失败消息
		},

	   xiaoshu:{
		validator : function(value){
		return /^(([1-9]+)|([0-9]+\.[0-9]{1,2}))$/.test(value);
		},
		message : '最多保留两位小数！'
		}
	});
})(jQuery);
</script>
<style scoped="scoped">
	.tb{
		width:100%;
		margin:0;
		padding:5px 4px;
		border:1px solid #ccc;
		box-sizing:border-box;
	}
.imgview{margin:-4px;padding:-4px;width:110px;height:60px ;float:left;display:inline;border:2px solid #990033;}
</style>