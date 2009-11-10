<?php

// Set up connection
//$connection_string = "host=dbclass.cs.pdx.edu dbname=cs386 user=cs386 password=introdb";
$connection_string = "host=db.cs.pdx.edu dbname=arik182 user=arik182 password=wwjcd181";

$connection = pg_connect($connection_string) or die ("Could not connect to postgres" . pg_last_error($connection));

// Extract query
$query = " SELECT DISTINCT N.candname, N.party FROM candcl N; ";

$result = pg_query($connection, $query) or die("Query error: " . pg_last_error());

echo pg_num_rows($result) . " rows returned <br/>\n";
while ($row = pg_fetch_row($result)) 
{
	echo "Name: $row[0]<br/>\n";
	echo "Party: $row[1]<br/>\n";
}
pg_close($connection);


?>
