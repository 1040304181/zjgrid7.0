<?php
$file = 'tree_data2.json';
// Open the file to get existing content
//$current = file_get_contents($file);
// Append a new person to the file
$current = "[{\"id\": 1,\"text\": \"自定义表单\",\"url\": \"self_defined_forms.php\"}]";
// Write the contents back to the file
file_put_contents($file, $current);
?>
