<?php
/* --------
Filename: forgotpassword.php
Author: Tracy Johnson
Purpose: To trigger random password generation 
and email to user after click of forgot password link
--------  */
?>
<?php $pagetitle = 'Forgot Password'; ?>
<?php include('includes/header.php'); ?>
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require('../mysqli_connect.php'); 

	// Assume nothing:
	$id = FALSE;

	// Validate the email address...
	if (!empty($_POST['email'])) {

		// Check for the existence of that email address...
		$query = 'SELECT user_id FROM USERS WHERE email="'.  mysqli_real_escape_string($connection, $_POST['email']) . '"';
		$result = mysqli_query($connection, $query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysqli_error($connection));

		if (mysqli_num_rows($result) == 1) { // Retrieve the user ID:
			list($id) = mysqli_fetch_array($result, MYSQLI_NUM);
		} else { // No database match made.
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}

	} else { // No email!
		echo '<p class="error">You forgot to enter your email address!</p>';
	} // End of empty($_POST['email']) IF.

	if ($id) { // If everything's OK.

		// Create a new, random password:
		$p = substr(md5(uniqid(rand(), true)), 3, 15);
        // $ph = SHA2('$p',512);

		// Update the database:
        $query = "UPDATE USERS SET `password`='$p' WHERE user_id=$id LIMIT 1";
		$result = mysqli_query($connection, $query) or trigger_error("Query: $query\n<br>MySQL Error: " . mysqli_error($connection));
		

		if (mysqli_affected_rows($connection) == 1) { // If it ran OK.
			$firstname = $row['first_name'];

			// Send an email:
			$body = "Hey " . $firstname . ",

			Someone requested a new password for your [Student Progress Management] account.
			
			Your password to log into <whatever site> has been temporarily changed to '$p'. 
			
			Please log in using this password and this email address. Then you may change your password to something more familiar.
			
			If you didn't make this request, please notify us.
			
			Your password reset is only valid for the next 30 minutes. 
			
			Sincerely, 
			
			The [Student Progress Management] team
			
			P.S. We're always around and love hearing from you.  
			Please get in touch if you want to ask something or even just to say hello!";

			mail($_POST['email'], 'Forgot Password Request', $body, 'From: admin@sitename.com');

			// Print a message and wrap up:
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
			
			// for troubleshooting - to view email body
			//echo $body;

			mysqli_close($connection);
			exit(); // Stop the script.

		} else { // If it did not run OK.
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
		}

	} else { // Failed the validation test.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($connection);

} // End of the main Submit conditional.
?>

<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgotpassword.php" method="post">
	<fieldset>
	<p><strong>Email Address:</strong> <input type="email" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Reset My Password"></div>
</form>

