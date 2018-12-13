<?php
session_start();
//判断是否登录
if(empty($_SESSION['user'])) {
	echo("<script>alert('归还信息填写不完整！');</script>");
	header("Location: ./login.php");
}
header("Content-Type: text/html;charset=UTF-8");
//用户信息
$ID = trim($_POST["ID"]);
$name = trim($_POST["name"]);
$NO = trim($_POST["NO"]);
$type = trim($_POST["type"]);
$num = trim($_POST["num"]);
$unit = trim($_POST["unit"]);
$cause = trim($_POST["cause"]);
$borrower = trim($_POST["borrower"]);
$borrowtime = trim($_POST["borrowtime"]);
$tel = trim($_POST["tel"]);
$borrowadmin = trim($_POST["borrowadmin"]);
$deadline = trim($_POST["deadline"]);
$returntime = trim($_POST["returntime"]);
$returnadmin = trim($_POST["returnadmin"]);
$returner = trim($_POST["returner"]);
$mortgage = trim($_POST["mortgage"]);
$note = trim($_POST["note"]);
$sub = trim($_POST["sub"]);
$ctr = trim($_POST["ctr"]);
$class1=trim($_GET["class1"]);
switch($_GET['class1']) {
	case 'tool':
		$title="工器具";
	break;
	case 'key':
		$title="钥匙";
	break;
	case 'spare':
		$title="备品备件";
	break;
	case 'material':
		$title="资料";
	break;
	case 'other':
		$title="其他";
	break;
}
//验证数据是否正确 
if(isset($_GET['update'])) {
	if(  empty($returntime) || empty($returnadmin) ) {
		//判断跳转位置
		if($ctr==edit) {
			$ctr="some_edit.php?ID=".$ID."class1=".$class1;
		}else {
			$ctr="some_add.php?class1=".$class1;
		}
		echo "<script>alert('归还信息填写不完整！');window.location.href = './".$ctr."'</script>";
		exit;
	}
}else{
	//完整
	if( empty($name) || empty($type) || empty($num)  || empty($unit) || empty($cause) || empty($borrowtime) || empty($borrower)|| empty($tel) || empty($borrowadmin) || empty($deadline)|| empty($mortgage)) {
		//判断跳转位置
		if($ctr==edit) {
			$ctr="tooledit.php?ID=".$ID."class1=".$class1;
		}else {
			$ctr="tooladd.php?class1=".$class1;
		}
		echo "<script>alert('借用信息填写不完整！');window.location.href = './".$ctr."'</script>";
		exit;
	}
//时间先后验证
$diff=diffBetweenTwoDays( $borrowtime,$deadline);
if($diff>0){		
		//判断跳转位置
		if($ctr==edit) {
			$ctr="some_edit.php?ID=".$ID."class1=".$class1;
		}else {
			$ctr="some_add.php?class1=".$class1;
		}
		echo "<script>alert('借用时间应小于最后期限!');window.location.href = './".$ctr."'</script>";
	exit;
}
}
//防注入需要加强****************************************************************************************S

//插入数据库
require_once "connect/toolconnect.php"; 
//判断是否是更新操作
if(isset($_GET['update'])) {
		$id = intval(trim($_GET['update']));
	$sql = "update {$class1} set returntime = '{$returntime}',returnadmin = '{$returnadmin}',returner = '{$returner}',note = '{$note}',sub = '{$sub}' where ID = {$id}";
	if(mysql_query($sql)) {
		//成功
		if($sub==1) {
			echo "<script>alert('归还成功！');window.location.href = './some_grid.php?class1={$class1}'</script>";
		}else {
			echo "<script>alert('更新成功！');window.location.href = './some_grid.php?class1={$class1}'</script>";
		}
	} else {
		//失败
			//判断跳转位置
			if($ctr==edit) {
				$ctr="some_edit.php?ID=".$ID."&class1=".$class1;
			}else {
				$ctr="some_add.php?class1=".$class1;
			}
			echo($sql);
		echo "<script>alert('编辑操作失败！');window.location.href = './".$ctr."'</script>";
	}
} else {
	//判断是否重复提交
	$rs = mysql_query("select ID from tool");
	$row = mysql_fetch_row($rs);
	if($row==$ID) {
		echo "<script>alert('已经提交！请重填写'); </script>";
	}
	$sql = "INSERT INTO `{$class1}`( `name`, `NO`,`type`, `num`, `unit`, `cause`, `borrowtime`, `borrower`,`tel`, `borrowadmin`, `deadline`, `mortgage`, `note`)
 values('{$name}', '{$NO}', '{$type}', '{$num}', '{$unit}', '{$cause}', '{$borrowtime}', '{$borrower}', '{$tel}', '{$borrowadmin}', '{$deadline}', '{$mortgage}', '{$note}')";

	if(mysql_query($sql)) {
		//成功
		echo "<script>alert('借用成功！'); closeTabA('{$title}借用登记');</script>";
	} else {
		//失败
			//判断跳转位置
			if($ctr==edit) {
				$ctr="some_edit.php?ID=".$ID."&class1=".$class1;
			}else {
				$ctr="some_add.php?class1=".$class1;
			}
			echo($sql);
		echo "<script>alert('增加操作失败！');window.location.href = './".$ctr."'</script>";
	}
}
mysql_close($con);
/**
 * 求两个日期之间相差的天数
 * (针对1970年1月1日之后，求之前可以采用泰勒公式)
 * @param string $day1
 * @param string $day2
 * @return number
 */
function diffBetweenTwoDays ($day1, $day2)
{
  $second1 = strtotime($day1);
  $second2 = strtotime($day2);
//  if ($second1 < $second2) {
//    $tmp = $second2;
//    $second2 = $second1;
//    $second1 = $tmp;
//  }
  return ($second1 - $second2) / 86400;
}

?>
