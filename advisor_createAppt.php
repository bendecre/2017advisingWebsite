<!DOCTYPE html>
<html>
    <head>
        
        <title>Create Appointment</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Login page for students" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="student.css" />
        
    </head>
<body>
    <div class="header">
        
            <h1>Advising</h1>
            <h2>Create An Appointment</h2>
            
    </div>
    
    <div class="content">
        <?php

            // If all of the information has been set:
            if (isset($_POST['apptDate']) && isset($_POST['apptSTime']) && isset($_POST['apptType']) && isset($_POST['maxStudents']) && isset($_POST['apptLoc']) && isset($_POST['leader']))
            {
            
                $appointmentDate = $_POST['apptDate'];
        
                $appointmentSTime = $_POST['apptSTime'];
        
                $appointmentType = $_POST['apptType'];
        
                $maximumStudents = $_POST['maxStudents'];
        
                $appointmentLocation = $_POST['apptLoc'];
        
                $appointmentLeader = $_POST['leader'];
        
                session_start();
        
                $debug = false;
        
                include("CommonMethods.php");
        
                $COMMON = new Common ($debug);
            
                // Check for an existing meeting with this information already.
                $check = "SELECT COUNT(*) FROM `appointments` WHERE `date` = '$appointmentDate' and `sTime` = '$appointmentSTime' and `location` = '$appointmentLocation'";
        
                $rs = $COMMON->executeQuery($check, $_SERVER["SCRIPT_NAME"]);
            
                $result = mysql_result($rs, 0);
        
                if ($result == 0)
                {
                    $sql = "INSERT INTO `appointments` (`id`, `date`, `sTime`, `location`, `leader`, `type`, `maxStudents`, `numStudents`) VALUES ('', '$appointmentDate', $appointmentType, '$maximumStudents', '$appointmentLocation', '$appointmentLeader', '')";
        
                    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                }
        
                else
                {
                    echo("<h4>Meeting Already Exists!</h4>\n");
                }
        
            
        }
    ?>
        
        
        
    <form action='advisor_createAppt.php' method='post' name='newAppointment'>
      
      <label for='apptDate'>Date: <br></label>
      <input id='date' type='date' method='post' name='apptDate' min='2016-12-09'><br>
      
      <label for='apptSTime'>Start Time (8:30 - 4:30): <br></label>
      <input id='apptSTime' type='time' name='apptSTime' ><br>

      <label for='sessionType'> Type of Session <br> </label>
      <input id='group' type='radio' name='apptType' value='group' style='text-align:left;'>
      <label for='group'>Group</label><br>
      <input id='indiv' type='radio' name='apptType' value='indiv' style='text-align:left;'>
      <label for='indiv'>Individual</label><br>
      
      <label for='maxStudents'> Number of Students (Max 40, Enter 1 for an individual appointment):<br> </label>
      <input id='maxStudents' type='number' name='maxStudents' min='1' max='40'><br>
      
     
      <label for='apptLoc'>Location: </label>
      <input id='apptLoc' type='text' name='apptLoc' placeholder='ex. ITE 210'><br>
      
      <label for='sessionLeader'> Session Leader: <br> </label>
      <select id='leader' name='leader'>
          <option> Ms. Michelle Bulger </option>
          <option> Mrs. Julie Crosby </option>
          <option> Ms. Christine Powers </option>
      </select> <br>
      <input type='submit' name='newApp' value='Create'>
      
    </form>
    </div>
  </body>
</html>
