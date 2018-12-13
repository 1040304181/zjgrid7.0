<head>
	<meta charset="UTF-8">
	<meta http-equiv="cache-control" content="no-cache">
	<title> some_grid</title>
	<link rel="stylesheet" type="text/css" href="../css/easyui_themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../css/easyui_themes/icon.css">
	<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../js/easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="../js/datagrid-filter.js"></script>
	<script type="text/javascript" src="../js/datagrid-detailview.js"></script>
	<script src="../canvas/index_data/jq-signature.js"></script>
</head>
	<table id="dg" title=""  data-options="url:'../some_json.php?tables=self_my_test&abstract=1',toolbar:'#toolbar',pagination:true,singleSelect:true,nowrap:false ">
		<thead>
			<tr>
			<th data-options="field:'ID', sortable:true ,width:50 ">序号</th><th data-options="field:'my_name', sortable:true ">姓名</th> 
<th data-options="field:'my_file', sortable:true ">文件</th> 
<th data-options="field:'my_some', sortable:true ">简介</th> 
<th data-options="field:'my_biao', sortable:true ">物资表</th> 
<th data-options="field:'my_note', sortable:true ">备注</th> 
<th data-options="field:'my_love', sortable:true ">爱好</th> 
<th data-options="field:'my_lovea', sortable:true ">爱好</th> 
<th data-options="field:'my_loveb', sortable:true ">爱好</th> 
<th data-options="field:'my_lovec', sortable:true ">爱好</th> 
<th data-options="field:'my_time', sortable:true ">时间</th> 
			</tr>
		</thead>
	</table>
	<div id="toolbar" style="height:auto">

		<a href="self_my_test_export.php?class1=self_my_test" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" >导出</a>
	</div>
<div id="signdlg" class="easyui-dialog" title="请签名" data-options="iconCls:'icon-save'" style="width:650px;height:350px;padding:10px">
            <span>ID：</span><span id="signdlgid"></span><span> &nbsp signer: </span><span id="signdlgsigner"></span>&nbsp row: </span><span id="signdlgrow"></span>
	        <div class="js-signature"  data-height="200" data-width="600" data-border="2px solid black" data-line-color="#330000" >		</div>
	        <p><button id="clearBtn" class="btn btn-default" onclick="clearCanvas();">清除</button>&nbsp;&nbsp;&nbsp;
            <button id="saveBtn" class="btn btn-default" onclick="saveSignature('self_my_test');" disabled="disabled">保存</button>&nbsp;&nbsp;&nbsp;
            <!--工具栏 	 -->
</div>
<script type="text/javascript">
    $(function () {
        //签名
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }
        //对话窗口
        $('#signdlg').window('close');
			$('#dg').datagrid({
				fit:true,
				autoRowHeight:true,
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					ddv.panel({
						border:false,
						cache:true,
						href:'./self_my_test_show_form.php?ID='+row.ID+'&index='+index+'&class1=self_my_test',
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
        });
        //筛选 现在不可以远程
        //$('#dg').datagrid('enableFilter');
    })
//签名对话框
function signapp(ID,signer,index){
	$('#signdlgid').html(ID);
	$('#signdlgsigner').html(signer);
	$('#signdlgrow').html(index+1);
	$('#signdlg').window('open');
	$('#signdlg').window('center');
	clearCanvas();
}
//清除签名
function clearCanvas() {
	$('.js-signature').eq(0).jqSignature('clearCanvas');
	$('#saveBtn').attr('disabled', true);
}
//保存签名
function saveSignature(class1){
	var dataUrl = $('.js-signature').eq(0).jqSignature('getDataURL');
	var img = $('<img>').attr('src', dataUrl);
	$.post("../canvas/save.php",{data:dataUrl,class1:class1,ID:$('#signdlgid').html(),person:$('#signdlgsigner').html() },function(data) {
		//弹出签名
		//alert(data);
		//保存按钮显示
			$('#saveBtn').attr('disabled', true);
			$('#signdlg').window('close');
			$('#dg').datagrid('collapseRow',$('#signdlgrow').html()-1);//关闭打开行相当于刷新
			$('#dg').datagrid('expandRow',$('#signdlgrow').html()-1);
		}
	)
}

//清除保存按钮功能
$('.js-signature').eq(0).on('jq.signature.changed', function() {
		$('#saveBtn').attr('disabled', false);
	});
//归还
function returnapp(ID,class1){
window.location.href='self_my_test_edit.php?ID='+ID+'&class1='+class1;
}
	</script>