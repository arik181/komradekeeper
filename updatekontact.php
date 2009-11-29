<?php
 include('head.php');
 include('connect.php');

 $contactid = $_GET['contactid'];

 echo"<table border=0>";
 echo"<td width=200>";
 include('menu.php');
 echo"<div>";
 echo"</div>";
 echo"</td>";
 echo"<td>";

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
  if (empty($contactid)) {
    echo"No contact specified to update.";
  } else
  {
   $query = "
    SELECT c.name,c.address,c.city,c.state,c.zip,u.name,u.password
    FROM contact c JOIN users u ON cast(c.userid as integer) = u.userid
    WHERE u.name = '" . $_COOKIE['uname'] . "' AND u.password = '" . $_COOKIE['passwd'] .
    "' AND c.userid = '" . $_COOKIE["userid"] . "'
    AND c.contactid = " . $contactid . ";"; 
 
   $contactresult = pg_query($connection, $query);

   if (pg_num_rows($contactresult) == 0) {
    echo"Contact not found to be updated.";
   } else
   {
    //$me = $_SERVER['PHP_SELF'];
    include('updateform.php');
   }
  }
 } else
 {

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
 
  }

  // Close db connection
  if ($connection) { pg_close($connection); }

  echo"</td>";
  echo"</table>";

  include('tail.php');
 }
?>

