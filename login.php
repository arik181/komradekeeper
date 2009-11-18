<?php
include("connect.php");

// Extract query
$query = "	
 SELECT * FROM contact;";
 //WHERE state = 'OK';";

$result = pg_query($connection, $query) or die("Query error: " . pg_last_error());

$colnum = pg_num_fields($result);

// Init document

include('head.php');
?>

<div align="left" class="leftbottom"> </div>
<div align="left" class="topbar"> </div>
<div align="left" class="rightbar"> </div>
<div align="left" class="nametag1"> </div>
<div align="left" class="nametag2"> </div>

<div align="center" class="lefttop">
</div>
<p>
<div align="left" style="body">
 <span class="whitek">K<br></span>
 <span class="body meshadow1">Komrade Keeper<br></span>
 <span class="body metext">Komrade Keeper<br></span>
 <div align="left" class="bordershadow main1shadow"> </div>
 <div align="left" class="border main1">
  <div align="left" class="listinput sub">
   Output:

<?php
echo "<br>" . pg_num_rows($result) . " rows returned \n";

echo "<table border=1 cellpadding=4 cellspacing=2>" . "\n";
echo "<tr>" . "\n";

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

echo "</div>\n</div>" . "\n";
include('tail.php');

pg_close($connection);

?>
