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
    $row = pg_fetch_row($contactresult);
    $row[$i];
    $me = $_SERVER['PHP_SELF'];
    echo"<form action=$me method=\"POST\">";
    echo"<table border=0 cellpadding=4 cellspacing=4>";
    echo"<tr>";
    echo"<td colspan=2>";
    echo"Update contact as needed, and then push submit button.";
    echo"</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> Contact Name: </td>";
    echo"<td align=right><input type=text name=name value=\"$row[0]\"></td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> Address: </td>";
    echo"<td align=right><input type=text name=address value=\"$row[1]\"></td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> City:</td>";
    echo"<td align=right><input type=text name=city value=\"$row[2]\"></td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> State:</td>";
    echo"<td align=right><input type=text name=state value=\"$row[3]\"></td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> Zip:</td>";
    echo"<td align=right><input type=text name=zip value=\"$row[4]\"></td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td colspan=2 align=right>";
    echo"<input type=hidden name=contactid value=$contactid>";
    echo"<input type=submit value=\"Update Contact\">";
    echo"</td>";
    echo"</tr>";
    echo"</table>";
    echo"</form>";
   }
  }
 } else
 {
  $name = pg_escape_string($_POST['name']);
  $address = pg_escape_string($_POST['address']);
  $city = pg_escape_string($_POST['city']);
  $state = pg_escape_string($_POST['state']);
  $zip = pg_escape_string($_POST['zip']);
  $contactid = $_POST['contactid'];

  if (empty($name) || empty($address) || empty($city) || empty($state) || empty($zip))
  {
    echo"All fields must have a value";
  } else
  {
   $query = "
    UPDATE contact 
    SET ";

   $query = $query . "name = '" . $name . "', ";
   $query = $query . "address= '" . $address . "', ";
   $query = $query . "city= '" . $city . "', ";
   $query = $query . "state= '" . $state . "', ";
   $query = $query . "zip= '" . $zip . "'";
  
   $query = $query . " WHERE contactid = " . $contactid . ";";
 
   //Debug print statement
   //echo $query;
  
    // Do the update
   $result = pg_query($connection, $query);
  
   echo "Contact updated.";
  }

  // Close db connection
  if ($connection) { pg_close($connection); }

  echo"</td>";
  echo"</table>";

  include('tail.php');
 }
?>

