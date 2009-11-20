<?php
 include('head.php');
 include('menu.php');
 include('greeting.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];
?>

<?php

 } else
 {
  include('connect.php');

    // Insert the new contact
    $query = "
    INSERT INTO users
    VALUES ( nextval('contactidseq'),'" . $_POST['name'] . "','" . $_POST['address'] . "','" . $_POST['city'] . "','" . $_POST['state'] . "','" . $_POST['zip'] . "');";
    $result = pg_query($connection, $query);
  }

  // Close db connection
  if ($connection) { pg_close($connection); }

 }
 include('tail.php');
?>

