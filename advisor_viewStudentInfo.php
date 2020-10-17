<?php
$id = $_GET['id']
$studentID = $_GET['studentID']

session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$query = "SELECT * FROM `emcgov1`.`students` WHERE `campusId` = '$studentId';";
$rs = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);


$studentRow = mysql_fetch_row($rs);

$firstName = $studentRow[1];
$lastName = $studentRow[2];
		

echo "<!DOCTYPE html>
    
    <head>
        
        <title>View Student Info</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="View student's information" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="advisor.css" />
        
    </head>";
    
echo    "<body>
        
        <div class="header">
			
			<h1>Advising</h1>
			<h2>View Student Info</h2>
            
		</div>
        
        <div class="content">";
		
			//This is where PHP code goes to get certain values about the student-->
			
			echo "<h3>".Basic Info."</h3>";
			echo "<p> First name:".$studentRow[1]."</p>";
			echo "<p>Last Name:" .$studentRow[2]."</p>";
			echo "<p>Preferred Name:".$studentRow[3]."</p>";
			echo "<p>Campus ID:".$studentRow[4]."</p>";
			echo "<p>E-mail:".$studentRow[5]."</p>";
			echo "<p>Major:".$studentRow[6]."</p>";
			
			echo "<h3>Questions</h3>";
			echo "<p>What are your current post-UMBC plans? For example: Medical School, Teach middle school science, Research career, Master's/PhD, ect:</p>
			<textarea readonly maxlength="300" rows="5" cols="50">".$studentRow[7]. "</textarea>";
			echo "<p>Do you have any questions or concerns that you would like to discuss during your advising session? For example: Withdrawing from a course, adding a second major, ect:</p> 
			<textarea readonly maxlength="300" rows="5" cols="50">".$studentRow[8]."</textarea>";
			echo"<br><a href="(some advisor page).html">Previous Page</a>
		
		</div>
        
    </body>
    
</html>";

?>