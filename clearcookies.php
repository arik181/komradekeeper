<?php 

  $uname = "";
  $passwd = "";

  setcookie("uname", $uname); 
  setcookie("passwd", $passwd); 

  unset($_COOKIE['uname']);
  unset($_COOKIE['passwd']);

?>

