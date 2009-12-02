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
      Please enter the information for the new contact:
      </td>
     </tr>
     <tr>
      <td> Contact Name: </td>
      <td align="right"><input type="text" name="name">*</td>
     </tr>
     <tr>
      <td> Address: </td>
      <td align="right"><input type="text" name="address">*</td>
     </tr>
     <tr>
      <td> City:</td>
      <td align="right"><input type="text" name="city">*</td>
     </tr>
     <tr>
      <td> State:</td>
      <td align="right"><input type="text" name="state">*</td>
     </tr>
     <tr>
      <td> Zip:</td>
      <td align="right"><input type="text" name="zip">*</td>
     </tr>
     <tr>
      <td> Email:</td>
      <td align="right"><input type="text" name="email">&nbsp;</td>
     </tr>
     <tr>
      <td colspan=2 align="right"> <input type="submit" value="Add new Contact"> </td>
     </tr>
     <tr>
      <td colspan=2 align="right"> * denotes required field</td>
     </tr>
    </table>
   </form>
  </td>
 </table>
