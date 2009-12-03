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
    SELECT c.name as \"Name\", c.address as \"Address\", c.city as \"City\",
    c.state as \"State\", c.zip as \"Zip\", e.emailaddr as \"Email Address\",
    p.phonenumber as \"Phone Number\", p.type as \"Type\"
    FROM contact c JOIN users u ON c.userid = u.userid
    LEFT OUTER JOIN email e ON c.contactid = e.contactid
    LEFT OUTER JOIN phone p ON c.contactid = p.contactid
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
    echo"<td align=right><input type=text name=name value=\"$row[0]\">*</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> Address: </td>";
    echo"<td align=right><input type=text name=address value=\"$row[1]\">*</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> City:</td>";
    echo"<td align=right><input type=text name=city value=\"$row[2]\">*</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> State:</td>";
    echo"<td align=right><input type=text name=state value=\"$row[3]\">*</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td> Zip:</td>";
    echo"<td align=right><input type=text name=zip value=\"$row[4]\">*</td>";
    echo"</tr>";
     echo"<tr>";
      echo"<td> Email:</td>";
      echo"<td align=right><input type=text name=email value=\"$row[5]\">&nbsp;</td>";
     echo"</tr>";
     echo"<tr>";
      echo"<td> Phone Number:</td>";
      echo"<td align=right><input type=text name=phone value=\"$row[6]\">&nbsp;</td>";
     echo"</tr>";
     echo"<tr>";
      echo"<td> Phone Type <br />(cell, home, etc):</td>";
      echo"<td align=right><input type=text name=phonetype value=\"$row[7]\">&nbsp;</td>";
     echo"</tr>";
    echo"<tr>";
    echo"<td colspan=2 align=right>";
    echo"<input type=hidden name=contactid value=$contactid>";
    echo"<input type=submit value=\"Update Contact\">";
    echo"</td>";
    echo"</tr>";
    echo"<tr>";
    echo"<td colspan=2 align=right>";
    echo"*denotes required field";
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
  $email = pg_escape_string($_POST['email']);
  $phone = pg_escape_string($_POST['phone']);
  $type = pg_escape_string($_POST['phonetype']);
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
 
   $result = pg_query($connection, $query);

   $query2 = "
    SELECT u.userid, e.emailaddr, p.phonenumber, p.type
    FROM contact c JOIN users u ON c.userid = u.userid
    LEFT OUTER JOIN email e ON c.contactid = e.contactid
    LEFT OUTER JOIN phone p ON c.contactid = p.contactid
    WHERE u.name = '" . $_COOKIE['uname'] . "' AND u.password = '" . $_COOKIE['passwd'] .
    "' AND c.userid = '" . $_COOKIE["userid"] . "'
    AND c.contactid = " . $contactid . ";"; 

   $result2 = pg_query($connection, $query2);
   echo"Contact updated.";
   $row = pg_fetch_row($result2);

   $emailexists = 1;
   $phoneexists = 1;

   if (empty($row[1]))
    { $emailexists = 0; }
   if (empty($row[2]))
    { $phoneexists = 0; }

   if (!empty($email))
   { 
    if ($emailexists)
    {
     $query3 = "
      UPDATE email
      SET ";
     $query3 = $query3 . "emailaddr = '" . $email . "'";
     $query3 = $query3 . " WHERE contactid = $contactid ;";
    }
    else
    {
     $query3 = "
     INSERT INTO email
     VALUES ('" . $email . "','" . $contactid . "');";
    }
   }
   else if ($emailexists)
   {
     $query3 = "
      DELETE FROM email
      WHERE contactid = $contactid;";
   }

   if (!empty($query3))
   {
    $result3 = pg_query($connection, $query3);
   }

   if (!empty($phone))
   { 
    if ($phoneexists)
    {
     $query4 = "
      UPDATE phone
      SET ";
     $query4 = $query4 . "phonenumber = '" . $phone. "',";
     $query4 = $query4 . "type = '" . $type. "'";
     $query4 = $query4 . " WHERE contactid = $contactid ;";
    }
    else
    {
     $query4 = "
     INSERT INTO phone 
     VALUES ('" . $phone . "','" . $contactid . "','" . $type . "');";
    }
   }
   else if ($phoneexists)
   {
     $query4 = "
      DELETE FROM phone
      WHERE contactid = $contactid;";
   }

   if (!empty($query4))
   {
    $result4 = pg_query($connection, $query4);
   }

  }

  // Close db connection
  if ($connection) { pg_close($connection); }

  echo"</td>";
  echo"</table>";

  include('tail.php');
 }
?>

