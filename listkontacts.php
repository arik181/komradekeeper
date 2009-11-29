<?php
 include('head.php');

 include('connect.php');

 echo "<table border=0>";
 echo "<td width=200>";
 include('menu.php');
 echo "<div>";
 echo "</div>";
 echo "</td>";
 echo "<td>";
 echo "Contact List:";

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

 $query = "
  SELECT c.contactid,c.name,c.address,c.city,c.state,c.zip
  FROM contact c JOIN users u ON cast(c.userid as integer) = u.userid
  WHERE u.name = '" . $_COOKIE['uname'] . "' AND u.password = '" . $_COOKIE['passwd'] .
  "' AND c.userid = '" . $_COOKIE["userid"] . "' ";
 
 for ($i=0; $i<5; ++$i)
 {
   if ($queryparts[$i])
   {
     $query = $query . " AND " . $queryname[$i] . " ILIKE '%" . $queryparts[$i] . "%'";
   }
 }

 $query = $query . ";";

 $result = pg_query($connection, $query);
 $colnum = pg_num_fields($result);

 echo "<table class=\"table\">\n<tr>\n";
    
 for ($i=1;$i<$colnum;++$i)
 {
  echo "<td>";
  echo pg_field_name($result, $i);
  echo "</td>";
 }
 echo "</tr><p>\n";
 while ($row = pg_fetch_row($result)) 
 {
  echo "<tr>";

  for ($i=1;$i<$colnum;++$i)
  {

   echo "<td>";
   if ($i == 1)
   {
     echo "<a href=\"updatekontact.php?contactid=" . $row[0] . "\">";
   }
   echo "$row[$i]";
   if ($i == 1)
   {
     echo "</a>";
   }

   echo "</td>\n";

  }

  echo "</tr>";
  }
 echo "</table>\n";
 echo "</div>\n</div>\n";
 
 // Close db connection
 if ($connection) { pg_close($connection); }

 echo "</td>";
 echo "</table>";

 include('tail.php');
?>

