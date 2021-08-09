<?php

session_start(); // Start the session.

  // Need the functions:
  require('includes/login_functions_inc.php');

$authorized_user = "";

switch ($_SESSION['user_role']) {
  case "Admin":
    $authorized_user = "You are an Admin.";
    break;
  case "Faculty":
    $authorized_user = "You are a faculty member.";
    break;
  case "Student":
   redirect_user('unauthorized-access.php');
    break;
  default:
   redirect_user('unauthorized-access.php');
}


include ('includes/header.php');

$pagetitle = 'Add Notes';
$user_id = $_GET['id'] ;
$faculty_id = $_SESSION['user_id'] ;

if(empty ($studentname)){
require('mysqli_connect.php');
$studentget = "SELECT * FROM USERS WHERE user_id = $user_id";
$studentname = mysqli_query($connection, $studentget);
while ( $studentrow = mysqli_fetch_assoc($studentname)){
    $student_fname=$studentrow['first_name']; 
    $student_lname=$studentrow['last_name']; 
    $student_major=$studentrow['major']; 
    $student_email=$studentrow['email']; 
    $student_phone=$studentrow['phone']; 
    }

$facultyget = "SELECT first_name, last_name FROM USERS WHERE user_id = $faculty_id";
$facultyname = mysqli_query($connection, $facultyget);
while ( $facultyrow = mysqli_fetch_assoc($facultyname)){
    $faculty_fname=$facultyrow['first_name']; 
    $faculty_lname=$facultyrow['last_name']; 
    }

}    

switch ($_SESSION['user_role']) {
  case "Admin":
    $redirect = "admin-user-details.php?id=";
    break;
  case "Faculty":
    $redirect = "faculty-user-details.php?id=";
}

//include ('inc_newnotes.php');  

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
        <br><h2><i class="fas fa-user-circle"></i><b><?php echo $student_fname . " " . $student_lname;?></b></h2><br>
        <h3><i class="fas fa-building"></i> Major:</h3>
        <h3><?php echo $student_major;?></h3><br>
        <!-- <h3><i class="fas fa-briefcase"></i></i> <?php // echo $role; ?></h3><br> -->
        <h3><i class="fas fa-envelope"></i> Email:</h3>
        <h3><?php echo $student_email; ?></h3><br>
        <h3><i class="fas fa-phone-alt"></i> Phone:</h3>
        <h3><?php echo $student_phone; ?></h3><br>
      </div><!-- container -->
    </div><!-- card -->
  </div><!-- side -->
  <div class="main">
    <div class="card">

  <h1>Student Note Creation Form</h1>
 
    <p>Enter your notes about the student. Only you will be able to edit this record in the future.</p>

<?php
//intro text:
print '';

// has the form been submitted?
if($_SERVER{'REQUEST_METHOD'} == 'POST'){
	
	$problem = false; 
	
	// value check
	if(empty ($_POST{'user_id'})){
		$problem = true;
		print '<p class="input--error">Please input the name of the student.</p>';
	}
	
		if(empty ($_POST{'faculty_id'})){
		$problem = true;
		print '<p class="input--error">Please input your name</p>';
	}
	
	
	if(!$problem){
		
		
// 		connect to database

    require('mysqli_connect.php');
    // create variables
    $user_id = $_POST{'user_id'};
    $faculty_id = $_POST{'faculty_id'};
    $course_name = $_POST{'course_name'};
    $scholarship = $_POST{'scholarship'};
    $internship = $_POST{'internship'};
    $notes = $_POST{'notes'};
    

    // bulid insert statement
    $add_note ="INSERT INTO NOTES (user_id, faculty_id, course_name, scholarship, internship, notes) VALUES('$user_id','$faculty_id', '$course_name', '$scholarship', '$internship', '$notes')";

    // Run Statement
    $result = mysqli_query($connection, $add_note);
    
    // check if successful
    if($result){
        print'<div class="link">
        <p class="input--success">The new note has been recorded.</p></div>';

    }
		
		$_POST = [ ];
		
	} 
	else {
		print '<p class="input--error"> Please try again';
	}
	
 }

 ?>

    <form action="notes-add.php" method="post" id="form-admin">



	<p><label for="user_name">Student Name:</label><br /><input type="text" placeholder="Enter Student's Name" name="user_name" size="15" value="<?php print htmlspecialchars($student_fname); print ' '; print htmlspecialchars($student_lname); ?>" readonly></p>

 <p><label for="notes">Notes:</label><br />
      <textarea placeholder="Enter your notes" name="notes" size="15" value="<?php if(isset($_POST['notes'])) { print htmlspecialchars($_POST['notes']); } ?>"></textarea></p>

	<p><label for="course_name">Course Name:</label><br /><input type="text" placeholder="Enter Course Name" name="course_name" size="15" value="<?php if(isset($_POST['course_name'])) { print htmlspecialchars($_POST['course_name']); } ?>"></p>

  	<p><label for="scholarship">Scholarship Recommendation:</label><br />
	<select placeholder="Select Scholarship" name="scholarship" value="<?php if(isset($_POST['scholarship'])) { print htmlspecialchars($_POST['scholarship']); } ?>">>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
	
  	<p><label for="internship">Internship Recommendation:</label><br />
	<select placeholder="Select Internship" name="internship" value="<?php if(isset($_POST['internship'])) { print htmlspecialchars($_POST['internship']); } ?>">>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>

    <input type="text" placeholder="Enter your ID" name="faculty_id" size="15" value="<?php if(isset($faculty_id)) { print htmlspecialchars($faculty_id); } ?>" hidden>
    <input type="text" placeholder="Enter the Student's ID" name="user_id" size="15" value="<?php if(isset($_POST['user_id'])) { print htmlspecialchars($_POST['user_id']); } else{print htmlspecialchars($user_id); } ?>" hidden>

  <p><label for="faculty_name">Faculty Name:</label><br /><input type="text" placeholder="Enter your name" name="faculty_name" size="15" value="<?php print htmlspecialchars($faculty_fname); print ' '; print htmlspecialchars($faculty_lname); ?>"  readonly></p>

<!--
	<p><label for="notes">Notes:</label><input type="text" placeholder="Enter your notes" name="notes" size="15" value="<?php //if(isset($_POST['notes'])) { print htmlspecialchars($_POST['notes']); } ?>"></p>

  <!-- created text area - Alex Green -->
   


	<p><input class="notes-add-button" type="submit" name="submit" value="Add Record" ></p>

</form>
<a class="notes-add-button" href="<?php echo $redirect . $user_id ?> ">Return To User Details</a>
    </div>
  </div>
</div><!-- row -->  
</main>


<?php
include 'footer.php';
?>