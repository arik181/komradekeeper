<?php

// Set up connection
//$connection_string = "";

// Extract query
$query = "	
	SELECT * FROM contact;";
	//WHERE state = 'OK';";

$result = pg_query($connection, $query) or die("Query error: " . pg_last_error());

$colnum = pg_num_fields($result);

// Init document

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">' . "\n";
echo '<html>' . "\n";
echo '<head>' . "\n";
echo '<title>arik181</title>' . "\n";
echo '	<meta name="author" content="">' . "\n";
echo '	<meta name="date" content="2008-11-08T20:32:31-0800">' . "\n";
echo '	<meta name="copyright" content="">' . "\n";
echo '	<meta name="keywords" content="">' . "\n";
echo '	<meta name="description" content="">' . "\n";
echo '	<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">' . "\n";
echo '	<meta http-equiv="content-type" content="text/html; charset=UTF-8">' . "\n";
echo '	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">' . "\n";
echo '	<meta http-equiv="content-style-type" content="text/css">' . "\n";
echo '	<meta http-equiv="expires" content="0">' . "\n";
echo '	<link type="text/css" title="blue" rel="stylesheet" href="blue.css">' . "\n";
echo '</head>' . "\n";
echo '<body>' . "\n";
echo '' . "\n";
echo '' . "\n";
echo '<div align="left" class="leftbottom"> </div>' . "\n";
echo '<div align="left" class="topbar"> </div>' . "\n";
echo '<div align="left" class="rightbar"> </div>' . "\n";
echo '<div align="left" class="nametag1"> </div>' . "\n";
echo '<div align="left" class="nametag2"> </div>' . "\n";
echo '' . "\n";
echo '<div align="center" class="lefttop">' . "\n";
echo '</div>' . "\n";
echo '<p>' . "\n";
echo '<div align="left" style="body">' . "\n";
echo '	<span class="whitek">K<br></span>' . "\n";
echo '	<span class="body meshadow1">Komrade Keeper<br></span>' . "\n";
echo '	<span class="body metext">Komrade Keeper<br></span>' . "\n";
echo '	<div align="left" class="bordershadow main1shadow"> </div>' . "\n";
echo '	<div align="left" class="border main1">' . "\n";
echo '		<div align="left" class="listinput sub">' . "\n";
echo '			Output:' . "\n";

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

echo '		</div>' . "\n";
echo '	</div>' . "\n";
echo '</div>\n</div>\n<p>\n</body>\n</html>' . "\n";

pg_close($connection);



?>
