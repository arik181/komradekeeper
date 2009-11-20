<?php
 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];
?>

 <table border=0>
  <td width=200>
    <?php include('menu.php');?>
    <div>
    </div>
  </td>
  <td>
   <form action="<?php echo $me;?>" method="POST">
    <table border=0 cellpadding=4 cellspacing=4>
     <tr>
      <td colspan=2>
      Please enter the information you wish to search for:
      </td>
     </tr>
     <tr>
      <td> Contact Name: </td>
      <td align="right"><input type="text" name="name"></td>
     </tr>
     <tr>
      <td> Address: </td>
      <td align="right"><input type="text" name="address"></td>
     </tr>
     <tr>
      <td> City:</td>
      <td align="right"><input type="text" name="city"></td>
     </tr>
     <tr>
      <td> State:</td>
      <td align="right"><input type="text" name="state"></td>
     </tr>
     <tr>
      <td> Zip:</td>
      <td align="right"><input type="text" name="zip"></td>
     </tr>
     <tr>
      <td colspan=2 align="right"> <input type="submit" value="Add new Contact"> </td>
     </tr>
    </table>
   </form>
  </td>
 </table>

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

 include('tail.php');
?>

