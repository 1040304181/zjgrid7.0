 <?php
include('connect/toolconnect.php');
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID';
$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
$abstract =isset($_GET['abstract']) ? intval($_GET['abstract']) : 1;
$tables=isset($_GET['tables']) ? strval($_GET['tables']) : '';
global $Briefing_Length;//\
$Briefing_Length = 250;
$offset = ($page-1) * $rows;
$result = array();
$sql="select count(*) from " . $tables;
//echo $sql;
$rs = $mysqli->query($sql);
//echo $mysqli->error;
$row = $rs->fetch_row();
//echo $row;
$result["total"] = $row[0];
$rs1 = $mysqli->query("select * from " . $tables . " order by $sort $order  limit $offset,$rows");
$items = array();

while ($row =$rs1->fetch_object()) {
	// 如果字段太长 则精简
	// $row=strip_tags($row);
	// $row=substr($row,0,50);
	$row = (array)$row;
	if ($abstract == 1) {
		$ia = array_keys((array)$row);
		for($ii = 1; $ii <= count($row); $ii++) {
			if (strlen($row[$ia[$ii]]) > $Briefing_Length) {
				$row[$ia[$ii]] = Generate_Brief($row[$ia[$ii]])."...";
			}
		}
	}
	array_push($items, $row);
}
$result["rows"] = $items;
echo json_encode($result);

function Generate_Brief($text) {
	global $Briefing_Length;

	if (strlen($text) <= $Briefing_Length) return $text;
	$Foremost = substr($text, 0, $Briefing_Length);

	$re = "/<(\/?)(P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|OBJECT|A|UL|OL|LI|BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT|SPAN)[^>]*(>?)/i";
	$Single = "/BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT/i";

	$Stack = array();
	$posStack = array();
	preg_match_all($re, $Foremost, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);

	/**
	 * [Child-matching Specification]:
	 *
	 * $matches[$i][1] : A "/" charactor indicating whether current "<...>" Friction is Closing Part
	 * $matches[$i][2] : Element Name.
	 * $matches[$i][3] : Right > of a "<...>" Friction
	 */

	for($i = 0 ; $i < count($matches); $i++) {
		if ($matches[$i][1][0] == "") {
			$Elem = $matches[$i][2][0];
			if (preg_match($Single, $Elem) && $matches[$i][3][0] != "") {
				continue;
			}
			array_push($Stack, strtoupper($matches[$i][2][0]));
			array_push($posStack, $matches[$i][2][1]);
			if ($matches[$i][3][0] == "") break;
		} else {
			$StackTop = $Stack[count($Stack)-1];
			$End = strtoupper($matches[$i][2][0]);
			if (strcasecmp($StackTop, $End) == 0) {
				array_pop($Stack);
				array_pop($posStack);
				if ($matches[$i][3][0] == "") {
					$Foremost = $Foremost . ">";
				}
			}
		}
	}

	$cutpos = array_shift($posStack) - 1;
	$Foremost = substr($Foremost, 0, $cutpos);
	return $Foremost;
}

?>

