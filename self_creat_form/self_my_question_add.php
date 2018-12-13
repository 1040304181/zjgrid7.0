<div style ="float:left"><meta charset="UTF-8"><link rel="stylesheet" type="text/css" href="../css/easyui_themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../css/easyui_themes/icon.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../js/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="../js/ueditor.all.min.js"></script>
<script src="../js/uploadfile.js"></script>
<link rel="stylesheet" href="../css/fileupdemo.css"/>
<?php
$url="self_my_question";
require_once "../connect/toolconnect.php";
$rs = $mysqli ->query("select * from ".$url );
$newnums = $rs ->num_rows+1;
?>
<script type="text/javascript" >
var furl= "#<?php echo $url; ?>"
</script>
<form action="self_my_question_app.php?ctr=add" id="self_my_question" method="POST">
<table>
<tr>
	<td class="label"><label for="ID">序号：</label>
	</td>
	<td><input type="text" name="ID" id="ID" value="<?php echo $newnums ; ?>" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_name">姓名：</label>
	</td>
	<td><input type="text" name="my_name" id="my_name" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_age">年龄：</label>
	</td>
	<td><input type="text" name="my_age" id="my_age" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_some">简介：</label>
	</td>
	<td><textarea id="my_some" name="my_some" style="width:800px;height:200px;"></textarea>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_biao">物资表：</label>
	</td>
	<td><table id='my_biao' border ='1px'>
	<tr><td>名称</td><td>数量</td><td>金额</td><td></td></tr>
	<tr>
		<td>
		<input type="text" name="name" id="name" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

		</td>
		<td>
			<input type="text" name="num" id="num" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

		</td>
		<td>
		<input type="text" name="amount" id="amount" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
	<td></td>
	</tr>	<tr>
		<td>
		<input type="text" name="name" id="name" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

		</td>
		<td>
			<input type="text" name="num" id="num" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

		</td>
		<td>
		<input type="text" name="amount" id="amount" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
	<td></td>
	</tr>	<tr>
		<td>
		<input type="text" name="name" id="name" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

		</td>
		<td>
			<input type="text" name="num" id="num" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

		</td>
		<td>
		<input type="text" name="amount" id="amount" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
	<td></td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td class="label"><label for="my_note">备注：</label>
	</td>
	<td><input type="text" name="my_note" id="my_note" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
</tr>
<tr>
	<td class="label">
	</td>
	<td><a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">提交</a>
	</td>
</tr>
	</table>
</form>
<script type="text/javascript" src="../js/my.js"></script></div><div class="imgdiv" style ="float:left;border:1px;"></div><script>
</script>
