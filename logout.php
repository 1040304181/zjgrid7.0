<?php
  session_start();
  unset($_SESSION["username"]);
  unset($_SESSION["userpwd"]); 
  echo 'You have cleaned session';
  header('Refresh: 1; URL=index.php');
?>
