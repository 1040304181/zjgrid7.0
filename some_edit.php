
+8
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
<title>归还</title>
<body >
<?php
$url=$_GET['class1'];

require_once "connect/toolconnect.php"; 
$id = intval(trim($_GET['ID']));	
$sql = "select * from {$url} where ID= {$id}";
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);
?>
<div class="easyui-panel" title="工具借用登记表归还" style="padding:20px 20px;">
<div style ="float:left" >
	<form id="<?php echo $url;?>" name="<?php echo $url;?>" method="POST"  action ="some_app.php?class1=<?php echo $url;?>&update=<?php echo $id;?>">
	<table  width="450" align="center" border="1px">
	<tbody><tr>
		<td width="100" align="right"  bgcolor="#009999" ><label for="ID">序号</label></td>
		<td width="350"><input name="ID" type="text" id="ID" size="40"    readonly="readonly"  class="easyui-validatebox tb" value = "<?php echo $row['ID'];?>" /></td>
	</tr> 
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="name">名称</label></td>
		<td ><input name="name" type="text" id="name" size="40"   readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['name'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right"bgcolor="#009999"><label for="NO">编号</label></td>
		<td ><input name="NO" type="text" id="NO" size="40"size="40"   readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['NO'];?>"/</td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="type">型号规格</label></td>
		<td><input name="type" type="text" id="type"size="40"  readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['type'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="num">借用数量</label></td>
		<td><input name="num" type="text" id="num" size="40" readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['num'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999"><label for="unit">单位</label></td>
		<td><input name="unit" type="text" id="unit" size="40" readonly="readonly" class="easyui-validatebox tb"  value = "<?php echo $row['unit'];?>"></td>
	</tr>	
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="cause">用途</label></td>
		<td><input name="cause" type="text" id="cause" size="40"  readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['cause'];?>"/></td>
	</tr>   
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="borrowtime">借用时间</label></td>
		<td><input name="borrowtime" type="text" id="borrowtime"  readonly="readonly"  class="easyui-datetimebox"  value = "<?php echo $row['borrowtime'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="borrower">借用人</label></td>
		<td><input name="borrower" type="text" id="borrower" size="40" readonly="readonly"  class="easyui-validatebox tb" value = "<?php echo $row['borrower'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="tel">借用人电话</label></td>
		<td><input name="tel" type="text" id="tel" size="40" readonly="readonly"  class="easyui-validatebox tb"  value = "<?php echo $row['tel'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="borrowadmin">借用管理人</label></td>
		<td><input name="borrowadmin" type="text" id="borrowadmin" readonly="readonly"  size="40"  class="easyui-validatebox tb"  value = "<?php echo $row['borrowadmin'];?>"/></td>
	</tr>
	<tr>
		<td width="100" align="right" bgcolor="#009999" ><label for="deadline">最后期限</label></td>
		<td><input name="deadline" type="text" id="deadline" readonly="readonly"  class="easyui-datetimebox"  value = "<?php echo $row['deadline'];?>"/></td>
	</tr>
	<tr>
	  <td width="100" align="right" bgcolor="#009999" ><label for="mortgage">抵押</label></td>
	  <td><input name="mortgage" type="text" id="mortgage" size="40" readonly="readonly"  class="easyui-validatebox tb" value = "<?php echo $row['mortgage'];?>"/></td>
	</tr>
	<tr>
	  <td width="100" height="105" align="right" bgcolor="#3399ff"><label for="note">检验及备注</label></td>
	  <td><textarea name="note" cols="43" rows="5" id="note"  class="easyui-validatebox tb" data-options="required:true,validType:'length[2,500]'" onKeyDown="textCounter(note,remLen,500);" ><?php echo $row['note'];?></textarea>
	  <br>您还可以输入:<input name="remLen" type="text" value="500" readonly="readonly"size="1" > 个字符  </td>
	</tr>
	<tr>
	  <td width="100" align="right"bgcolor="#ff0000"><label for="returntime">归还时间</label></td>
	  <td>
	  <input id="returntime" name="returntime" required="required"  editable="false"  class=" easyui-datetimebox"  data-options="required:true, validType:'equaldDate[\'#borrowtime\']'" value = "<?php echo $row['returntime'];?>"/>
  	  </td>
	</tr>
	<tr>
	  <td width="100" align="right"bgcolor="#ff0000"><label for="returner">归还人</label></td>
	  <td><input  name="returner" type="text" id="returner" size="40" class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'" value = "<?php echo $row['returner'];?>"/>
	  </td>
	</tr>
	<tr>
	  <td width="100" align="right"bgcolor="#ff0000"><label for="returnadmin">归还管理人</label></td>
	  <td><input  name="returnadmin" type="text" id="returnadmin" size="40" class="easyui-validatebox tb" data-options="required:true,validType:'length[2,50]'" value = "<?php echo $row['returnadmin'];?>"/>
	  </td>
	</tr>
	</tbody></table>
	<input type="hidden"  name="ctr" value="edit">
	<p align="center"> 
<!-- 	确认提交:<input type="checkbox" id="myCheck"  value=1 name="sub" >   -->
	确认提交: <?php 
		if ($row['sub']==1) {
			
			echo("<input type='checkbox' id='myCheck' value=1 checked='true' name='sub'> <br><a href='javascript:void(0)' class='easyui-linkbutton' id='editsubmit' onclick='submitFormEdit()' style='width:80px'>提交</a>");
		}else {
			echo("<input type='checkbox' id='myCheck'  value=1 name='sub'> <a href='javascript:void(0)' class='easyui-linkbutton' id='editsubmit' onclick='submitFormEdit()' style='width:80px'>提交</a>");
		}
	?>
	</p><br>
	</form>
</div>
	<div class="imgdiv" style ="float:right;border:1px;">
	<h1>归还照片</h1>
		<div class="up_load_file">
		</div>
	</div>

</div>

</body>
</html>
<script>
//提交控制  转到后台处理。
//$("#editsubmit").removeAttr("disabled");
//if ( {<?php echo $row['sub'];?>} ==1) {
//	$("#myCheck").attr("checked","true");
//	$(".#editsubmit").attr("disabled","true");
//}else {
//	$("#myCheck").removeAttr("checked");
//	}
//文件上传控件初始化
		$('.up_load_file').uploadfile({
			url : 'uploadfileapp.php?id=<?php echo $row['ID'];?>&method=after&class=<?php echo $url;?>',
			width : 700,
			height : 100,
			canDrag : true,
			canMultiple : true,
			success: function (fileName) {
				alert(fileName + '上传成功');
			},
			error: function (fileName) {
				alert(fileName + '上传失败');
			},
			complete : function () {
				alert('所有文件上传完毕');
			}
		});
//字数显示函数
	function textCounter(field, countfield, maxlimit) { 
		// 函数，3个参数，表单名字，表单域元素名，限制字符； 
		if (field.value.length > maxlimit) 
		//如果元素区字符数大于最大字符数，按照最大字符数截断； 
		field.value = field.value.substring(0, maxlimit); 
		else 
		//在记数区文本框内显示剩余的字符数； 
		countfield.value = maxlimit - field.value.length; 
	}
	function submitFormEdit(){
		$('#<?php echo $url;?>').submit();
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
			  message: '应大于借用时间!'                     //匹配失败消息  
		},
		equalxDate: {  
			validator: function (value, param) {  
				var start = $(param[0]).datetimebox('getValue');  //获取开始时间    
				return value < start;                             //有效范围为当前时间小于开始时间    
			},  
			  message: '应大于最后期限!'                     //匹配失败消息  
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
	</style>