 <?php
include "connect/toolconnect.php";
// $name="my_fulltest";
// $field="formsyname";
$name = $mysqli ->real_escape_string(trim($_POST['name']));
$field = $mysqli ->real_escape_string(trim($_POST['field']));
if($field=="formsyname") {
	$name = "my_".$name;
}
$query = "select `$field` from `self_defined_forms` where `$field` = '$name'";
// echo $query;
$result = $mysqli -> query($query);
$num=$result->num_rows;
echo $num;
// echo $name."存在";
?>
