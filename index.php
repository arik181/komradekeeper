<?php

 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];

?>
   <form action="<?php echo $me;?>" method="POST">
    <table border=0 cellpadding=4 cellspacing=4>
     <tr>
      <td> Username: </td>
      <td><input type="text" name="username"></td>
     </tr>
     <tr>
      <td>Password: </td>
      <td><input type="password" name="passwd"></td>
     </tr>
     <tr>
      <td align="left"><a href=newuser.php>New User?</a> </td>
      <td align=right><input type="submit" value="Log In"></td>
     </tr>
     <tr>
     </tr>
    </table>
   </form>

<?php
 } else
 {
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
    echo "Welcome!";
  }

  // Close db connection
  pg_close($connection);
 }
 include('tail.php');
?>
