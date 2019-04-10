<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Adam Diel (S0854801)
// CSIS 279  - Yoast/DeLay
// Chap. 8.1 - GuestBook
// GuestBook validation / write process: Validates user input and writes
// input data to database.
--> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sign My Guest Book</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
// Verify information was entered.
if (empty(ltrim($_POST['first_name'])) || empty(ltrim($_POST['last_name'])))
{
	echo "<p>You must enter your first name and last name. 
          Click your browser's Back button to return to 
          the Guest Book.</p>\n";
}
else 
{ 
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
		// Connect to database.  If it doesn't exist, create it.
		$DBName = "guestbook"; 
		if (!@mysqli_select_db($DBConnect, $DBName)) 
		{
			$SQLstring = "CREATE DATABASE $DBName"; 
			$QueryResult = @mysqli_query($DBConnect, $SQLstring); 
			
			if ($QueryResult === FALSE)
			{
				echo "<p>Unable to execute the query.</p>"
				   . "<p>Error code " 
				   . mysqli_connect_errno($DBConnect) 
				   . ": " 
				   . mysqli_connect_error($DBConnect)
				   . "</p>";
			}
			else
			{
				echo "<p>You are the first visitor!</p>";
			}
		}	
		
		// Connect to Table.  If table doesn't exist, create it.		
		mysqli_select_db($DBConnect, $DBName);
		$TableName = "visitors"; 
		$SQLstring = "SHOW TABLES LIKE '$TableName'"; 
		$QueryResult = @mysqli_query($DBConnect, $SQLstring); 
		
		if (mysqli_num_rows($QueryResult) == 0) 
		{
			$SQLstring = "CREATE TABLE $TableName 
				(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
				 last_name VARCHAR(40), 
				 first_name VARCHAR(40))"; 
			$QueryResult = @mysqli_query($DBConnect, $SQLstring);
			
			if ($QueryResult===FALSE) 
			{
				echo "<p>Unable to create the table.</p>"
				   . "<p>Error code " 
				   . mysqli_connect_errno($DBConnect) 
				   . ": " 
				   . mysqli_connect_error($DBConnect) 
				   . "</p>";
			}
		}
		
		// Insert rows to table.
		$LastName = stripslashes($_POST['last_name']); 
		$FirstName = stripslashes($_POST['first_name']); 
		$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";
		$QueryResult = @mysqli_query($DBConnect, $SQLstring); 
		
		if ($QueryResult === FALSE)
		{
			echo "<p>Unable to execute the query.</p>"
			   . "<p>Error code " 
			   . mysqli_connect_errno($DBConnect) 
			   . ": " 
			   . mysqli_connect_error($DBConnect) 
			   . "</p>";
		}
		else
		{
			echo "<h1>Thank you for signing our guest book!</h1>";
		}
		
		// Close database.		
		mysqli_close($DBConnect);				
	}
}
?>
</body>
</html>

