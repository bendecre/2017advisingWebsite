<!DOCTYPE html>
<html>  
    <?php
		/*
			!!!!We may want to add overwrite protection later!!!!
		*/
		
		//get the student id for the logged in student (passed around)
		$id = $_GET['id'];
	
		//check if fields have been entered
		if(isset($_POST['q1'])){
			
			$q1 	= $_POST['q1'];
			$q2 	= $_POST['q2'];
				
			//Common Methods setup
			session_start();
			$debug = false;
			include('CommonMethods.php');
			$COMMON = new Common($debug);
			
			$sql = "UPDATE `emcgov1`.`students` SET `q1Ans`='$q1', `q2Ans`='$q2' WHERE `campusId` = '$id';";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			
			$newURL = "student_selectAppointmentType.php?id=";
			$newURL .= $id;
			header('Location: '.$newURL);
		}
	?>
	
	<head>     
		<title>Student Questions</title>

		<!-- Meta tags to describe the page -->
		<meta charset="UTF-8" />
		<meta name="description" content="Question page for students" />
		<meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
		
		<link rel="stylesheet" type="text/css" href="student.css" />
    </head>
    
    <body>
        <div class="header">
			<h1>Advising</h1>
			<h2>Student Questions</h2>
        </div>
        
        <div class="content">
		
			<?php
				//put the students id in the form submit
				$htmlString = "<form action=\"student_questions.php?id=".$id."\" method=\"POST\">";
				echo($htmlString);
			?>
			
			
				<p>
					1. What are your current post-UMBC plans? For example: Medical School, 
					Teach middle school science, Research career, Master’s/PhD, etc. 
				</p>
				<p><i>(required)</i> 300 char max</p>
				<textarea maxlength="300" rows="5" cols="50" id="q1" name="q1"required></textarea>
				
				<p>
					2. Do you have any questions or concerns that you would like to discuss during your 
					advising session? For example: Withdrawing from a course, adding a second major, etc.
				</p>
				<p><i>(optional)</i> 300 char max</p>
				<textarea maxlength="300" rows="5" cols="50" id="q2" name="q2"/></textarea>
			
				<input type="submit" />
			</form>
        </div>
        
    </body>
    
</html>