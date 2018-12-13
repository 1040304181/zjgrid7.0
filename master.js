$(document).ready(function() {
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
            for (i = 0; i < ($('#listnum').textbox('getValue')); i++) {
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
                '<div style=\'width:80px;\'> | 字符类型</div><br>' +
                '</div>');
            eval('sheet_to_' + num + '=0') //  add_sheet(num);
        }
        $('input[type!="hidden"],select,textarea', '#ff').each(function() { //这一句 从新加载验证很关键   
            $(this).validatebox();
        });


    })

    $('body').on('change', 'input[id^="sheetnum_"]', function() {
        console.log("sheetnum_1 on  change");
        var num = $(this).parent().attr('id').split('_')[1];
        $('#sheet_' + num + ' div:gt(3),#sheet_' + num + ' p').remove(); //
        eval('sheet_to_' + num + '=0')
        for (j = 0; j < $(this).val(); j++) {
            add_sheet(num);
        }
        $('input[type!="hidden"],select,textarea', '#ff').each(function() { //这一句 从新加载验证很关键   
            $(this).validatebox();
        })
    })
});

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




function add_sheet(num) {
    //    console.log("add_sheet2:" +num);
    //添加一行
    $('#sheet_' + num).append('<div style=\'width:30px\'  id=\'num_' + ('sheet_to_' + num) + '\'> ' + eval('sheet_to_' + num) + '</div>');
    $('#sheet_' + num).append('<div  id=\'sheet_zname_' + eval('sheet_to_' + num) + '\' ><input  type=\'text\' name=\'sheet_zname_' + eval('sheet_to_' + num) + '\'style=\'width:120px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"CHS" ,missingMessage:"填入字段中文名"\'/></div>');
    $('#sheet_' + num).append('<div id=\'sheet_yname_' + eval('sheet_to_' + num) + '\'><input  type=\'text\' name=\'sheet_yname_' + eval('sheet_to_' + num) + '\' style=\'width:100px\' class=\'easyui-validatebox\' data-options=\'required:true,validType:"english",missingMessage:"填入字段英文名"\'/></div>');
    $('#sheet_' + num).append('<div id=\'sheet_char_type_' + eval('sheet_to_' + num) +
        '\'><select style=\'width:80px\'   name=\'sheet_char_type_' + eval('sheet_to_' + num) + '\'>' +
        '<option value="int" selected>整数' +
        '<option value="char">短文本' +
        '<option value="varchar">长文本' +
        '<option value="datetime">时间' +
        '<option value="double">小数' +
        '<option value="radio">单选' +
        '<option value="checkbox">复选' +
        '<option value="select">下拉单选' +
        '<option value="selectmul">列表多选' +
        '<option value="files">文件' +
        '</select></div><p style="height:5px">&nbsp</p>');
    eval('sheet_to_' + num + '++')
    //    console.log(sheet_to);
}