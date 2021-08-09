<?php
/* --------
Filename: registration.php
Author: Alex Green
Purpose: Form to add users to the database
--------  */

/* Session and Redirect by Alex Green */
 session_start(); // Start the session.
 if ($_SESSION['user_role'] != "Admin") {

   // Need the functions:
   require('includes/login_functions_inc.php');
   redirect_user('unauthorized-access.php');
 }

 $pagetitle = 'Administration Profile Page';

 $session_id = $_SESSION['user_id'];

$pagetitle = 'Create an User Account';

include ('includes/header.php');

$session_id = $_SESSION['user_id'];
require('mysqli_connect.php');

$user_profile=
"Select USERS.first_name, USERS.last_name, USERS.email, USERS.phone_number, USERS.user_role, DEPARTMENTS.department_name
FROM USERS 
INNER JOIN DEPARTMENTS ON USERS.department_id = DEPARTMENTS.department_id WHERE user_id = $session_id";

$user_profile_results=mysqli_query($connection,$user_profile);

while ($user_profile_answer = mysqli_fetch_assoc($user_profile_results)) {
  $first = $user_profile_answer['first_name'];
  $last = $user_profile_answer['last_name'];
  $email = $user_profile_answer['email'];
  $department_name = $user_profile_answer['department_name'];
  $phone_number = $user_profile_answer['phone_number'];
  $role = $user_profile_answer['user_role'];
}

mysqli_close($connection);

?>

<main>
<div class="row">
	<div class="side">
		<div class="card">
			<div class="container">
				<img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br><br>
				<div class="edit_profile">
				<a class="button" href="edit_user.php">Edit Profile</a>
				</div>
				<br><h2><i class="fas fa-user-circle"></i><b><?php echo $first . " " . $last;?></b></h2><br>
				<h3><i class="fas fa-building"></i> Department:</h3>
				<h3><?php echo $department_name;?></h3><br>
				<h3><i class="fas fa-briefcase"></i></i> <?php echo $role; ?></h3><br>
				<h3><i class="fas fa-envelope"></i> Email:</h3>
				<h3><?php echo $email; ?></h3><br>
				<h3><i class="fas fa-phone-alt"></i> Phone:</h3>
				<h3><?php echo $phone_number; ?></h3><br>
			</div><!-- container -->
		</div><!-- card -->
	</div><!-- side -->
	<div class="main">
		<div class="card">
			<form action="registration.php" method="post" id="form-admin">
			<h1>Add User</h1>
			<?php 
			// Check if the form has been submitted:
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$problem = false; // No problems so far.
				
				// Check for each value...
				if (empty($_POST['first-name'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your first name.</span></p>';
				}
				
				if (empty($_POST['last-name'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your last name.</span></p>';
				}

				if (empty($_POST['email'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your email address.</span></p>';
				}

				if (empty($_POST['phone-number'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your phone number.</span></p>';
				}

				if (empty($_POST['password'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter a password!</span></p>';
				}

				if ($_POST['password'] != $_POST['confirm-password']) {
					$problem = true;
					print '<p><span class="form-error">Your password did not match your confirmed password!</span></p>';
				} 
				
				if (!$problem) { // If there weren't any problems...

					// Add user to database
					$firstname = $_POST['first-name'];
					$lastname = $_POST['last-name'];
					$email = $_POST['email'];
					$phonenumber = $_POST['phone-number'];
					$major = $_POST['major'];
					$userrole = $_POST['user-role'];
					//$password = $_POST['password'];
					$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

					require('mysqli_connect.php');

					$sql = "INSERT INTO USERS (first_name, last_name, email, phone_number, password, user_role, major, status, department_id)
			        VALUES ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $phonenumber . "','" . $password . "', 'Student', '" . $major . "', 'Active', '1' )";


					if (mysqli_query($connection, $sql)) {
					  //echo '<p><span class="form-success">' . $firstname . ' ' . $lastname . ', your account has been successfully registered.</span></p>';
						redirect_user('admin-users.php');
					  // for troubleshooting - to view email body
					  // echo $body;

					} else {
					  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
					}

					mysqli_close($connection);		

					// Clear the posted values:
					$_POST = [];
				
				} else { // Forgot a field.
				
					print '<p><span class="form-error">Please try again!</span></p>';
					
				}

			} // End of handle form IF.
			?>

					<input type="text" name="first-name" id="first-name" placeholder="First Name" value="<?php if (isset($_POST['first-name'])) { print htmlspecialchars($_POST['first-name']); } ?>">
				
					<input type="text" name="last-name" id="last-name" placeholder="Last Name" value="<?php if (isset($_POST['last-name'])) { print htmlspecialchars($_POST['last-name']); } ?>">
				
					<input type="email" name="email" id="email" placeholder="Email" value="<?php if (isset($_POST['email'])) { print htmlspecialchars($_POST['email']); } ?>">
			
					<input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone-number" id="phone-number" placeholder="Phone Number" value="<?php if (isset($_POST['phone-number'])) { print htmlspecialchars($_POST['phone-number']); } ?>">
				<!-- updated code -->
				<small>Format: 123-456-7890</small><br />
			
						<select name="major">
							<option selected value="<?php //if (isset($_POST['user-role'])) { print htmlspecialchars($_POST['major']); } ?>">Select Major</option>
							<option value="Business Information">Business Information</option>
							<option value="Computer Science">Computer Science</option>
							<option value="Computer Security &amp; Networking">Computer Security &amp; Networking</option>
							<option value="Computer Support Specialist">Computer Support Specialist</option>
							<option value="Computer Technology">Computer Technology</option>
							<option value="Database Management">Database Management</option>
							<option value="Web Development">Web Development</option>
						</select>
					
					<input type="password" name="password" id="password" placeholder="Password">
			
				<input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="confirm-password" id="confirm-password" placeholder="Password">
				<small>Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars)</small><br />
				<!-- updated code -->
				<input type="submit">
			</form>
		</div>
	</div>
</div><!-- row -->	
</main>

			

<?php include('includes/footer.php'); ?>