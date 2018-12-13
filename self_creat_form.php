<?php
include 'connect/toolconnect.php';
include "self_form.php";
$log_str = "";
// /////////////////////////////////////逻辑层/////////////////////////////////////////////////
// //将数据新表登记在数据库
$log_str .= self_defined_form_register();
// //创建数据表
$log_str .= creat_data();
// ////从数据表里查找数据  为提高效率暂时弃用
// search_self_defined_form($yformname)
// //做插入表单
$log_str .= creat_add_form();
// //做更新表单
$log_str .= creat_eidt_form();
// //插入和更新程序
$log_str .= creat_form_app();
// //做表格
$log_str .= creat_grid();
// //做展开行
$log_str .= crear_show_form();
// //生成目录
$log_str .= make_contens();
// //数据导出
$log_str .= self_export();
// 生成log
make_log("[self_creat_form ]" . $log_str . "[self_creat_form ]");
echo "<script>alert('完成,请查看日志！');</script>";
// ///////////////////////////////////////函数层////////////////////////////////////////////////
// //将数据新表登记在数据库
function self_defined_form_register() {
	$log_strs = "";
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values,$sheet_parameter,$sheet_values;
	$zformname = $mysqli -> real_escape_string(trim($_POST['zformname']));
	$yformname = $mysqli -> real_escape_string(trim("my_" . $_POST['yformname']));
	$dataListNum = $mysqli -> real_escape_string(trim($_POST['listnum'])); //参数个数
	$sql_all_value = "";
	// 将总表登记在数据库
	for ($ii = 0; $ii < $dataListNum; $ii++) {
		$zname[$ii] = $mysqli -> real_escape_string(trim($_POST['zname_' . $ii]));
		$yname[$ii] = $mysqli -> real_escape_string(trim("my_" . $_POST['yname_' . $ii]));
		$char_type[$ii] = $mysqli -> real_escape_string(trim($_POST['char_type_' . $ii]));
		$parameter[$ii] = $mysqli -> real_escape_string(trim($_POST['parameter_' . $ii]));
		$values[$ii] = $mysqli -> real_escape_string(trim($_POST['values_' . $ii]));

		$sign[$ii] = $mysqli -> real_escape_string(trim(isset($_POST['sign_' . $ii]) ? strval($_POST['sign_' . $ii]) : 'off'));
		$show[$ii] = $mysqli -> real_escape_string(trim(isset($_POST['show_' . $ii]) ? strval($_POST['show_' . $ii]) : 'off'));

		$sql_all_value .= "('" . $zformname . "', '" . $yformname . "','" . $zname[$ii] . "', '" . $yname[$ii] . "', '" . $char_type[$ii] . "', '" . $parameter[$ii] . "','" . $values[$ii] . "', '" . $sign[$ii] . "','" . $show[$ii] . "'),";
	}
	$sql_all_value = substr($sql_all_value, 0, strlen($sql_all_value) - 1);
	// 判断数据表是否存在，以英文名为准。
	$sqlall = "INSERT INTO `zj_self_defined_forms` (`formszname`,`formsyname`,`fieldzname`,`fieldyname`,`char_type`,`parameter`,`values`,`sign`,`show`)values" . $sql_all_value;
	// 在执行前再检查一下，数据库中是否存在。
	// 仅仅依靠前端是不够的。所以php框架很重要。
	if ($mysqli -> query($sqlall)) {
		$log_strs .= "已将新表数据登记在数据库：" . $sqlall;
	} else {
		$log_strs .= "dataListNum:" . $mysqli -> real_escape_string(trim($_POST['dataListNum'])) . "  新表数据未能登记在数据库: " . $sqlall;
	}
	// 将子表登记在数据库！！！！！！！！！！！未完成
	$sql_all_value = "";
	$j = 0;
	for ($jj = 0; $jj < $dataListNum; $jj++) {//表数
		$log_strs .= "\n 进入子表程序 11 sheetnum_" . $jj;
		if (array_key_exists('sheetnum_' . $jj, $_POST)) {
			$sheetListNum[$jj] = $mysqli -> real_escape_string(trim($_POST['sheetnum_' . $jj])); //参数个数
			// $log_strs.="\n 进入子表程序$sheetListNum[$jj] ".$sheetListNum[$jj];
			for ($ii = 0; $ii < $sheetListNum[$jj]; $ii++) {// 行数
				$sheet_zname[$j][$ii] = $mysqli -> real_escape_string(trim($_POST['sheet_zname_sheet_' . $jj.'_rows_'.$ii]));
				$sheet_yname[$j][$ii] = $mysqli -> real_escape_string(trim($_POST['sheet_yname_sheet_' . $jj.'_rows_'.$ii]));
				$sheet_char_type[$j][$ii] = $mysqli -> real_escape_string(trim($_POST['sheet_char_type_sheet_' . $jj.'_rows_'.$ii]));
				$sheet_parameter[$j][$ii] = $mysqli -> real_escape_string(trim($_POST['sheet_parameter_sheet_' . $jj.'_rows_'.$ii]));
				$sheet_values[$j][$ii] = $mysqli -> real_escape_string(trim($_POST['sheet_values_sheet_' . $jj.'_rows_'.$ii]));

				$log_strs .= "\n $sheet_zname" . $sheet_zname[$j][$ii];
				$sql_all_value .= "('" . $zformname . "', 'sheet_" . $yformname . "','" . $sheet_zname[$j][$ii] . "', '" . $sheet_yname[$j][$ii] . "', '" . $sheet_char_type[$j][$ii] . "', '" . $sheet_parameter[$j][$ii] . "', '" . $sheet_values[$j][$ii] . "'),";
			}
			$sql_all_value = substr($sql_all_value, 0, strlen($sql_all_value) - 1);//去掉；
			// 判断数据表是否存在，以英文名为准。
			$sqlall = "INSERT INTO `zj_self_defined_forms` (`formszname`,`formsyname`,`fieldzname`,`fieldyname`,`char_type`,`parameter`,`values`)values" . $sql_all_value;

			if ($mysqli -> query($sqlall)) {
				$log_strs .= "已将新子表数据登记在数据库：" . $sqlall;
			} else {
				$log_strs .= "sheetListNum[$jj]:" . $mysqli -> real_escape_string(trim($_POST['sheetnum_' . $ii])) . "  新子表数据未能登记在数据库: " . $sqlall;
			}
			$j++; //只有数据存在才加1
		}
	}

	return $log_strs;
}
// //创建数据表
function creat_data() {
	// //创建数据表
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	$log_strs = "";
	if ($zformname == "") {
		return ("\n测试不生成数据库");
	}
	// !!!!!!!!!!创建总表
	$zname_sql = " `ID` int(50) NOT NULL AUTO_INCREMENT COMMENT '序号', "; //插入序号
	// 在这需要加入  填报时间 字段 方便后面已加入  修改时限功能
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		switch ($char_type[$ii]) {
			case 'radio':
			case 'checkbox':
			case 'select':
			case 'selectmul':
			case 'files':
			case 'sheets':
			case 'char':
				$type = 'char';
				$size = 255;
				break;
			case 'int':
				$type = 'int';
				$size = 255;
				break;
			case 'varchar':
				$type = 'varchar';
				$size = 1000;
				break;

			default:
				$type = $char_type[$ii];
				$size = $char_size[$ii];
				break;
		}
		if ($type == "datetime" || $type == "double" || $type == "mediumtext") {
			$zname_sql .= "`" . $yname[$ii] . "` " . $type . " DEFAULT NULL  COMMENT '" . $zname[$ii] . "', "; //`name` varchar(400) DEFAULT NULL  COMMENT '名称',
		} else {
			$zname_sql .= "`" . $yname[$ii] . "` " . $type . "(" . $size . ") DEFAULT NULL  COMMENT '" . $zname[$ii] . "', "; //`name` varchar(400) DEFAULT NULL  COMMENT '名称',
		}
	}
	$zname_sql .= " `sub` tinyint(1)   DEFAULT NULL  COMMENT '提交',";
	$zname_sql .= " PRIMARY KEY (`ID`) ";
	// $zname_sql=substr($zname_sql,0,strlen($zname_sql)-2);
	$sql = "CREATE TABLE IF NOT EXISTS self_" . $yformname . "(" . $zname_sql . ")ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin  ;";
	// echo("<meta charset=\"UTF-8\"><br>creeatdata:.$sql");
	if ($mysqli -> query($sql)) {
		$log_strs .= "\n表格创建成功 " . $sql;
	} else {
		$log_strs .= "\n表格未创建,可能表格已存在 " . $sql;
	}
	// !!!!!!!创建各个子表

	// 在这需要加入  填报时间 字段 方便后面已加入  修改时限功能
	$Num = count($sheet_yname); //计算子表的一维维度
	if ($Num > 0) {
		for ($jj = 0; $jj < $Num; $jj++) {//表
			$zname_sql = " `ID` int(50) NOT NULL AUTO_INCREMENT COMMENT '序号', "; //插入序号
			for ($ii = 0; $ii < sizeof($sheet_yname[$jj]); $ii++) {//行
				$log_strs .= "\n" . $sheet_yname[$jj][$ii] . "\n";
				$log_strs .= $sheet_zname[$jj][$ii] . "\n";
				switch ($sheet_char_type[$jj][$ii]) {
					case 'radio':
					case 'checkbox':
					case 'select':
					case 'selectmul':
					case 'files':
					case 'char':

						$type = 'char';
						$size = 255;
						break;
					case 'int':
						$type = 'int';
						$size = 255;
						break;
					default:
						$type = $sheet_char_type[$jj][$ii];
						$size = $sheet_char_size[$jj][$ii];
						break;
				}
				if ($sheet_char_type[$jj][$ii] == "datetime" || $sheet_char_type[$jj][$ii] == "double" ) {
					$zname_sql .= "`" . $sheet_yname[$jj][$ii] . "` " . $type . " DEFAULT NULL  COMMENT '" . $sheet_zname[$jj][$ii] . "', "; //`name` varchar(400) DEFAULT NULL  COMMENT '名称',
				} else {
					$zname_sql .= "`" . $sheet_yname[$jj][$ii] . "` " . $type . "(" . $size . ") DEFAULT NULL  COMMENT '" . $sheet_zname[$jj][$ii] . "', "; //`name` varchar(400) DEFAULT NULL  COMMENT '名称',
				}
			}
			$zname_sql .= " `sub` tinyint(1)   DEFAULT NULL  COMMENT '提交',";
			$zname_sql .= " PRIMARY KEY (`ID`) ";
			$sql = "CREATE TABLE IF NOT EXISTS self_" . $yformname . "_sheet_" . $jj . "(" . $zname_sql . ")ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin  ;";
			if ($mysqli -> query($sql)) {
				$log_strs .= "\n子表格创建成功 " . $sql;
			} else {
				$log_strs .= "\n子表格未创建,可能表格已存在 " . $sql;
			}
		}
	}
	return $log_strs;
}
// ////!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!上面已修改!!!!!!!!!!!!!!!!!!!!!!!!!!////
// //做插入表单
function creat_add_form() {
	// 创建表单
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
    $log_strs = "[creat_add_form()]";
	$form_item = "";
	$content = "";
	$text = "<?php \n";
	$text .= "\$url=\"self_" . $yformname . "\"; \n";
	$text .= "require_once \"../connect/toolconnect.php\"; \n";
	// //*********z这个是要研究一下的*************//    $text .= "\$mysqli = new mysqli(\"localhost:3306\", \"root\", \"root\",\"zjdata\");"
	$text .= "\$rs = \$mysqli ->query(\"select * from \".\$url ); \n";
	// 总记录数
	$text .= "\$newnums = \$rs ->num_rows+1; \n";
	$text .= "?> \n";
	$text .= "<script type=\"text/javascript\" > \n";
	$text .= "var furl= \"#<?php echo \$url; ?>\" \n";
	$text .= "</script> \n";
	$js_content .= "<script>\n";
	$file_ii= array();// 文件的不兼容所以记录一下
	if ($zformname == "") {
		return ("\n测试不生成addform");
	}
	$form_add = new form("self_" . $yformname . "_app.php?ctr=add"); //提交到
	$form_add -> selftext = $text;
	$form_add -> layout = true; //不使用表格布局，大家可以把这句注释掉看结果有何不同
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		$i = 0;
		switch ($char_type[$ii]) {
			// 可以用if
			case 'mediumtext': // 增加 一段js 如果是长文本
				$js_content .= "var changue2 = UE.getEditor('" . $yname[$ii] . "',{
				    toolbars: [
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
				});";
				break;
			case 'sheets':
				for($jj = 0; $jj < $sheetListNum[$ii]; $jj++) {
					$parameter[$ii] .= $sheet_zname[$i][$jj] . "," . $sheet_yname[$i][$jj] . "," . $sheet_char_type[$i][$jj] . ",". $sheet_parameter[$i][$jj] . ",". $sheet_values[$i][$jj] . "-"; //把参数传过来
					//print_r('sheet parameter' . $parameter);

				}
				$i++;
				break;
			case 'files':
				$js_content .= "//文件上传控件初始化";
				$js_content .= "\$('.up_load_file').uploadfile({";
				$js_content .= "	url : \"../uploadfileapp.php?id=<?php echo \$newnums;?>&method=$yname[$ii]&class=$yname[$ii]\",";
				$js_content .= "	width : 700,";
				$js_content .= "	height : 100,";
				$js_content .= "	canDrag : true,";
				$js_content .= "	canMultiple : true,";
				$js_content .= "	success: function (fileName,fileType) {";
				$js_content .= "		alert(fileName + '上传成功 fileType='+fileType);";
				$js_content .= "	},";
				$js_content .= "	error: function (fileName) {";
				$js_content .= "		alert(fileName + '上传失败');";
				$js_content .= "	},";
				$js_content .= "	complete : function () {";
				$js_content .= "		alert('所有文件上传完毕');";
				$js_content .= "	}";
				$js_content .= "});";
				array_push($file_ii ,$ii);
				break;
		}
        if ($char_type[$ii] <> "files") {
            $form_item[$ii] = $form_add -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], $parameter[$ii], $values[$ii]);
			make_log("[biao_value ]" . $yname[$ii].'  '. $zname[$ii].'  '.$char_type[$ii].'  '. $parameter[$ii].'  '. $values[$ii]. "[/biao_value]");
             $log_strs .= $form_item[$ii];//平常要关闭
             $log_strs .= $parameter[$ii];//平常要关闭

        }

	}
    $form_item[$ii] = $form_add -> form_easy("submit", "提交", "submit");
	array_unshift($form_item, $form_add -> form_easy('ID', '序号', 'char', "", '$newnums')); //####################要改 不能编辑
	// print_r($form_item);
	// 显示表单
	$content = $form_add -> create_form($form_item);
    $content = '<div style ="float:left">' . $content. '</div><div class="imgdiv" style ="float:left;border:1px;">';
    // 把文件插入到表单后面
    foreach ($file_ii as $item) {
        $content .=  '<h1>'.$zname[$item].'</h1> <div  name="'.$yname[$item].'" class="up_load_file" id="'.$yname[$item].'" ></div>';
    }

    $content .= '</div>';
	$js_content .= "</script>\n";
	$content .= $js_content;
	// 输出php
	$file_path = "./self_creat_form/self_" . $yformname . "_add.php";

	file_put_contents($file_path, $content);
	$log_strs .= "\n生成：" . $file_path;
	$log_strs = "[/creat_add_form()]";
    return $log_strs;
}
// //做更新表单
function creat_eidt_form() {
	// 创建表单
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	$form_item = "";
	$content = "";
	$text = "<?php \n";
	$text .= "\$url=\"self_" . $yformname . "\"; \n";
	$text .= "require_once \"../connect/toolconnect.php\";  \n";
	$text .= "\$id = intval( \$mysqli ->real_escape_string(trim(\$_GET['ID']))); \n";
	$text .= "\$sql = \"select * from {\$url} where ID= {\$id}\"; \n";
	$text .= "\$rs = \$mysqli ->query(\$sql); \n";
	$text .= "\$row = \$rs ->fetch_assoc(); \n  ?>\n";
	$text .= "<script type=\"text/javascript\" > \n";
	$text .= "var furl= \"#<?php echo \$url; ?>\" \n";
	$text .= "</script> \n";
	$js_content .= "<script>\n";
	if ($zformname == "") {
		return ("\n测试不生成editform");
	}
	$form_edit = new form("self_" . $yformname . "_app.php?ctr=edit"); //提交到
	$form_edit -> selftext = $text;
	$form_edit -> layout = true; //不使用表格布局，大家可以把这句注释掉看结果有何不同
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		switch ($char_type[$ii]) {
			case 'radio':
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], $parameter[$ii], "");
				// 只能在最后加一段js  php不能实现 才能实现  定义变量
				$js_content .= "<?php echo (\"var " . $yname[$ii] . "=\\\"\".\$row['" . $yname[$ii] . "'].\"\\\"\");?>;\n";
				$js_content .= "\$(\"input[ value='\"+" . $yname[$ii] . "+\"'][ name='" . $yname[$ii] . "']\").attr(\"checked\",\"checked\");\n";
				continue;
			case 'checkbox':
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], $parameter[$ii], "");
				// 只能在最后加一段js  php不能实现 才能实现  定义变量
				$js_content .= "<?php echo (\"var " . $yname[$ii] . "=\\\"\".\$row['" . $yname[$ii] . "'].\"\\\"\");?>;\n";
				$js_content .= $yname[$ii] . "=" . $yname[$ii] . ".split(';;');\n";
				$js_content .= "for (i=0;i<" . $yname[$ii] . ".length ;i++ ){\n";
				$js_content .= "\$(\"input[ value='\"+" . $yname[$ii] . "[i]+\"'][ name='" . $yname[$ii] . "[]']\").attr(\"checked\",\"checked\");}\n";
				continue;
			case 'select':
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], $parameter[$ii], "");
				// 只能在最后加一段js  php不能实现 才能实现  定义变量
				$js_content .= "<?php echo (\"var " . $yname[$ii] . "=\\\"\".\$row['" . $yname[$ii] . "'].\"\\\"\");?>;\n";

				$js_content .= "\$(\"#" . $yname[$ii] . "\").val(" . $yname[$ii] . ");\n";
				continue;
			case 'selectmul':
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], $parameter[$ii], "");
				// 只能在最后加一段js  php不能实现 才能实现  定义变量
				$js_content .= "<?php echo (\"var " . $yname[$ii] . "=\\\"\".\$row['" . $yname[$ii] . "'].\"\\\"\");?>;\n";
				$js_content .= $yname[$ii] . "=" . $yname[$ii] . ".split(';;');\n";
				$js_content .= "\$(\"#" . $yname[$ii] . "\").val(" . $yname[$ii] . ");\n";
				continue;
			case 'mediumtext':
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], "", "\$row['" . $yname[$ii] . "']");
				$js_content .= "var changue2 = UE.getEditor('" . $yname[$ii] . "',{
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
				});";
				continue;
			case 'sheets':
				// code...
				$js_content .= "
					$('$yname').datagrid({
					    url:'datagrid_data.json',
					    columns:[[
					        {field:'code',title:'代码',width:100},
					        {field:'name',title:'名称',width:100},
					        {field:'price',title:'价格',width:100,align:'right'}
					    ]]
					});
				";
				break;
			default:
				$form_item[$ii] = $form_edit -> form_easy($yname[$ii], $zname[$ii], $char_type[$ii], "", "\$row['" . $yname[$ii] . "']");
				continue;
		}
	}
	$form_item[$ii] = $form_edit -> form_easy("submit", "提交", "submit");
	array_unshift($form_item, $form_edit -> form_easy('ID', '序号', 'char', "", '$id')); //####################要改 不能编辑
	// print_r($form_item);
	// 显示表单
	$content = $form_edit -> create_form($form_item);
	$js_content .= "</script>\n";
	$content .= $js_content;
	// 输出php
	$file_path = "./self_creat_form/self_" . $yformname . "_edit.php";
	file_put_contents($file_path, $content);
	return "\n生成：" . $file_path;
}
// //插入和更新程序
function creat_form_app() {
	$acept_str = "<?php
	\n require_once \"../connect/toolconnect.php\";
	\n session_start(); \n if(empty(\$_SESSION['user'])) {
		\n echo(\"<script>alert('归还信息填写不完整！'); </script>\");
		\n	header(\"Location: ../login.php\");
		\n } \n";
	$acept_str .= <<<EOF
function make_log(\$log_str) {
date_default_timezone_set("PRC");
	\$log_file = "../log/" . date("Y") . "/" . date("m") . "/" . date("Y-m-d") . ".log";
	if (!file_exists(dirname(\$log_file))) {
		mkdir(dirname(\$log_file), 0700, true);
	}
	\$content = \$log_str;
	\$content .= "\\r\\n\\n";
	file_put_contents(\$log_file, date("Y-m-d H:m:s") . \$content, FILE_APPEND);
}

EOF;
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	$content = "";
	if ($zformname == "") {
		return ("\n测试不生成formapp");
	}
	$sql_add1 = "INSERT INTO `self_" . $yformname . "` ( ";
	$sql_add2 = ")values(";
	$sql_edit = "\"update `self_" . $yformname . "` set ";
	$acept_str .= "\$id= \$mysqli ->real_escape_string(trim(\$_POST['ID']));\n";
	$acept_str .= "\$ctr= \$mysqli ->real_escape_string(trim(\$_GET['ctr']));\n";
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		// 创建接受表单
		switch ($char_type[$ii]) {
			// 自动循环 将多选租和后重新放在一个变量里面
			case 'checkbox':
			case 'selectmul':
				$acept_str .= "\$" . $yname[$ii] . "= \$mysqli ->real_escape_string(trim(\$_POST['" . $yname[$ii] . "']));\n";
				$acept_str .= "\$temp_" . $yname[$ii] . "=\"\";\n";
				$acept_str .= "for(\$ii=0; \$ii<sizeof(\$_POST['" . $yname[$ii] . "']); \$ii++) {\n";
				$acept_str .= "\t\$temp_" . $yname[$ii] . ".=\$_POST['" . $yname[$ii] . "'][\$ii].\";;\";\n}\n";
				$sql_add1 .= "`" . $yname[$ii] . "`, ";
				$sql_add2 .= "'{\$temp_" . $yname[$ii] . "}', ";
				$sql_edit .= $yname[$ii] . "='{\$temp_" . $yname[$ii] . "}', ";
				continue;
			default:
				$acept_str .= "\$" . $yname[$ii] . "= \$mysqli ->real_escape_string(trim(\$_POST['" . $yname[$ii] . "']));\n";
				$sql_add1 .= "`" . $yname[$ii] . "`, ";
				$sql_add2 .= "'{\$" . $yname[$ii] . "}', ";
				$sql_edit .= $yname[$ii] . "='{\$" . $yname[$ii] . "}', ";
				continue;
		}
	}
	$sql_edit = substr($sql_edit, 0, strlen($sql_edit) - 2);
	$sql_edit .= " where ID = '{\$id}'\"";
	$sql_add1 = substr($sql_add1, 0, strlen($sql_add1) - 2);
	$sql_add2 = substr($sql_add2, 0, strlen($sql_add2) - 2);
	$sql_add2 .= ")";
	$sql_add3 = $sql_add1 . $sql_add2;
	$acept_str .= "\$sql_edit=" . $sql_edit . ";\n";
	$acept_str .= "\$sql_add3=\"" . $sql_add3 . "\";\n";
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$acept_str .= "\$sql = \"select * from self_" . $yformname . " where ID= {\$id}\"; \n";
	$acept_str .= "\$rs = \$mysqli ->query(\$sql); \n";
	$acept_str .= "\$row = \$rs ->fetch_assoc(); \n  \n";
	// $acept_str .=" echo \$sql_edit.\" esqla\".\$sql_add .\" row=\".\$row;\n";//#######################################调试使用 打印参数
	$acept_str .= "if(\$ctr=='add'){\n ";
	$acept_str .= "	if(\$row['ID']==\$id){\n";
	$acept_str .= "		\$log_str.=\"[" . $yformname . " ==]请勿重复添加！\";\n";
	$acept_str .= "		echo \"<script>alert('请勿重复添加！');</script>\";\n";
	$acept_str .= "	}else{\n";
	$acept_str .= "		if(\$mysqli ->query(\$sql_add3)) {	\n";
	$acept_str .= "			\$log_str.=\"[" . $yformname . " add]添加成功! sql_add3\".\$sql_add3;\n";
	$acept_str .= "			echo \"<script>alert('添加成功！');</script>\";\n";
	$acept_str .= "		}else{\n";
	$acept_str .= "			\$log_str.=\"[" . $yformname . " add]添加失败！ sql_add3\".\$sql_add3;\n";
	$acept_str .= "			echo \"<script>alert('添加失败！');</script>\";\n";
	$acept_str .= "		}\n";
	$acept_str .= "	}\n";
	$acept_str .= "}elseif(\$ctr=='edit'){\n";
	$acept_str .= "	if(\$mysqli ->query(\$sql_edit)) {\n";
	$acept_str .= "		\$log_str.=\"[" . $yformname . " edit]更新成功！! sql_edit\".\$sql_edit;\n";
	$acept_str .= "		echo \"<script>alert('更新成功！');window.history.back();</script>\$sql_edit\";\n";
	$acept_str .= "	}else{\n";
	$acept_str .= "		\$log_str.=\"[" . $yformname . " edit]更新失败！! sql_edit\".\$sql_edit;\n";
	$acept_str .= "		echo \"<script>alert('更新失败！');</script>\";\n";
	$acept_str .= "	}\n";
	// $acept_str.="        if(\$mysqli ->query(\$sql_edit)) {echo \"<script>alert('更新成功！');window.location.href = './self_" . $yformname . "_grid.php';</script>\";}\n";
	$acept_str .= "}\n \$mysqli->close();\n make_log(\$log_str); \n?>";
	// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	// 输出php
	$file_path = "./self_creat_form/self_" . $yformname . "_app.php";
	file_put_contents($file_path, $acept_str);
	return "\n生成：" . $file_path;
}
// //做表格
function creat_grid() {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	if ($zformname == "") {
		return "\n测试不生成grid";
	}
	$grid_str = <<<EOF
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
	<table id="dg" title=""  data-options="url:'../some_json.php?tables=self_{$yformname}&abstract=1',toolbar:'#toolbar',pagination:true,singleSelect:true,nowrap:false ">
		<thead>
			<tr>
			<th data-options="field:'ID', sortable:true ,width:50 ">序号</th>
EOF;
	$grid_str_end = <<<EOF
			</tr>
		</thead>
	</table>
	<div id="toolbar" style="height:auto">

		<a href="self_{$yformname}_export.php?class1=self_{$yformname}" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" >导出</a>
	</div>
<div id="signdlg" class="easyui-dialog" title="请签名" data-options="iconCls:'icon-save'" style="width:650px;height:350px;padding:10px">
            <span>ID：</span><span id="signdlgid"></span><span> &nbsp signer: </span><span id="signdlgsigner"></span>&nbsp row: </span><span id="signdlgrow"></span>
	        <div class="js-signature"  data-height="200" data-width="600" data-border="2px solid black" data-line-color="#330000" >		</div>
	        <p><button id="clearBtn" class="btn btn-default" onclick="clearCanvas();">清除</button>&nbsp;&nbsp;&nbsp;
            <button id="saveBtn" class="btn btn-default" onclick="saveSignature('self_{$yformname}');" disabled="disabled">保存</button>&nbsp;&nbsp;&nbsp;
            <!--工具栏 	 -->
</div>
<script type="text/javascript">
    \$(function () {
        //签名
        if (\$('.js-signature').length) {
            \$('.js-signature').jqSignature();
        }
        //对话窗口
        \$('#signdlg').window('close');
			\$('#dg').datagrid({
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
						href:'./self_{$yformname}_show_form.php?ID='+row.ID+'&index='+index+'&class1=self_{$yformname}',
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
	\$('#signdlgid').html(ID);
	\$('#signdlgsigner').html(signer);
	\$('#signdlgrow').html(index+1);
	\$('#signdlg').window('open');
	\$('#signdlg').window('center');
	clearCanvas();
}
//清除签名
function clearCanvas() {
	\$('.js-signature').eq(0).jqSignature('clearCanvas');
	\$('#saveBtn').attr('disabled', true);
}
//保存签名
function saveSignature(class1){
	var dataUrl = \$('.js-signature').eq(0).jqSignature('getDataURL');
	var img = \$('<img>').attr('src', dataUrl);
	\$.post("../canvas/save.php",{data:dataUrl,class1:class1,ID:\$('#signdlgid').html(),person:\$('#signdlgsigner').html() },function(data) {
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
window.location.href='self_{$yformname}_edit.php?ID='+ID+'&class1='+class1;
}
	</script>
EOF;
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		// 生成浏览表
		if ($show[$ii] == 1) {
			$grid_str .= "<th data-options=\"field:'{$yname[$ii]}', sortable:true \">{$zname[$ii]}</th> \n";
		} else {
			$grid_str .= "<th data-options=\"field:'{$yname[$ii]}', sortable:true ,hidden:true\">{$zname[$ii]}</th> \n";
		}

		$sql_all_value .= "('" . $zformname . "', '" . $yformname . "','" . $zname[$ii] . "', '" . $yname[$ii] . "', '" . $char_type[$ii] . "', " . $char_size[$ii] . ", " . $show_width[$ii] . ", " . $sign[$ii] . '),';
	}
	// //生成浏览表格
	$file_path = "./self_creat_form/self_" . $yformname . "_grid.php";
	$grid_str .= $grid_str_end;
	file_put_contents($file_path, $grid_str);
	// echo("<script>alert('操作成功！');</script>");
	return "\n生成：" . $file_path;
}
// //做展开行
function crear_show_form() {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	$content = "<meta charset=\"UTF-8\"> \n";
	$content .= "<?php \n";
	$content .= "\$ID=\$_REQUEST['ID']; \n";
	$content .= "\$index=\$_REQUEST['index']; \n";
	$content .= "\$class1=\$_REQUEST['class1']; \n";
	$content .= " \n";
	if ($zformname == "") {
		return "\n测试不生成show_form";
	}
	// 看是否需要签名
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		if ($sign[$ii] == "1") {
			$content .= "\$img" . $ii . " = '../canvas/sign/'.\$class1.\"/\".md5(\$ID.'{$yname[$ii]}').'.png'; \n";
			// $content.=" echo \"<span>{$zname[$ii]}</span><img class='signimg'  src=\".\$borrower_img.\"  alt='请签名' />\"; \n";
			$content .= "  \n";
			$content .= "if (file_exists(\$img" . $ii . ")) {\n";
			$content .= "	echo \"<span>{$zname[$ii]}签名：</span><img class='signimg'  src='\$img" . $ii . " ' alt='请签名' />\";\n";
			$content .= "} else {\n";
			$content .= "	echo \"<span>{$zname[$ii]}签名：</span><img class='unsignimg' src='#' alt='请签名'   onclick='signapp(\".\$ID.\",\\\"{$yname[$ii]}\\\",\".\$index.\")' />\";\n";
			$content .= "}\n";
		}
	}
	$content .= "	//是否需要显示归还按钮 \n";
	$content .= "require_once \"../connect/toolconnect.php\"; \n";
	$content .= "\$id = intval( \$mysqli ->real_escape_string(trim(\$_GET['ID']))); \n";
	$content .= "\$sql = \"select * from \".\$class1.\" where ID= {\$id}\"; \n";
	$content .= "\$rs = \$mysqli ->query(\$sql); \n";
	$content .= "\$row = \$rs ->fetch_assoc(); \n";
	$content .= "if(\$row['sub']!=1) { \n";
	$content .= "	echo 	\"<a class='easyui-linkbutton' data-options=\\\"iconCls:'icon-edit'\\\" onclick=\\\"returnapp(\".\$ID.\",'\".\$class1.\"')\\\">编辑</a>\";//不跳转直接改成连接 \n";
	$content .= "} \n";
	$content .= "	echo(\"<br>\"); \n";
	// 后面防样式
	$content .= "?> \n<style>\n";
	$content .= ".signimg:active{\n";
	$content .= "	cursor: -webkit-zoom-in;\n";
	$content .= "	height:90px;\n";
	$content .= "	width:270px;\n";
	$content .= "}\n";
	$content .= ".signimg{\n";
	$content .= "	cursor: -webkit-zoom-in;\n";
	$content .= "height:30px;\n";
	$content .= "width:90px;\n";
	$content .= "}\n";
	$content .= ".unsignimg{\n";
	$content .= "	cursor:pointer;\n";
	$content .= "	height:30px;\n";
	$content .= "width:90px;\n";
	$content .= "}\n";
	$content .= ".evidenceimg{\n";
	$content .= "	height:50px;\n";
	$content .= "	width:50px;\n";
	$content .= "}\n";
	$content .= ".evidenceimg:active{\n";
	$content .= "	height:300px;\n";
	$content .= "	width:300px;\n";
	$content .= "}\n";
	$content .= "</style>\n";
	$file_path = "./self_creat_form/self_" . $yformname . "_show_form.php";
	file_put_contents($file_path, $content);
	return "\n生成：" . $file_path;
}
// //生成目录
function make_contens() {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	// 读取
	$jsonaddr = "tree_data1.json";
	$json = (json_decode(file_get_contents($jsonaddr), true));
	// 如果存在则不加入
	if ($zformname == "") {
		return "\n测试不生成目录";
	}

	for ($i = 0; $i < count($json); $i++) {
		if (in_array($zformname, $json[$i])) {
			$contents = 1;
		}
	}
	if ($contents == 1) {
		return "\n目录存在";
	} else {
		$arr['text'] = $zformname;
		$arr['children'][0]['text'] = $zformname . "增加";
		$arr['children'][0]['url'] = "self_creat_form/self_" . $yformname . "_add.php";
		$arr['children'][1]['text'] = $zformname . "统计";
		$arr['children'][1]['url'] = "self_creat_form/self_" . $yformname . "_grid.php";
		array_push($json, $arr);
		file_put_contents($jsonaddr, json_encode($json));
		return "\n目录已生成";
	}
}
// //生成日志
function make_log($log_str) {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	date_default_timezone_set("PRC");
	$log_file = "./log/" . date("Y") . "/" . date("m") . "/" . date("Y-m-d") . ".txt";//$_SERVER['DOCUMENT_ROOT'] .
	echo("dirname".dirname($log_file). "log_file" . $log_file);
	if (!is_dir(dirname($log_file))) {
		mkdir(dirname($log_file), 0700, true);
	}
	if (!file_exists($log_file)) {

		$content0 ="<meta charset='UTF-8'>";
		$content .= $log_str;
//		file_put_contents($log_file , $content);
		$fp = fopen($log_file, 'a+');
		fwrite($fp, $content0);
		fwrite($fp, date("Y-m-d H:m:s") . $content);
		fclose($fp);
	}else{
		// echo("2222222222222222222222");
		$content = $log_str;
		$content .= "\n";
		file_put_contents($log_file, date("Y-m-d H:m:s") . $content, FILE_APPEND);
		$fp = fopen($log_file, 'a');
		fwrite($fp, date(" Y-m-d H:m:s ") . $content);
		fclose($fp);
	}
}
// //数据导出
function self_export() {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;

	$content = "\n";
	$content .= "<?php\n";
	$content .= "include \"../connect/toolconnect.php\";\n";
	$content .= "\$rs = \$mysqli ->query(\"select * from \".\$_GET['class1'] );\n";
	$content .= "\$row = \$rs ->fetch_row();\n";
	$temp = "";
	if ($zformname == "") {
		return "\n测试不生成export";
	}
	for ($ii = 0; $ii < sizeof($zname); $ii++) {
		$temp .= $zname[$ii] . ",";
	}
	$temp = substr($temp, 0, strlen($temp) - 1) . "";
	$content .= "\$content=\"" . $temp . "\\" . "n\";\n";
	$content .= "	while(\$row = \$rs ->fetch_assoc()) {\n";
	$temp = "";
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		$temp .= "\$row['" . $yname[$ii] . "'].','.";
	}
	$temp = substr($temp, 0, strlen($temp) - 5);
	$content .= "	\$content.=" . $temp . ".\"\\" . "n\";\n";
	$content .= "	}\n";
	$content .= "	\$file_sub_path=\$_SERVER['DOCUMENT_ROOT'].\"/zjgrid/down/\";\n";
	$content .= "	\$file_name=date().\$_GET['class1'].\".csv\";\n";
	$content .= "	\$file_path=\$file_sub_path.\$file_name;\n";
	$content .= "file_put_contents(\$file_path, \$content);\n";
	$content .= "//文件导出\n";
	$content .= "	//用以解决中文不能显示出来的问题\n";
	$content .= "	\$file_name=iconv(\"utf-8\",\"gb2312\",\$file_name);\n";
	$content .= "	//首先要判断给定的文件存在与否\n";
	$content .= "	if(!file_exists(\$file_path)){\n";
	$content .= "	echo \"没有该文件文件\";\n";
	$content .= "	return ;\n";
	$content .= "	}\n";
	$content .= "	\$fp=fopen(\$file_path,\"r\");\n";
	$content .= "	\$file_size=filesize(\$file_path);\n";
	$content .= "	//下载文件需要用到的头\n";
	$content .= "	Header(\"Content-type: application/octet-stream\");\n";
	$content .= "	Header(\"Accept-Ranges: bytes\");\n";
	$content .= "	Header(\"Accept-Length:\".\$file_size);\n";
	$content .= "	Header(\"Content-Disposition: attachment; filename=\".\$file_name);\n";
	$content .= "	\$buffer=1024;\n";
	$content .= "	\$file_count=0;\n";
	$content .= "	//向浏览器返回数据\n";
	$content .= "	while(!feof(\$fp) && \$file_count<\$file_size){\n";
	$content .= "	\$file_con=fread(\$fp,\$buffer);\n";
	$content .= "	\$file_count+=\$buffer;\n";
	$content .= "	echo \$file_con;\n";
	$content .= "	}\n";
	$content .= "	fclose(\$fp);\n";
	$content .= "?>\n";
	$file_path = "./self_creat_form/self_" . $yformname . "_export.php";
	file_put_contents($file_path, $content);
	return "\n生成：" . $file_path;
}
// //从数据表里查找数据
function search_self_defined_form($yformname) {
	global $zformname, $yformname, $zname, $yname, $char_type, $char_size, $show_width, $show_size, $parameter, $values, $document, $sign, $show, $dataListNum,$sheetListNum, $mysqli, $sheet_zname, $sheet_yname, $sheet_char_type,$sheet_parameter,$sheet_values;
	$rs = $mysqli -> query($sql);
	$row = $rs -> fetch_assoc();
	for ($ii = 0; $ii < sizeof($yname); $ii++) {
		$zname[$ii] = $row['zname_' . $ii];
		$yname[$ii] = $row['yname_' . $ii];
		$char_type[$ii] = $row['char_type_' . $ii];
		$char_size[$ii] = $row['char_size_' . $ii];
		$show_width[$ii] = $row['show_width_' . $ii];
		$sign[$ii] = $row['sign_' . $ii];
	}
}
