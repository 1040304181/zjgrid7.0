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
$url="self_my_test"; 
require_once "../connect/toolconnect.php";  
$id = intval( $mysqli ->real_escape_string(trim($_GET['ID']))); 
$sql = "select * from {$url} where ID= {$id}"; 
$rs = $mysqli ->query($sql); 
$row = $rs ->fetch_assoc(); 
  ?>
<script type="text/javascript" > 
var furl= "#<?php echo $url; ?>" 
</script> 
<form action="self_my_test_app.php?ctr=edit" id="self_my_test" method="POST">
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
	<td class="label"><label for="my_file">文件：</label>
	</td>
	<td><div  name="my_file"  class="up_load_file" id="my_file" ></div>

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
	<td><textarea id="my_note" name="my_note" style="width:800px;height:200px;"><?php echo $row['my_note'] ; ?></textarea>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_love">爱好：</label>
	</td>
	<td><select id="my_love" name="my_love[]" size="" multiple="multiple">
	<option value="维修风机">维修风机</option>
	<option value="唱歌">唱歌</option>
	<option value="编程">编程</option>
	<option value="写作">写作</option>
</select>

	</td>
</tr>
<tr>
	<td class="label"><label for="my_lovea">爱好：</label>
	</td>
	<td>
	<input type="radio" id="0" name="my_lovea" value="维修风机" /><label for="0">维修风机</label> 
	<input type="radio" id="1" name="my_lovea" value="唱歌" /><label for="1">唱歌</label> 
	<input type="radio" id="2" name="my_lovea" value="编程" /><label for="2">编程</label> 
	<input type="radio" id="3" name="my_lovea" value="写作" /><label for="3">写作</label> 
	</td>
</tr>
<tr>
	<td class="label"><label for="my_loveb">爱好：</label>
	</td>
	<td>
	<input type="checkbox" id="0" name="my_loveb[]" value="维修风机" /><label for="0">维修风机</label>
	<input type="checkbox" id="1" name="my_loveb[]" value="唱歌" /><label for="1">唱歌</label>
	<input type="checkbox" id="2" name="my_loveb[]" value="编程" /><label for="2">编程</label>
	<input type="checkbox" id="3" name="my_loveb[]" value="写作" /><label for="3">写作</label>
	</td>
</tr>
<tr>
	<td class="label"><label for="my_lovec">爱好：</label>
	</td>
	<td><select id="my_lovec" name="my_lovec">
	<option value="维修风机">维修风机</option>
	<option value="唱歌">唱歌</option>
	<option value="编程">编程</option>
	<option value="写作">写作</option>
</select>
	</td>
</tr>
<tr>
	<td class="label"><label for="my_time">时间：</label>
	</td>
	<td><input type="text" name="my_time" id="my_time" value="<?php echo $row['my_time'] ; ?>" required="required"  editable="false" class=" easyui-datetimebox"/>

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
var changue2 = UE.getEditor('my_some',{
				    toolbars: [
				    ['source', 'undo', 'redo'],
				     [
				        'undo', //撤销
				        'redo', //重做
				        'bold', //加粗
				        'indent', //首行缩进
				        'italic', //斜体
				        'underline', //下划线
				        'strikethrough', //删除线
				        'subscript', //下标
				        'fontborder', //字符边框
				        'superscript', //上标
				        'formatmatch', //格式刷
				        'blockquote', //引用
				        'time', //时间
				        'date', //日期
				        'fontfamily', //字体
				        'fontsize', //字号
				        'paragraph', //段落格式
				        'link', //超链接
				        'justifyleft', //居左对齐
				        'justifyright', //居右对齐
				        'justifycenter', //居中对齐
				        'justifyjustify', //两端对齐
				        'forecolor', //字体颜色
				        'backcolor', //背景色
				        'insertorderedlist', //有序列表
				        'insertunorderedlist', //无序列表
				        'fullscreen', //全屏
				        'imagenone', //默认
				        'imageleft', //左浮动
				        'imageright', //右浮动
				        'attachment', //附件
						'insertimage', //多图上传
				        'imagecenter', //居中
				        'background', //背景

				    ]
				],
				    autoHeightEnabled: true,
				    autoFloatEnabled: true
				});
					$('Array').datagrid({
					    url:'datagrid_data.json',
					    columns:[[
					        {field:'code',title:'代码',width:100},
					        {field:'name',title:'名称',width:100},
					        {field:'price',title:'价格',width:100,align:'right'}
					    ]]
					});
				<?php echo ("var my_love=\"".$row['my_love']."\"");?>;
my_love=my_love.split(';;');
$("#my_love").val(my_love);
<?php echo ("var my_lovea=\"".$row['my_lovea']."\"");?>;
$("input[ value='"+my_lovea+"'][ name='my_lovea']").attr("checked","checked");
<?php echo ("var my_loveb=\"".$row['my_loveb']."\"");?>;
my_loveb=my_loveb.split(';;');
for (i=0;i<my_loveb.length ;i++ ){
$("input[ value='"+my_loveb[i]+"'][ name='my_loveb[]']").attr("checked","checked");}
<?php echo ("var my_lovec=\"".$row['my_lovec']."\"");?>;
$("#my_lovec").val(my_lovec);
</script>
