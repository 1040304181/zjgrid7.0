<?php
// Form.php
class form {
	public $layout = true; //是否使用表格布局
	public $action; //表单要提交到的URL
	public $method;
	public $enctype = "";
	public $name = "";
	public $id = "";
	public $class = "";
	public $selftext = "";
	public function form($action, $method = "POST") {
		// 通过构造函数初始化成员变量
		$this -> action = $action;
		$this -> method = $method;
	}

	public function form_start() {
		$text = "<meta charset=\"UTF-8\">";
		$text .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/easyui_themes/default/easyui.css\">\n";
		$text .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/easyui_themes/icon.css\">\n";
		$text .= "	<script type=\"text/javascript\" src=\"../js/jquery.min.js\"></script>\n";
		$text .= "<script type=\"text/javascript\" src=\"../js/jquery.easyui.min.js\"></script>\n";
		$text .= "<script type=\"text/javascript\" src=\"../js/easyui-lang-zh_CN.js\"></script>\n";
		$text .= "<script type=\"text/javascript\" charset=\"utf-8\" src=\"../js/ueditor.config.js\"></script>\n";
		$text .= "<script type=\"text/javascript\" charset=\"utf-8\" src=\"../js/ueditor.all.min.js\"></script>\n";
		$text .= "<script src=\"../js/uploadfile.js\"></script>\n";
		$text .= "<link rel=\"stylesheet\" href=\"../css/fileupdemo.css\"/>\n";
		$text .= $this -> selftext;
		$text .= "<form action=\"{$this->action}\" id=\"" . substr(explode("?", $this -> action)[0], 0, -8) . "\" method=\"{$this->method}\"";
		if ($this -> class !== "") {
			$text .= " class=\"{$this->class}\"";
		}
		if ($this -> enctype !== "") {
			$text .= " enctype=\"{$this->enctype}\"";
		}
		if ($this -> id !== "") {
			$text .= " id=\"{$this->id}\"";
		}
		if ($this -> name !== "") {
			$text .= " name=\"{$this->name}\"";
		}
		$text .= ">\n";
		if ($this -> layout == true) {
			$text .= "<table>\n";
		}
		return $text;
	}

	public function form_end() {
		if ($this -> layout == true) {
			$text = "\t</table>\n";
			$text .= "</form>\n";
		} else {
			$text = "</form>\n";
		}
		$text .= "<script type=\"text/javascript\" src=\"../js/my.js\"></script>";
		return $text;
	}
	// 简化函数  $form_add->form_easy($yname[$ii], $zname[$ii], $char_type[$ii],$parameter[$ii]);
	// form_easy($yname[$ii], $zname[$ii], $char_type[$ii],$parameter[$ii],$values[$ii]);
	public function form_easy($name, $label_name, $validType, $parameter = "", $value = "", $selected = false, $onchange = "") {
		$cols = 40;
		$rows = 15;
		$parameter = str_replace("；", ";", $parameter);// 替换中文分号为英文分号
		$label = explode(';', $parameter);
		$options = explode(';', $parameter);
		//make_log("[form_easy ]" . $name.'----'. $label_name.'----'. $validType.'----'. $parameter . "[/form_easy]");
		$id = $name;
		$label_for = $name;
		// /echo("name:" . $name . " label_name:" . $label_name . " validType:" . $validType . " parameter:" . $parameter . " value:" . $value . "<br>");
		switch ($validType) {
			case 'submit':
				$form_item = $this -> form_submit($name, $id, $label_name, $label_for, $validType, $value) ;
				break;

			case 'int':
				$form_item = $this -> form_text($name, $id, $label_name, $label_for, $validType, $value) ;
				break;
			case 'char':
				$form_item = $this -> form_text($name, $id, $label_name, $label_for, $validType, $value) ;
				break;
			case 'varchar':
				$form_item = $this -> form_textarea($id, $name, $cols, $rows, $label_name, $label_for, $value);
				break;
			case 'mediumtext':
				$form_item = $this -> form_textarea($id, $name, $cols, $rows, $label_name, $label_for, $value);
				break;
			case 'datetime':
				$form_item = $this -> form_text($name, $id, $label_name, $label_for, $validType, $value) ;
				break; //
			case 'double':
				$form_item = $this -> form_text($name, $id, $label_name, $label_for, $validType, $value, $parameter) ;
				break;
			case 'radio':// form_radio($name, $label = array(), $label_name, $label_for = "")
				$form_item = $this -> form_radio($name, $label, $label_name, $label_for) ;
				break;
			case 'checkbox':// form_checkbox($name, $label = array(), $label_name, $label_for = "")
				$form_item = $this -> form_checkbox($name, $label, $label_name, $label_for) ;
				break;
			case 'select':// form_select($id, $name, $options = array(), $selected = false, $label_name, $label_for, $onchange = "")
				$form_item = $this -> form_select($id, $name, $options, $selected, $label_name, $label_for , $onchange) ;
				break;
			case 'selectmul':// form_selectmul($id, $name, $size, $options = array(), $label_name, $label_for)
				$form_item = $this -> form_selectmul($id, $name, $size, $options, $label_name, $label_for) ;
				break;
			case 'files': // function form_file($name, $id, $label_name, $label_for, $size = "") {
				$form_item = $this -> form_file($name, $id, $label_name, $label_for, $size);
				break;
			case 'sheets': // function form_file($name, $id, $label_name, $label_for, $size = "") {
				$form_item = $this -> form_sheets($name, $id, $parameter, $label_name, $label_for);
				break;
		}
		make_log("[form_item ]" .$form_item . "[/form_item]");
		return $form_item;
	}

	// 文本框函数
	public function form_text($name, $id, $label_name, $label_for, $validType, $value = "", $parameter) {
		$text = "<input type=\"text\" name=\"{$name}\" ";
		$text .= "id=\"{$id}\" ";
		if (!empty($value)) {
			$text .= "value=\"<?php echo $value ; ?>\" ";
		}
		switch ($validType) {
			case "int":
				$text .= "class=\" easyui-validatebox tb\" ";
				$text .= "data-options=\"required:true,validType:'integ'\"";
				break;
			case "char":
				$text .= "class=\" easyui-validatebox tb\" ";
				$text .= "data-options=\"required:true,validType:'length[1,255]'\"";
				break;
			case "varchar":
				$text .= "class=\" easyui-validatebox tb\" ";
				$text .= "data-options=\"required:true,validType:'length[1,1000]'\"";
				break;
			// case "mediumtext":
			// $text .= "class=\" easyui-validatebox tb\" ";
			// $text .= "style=\"width:500px;height:300px;\"";
			// break;
			case "datetime":
				$text .= "required=\"required\"  editable=\"false\" class=\" easyui-datetimebox\"";
				break;
			case "double":

				echo ("!!!!!!!" . $parameter);
				echo ("#####");
				$text .= "class=\" easyui-validatebox tb\" ";
				// 如果用户未定义则默认为二
				// if(isset($parameter)){$parameter=2;}
				switch ($parameter) {
					case 1:
						$text .= "data-options=\"required:true,validType:'xiaoshuyi'\"";
						break;
					case 2:
						$text .= "data-options=\"required:true,validType:'xiaoshuer'\"";
						break;
					case 3:
						$text .= "data-options=\"required:true,validType:'xiaoshusan'\"";
						break;
					case 4:
						$text .= "data-options=\"required:true,validType:'xiaoshusi'\"";
						break;
					case 5:
						$text .= "data-options=\"required:true,validType:'xiaoshuwu'\"";
						break;
					case 6:
						$text .= "data-options=\"required:true,validType:'xiaoshuliu'\"";
						break;
					case 7:
						$text .= "data-options=\"required:true,validType:'xiaoshuqi'\"";
						break;
					case 8:
						$text .= "data-options=\"required:true,validType:'xiaoshuba'\"";
						break;
					default:
						$text .= "data-options=\"required:true,validType:'xiaoshu'\"";
						break;
				}
				break;
		}
		$text .= "/>\n";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 文本框函数
	public function form_submit($name, $id, $label_name, $label_for, $validType, $value = "") {
		$text = '<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">提交</a>';
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 密码框函数
	public function form_passwd($name, $id, $label_name, $label_for, $value = "") {
		$text = "<input type=\"password\" name=\"{$name}\" ";
		$text .= "id=\"{$id}\" ";
		if (isset($value)) {
			$text .= "value=\"{$value}\" ";
		}
		$text .= "/>\n";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 隐藏域函数
	public function form_hidden($name, $id, $label_name, $label_for, $value = "") {
		$text = "<input type=\"hidden\" name=\"{$name}\" id=\"{$id}\" ";
		if (isset($value)) {
			$text .= "value=\"{$value}\" ";
		}
		$text .= "/>\n";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 表格函数
	public function form_sheets($name, $id, $options, $label_name, $label_for) {
			make_log("[sheetoptions ]" . $options . "[/sheetoptions]");
		$text = "<table id='$name' border ='1px'><tr>";
		$sheet_row = explode('-', $options);
		make_log("[sheet_row ]" . $sheet_row[3] . "[/sheet_row]");
		foreach ($sheet_row as $id => $value) {//表头
			$tr = explode(',', $value);
			$text .= "<td>" . $tr[0]. "</td>"; //调用自己的easy  再将多余的删除 $td[0]中文名 $td[1]英文名
			make_log("[value ]" . $value . "[/value]");
			make_log("[sheet_tr 0]" . $tr[0] . "[/sheet_tr]");
			make_log("[sheet_tr 1]" . $tr[1] . "[/sheet_tr]");
			make_log("[sheet_tr 2]" . $tr[2] . "[/sheet_tr]");
			make_log("[sheet_tr 3]" . $tr[3] . "[/sheet_tr]");
			make_log("[sheet_tr 4]" . $tr[4] . "[/sheet_tr]");
			make_log("[text]" . $text . "[/text]");

		}
		$text .= "</tr><tr>";

		foreach ($sheet_row as $id => $value) {//表体
			$text .= "<td>" ; //$td[2]文本类型  根据类型再switch
			$tr = explode(',', $value);
			$str=$this->form_easy($tr[1],$tr[0],$tr[2], $tr[3]);//zname ynamme tpye para
				make_log("[tr ]" . $tr[1].' '.$tr[0].' '.$tr[2].' '.$tr[3].' '.  "[/tr]");
				make_log("[str1 ]" . $str . "[/str1]");
			if($this -> layout){
				$num1=strpos($str,"</td>")+11;
				$num2=strpos($str,"</td>",$num1);
				$str=substr($str,$num1,-12);
			}else{
				$num1=strpos($str,'</label>');
				$str=substr($str,$num1);
			}
			$text .=$str."</td>";
		}

		$text .= "</tr></table> ";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	public function form_file($name, $id, $label_name, $label_for, $size = "") {
		$text = "<div  name=\"{$name}\"  class=\"up_load_file\" ";
		$text .= "id=\"{$id}\" ";
		if (isset($size)) {
			$text .= "size=\"{$size}\" ";
		}
		$text .= "></div>\n";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 复选框函数
	public function form_checkbox($name, $label = array(), $label_name, $label_for = "") {
		$text = "";
		foreach ($label as $id => $value) {
			$text .= "\n\t<input type=\"checkbox\" id=\"{$id}\" name=\"{$name}[]\" value=\"{$value}\" />";
			$text .= "<label for=\"{$id}\">{$value}</label>";
		}
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 单选框函数
	public function form_radio($name, $label = array(), $label_name, $label_for = "") {
		$text = "";
		foreach ($label as $id => $value) {
			$text .= "\n\t<input type=\"radio\" id=\"{$id}\" name=\"{$name}\" value=\"{$value}\" />";
			$text .= "<label for=\"{$id}\">{$value}</label> ";
		}
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 下拉菜单函数
	public function form_select($id, $name, $options = array(), $selected = false, $label_name, $label_for, $onchange = "") {
		if ($onchange !== "") {
			$text = "<select id=\"{$id}\" name=\"{$name}\" onchang=\"{$onchange}\">\n";
		} else {
			$text = "<select id=\"{$id}\" name=\"{$name}\">\n";
		}
		foreach ($options as $value) {
			if ($selected == $value) {
				$text .= "\t<option value=\"{$value}\" selected=\"selected\">{$value}</option>\n";
			} elseif ($selected === false) {
				$text .= "\t<option value=\"{$value}\">{$value}</option>\n";
			}
		}
		$text .= "</select>";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 多选列表函数
	public function form_selectmul($id, $name, $size, $options = array(), $label_name, $label_for) {
		$text = "<select id=\"{$id}\" name=\"{$name}[]\" size=\"{$size}\" multiple=\"multiple\">\n";
		foreach ($options as $value) {
			$text .= "\t<option value=\"{$value}\">{$value}</option>\n";
		}
		$text .= "</select>\n";
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 按钮函数
	public function form_button($id, $name, $type, $value, $onclick = "") {
		$text = "<button id=\"{$id}\" name=\"{$name}\" type=\"{$type}\"";
		if ($onclick !== "") {
			$text .= " onclick='{$onclick}'";
		}
		$text .= ">" . $value;
		$text .= "</button>\n";
		if ($this -> layout == true) {
			$form_item = "<tr>\n\t<th> </th><td>{$text}</td>\n</tr>\n";
		} else {
			$form_item = $text;
		}
		return $form_item;
	}
	// 文本域函数
	public function form_textarea($id, $name, $cols, $rows, $label_name, $label_for, $value = "") {
		if (!empty($value)) {
			$text = "<textarea id=\"{$id}\" name=\"{$name}\" style=\"width:800px;height:200px;\"><?php echo {$value} ; ?></textarea>\n";
		} else {
			$text = "<textarea id=\"{$id}\" name=\"{$name}\" style=\"width:800px;height:200px;\"></textarea>\n";
		}
		$label = $this -> form_label($label_name, $label_for);
		$form_item = $this -> form_item($label, $text);
		return $form_item;
	}
	// 文字标签函数
	public function form_label($text, $for) {
		if ($for !== "") {
			$label = "<label for=\"{$for}\">{$text}：</label>";
		} else {
			$label = $text . "：";
		}
		return $label;
	}

	public function form_item($form_label, $form_text) {
		switch ($this -> layout) {
			case true:
				$text = "<tr>\n";
				$text .= "\t<td class=\"label\">";
				$text .= $form_label;
				$text .= "\n\t</td>\n";
				$text .= "\t<td>";
				$text .= $form_text;
				$text .= "\n\t</td>\n";
				$text .= "</tr>\n";
				break;
			case false:
				$text = $form_label;
				$text .= $form_text;
				break;
		}
		return $text;
	}

	public function create_form($form_item = array()) {
		$str = $this -> form_start();
		foreach ($form_item as $item) {
			$str .= $item;
		}
		$str .= $this -> form_end();
		return $str;
	}
}
?>