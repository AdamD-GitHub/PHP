<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Adam Diel (S0854801)
// CSIS 279  - Yoast/DeLay
// Chap. 8.2 - GuestBook
// GuestBook data retrieval which shows everyone who has signed the GuestBook.
--> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Guest Book</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php

// Establish Database connection and sign in.
$DBConnect = @mysqli_connect("localhost", "root", ""); 
if ($DBConnect === FALSE)
{
	echo  "<p>Unable to connect to the database server.</p>"
		. "<p>Error code " 
		. mysqli_connect_errno()
		. ": " 
		. mysqli_connect_error() 
		. "</p>";
}
else 
{ 
	// Connect to database. 
	$DBName = "guestbook"; 
	if (!@mysqli_select_db($DBConnect, $DBName)) 
	{
		echo "<p>There are no entries in the guest book!</p>";
	}
	else
	{	
		// Connect to Table and select all rows.
		$TableName = "visitors";
		$SQLstring = "SELECT * FROM $TableName";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring);
		
		// Build result set and display.
		if (mysqli_num_rows($QueryResult) == 0) 
		{
			echo "<p>There are no entries in the guest book!</p>";
		}
		else 
		{
			echo "<p>The following visitors have signed our guest book:</p>";
			echo "<table width='100%' border='1'>";
			echo "<tr><th>First Name</th>
					  <th>Last Name</th>
				  </tr>";
			while ($Row = $QueryResult->fetch_assoc())
			{
				echo "<tr>";
				echo "<td>{$Row['first_name']}</td>";
				echo "<td>{$Row['last_name']}</td>";
				echo "</tr>";				
			}
		}
		// Close cursor.
		mysqli_free_result($QueryResult);
	}
	// Close database.
	mysqli_close($DBConnect);				
}
?>
</body>
</html>

