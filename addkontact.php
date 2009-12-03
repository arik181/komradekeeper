<?php
 include('head.php');

 $name    = $_POST['name'];
 $address = $_POST['address'];
 $city    = $_POST['city'];
 $state   = $_POST['state'];
 $zip     = $_POST['zip'] ;
 $email     = $_POST['email'] ;
 $phone = $_POST['phone'] ;
 $phonetype     = $_POST['phonetype'] ;

 if (($_SERVER['REQUEST_METHOD'] != 'POST'))
 {

   $me = $_SERVER['PHP_SELF'];
   include('addform.php');

 }
 elseif (($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($name) || empty($address) || empty($city) || empty($state) || empty($zip)))
 {

   //$me = $_SERVER['PHP_SELF'];
   include('addform.php');
   include('adderror.php');

 } else
 {

   include('connect.php');

   // Insert the new contact
   $query = "
    INSERT INTO contact
    VALUES ( nextval('contactidseq'),'" . $_POST['name'] . "','" . $_POST['address'] . "','" . $_POST['city'] . "','" . $_POST['state'] . "','" . $_POST['zip'] . "','" . $_COOKIE['userid'] . "');";
   $result = pg_query($connection, $query);

   if (!empty( $_POST['email'])) {
    $query2 = "
     INSERT INTO email
     VALUES ( '" . $_POST['email'] . "', lastval() );";
    $result2 = pg_query($connection, $query2);
   }

   if (!empty( $_POST['phone'])) {
    $query3 = "
     INSERT INTO phone 
     VALUES ( '" . $_POST['phone'] . "', lastval() ,'" . $_POST['phonetype'] . "');";
    $result3 = pg_query($connection, $query3);
   }


   // Close db connection
   if ($connection) { pg_close($connection); }

   echo"<table border=0>";
    echo"<td width=200>";
    include('menu.php');
    echo"<div>";
    echo"</div>";
   echo"</td>";
   echo"<td>";
    echo"<table border=0>";
     echo"<td>";
      echo"New contact added successfully.";
     echo"</td>";
    echo"</table>";
   echo"</td>";
   echo"</table>";


   // Debug statements
   //echo "success\n";
   //echo $query;

  }
 include('tail.php');
?>

