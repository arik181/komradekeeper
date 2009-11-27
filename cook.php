<?php 

  $uname =  $_POST['username'];
  $passwd =  $_POST['passwd'];

  setcookie("uname", $uname); 
  setcookie("passwd", $passwd); 

  // Redirect
  header('Location: main.php');

?>

