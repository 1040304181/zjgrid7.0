
//文件上传控件初始化
		$('.up_load_file').uploadfile({
			url : "uploadfileapp.php?id=<?php echo $newnums;?>&method=before&class1=<?php  echo($_GET['class1']);?>",
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
	console.log('url= '+furl)
	$(furl).form('submit');
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
		range:{//data-options="required:true, validType:'range[1]'" 
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
		equaldDate: {  //data-options="required:true, validType:'equaldDate[\'#borrowtime\']'" 
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
		return /^(([1-9]+)|([0-9]+\.[0-9]{1,8}))$/.test(value);
		}, 
		message : '1到8位小数！'    
		},
	   xiaoshuyi:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{1})|([0-9]+\.[0-9]{1}))$/.test(value);
		}, 
		message : '1位小数！'    
		},
	   xiaoshuer:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{2})|([0-9]+\.[0-9]{2}))$/.test(value);
		}, 
		message : '2位小数！'    
		},
	   xiaoshusan:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{3})|([0-9]+\.[0-9]{3}))$/.test(value);
		}, 
		message : '3位小数！'    
		},
	   xiaoshusi:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{4})|([0-9]+\.[0-9]{4}))$/.test(value);
		}, 
		message : '4位小数！'    
		},
	   xiaoshuwu:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{5})|([0-9]+\.[0-9]{5}))$/.test(value);
		}, 
		message : '5位小数！'    
		},
	   xiaoshuliu:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{6})|([0-9]+\.[0-9]{6}))$/.test(value);
		}, 
		message : '6位小数！'    
		},
	   xiaoshuqi:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{7})|([0-9]+\.[0-9]{7}))$/.test(value);
		}, 
		message : '7位小数！'    
		},
	   xiaoshuba:{ 
		validator : function(value){ 
		return /^(([1-9]+\.[0-9]{8})|([0-9]+\.[0-9]{8}))$/.test(value);
		}, 
		message : '8位小数！'    
		}
	});
})(jQuery);
