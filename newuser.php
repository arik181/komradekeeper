<?php

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {

   include('head.php');
   $me = $_SERVER['PHP_SELF'];
   include('newuserform.php');
   include('tail.php');

 } else
 {
  include('connect.php');

  $valid = 1;
  $inconsistentpass = 0;
  $unameconflict = 0;
  $datadoesnotexist = 0;
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

      if (empty($_POST['username'])||empty($_POST['passwd'])||empty($_POST['passwd2']))
      {
        $valid = 0;
        $datadoesnotexist = 1;
      }
    }

  if ($valid)
  {
    $query = "SELECT * FROM users";
    $result = pg_query($connection, $query);
    $rownum = pg_num_rows($result);

    // Insert the username
    $query = "
    INSERT INTO users
    VALUES ( nextval('useridseq'),'" . $_POST['passwd'] . "','" . $_POST['username'] . "');";
    $result = pg_query($connection, $query);
    include('head.php');
    include('loginform.php');
    echo "You may now log in.";
    include('tail.php');

    // Close db connection
    if ($connection) { pg_close($connection); }

  }
  else 
  {
    // Display an error 
    if ($datadoesnotexist)
    {
      include('head.php');
      include('newuserform.php');
      echo "User and password fields are required."; 
      include('tail.php');
    }
    else if ($inconsistentpass)
    {
      include('head.php');
      include('newuserform.php');
      echo "Passwords must match"; 
      include('tail.php');
    }
    else if ($unameconflict)
    {
      include('head.php');
      include('newuserform.php');
      echo "Sorry, the username " . $_POST['username'] . " is taken."; 
      include('tail.php');
    }
  }

 }
?>

