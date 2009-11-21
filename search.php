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
      <td colspan=2 align="right"> <input type="submit" value="Search Contacts"> </td>
     </tr>
    </table>
   </form>
  </td>
 </table>

<?php

 } else
 {
  include('connect.php');

  $queryparts[0] = $_POST['name'];
  $queryparts[1] = $_POST['address'];
  $queryparts[2] = $_POST['city'];
  $queryparts[3] = $_POST['state'];
  $queryparts[4] = $_POST['zip'];

  $queryname[0] = "name";
  $queryname[1] = "address";
  $queryname[2] = "city";
  $queryname[3] = "state";
  $queryname[4] = "zip";

  // Build the query
  $query = "
   SELECT * FROM contact 
   WHERE ";

  for ($i=0; $i<4; ++$i)
  {
    if ($queryparts[$i])
    {
      $query = $query . " " . $queryname[$i] . " LIKE '%" . $queryparts[$i] . "%'";

      $j = $i+1;
      while ($j < 4)
      {
        if ($queryparts[$j])
        {
	  $query = $query . " AND ";
          break;
        }
        ++$j;
      }
    }
  }

  $query = $query . ";";
  //Debug print statement
  echo $query;

/*
  // Do the search
  $result = pg_query($connection, $query);
  $colnum = pg_num_fields($result);

  echo "<br>" . pg_num_rows($result) . " rows returned \n";
  echo "<table border=1 cellpadding=4 cellspacing=2>\n<tr>\n";
    
  for ($i=0;$i<$colnum;++$i)
  {
   echo "<td>";
   echo pg_field_name($result, $i);
   echo "</td>";
  }
  echo "</tr><p>\n";
  while ($row = pg_fetch_row($result)) 
  {
   echo "<tr>";
   for ($i=0;$i<$colnum;++$i)
   {
    echo "<td>";
    echo "$row[$i]";
    echo "</td>\n";
   }
   echo "</tr>";
  }
  echo "</table>\n";
  
  echo "</div>\n</div>\n";


  // Close db connection
  if ($connection) { pg_close($connection); }
*/
 include('tail.php');
 }
?>

