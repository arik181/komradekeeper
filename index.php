<?php

 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {

?>
   <form action="main.php" method="POST">
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
      <td align="left"><a href="newuser.php">New User?</a> </td>
      <td align=right><input type="submit" value="Log In"></td>
     </tr>
     <tr>
     </tr>
    </table>
   </form>

<?php
 include('tail.php');
}
?>
