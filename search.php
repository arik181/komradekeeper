<?php
 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];

   include('searchform.php');

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
  $queryempty = 1;

  for ($i=0; $i<5; ++$i)
  {
    if (!empty($queryparts[$i]))
      $queryempty = 0;
  }
  if ($queryempty) { include('searchform.php'); }
  else
  {
   $query = "
    SELECT * FROM contact 
    WHERE ";
 
   for ($i=0; $i<5; ++$i)
   {
     if ($queryparts[$i])
     {
       $query = $query . " " . $queryname[$i] . " ILIKE '%" . $queryparts[$i] . "%'";
 
       $j = $i+1;
       while ($j < 5)
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
   //echo $query;
 
   // Do the search
   $result = pg_query($connection, $query);
   $colnum = pg_num_fields($result);
 
   //Debug print statement
   //echo "<br>" . pg_num_rows($result) . " rows returned \n";
 
   echo "<table class=\"table\">\n<tr>\n";
     
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
     if ($i == 1)
     {
       echo "<a href=\"updatekontact.php\">";
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

  }
 include('tail.php');
 }

?>

