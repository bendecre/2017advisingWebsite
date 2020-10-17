<?php
	include("CommonMethods.php");

	// Execute code once sign in is hit.
	if(isset($_POST["tfPassword"]))
	{

		// CHANGE AS NEEDED IF CHECKING OVER. ENCRYPTION FOR PASSWORD?

		// Get the entered email.
		$advEmail = $_POST["tfEmail"];

		// Get the entered password.
		$advPassword = md5($_POST["tfPassword"]);

		$debug = false;
		$COMMON = new Common($debug);

		// Check if the entered information matches that of the database.
		$sql = "SELECT COUNT(*) FROM `advisors` WHERE `email` = \"$advEmail\" and  `pWord` = \"$advPassword\"";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

		// Number of results that turned up. Should only be 0 or 1.
		$result = mysql_result($rs, 0);

		// If no advisor showed up:
		if ($result == 0)
		{
			// This is filler. It will be printed in the actual HTML portion.
			echo("");
		}

		// If the advisor was found:
		else
		{
			session_start();

			// Grab the advisor's ID. To be used for the session ID.
			$sql = "SELECT `campusId` FROM `advisors` WHERE `email` = \"$advEmail\" and  `pWord` = \"$advPassword\"";
			$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

			// The advisor ID.
			$result = mysql_result($rs, 0);

			// Session stored.
			$_SESSION['sessionID'] = $result;

			// Send advisor to the next page.
			header("Location: advisor_main.php");
		}
	}
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Advisor Login</title>

        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Login page for advisors" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />

        <link rel="stylesheet" type="text/css" href="advisor.css" />

    </head>

    <body>

        <div class="header">

            <h1>Advising</h1>
            <h2>Advisor Login</h2>

			<?php
				// If they hit sign in:
				if (isset($_POST["Sign In"]))
				{
					// If not found in database:
					if ($result == 0)
					{
						// Should print out in red.
						echo("<h3>Incorrect Password or User Does Not Exist</h3>");
					}
				}
			?>

        </div>

        <div class="content">

            <form method="post" name="SignIn" action="<?php echo $_SERVER["PHP_SELF"];?>">

                <label for="tfEmail">Email</label><br>
                <input id="tfEmail" type="email" size="30" maxlength="25" pattern="^\w+@umbc\.edu$" title="advisor@umbc.edu" name="tfEmail" placeholder="advisor@umbc.edu" required>
				<br>
                <br>

				<label for "tfPassword">Password</label><br>
				<input id = "tfPassword" type = "password" size = "30" title = "Password" name = "tfPassword" placeholder="Password" required>
				<br>
				<br>

                <input type="submit" value="Sign In" name="Sign In">
            </form>

        </div>

    </body>

</html>
