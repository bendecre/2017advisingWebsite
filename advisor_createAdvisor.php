<!DOCTYPE html>
<html>   
	
	<?php
		include('CommonMethods.php');

		//Common Methods setup
		session_start();
		$id = $_SESSION['sessionID'];

		$debug = false;
		$COMMON = new Common($debug);
		$sql = "SELECT * FROM `advisors` WHERE `campusId` = \"$id\"";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$rows = mysql_fetch_row($rs);

		if($rows <= 0){
			$newURL = "advisor_login.php";
			header('Location: '.$newURL);
		}
		
		if(isset($_POST['tfFName']) &&
			isset($_POST['tfLName']) &&  
			isset($_POST['tfID']) && 
			isset($_POST['tfEmail']) && 
			isset($_POST['tfPassword']) &&
			isset($_POST['tfConfirm']) &&
			isset($_POST['tfOffice'])){
				
				
		}
	?>

    <head>
        <title>Create Appointment</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Page to create a new advisor" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="advisor.css" />
    </head>
	<body>
		<div class="header">
			<h1>Advising</h1>
			<h2>Create An Advisor</h2>
		</div>
		<div class="content">
			<form action="advisorCreator.php" method="post" name="Creator">

			<label for="tfFName">First Name</label><br>
			<input id="tfFName" type="text" size="30" maxlength="25" name="tfFName" required autofocus><br>
			<label for="tfLName">Last Name</label><br>
			<input id="tfLName" type="text" size="30" maxlength="25" name="tfLName" required><br>
			
			<label for="tfPName">Prefered Name</label><br>
			<input id="tfPName" type="text" size="30" maxlength="25" name="tfPName"><br>

			<label for="tfID">Campus ID</label><br>
			<input id="tfID" type="text" size="30" maxlength="7" pattern="[A-Za-z]{2}[0-9]{5}" title="AB12345" placeholder="AB12345" name="tfID" required> <br>

			<label for="tfEmail">Email</label><br>
			<input id="tfEmail" type="email" size="30" maxlength="25" pattern="^\w+@umbc\.edu" title="advisor1@umbc.edu" name="tfEmail" placeholder="advisor1@umbc.edu" required> <br>

			<label for="tfPassword"> Password </label><br>
			<input id="tfPassword" type="password" size="30" maxlength="25" title="tfPassword"><br>

			<label for="tfConfirm"> Confirm Password </label><br>
			<input id="tfConfirm" type="password" size="30" maxlength="25" title="tfConfirm"><br>

			<label for="tfOffice">Office</label><br>
			<input id="tfOffice" type="text" size="30" maxLength="25" name="tfOffice" required> <br>

			<input type="submit" value="Sign In" name="Sign In">
			</form>
		</div>
	</body>
</html>
