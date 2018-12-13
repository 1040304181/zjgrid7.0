<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
		<meta http-equiv="cache-control" content="no-cache">
        <link rel="stylesheet" type="text/css" href="css/easyui_themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="css/easyui_themes/icon.css">
        <script type="text/javascript"  id="reloadjq" src="js/jquery.min.js"></script>
		<script type="text/javascript" id="reloadjs" src="js/jquery.easyui.min.js"></script>
        <script type="text/javascript" id="reloadjszh" src="js/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" id="reloadjsext" src="js/formValidator.js"></script>
        <script src="js/uploadfile.js"></script>
        <link rel="stylesheet" href="css/fileupdemo.css"/>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	outline: none;
}
#datalist  div,#tableslist  div{
    display: inline-block;
    flex-wrap: nowrap;
}
#textP{width:0px;}
</style>
    </head>
    <title>新增</title>
    <body>
<!--         <form  id="ff"  method="post" action="self_creatform.php"  > -->
        <form  id="ff"  method="post" action="self_creat_form.php"  >
            <font  color="#3399cc">表格中文名称<input type="text" name="zformname" id="zformname" class='easyui-validatebox'  style='width:130px' data-options="required:true,validType:'CHS',missingMessage:'填入表格中文名称'" ></font>
			<font id="formsznamemsg"></font>
			<font  color="#3399cc">表格英文名称<input type="text" name="yformname" id ="yformname" class='easyui-validatebox'  style='width:130px' data-options="required:true,validType:'english',missingMessage:'表格英文名称'"></font>
			<font id="formsynamemsg"></font><br>
            </font>
            <div id="datalist"  style='border:1px solid blue;'>

			</div>
			<div id="tableslist" style='border:1px solid gray;'>

			</div><p>&nbsp</p>
<input id="datalistNum" type="hidden" name="datalistNum">
<!--需要增强的暂时不该-->

<!--                  <div style='width:70px;'> 上传附件：</div> -->
<!--  				<select style='width:40px;'  name='self_document'><option value=\"1\" selected>是<option value=\"0\">否</select> -->
<!--                  <div style='width:50px;'> 表格化</div> -->
<!--  				<select style='width:40px;' name='self_sheet'><option value=\"1\" selected>是<option value=\"0\">否</select> -->
<!--                  <div style='width:50px;'> 可删除:</div> -->
<!--  				<select style='width:40px;' name='self_del'><option value=\"1\" selected>是<option value=\"0\">否</select> -->
<!--                  <div style='width:50px;'> 可更改:</div> -->
<!--  				<select style='width:40px;' name='grid'><option value=\"1\" selected>是<option value=\"0\">否</select> -->
<!--                  <div style='width:50px;'> 序列号:</div> -->
<!--  				<select style='width:40px;' name='grid'><option value=\"1\" selected>是<option value=\"0\">否</select> -->

快速插入<input id="listnum" name="listnum" value='1' class="easyui-textbox"  data-options="required:true,validType:['integer','range[1,10]'],missingMessage:'填入整数'" style="width:30px">行
				<a id="btsubmit" href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">提交</a><br>
 </form>
		<div style='border:1px solid red;'>
		<a href="clean_json.php" class="easyui-linkbutton" >还原自定义列表</a>
        <font size="1" color="#3399cc"><br>
		字符类型：短文本-char（最大存50个字符）、   长文本-char（最大存255个字符）、
		整数-int(范围：-2 147 483 648，2 147 483 647)、
		富文本--MEDIUMTEXT（16 777 215字节）、
		时间--datetime,。<br>
		小数-double(在参数中只能填1-8的整数)<br>
        单选框、复选框、下拉单选、列表多选--要在参数必填，且用";"隔开。如维修风机;唱歌;编程;写作。“；” “;”都可以<br>
		表格--
		签名--在表格展开后可以看到<br>

		<br>
		短文本、长文本、整数、小数填入默认值，其他的需要联系管理设置默认值
        </font>
		</div>

<script type="text/javascript">
// $(document).ready(function() {
    //校验表格名唯一
    $('#zformname').change(function() {
        //ajax
        var zname = $('#zformname').val();
        var yname = $('#yformname').val();
        var checkz = checkname(zname, 'formszname');
        var checky = checkname(yname, 'formsyname');
        //js  把0当成ture,所以加了这句区分
        var checkzz = (checkz > 0) ? true : false;
        var checkyy = (checky > 0) ? true : false;
        if (checkz > 0) {
            $('#formsznamemsg').html('<font color=RED>该中名已被使用</font>');
            $('#btsubmit').linkbutton('disable');
        } else {
            $('#formsznamemsg').html('<font color=GREEN>该中名未被使用</font>');
            if (yname.length && !checkyy) {
                $('#btsubmit').linkbutton('enable');
            }
        }
    })


    $('#yformname').change(function() {
        //ajax
        var yname = $('#yformname').val();
        var zname = $('#zformname').val();
        var checkz = checkname(zname, 'formszname');
        var checky = checkname(yname, 'formsyname');
        var checkzz = (checkz > 0) ? true : false;
        var checkyy = (checky > 0) ? true : false;
        if (checky > 0) {
            $('#formsynamemsg').html('<font color=RED>该英名已被使用</font>');
            $('#btsubmit').linkbutton('disable');
        } else {
            $('#formsynamemsg').html('<font color=GREEN>该英名未被使用</font>');
            if (zname.length && !checkzz) {
                $('#btsubmit').linkbutton('enable');
            }
        }
    })


    //获取当前的添加文件的div id="fileList"
    var data_to = 0;
    $('#datalist').append('<div style=\'width:30px;\'>序号</div><div style=\'width:120px;\'>| 中文名</div><div style=\'width:100px;\'>| 英文名</div><div style=\'width:80px;\'>| 字符类型</div><div style=\'width:300px;\'>| 参数</div><div style=\'width:300px;\'>| 默认值</div><div style=\'width:60px;\'>| 签名</div><div style=\'width:60px;\'>| 展示</div><br>');
    add_data();
    $('#listnum').textbox({
        onChange: function() {
            $('#datalist div:gt(7),#datalist p').remove(); //
            $('#tableslist ').html('');
            data_to = 0;
            for (i = 0; i < Math.min(($('#listnum').textbox('getValue')),10); i++) {
                add_data();
            }
            $('input[type!="hidden"],select,textarea', '#ff').each(function() { //这一句 从新加载验证很关键   
                $(this).validatebox();
            });
        }
    })


    $('body').on('change', '#datalist > div > select', function() { //选择主表 类型
        var num = $(this).attr('name').split('_')[2];
        //  console.log('num123456781:' + num);
        if ($('#sheet' + num)) {
            $('#sheet_' + num).remove();
        }
        if ($(this).val() == 'sheets') { //如果类型是sheets
            //    console.log('num1781:' + num);
            $('#tableslist').append('<div style=\'border:1px solid #00ff00;\' id=sheet_' + num + '><h4>子表' + num + '</h4>' +
                '快速插入<input id=\'sheetnum_' + num + '\' name=\'sheetnum_' + num + '\'   class=\'easyui-textbox sheetnum\'  data-options="required:true,validType:[\'integer\',\'range[1,10]\'],missingMessage:\'填入整数\'" style=\'width:30px\'>行<br>' +
                '<div style=\'width:30px;\'> 序号</div>' +
                '<div style=\'width:120px;\'> | 中文名</div>' +
                '<div style=\'width:100px;\'> | 英文名</div>' +
                '<div style=\'width:80px;\'>  | 字符类型</div>' +
                '<div style=\'width:300px;\'> | 参数</div>'+
                '<div style=\'width:300px;\'> | 默认值</div><br>' +
                '</div>');
            eval('sheet_' + num + '=0') //  add_sheet(num);
        }
        if ($(this)) {}
        $('input[type!="hidden"],select,textarea', '#ff').each(function() { //这一句 从新加载验证很关键   
            $(this).validatebox();
        });


    })

    $('body').on('change', 'input[id^="sheetnum_"]', function() {//子表数变化
        
        var num = $(this).parent().attr('id').split('_')[1];// 子表名
        $('#sheet_' + num + ' div:gt(5),#sheet_' + num + ' p').remove(); //移除上一次所有子表
        var rows=0
        console.log("add_sheet num :" + num);
        for (j = 0; j < Math.min($(this).val(),10); j++) {//j 行数 最大为10行
        
            add_sheet(num,j);
        }
        $('input[type!="hidden"],select,textarea', '#ff').each(function() { //这一句 从新加载验证很关键   
            $(this).validatebox();
        })
    })
// });

function submitForm() {
    $('#ff').form('submit');
}



function checkname(name, field) {
    var fnmsg;
    $.ajax({
        type: 'POST',
        url: 'check_name.php',
        data: 'name=' + name + '&field=' + field,
        async: false, //同步  这是一个难点  这是等这个ajax有了返回值后才会执行下面的js。一语道破天机，怪不得以前很多ajax调用里面的赋值都不起作用
        success: function(msg) {
            fnmsg = msg;
        }
    });
    return fnmsg;
}

function add_data() {
    //添加一行
    $('#datalist').append('<div   id=\'num_' + data_to + '\'style=\'width:30px\'> ' + data_to + '</div>');
    $('#datalist').append('<div   id=\'zname_' + data_to + '\' ><input  type=\'text\' name=\'zname_' + data_to + '\'style=\'width:120px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"CHS" ,missingMessage:"填入字段中文名"\'/></div>');
    $('#datalist').append('<div id=\'yname_' + data_to + '\'><input  type=\'text\' name=\'yname_' + data_to + '\' style=\'width:100px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"english",missingMessage:"填入字段英文名"\'/></div>');
    $('#datalist').append('<div id=\'char_type_' + data_to +
        '\'><select style=\'width:80px\'   name=\'char_type_' + data_to + '\'>' +
        '<option value="int" selected>整数' +
        '<option value="char">短文本' +
        '<option value="varchar">长文本' +
        '<option value="mediumtext">富文本' +
        '<option value="datetime">时间' +
        '<option value="double">小数' +
        '<option value="radio">单选' +
        '<option value="checkbox">复选' +
        '<option value="select">下拉单选' +
        '<option value="selectmul">列表多选' +
        '<option value="files">文件' +
        '<option value="sheets">表格' +
        '</select></div>');
    // 参数
    $('#datalist').append('<div  id=\'parameter_' + data_to + '\'><input   type=\'text\' name=\'parameter_' + data_to + '\' style=\'width:300px\' /></div>');
    // 默认值
    $('#datalist').append('<div  id=\'values_' + data_to + '\'><input  type=\'text\' name=\'values_' + data_to + '\' style=\'width:300px\' class=\'easyui-validatebox\' /></div>');
    // 签名
    $('#datalist').append('<div id=\'sign_' + data_to + '\'><select style=\'width:60px\' name=\'sign_' + data_to + '\'><option value="1" >是<option value="0"selected>否</select></div>');
    // 显示
    $('#datalist').append('<div id=\'show_' + data_to + '\'><select style=\'width:60px\' name=\'show_' + data_to + '\'><option value="1" selected>是<option value="0">否</select></div>');
    //添加换行
    $('#datalist').append('<p class="data_p_' + data_to + '" style="height:5px">&nbsp</p>');
    $('#datalistNum').val(data_to);
    data_to++;
    //console.log(data_to);
}

function del_data() {
    data_to--;
    $('#num_' + data_to).remove();
    $('#zname_' + data_to).remove();
    $('#yname_' + data_to).remove();
    $('#char_type_' + data_to).remove();
    //                $("#show_width_" + data_to).remove();
    $('#parameter_' + data_to).remove();
    $('#values_' + data_to).remove();
    $('#sign_' + data_to).remove();
    $('#show_' + data_to).remove();
    $('#data_add_' + data_to).remove();
    $('#data_del_' + data_to).remove();
    $('.data_p_' + data_to).remove();
    $('#datalistNum').val(data_to);
}
function reloadFn(id, newJS) {
    var oldjs = $('#' + id);
    if (oldjs) oldjs.remove();
    $('<script>', {
        'id': id,
        //    'name': Math.random(),
        'src': newJS,
        'type': 'text/javascript'
    }).appendTo('head');
} //定义子表  on 是一个关键命令

function add_sheet(num,rows) {
        console.log("add_sheet num rows:" +('sheet_' + num+'_rows_' + rows));
    //添加一行
    $('#sheet_' + num).append('<div style=\'width:30px\'  id= sheet_num_' +('sheet_' + num+'_rows_' + rows)+  '\'> ' + rows + '</div>');
    $('#sheet_' + num).append('<div  id=\'sheet_zname_' + ('sheet_' + num+'_rows_' + rows) + '\' ><input  type=\'text\' name=\'sheet_zname_' + ('sheet_' + num+'_rows_' + rows) + '\'style=\'width:120px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"CHS" ,missingMessage:"填入字段中文名"\'/></div>');
    $('#sheet_' + num).append('<div id=\'sheet_yname_' + ('sheet_' + num+'_rows_' + rows) + '\'><input  type=\'text\' name=\'sheet_yname_' + ('sheet_' + num+'_rows_' + rows) + '\' style=\'width:100px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"english",missingMessage:"填入字段英文名"\'/></div>');
    $('#sheet_' + num).append('<div id=\'sheet_char_type_' + ('sheet_' + num+'_rows_' + rows) +
        '\'><select style=\'width:80px\'   name=\'sheet_char_type_' + ('sheet_' + num+'_rows_' + rows) + '\'>' +
        '<option value="char">短文本' +
        '<option value="int" selected>整数' +
        '<option value="datetime">时间' +
        '<option value="double">小数' +
        '<option value="select">下拉单选' +
        '</select></div>');
        // 参数
    $('#sheet_' + num).append('<div  id=\'sheet_parameter_' + ('sheet_' + num+'_rows_' + rows) + '\'><input   type=\'text\' name=\'sheet_parameter_' + ('sheet_' + num+'_rows_' + rows) + '\' style=\'width:300px\' /></div>');
    // 默认值
    $('#sheet_' + num).append('<div  id=\'sheet_values_' + ('sheet_' + num+'_rows_' + rows)+ '\'><input  type=\'text\' name=\'sheet_values_' + ('sheet_' + num+'_rows_' + rows) + '\' style=\'width:300px\' class=\'easyui-validatebox\' /></div><p>');
    
}
</script>
