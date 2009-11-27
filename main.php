<?php

 include('connect.php');

 // Compare the username and pass to the database
 $query = "
 SELECT name, password 
 FROM users 
 WHERE name = '" . $_COOKIE['uname'] . "' AND password = '" . $_COOKIE['passwd'] . "';";

 $result = pg_query($connection, $query);

 //$colnum = pg_num_fields($result);
 $rownum = pg_num_rows($result);

 if (!$result || !$rownum)
 {
   include('clearcookies.php');
   include('head.php');
   include('loginform.php');
   echo "Sorry, that username/password combination does not exist.";
 }
 else
 {
   include('head.php');
   include('menu.php');
 }

 // Close db connection
 if ($connection) { pg_close($connection); }
 include('tail.php');

?>

