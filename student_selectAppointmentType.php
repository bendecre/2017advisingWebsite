<!DOCTYPE html>
<html>  

	<?php
		$id = $_GET['id'];
	?>

    <head>
        
        <title>Student Select Appt. Type</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Select Appointment Type Page for Students (Group vs Individual)" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="student.css" />
        
    </head>
    
    <body>
        
        <div class="header">
            <h1>Advising</h1>
            <h2>Student Select Appt.</h2>
        </div>
        
        <div class="content">
			<?php
				//put the students id in the form submit
				$htmlString = "
					<a class=\"button\" href=\"student_selectAppointment.php?id=".$id."&type=group\">Group</a>
					<a class=\"button\" href=\"student_selectAppointment.php?id=".$id."&type=ind\">Individual</a>
				";
				echo($htmlString);
			?>
        </div>
    </body>
</html>