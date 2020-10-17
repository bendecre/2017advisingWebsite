<?php
	// starts the session and gets the name of the advisor
	include("CommonMethods.php");

	session_start();
	
	$advisorID = $_SESSION['sessionID'];

	$debug = false;
	$COMMON = new Common($debug);
	$sql = "SELECT `fName`,'lName' FROM `advisors` WHERE `campusId` = \"$advisorID\"";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	$row = mysql_fetch_row ($rs);
	$name = $row[0] . " " . $row[1];

	// class to hold meeting as an object
	class Meeting{ //BASIC object to hold meeting data
		
		public $meetingId;
		public $sTime;
		public $eTime;
		public $date;
		public $location;
		public $isGroupType;
		public $listOfStudents;
		
		public function __construct($meetingId){
			$this->meetingId = $meetingId;
		}
	}

	$sql = "SELECT * FROM `appointments` WHERE `leader` = '$name'";
	
	$sqlEnd = " ORDER BY date, sTime ASC";
	$sql .= $sqlEnd;
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$listOfMeetings = array();
	
	while($row = mysql_fetch_row($rs)){
		$meetingId = $row[0];
		$sTime = $row[2];
		$eTime = $row[3];
		$date = $row[1];
		$location = $row[4];
		$isGroupType = $row[6];
		
		if($isGroupType == 1){
			$isGroupType = "Group";
		}
		else{
			$isGroupType = "Individual";
		}
		
		$listOfStudents = "";
		
		$sql2 = "SELECT * FROM  `students` WHERE `apptId` = '$meetingId'";
		$rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
		
		while($row2 = mysql_fetch_row($rs2)){
			echo("we got into adding students");
			$studentId = $row2[4];
			$listOfStudents = $studentId . ", " . $listOfStudents;
		}
		
		$meeting = new Meeting($meetingId);
		$meeting->sTime = $sTime;
		$meeting->eTime = $eTime;
		$meeting->date = $date;
		$meeting->location = $location;
		$meeting->isGroupType = $isGroupType;
		$meeting->listOfStudents = $listOfStudents;

		
		array_push($listOfMeetings, $meeting);
	}

?>

<!DOCTYPE html>
    
    <head>
        
        <title>Advisor Main Page</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Main page for advisors" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="advisor.css" />
        
    </head>
    
    <body>
        
        <div class="header">
        
            <h1>Advising Scheduling</h1>
            <h2>Welcome <?php echo($name) ?></h2>
            
        </div>
        
        <div class="more-content">
            
            <center><a class="button" href="advisor_createAppt.php">Create Appointment</a><a class="button" href="advisor_createAdvisor.php">Create Advisor</a></center>
            
            <hr>
            
            <h3>List of Appointments</h3>
            
            <center><table>
                <tr>
                    <th colspan="5">December 2, 2016</th>
                </tr>
                
                <tr>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Group or Individual</th>
                    <th>Students</th>
                    <th>Delete Appt.</th>
                </tr>
                
        	<?php
		foreach($listOfMeetings as $meeting){	
			echo("we in the foreach");
			$tableRow = "
			<tr>
				<td>".$meeting->date."</td>
				<td>".$meeting->time."</td>
				<td>".$meeting->location."</td>
				<td>".$meeting->isGroup."</td>
				<td>".$meeting->listOfStudents."</td>
				<td><a class=\"deleteButton\" href=\"advisor_searchAppointments.php?advisorId=".$advisorId."&deleteId=".$meeting->meetingId."\">Delete</a></td>
			</tr>
			";
			echo $tableRow;
		}
 		?>

	       <tr>
                    <td>1:00pm</td>
                    <td>ITE 123</td>
                    <td>Group</td>
                    <td>
                        <ul>
                            <li><a href="#">Edgar Courtemanch</a></li>
                            <li><a href="#">Benjamin Decre</a></li>
                            <li><a href="#">Emily McGovern</a></li>
                            <li><a href="#">Taylor Webb</a></li>
                            <li><a href="#">Emily Yu</a></li>
                        </ul>
                    </td>
                    <td><a class="button" href="#">Delete</a></td>
                </tr>
                
                <tr>
                    <td>2:00pm</td>
                    <td>ITE 321</td>
                    <td>Individual</td>
                    <td>
                        <ul>
                            <li><a href="#">Shawn Lupoli</a></li>
                        </ul>
                    </td>
                    <td><a class="button" href="#">Delete</a></td>
                </tr>
            </table></center>
            
        </div>
        
    </body>
    
</html>