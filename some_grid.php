
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="cache-control" content="no-cache">
        <title> some_grid</title>
        <link rel="stylesheet" type="text/css" href="css/easyui_themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="css/easyui_themes/icon.css">
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="js/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="js/datagrid-filter.js"></script>
        <script type="text/javascript" src="js/datagrid-detailview.js"></script>
        <script src="canvas/index_data/jq-signature.js"></script>
    </head>
    <body>
        <?php
        $class1 = $_GET['class1'];
        switch ($_GET['class1']) {
            case 'tool':
                $title = "工器具";
                break;
            case 'key':
                $title = "钥匙";
                break;
            case 'spare':
                $title = "备品备件";
                break;
            case 'material':
                $title = "资料";
                break;
            case 'other':
                $title = "其他";
                break;
        }
        ?>
        <table id="dg" title="<?php echo($title); ?>借用登记"  data-options="url:'some_json.php?class1=<?php echo($class1); ?>',toolbar:'#toolbar',pagination:true,singleSelect:true,nowrap:false ">
            <thead>
                <tr>
                    <th data-options="field:'ID', sortable:true ,width:50 ">序号</th>
                    <th data-options="field:'name' ,sortable:true ,width:80 ">名称</th>
                    <th data-options="field:'NO' ,sortable:true ,width:80 ">编号</th>
                    <th data-options="field:'type',sortable:true  ,width:50 ">型号</th>
                    <th data-options="field:'num', sortable:true  ,width:50 ">数量</th>
                    <th data-options="field:'unit', sortable:true  ,width:50 ">单位</th>
                    <th data-options="field:'cause', sortable:true ,width:120 ">事由</th>
                    <th data-options="field:'borrowtime', sortable:true ,width:80">借用时间</th>
                    <th data-options="field:'borrower', sortable:true ,width:80 ">借用人</th>
                    <th data-options="field:'tel', sortable:true ,width:100 ">电话</th>
                    <th data-options="field:'borrowadmin',sortable:true  ,width:80 ">借用管理人</th>
                    <th data-options="field:'deadline', sortable:true ,width:80 ">最后期限</th>
                    <th data-options="field:'returntime', sortable:true ,width:80 ">归还时间</th>
                    <th data-options="field:'returnadmin',sortable:true  ,width:80 ">归还管理人</th>
                    <th data-options="field:'returner',sortable:true  ,width:80 ">归还人</th>
                    <th data-options="field:'mortgage',sortable:true  ,width:80 ">抵押</th>
                    <th data-options="field:'note',sortable:true,width:120" >备注</th>
                    <th data-options="field:'sub',sortable:true,width:65" >确认归还</th>
                </tr>
            </thead>
        </table>
    <div id="signdlg" class="easyui-dialog" title="请签名" data-options="iconCls:'icon-save'" style="width:650px;height:350px;padding:10px">
            <span>ID：</span><span id="signdlgid"></span><span> &nbsp signer: </span><span id="signdlgsigner"></span>&nbsp row: </span><span id="signdlgrow"></span>
	        <div class="js-signature"  data-height="200" data-width="600" data-border="2px solid black" data-line-color="#330000" >		</div>
	        <p><button id="clearBtn" class="btn btn-default" onclick="clearCanvas();">清除</button>&nbsp;&nbsp;&nbsp;
            <button id="saveBtn" class="btn btn-default" onclick="saveSignature('<?php echo($_GET['class1']); ?>');" disabled="disabled">保存</button>&nbsp;&nbsp;&nbsp;
            <!--工具栏 	 -->
    </div>
    <div id="toolbar" style="height:auto">
        <a href="some_export.php?class1=<?php echo($class1); ?>" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" >导出</a>
    </div>
    <!--分析栏  -->
    <div id="analysis" class="easyui-panel" title="统计分析" style="width:100%;max-width:1000px;padding:20px 20px;">
        <table border="1" align="left" cellpadding="0" cellspacing="0">
            <tr>
                <td>借用人</td>
                <td>未归还数量</td>
            </tr>
            <?php
            require_once "connect/toolconnect.php";
            $sql = "select borrower,count(*) as count from {$class1} where sub= 0 group by borrower";
            $rs = mysql_query($sql);
            while ($row = mysql_fetch_assoc($rs)) {
                echo "<tr><td>{$row['borrower']}</td><td>{$row['count']}</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
<script type="text/javascript">
    $(function () {
        //签名
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }
        //对话窗口
        $('#signdlg').window('close');
        //展开对话框
        $('#dg').datagrid({
			fit:true,
            autoRowHeight: true,
            view: detailview,
            detailFormatter: function (index, row) {
                return '<div class="ddv"></div>';
            },
            onExpandRow: function (index, row) {
                var ddv = $(this).datagrid('getRowDetail', index).find('div.ddv');
                ddv.panel({
                    border: false,
                    cache: true,
                    href: 'some_show_form.php?ID=' + row.ID + '&index=' + index + '&class1=<?php echo($_GET['class1']); ?>',
                    onLoad: function () {
                        $('#dg').datagrid('fixDetailRowHeight', index);
                        $('#dg').datagrid('selectRow', index);
                        $('#dg').datagrid('getRowDetail', index).find('form').form('load', row);
                    }
                });
                $('#dg').datagrid('fixDetailRowHeight', index);
            }
        });
        //筛选 现在不可以远程
        //$('#dg').datagrid('enableFilter');
    })
//签名对话框
    function signapp(ID, signer, index) {
        $('#signdlgid').html(ID);
        $('#signdlgsigner').html(signer);
        $('#signdlgrow').html(index + 1);
        $('#signdlg').window('open');
        clearCanvas();
    }
//清除签名
    function clearCanvas() {
        $('.js-signature').eq(0).jqSignature('clearCanvas');
        $('#saveBtn').attr('disabled', true);
    }
//保存签名
    function saveSignature(class1) {
        var dataUrl = $('.js-signature').eq(0).jqSignature('getDataURL');
        var img = $('<img>').attr('src', dataUrl);
        $.post("canvas/save.php", {data: dataUrl, class1: class1, ID: $('#signdlgid').html(), person: $('#signdlgsigner').html()}, function (data) {
            //弹出签名
            //alert(data);
            //保存按钮显示
            $('#saveBtn').attr('disabled', true);
            $('#signdlg').window('close');
            $('#dg').datagrid('collapseRow', $('#signdlgrow').html() - 1);//关闭打开行相当于刷新
            $('#dg').datagrid('expandRow', $('#signdlgrow').html() - 1);
        }
        )
    }

//清除保存按钮功能
    $('.js-signature').eq(0).on('jq.signature.changed', function () {
        $('#saveBtn').attr('disabled', false);
    });
//归还
    function returnapp(ID, class1) {
        window.location.href = 'some_edit.php?ID=' + ID + '&class1=' + class1;
    }
</script>
<style type="text/css" easyui="true">
    icon-filter{
        background:url('img/filter.png') no-repeat center center;
    }
</style>
