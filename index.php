<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>华能新能源</title>
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="css/easyui_themes/icon.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="js/easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="js/datagrid-filter.js"></script>
</head>
<body class="easyui-layout">
	<div data-options="region:'north',split:true" style="height:70px;padding:-px; "  href="top.php">
	</div>
	<div data-options="region:'west',split:true" title="目录" style="width:160px;">
			<div class="easyui-accordion" data-options="fit:true,border:false">
				<div title="自定义报表" style="padding:10px;">
					<ul id="tt1" class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true,dnd:true,selected:true"></ul>
				</div>
				<div title="借用登记" style="padding:10px;">
					<ul id="tt2" class="easyui-tree" data-options="url:'tree_data2.json',method:'get',animate:true,dnd:true,selected:true"></ul>
				</div>
				<div title="招标" style="padding:10px;">
					<ul id="tt3" class="easyui-tree" data-options="url:'tree_data3.json',method:'get',animate:true,dnd:true,selected:true"></ul>
				</div>
				<div title="风机、箱变、线路缺陷" style="padding:10px">
					<a href="">content1</a><br>
					<a href="">content1</a><br>
					<a href="">content1</a>
				</div>
			</div>
	</div>
	<div data-options="region:'center'">
		<div id="tbs" class="easyui-tabs" data-options="fit:true,border:false,plain:true">		</div>
	</div>
<!-- 	<div data-options="region:'south',border:false" style="height:30px;padding:5px;">版权所有，翻版必究 © 2016-2020巨扩展</div> -->




</body>
<script type="text/javascript" >
	//	关闭登录对话框
		$('#logindlg').dialog('close');
$(function(){
//目录

	// 实例化树菜单
	$("#tt1").tree({
		onClick : function(node) {//node是点击菜单后传过来的节点(不包含根节点)
			if (node.url) {
				openTab(node.text, node.url);
			}
		}
	});
	$("#tt2").tree({
		onClick : function(node) {//node是点击菜单后传过来的节点(不包含根节点)
			if (node.url) {
				openTab(node.text, node.url);
			}
		}
	});
		$("#tt3").tree({
		onClick : function(node) {//node是点击菜单后传过来的节点(不包含根节点)
			if (node.url) {
				openTab(node.text, node.url);
			}
		}
	});



	// 新增Tab 内部用
	function openTab(text, url) {
		if ($("#tbs").tabs('exists', text)) {
			$("#tbs").tabs('select', text);
		} else {
			var content = "<iframe frameborder='0' scrolling='auto' style='width:100%;height:100%' src="
					+ url + "></iframe>";
			$("#tbs").tabs('add', {
				title : text,
				closable : true,
				content : content
			});
		}
	}
		//滑动
			var tabs = $('#tbs').tabs().tabs('tabs');
			for(var i=0; i<tabs.length; i++){
				tabs[i].panel('options').tab.unbind().bind('mouseenter',{index:i},function(e){
					$('#tbs').tabs('select', e.data.index);
				});
			}
})
	// 新增Tab
	function openTabA(text, url) {
		if ($("#tbs").tabs('exists', text)) {
			$("#tbs").tabs('select', text);
		} else {
			var content = "<iframe frameborder='0' scrolling='auto' style='width:100%;height:100%' src="
					+ url + "></iframe>";
			$("#tbs").tabs('add', {
				title : text,
				content : content
			});
		}
	}
	// 关闭Tab
	function closeTabA(text) {
		if ($("#tbs").tabs('exists', text)) {
			("#tbs").tabs('close', text)
		}

	}

</script>
</html>
