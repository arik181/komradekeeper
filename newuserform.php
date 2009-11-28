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
