<!--
// Adam D
// Determines price of movie ticket based on customer's age
//     Return: price of ticket
	   
	   getPrice returns the price of a ticket based on age 
			under 5		Free
			5 to 17 	Half price
			18 to 55	Full price
			Over 55		$2 off	
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" " ">
<html xmlns=" ">
	<head>
		<title>Movies Class Tester</title>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	</head>
	
	<body>
		<h1>Movies Class Tester</h1>
		
		<?php
			$MinAge = 1;
			$MaxAge = 80;
			$MoviesClassThresholds = array(
				array("age" => 0, "price" => "Free"),
				array("age" => 5, "price" => "Half price"),
				array("age" => 18, "price" => "Full price"),
				array("age" => 56, "price" => "\$2 off"),
				array("age" => $MaxAge+1, "price" => "Undefined"));
			$ThresholdCount = count($MoviesClassThresholds);
			$ThresholdIndex = 0;
			
			require_once("Movies.php");  
			
			$Ticket = new Movies();
			
			echo "<p>\n";
			
			for ($i = $MinAge;$i <= $MaxAge;++$i) 
			{
				if ($i >= $MoviesClassThresholds[$ThresholdIndex]["age"]) 
				{
					echo "*** Tickets are " . strtolower($MoviesClassThresholds[$ThresholdIndex]["price"]) ." ***<br />\n";
					++$ThresholdIndex;					
				}
			
				$Ticket->SetAge($i);
				echo "Age $i, ticket price is \$" .trim(sprintf("%4.2f",$Ticket->GetPrice())) ."<br />\n";
			}
			
				echo "</p>\n";
		?>
	</body>
</html>

