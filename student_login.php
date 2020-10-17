<!DOCTYPE html>

<html>
	
	<?php
	
		//check if fields have been entered
		if(isset($_POST['tfFName']) &&
			isset($_POST['tfLName']) && 
			isset($_POST['tfID']) && 
			isset($_POST['tfEmail']) && 
			isset($_POST['ddMajor'])){	//if all fields have been entered, attempt login
			
			$fName 	= $_POST['tfFName'];
			$lName 	= $_POST['tfLName'];
			$pName 	= $_POST['tfPName'];
			$id		= $_POST['tfID'];
			$email	= $_POST['tfEmail'];
			$major 	= $_POST['ddMajor'];
			
			if($major != "Other"){
				
				//Common Methods setup
				session_start();
				$debug = false;
				include('CommonMethods.php');
				$COMMON = new Common($debug);
				
				$sql = "SELECT * FROM `emcgov1`.`students` WHERE `campusId` = '$id';";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				
				$nextPage = 0;
					/*
						When the student logs in, it will check for existing information
						and send the student to their personal next step
						0 - no progress, go to answer question
						1 - no appointment, go to select appointment type
						2 - existing appointment, go to view appointment
					*/
				
				//if student already exists, verify input, otherwise add new student and move on
				if($row = mysql_fetch_row($rs)){
					
					$q1Ans = $row[7];
					$apptId = $row[9];
					
					if($apptId != NULL){
						$nextPage = 2;
					}
					else if ($q1Ans != NULL){
						$nextPage = 1;
					}
				}
				else{
					$sql = "INSERT INTO `emcgov1`.`students` (`id`, `fName`, `lName`, `pName`, `campusId`, `email`, `major`, `q1Ans`, `q2Ans`, `apptId`) VALUES (NULL, '$fName', '$lName', '$pName', '$id', '$email', '$major', NULL, NULL, NULL);";
					$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
				}
				
				//QUESTION: If a student already exists, should we do any input validation?
				
				if($nextPage == 0){
					$newURL = "student_questions.php?id=";
					$newURL .= $id;
					header('Location: '.$newURL);
				}
				else if ($nextPage == 1){
					$newURL = "student_selectAppointmentType.php?id=";
					$newURL .= $id;
					header('Location: '.$newURL);
				}
				else{
					$newURL = "student_viewAppointment.php?id=";
					$newURL .= $id;
					header('Location: '.$newURL);
				}
				
			}
			else{
				$newURL = "student_majorError.html";
				header('Location: '.$newURL);
			}
		}
	?>
 
    <head>
        
        <title>Student Login</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Login page for students" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="student.css" />
        
    </head>
    
    <body>
        
        <div class="header">
        
            <h1>Advising</h1>
            <h2>Student Login</h2>
            
        </div>
        
        <div class="content">
            
            <form action="student_login.php" method="post">
                <label for="tfFName">First Name</label><br>
                <input id="tfFName" type="text" size="30" maxlength="25" name="tfFName" required autofocus><br>
            
                <label for="tfLName">Last Name</label><br>
                <input id="tfLName" type="text" size="30" maxlength="25" name="tfLName" required><br>
				
				<label for="tfPName">Preferred Name</label><br>
                <input id="tfPName" type="text" size="30" maxlength="25" name="tfPName"><br>
            
                <label for="tfID">Student ID</label><br>
                <input id="tfID" type="text" size="30" maxlength="7" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" placeholder="AB12345" name="tfID" required><br>
            
                <label for="tfEmail">Email</label><br>
                <input id="tfEmail" type="email" size="30" maxlength="25" pattern="^\w+@umbc\.edu" title="student1@umbc.edu" name="tfEmail" placeholder="student1@umbc.edu" required><br>
            
                <label for="ddMajor">Major</label><br>
                <select id="ddMajor" name="ddMajor" required>
                    <option value="Biochemistry & Molecular Biology (BS)">Biochemistry & Molecular Biology (BS)</option>
                    <option value="Bioinformatics & Computational Biology (BS)">Bioinformatics & Computational Biology (BS)</option>
                    <option value="Biological Sciences (BA)">Biological Sciences (BA)</option>
                    <option value="Biological Sciences (BS)">Biological Sciences (BS)</option>
                    <option value="Biology Education (BA)">Biology Education (BA)</option>
                    <option value="Chemistry (BA)">Chemistry (BA)</option>
                    <option value="Chemistry (BS)">Chemistry (BS)</option>
                    <option value="Chemistry Education (BA)">Chemistry Education (BA)</option>
					<option value="Other">Other</option>
                </select><br>
                
                <br>
            
                <input type="submit" value="Sign In" name="Sign In">
            </form>
            
        </div>
        
    </body>
    
</html>