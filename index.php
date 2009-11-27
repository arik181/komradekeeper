<?php


 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {

  if (isset($_COOKIE['uname']))
  {
    include('head.php');
    include('menu.php');
    include('tail.php');
  }
  else
  {
    include('head.php');
    include('loginform.php');
    include('tail.php');
  }

 }
?>
