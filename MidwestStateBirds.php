<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- 
// Author: Adam D
// Midwest State Birds
// Prompts users to guess the state birds of the Midwest
--> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Midwest State Birds</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<?php
// array list of state birds
$StateBirds = array(
     "Illinois" => "Cardinal",
     "Indiana" => "Cardinal",
     "Iowa" => "Eastern Goldfinch",
     "Kansas" => "Western Meadowlark",
     "Michigan" => "Robin",
     "Minnesota" => "Loon",
	 "Missouri" => "Eastern Bluebird",
     "Nebraska" => "Western Meadowlark",
     "North Dakota" => "Western Meadowlark",
	 "Ohio" => "Cardinal",
     "South Dakota" => "Ring-Necked Pheasant",
     "Wisconsin" => "Robin"    
);
//array list of state bird images
$StateBirdsImg = array(
     "Illinois" => "birdcardinal.jpg",
     "Indiana" => "birdcardinal.jpg",
     "Iowa" => "birdeasterngolfinch.jpg",
     "Kansas" => "birdwesternmeadowlark.jpg",
     "Michigan" => "birdrobin.jpg",
     "Minnesota" => "birdloon.jpg",
	 "Missouri" => "birdeasternblue.jpg",
     "Nebraska" => "birdwesternmeadowlark.jpg",
     "North Dakota" => "birdwesternmeadowlark.jpg",
	 "Ohio" => "birdcardinal.jpg",
     "South Dakota" => "birdringneckedpheasant.jpg",
     "Wisconsin" => "birdrobin.jpg"    
);
// once user clicks check answers, reveals correct answers of state birds 
// and displays the birds image (in '/birdimg' folder)
if (isset($_POST['submit'])) {
     $Answers = $_POST['answers'];
     if (is_array($Answers)) {
          foreach ($Answers as
               $State => $Response) {
               $Response =
                    stripslashes($Response);
               if (strlen($Response)>0) {
                    if (strcasecmp(
                         $StateBirds[$State],
                         $Response)==0)
                         echo "<p><font color='Blue'>Correct!</font> The
                              state bird of $State is the <font color='Blue'>" .
                              $StateBirds[$State] . "</font>. <br> " . 
							  "<img src = /birdimg/" . $StateBirdsImg[$State] . 
                              "> </p>\n";
                    else
                         echo "<p><font color='Red'>Sorry</font>, the state bird
                              of $State is the <font color='Red'>" .
                              $StateBirds[$State] . "</font>, not the " .
                              $Response . ". <br> " . 
							  "<img src = /birdimg/" . $StateBirdsImg[$State] . 
                              "> </p>\n";
               }
               else
                    echo "<p>You did not enter a
                         value for the state bird of
                         $State.</p>\n";
          }
     }
     echo "<p><a href='MidwestStateBirds.php'>
          Try again?</a></p>\n";
}
// displays form for user to enter state bird guesses
else {
     echo "<form action='MidwestStateBirds.php'
          method='POST'>\n";
     foreach ($StateBirds as
          $State => $Response)
          echo "The state bird of $State is the:
               <input type='text' name='answers[" .
               $State . "]' /><br />\n";
          echo "<input type='submit'
               name='submit'
               value='Check Answers' /> ";
          echo "<input type='reset' name='reset'
               value='Reset Form' />\n";
          echo "</form>\n";
}
?>
</body>
</html>

