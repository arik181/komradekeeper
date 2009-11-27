<?php
 include('head.php');

 $name    = $_POST['name'];
 $address = $_POST['address'];
 $city    = $_POST['city'];
 $state   = $_POST['state'];
 $zip     = $_POST['zip'] ;

 if (($_SERVER['REQUEST_METHOD'] != 'POST') || empty($name) || empty($address) || empty($city) || empty($state) || empty($zip))
 {

   $me = $_SERVER['PHP_SELF'];
   include('addform.php');

 } else
 {

   include('connect.php');

   // Insert the new contact
   $query = "
    INSERT INTO contact
    VALUES ( nextval('contactidseq'),'" . $_POST['name'] . "','" . $_POST['address'] . "','" . $_POST['city'] . "','" . $_POST['state'] . "','" . $_POST['zip'] . "','" . $_COOKIE['userid'] . "');";
   $result = pg_query($connection, $query);

   // Close db connection
   if ($connection) { pg_close($connection); }

   include('menu.php');

   // Debug statements
   //echo "success\n";
   //echo $query;

  }
 include('tail.php');
?>

