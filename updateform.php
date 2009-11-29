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
      <td colspan=2 align="right"> <input type="submit" value="Search Contacts"> </td>
     </tr>
    </table>
   </form>
