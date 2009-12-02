<?php
 include('head.php');

 if ($_SERVER['REQUEST_METHOD'] != 'POST')
 {
   $me = $_SERVER['PHP_SELF'];

   include('searchform.php');

 } else
 {
  include('connect.php');

  echo "<table border=0>";
  echo "<td width=200>";
  include('menu.php');
  echo "<div>";
  echo "</div>";
  echo "</td>";
  echo "<td>";
  echo "Results of search:";

  $queryparts[0] = $_POST['name'];
  $queryparts[1] = $_POST['address'];
  $queryparts[2] = $_POST['city'];
  $queryparts[3] = $_POST['state'];
  $queryparts[4] = $_POST['zip'];

  $queryname[0] = "c.name";
  $queryname[1] = "c.address";
  $queryname[2] = "c.city";
  $queryname[3] = "c.state";
  $queryname[4] = "c.zip";

  $query = "
  SELECT c.contactid,c.name as \"Name\", c.address as \"Address\", c.city as \"City\",
  c.state as \"State\", c.zip as \"Zip\", e.emailaddr as \"Email Address\"
  FROM contact c JOIN users u ON c.userid = u.userid
  LEFT OUTER JOIN email e ON c.contactid = e.contactid
  WHERE u.name = '" . $_COOKIE['uname'] . "' AND u.password = '" . $_COOKIE['passwd'] .
  "' AND c.userid = '" . $_COOKIE["userid"] . "' ";

  for ($i=0; $i<5; ++$i)
  {
    if ($queryparts[$i])
    {
      $query = $query . " AND " . $queryname[$i] . " ILIKE '%" . $queryparts[$i] . "%'";
    }
  }

  $query = $query . " ORDER by c.name;";

  //Debug print statement
  //echo $query;

  // Do the search
  $result = pg_query($connection, $query);
  $colnum = pg_num_fields($result);

  //Debug print statement
  //echo "<br>" . pg_num_rows($result) . " rows returned \n";

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
 }

?>

