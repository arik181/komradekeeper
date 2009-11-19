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
      Please enter the information for the new kontact:
      </td>
     </tr>
     <tr>
      <td> Kontact Name: </td>
      <td><input type="text" name="name"></td>
     </tr>
     <tr>
      <td> Address: </td>
      <td><input type="text" name="address"></td>
     </tr>
     <tr>
      <td> City:</td>
      <td><input type="text" name="city"></td>
     </tr>
     <tr>
      <td> State:</td>
      <td><input type="text" name="state"></td>
     </tr>
     <tr>
      <td> Zip:</td>
      <td><input type="text" name="zip"></td>
     </tr>
     <tr>
      <td colspan=2 align="right"> <input type="submit" value="Add new Kontact"> </td>
     </tr>
    </table>
   </form>

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

