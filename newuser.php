<?php
 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];
?>

   <form action="<?php echo $me;?>" method="POST">
    <table border=0 cellpadding=4 cellspacing=4>
     <tr>
      <td colspan=2>
      Please enter the information for the new user:
      </td>
     </tr>
     <tr>
      <td> Username: </td>
      <td><input type="text" name="username"></td>
     </tr>
     <tr>
      <td> Password: </td>
      <td><input type="password" name="passwd"></td>
     </tr>
     <tr>
      <td> Password (again): <td><input type="password" name="passwd2"></td>
     </tr>
     <tr>
      <td colspan=2 align="right"> <input type="submit" value="Add new user"> </td>
     </tr>
    </table>
   </form>

<?php

 } else
 {
  include('connect.php');

  $valid = 1;
  $inconsistentpass = 0;
  $unameconflict = 0;
  // Verify the validity of the username
    // By first testing the matching passwords...
    if ($_POST['passwd'] != $_POST['passwd2'])
    {
      $valid = 0;
      $inconsistentpass = 1;
    }
    else 
    {
      // ...and then by checking name availability 
      $query = "
       SELECT name
       FROM users
       WHERE name = '" . $_POST['username'] . "';"; 

      $result = pg_query($connection, $query);
      $rownum = pg_num_rows($result);

      if ($result && $rownum)
      {
        $valid = 0;
        $unameconflict = 1;
      }
    }

  if ($valid)
  {
    $query = "SELECT * FROM users";
    $result = pg_query($connection, $query);
    $rownum = pg_num_rows($result);

    // Insert the username
    // Note: The following query is broken. It does not yet properly
    // serialize the user id number. What we need here is
    // a sequence that we can retrieve from the database.
    $query = "
    INSERT INTO users
    VALUES ( nextval('useridseq'),'" . $_POST['passwd'] . "','" . $_POST['username'] . "');";
    $result = pg_query($connection, $query);
}
  else 
  {
    // Display an error 
    if ($inconsistentpass)
    {
      echo $_POST['passwd'] . " " . $_POST['passwd2'] . " ";
      echo "Passwords must match"; 
    }
    else if ($unameconflict)
    {
      echo "Sorry, the username " . $_POST['username'] . " is taken."; 
    }
  }

  // Close db connection
  if ($connection) { pg_close($connection); }

 }
 include('tail.php');
?>

