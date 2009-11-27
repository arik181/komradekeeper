<?php

 include('cook.php');
 include('menu.php');
 include('connect.php');

 // Compare the username and pass to the database
 $query = "
 SELECT name, password 
 FROM users 
 WHERE name = '" . $_POST['username'] . "' AND password = '" . $_POST['passwd'] . "';";

 $result = pg_query($connection, $query);

 //$colnum = pg_num_fields($result);
 $rownum = pg_num_rows($result);

 if (!$result || !$rownum)
 {
   echo "Sorry, that username/password combination does not exist.";
 }
 else
 {
 }

 // Close db connection
 if ($connection) { pg_close($connection); }
 include('tail.php');

?>

