<meta charset="UTF-8"><link rel="stylesheet" type="text/css" href="../css/easyui_themes/default/easyui.css">
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
$id = intval( $mysqli ->real_escape_string(trim($_GET['ID']))); 
$sql = "select * from {$url} where ID= {$id}"; 
$rs = $mysqli ->query($sql); 
$row = $rs ->fetch_assoc(); 
  ?>
<script type="text/javascript" > 
var furl= "#<?php echo $url; ?>" 
</script> 
<form action="self_my_question_app.php?ctr=edit" id="self_my_question" method="POST">
<table>
<tr>
	<td class="label"><label for="ID">序号：</label>
	</td>
	<td><input type="text" name="ID" id="ID" value="<?php echo $id ; ?>" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_name">姓名：</label>
	</td>
	<td><input type="text" name="my_name" id="my_name" value="<?php echo $row['my_name'] ; ?>" class=" easyui-validatebox tb" data-options="required:true,validType:'length[1,255]'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_age">年龄：</label>
	</td>
	<td><input type="text" name="my_age" id="my_age" value="<?php echo $row['my_age'] ; ?>" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_some">简介：</label>
	</td>
	<td><textarea id="my_some" name="my_some" style="width:800px;height:200px;"><?php echo $row['my_some'] ; ?></textarea>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_note">备注：</label>
	</td>
	<td><input type="text" name="my_note" id="my_note" value="<?php echo $row['my_note'] ; ?>" class=" easyui-validatebox tb" data-options="required:true,validType:'integ'"/>

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
<script type="text/javascript" src="../js/my.js"></script><script>

					$('Array').datagrid({
					    url:'datagrid_data.json',
					    columns:[[
					        {field:'code',title:'代码',width:100},
					        {field:'name',title:'名称',width:100},
					        {field:'price',title:'价格',width:100,align:'right'}
					    ]]
					});
				</script>
