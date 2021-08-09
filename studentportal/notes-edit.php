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
//  default:
//   redirect_user('unauthorized-access.php');
}

switch ($_SESSION['user_role']) {
  case "Admin":
    $redirect = "admin-user-details.php?id=";
    break;
  case "Faculty":
    $redirect = "faculty-user-details.php?id=";
}


$pagetitle = 'Edit Notes';

include ('includes/header.php');

?>


<main> 
<?php 
require('mysqli_connect.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // print_r($_POST);
    $record_id = $_POST['record_id'];
    $user_id = $_POST['user_id'];
    $faculty_id = $_POST['faculty_id'];
    $course_name = $_POST['course_name'];
    $scholarship = $_POST['scholarship'];
    $internship = $_POST['internship'];
    $notes = $_POST['notes'];
    $session_id = $_SESSION['user_id'];
    $user_id2 = $user_id;

    if ($faculty_id == $session_id) {
    $update_query =
        "UPDATE NOTES
        SET user_id = '$user_id',
        faculty_id = '$faculty_id',
        course_name = '$course_name',
        scholarship = '$scholarship',
        internship = '$internship',
        notes = '$notes'
        WHERE record_id = '$record_id' ";
    
    // testing
    // echo $update_query;
 if ($faculty_id != $session_id)  {
     unset($update_query);
 }        
    $update_result = mysqli_query($connection, $update_query);
    $updateconfirm = 'yes';
    }
    


    if($update_result) {
      print'<div class="link">
        <p class="input--success">The note has been updated 

                </div>';

    }
    else{
        echo "Update Failed.";
           if ($faculty_id != $session_id)
           {
              print'<div class="link">
        <p class="input--success">This is not your note.  Please go back and add a new note instead. 
        </div>';}
    }

//    exit("");

}
//else{

if (isset($_GET['record_id'])) {
$record_id = $_GET['record_id'] ;
}
$query = "SELECT * FROM NOTES WHERE record_id = $record_id";



// USER TESTING
// echo $department_id;
// echo $query;

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

    $user_id2 = $row['user_id'];
    $faculty_id2 = $row['faculty_id'];

$studentget = "SELECT first_name, last_name FROM USERS WHERE user_id = $user_id2";
$studentname = mysqli_query($connection, $studentget);
while ( $studentrow = mysqli_fetch_assoc($studentname)){
    $student_fname=$studentrow['first_name']; 
    $student_lname=$studentrow['last_name']; 
    }

$facultyget = "SELECT first_name, last_name FROM USERS WHERE user_id = $faculty_id2";
$facultyname = mysqli_query($connection, $facultyget);
while ( $facultyrow = mysqli_fetch_assoc($facultyname)){
    $faculty_fname=$facultyrow['first_name']; 
    $faculty_lname=$facultyrow['last_name']; 
    }

//}
?>
<h1>Update User Note</h1>

<form action="notes-edit.php" method="post" class="form">
<p> Record ID:
<input type="text" name="record_id" readonly value="<?php echo $row['record_id']; ?>">
</p>

<p> Student ID:
<input type="text" name="user_id" readonly value="<?php echo $row['user_id']; ?>">
</p>

<p> Student Name:
<input type="text" name="user_name" readonly value="<?php echo $student_fname . ' ' . $student_lname ; ?>">
</p>

<p>Faculty ID:
<input type="text" name="faculty_id" readonly value="<?php echo $row['faculty_id']; ?>" required>
</p>

<p> Faculty Name:
<input type="text" name="faculty_name" readonly value="<?php echo $faculty_fname . ' ' . $faculty_lname ; ?>">
</p>

<p>Course Name:
<input type="text" name="course_name" value="<?php echo $row['course_name']; ?>" >
</p>


<p>Scholarship Reccomendation:
<select type="text" name="scholarship" value="<?php echo $row['scholarship']; ?>" required>
    <option value="Yes">Yes</option>
     <option value="No">No</option>
     </select>
</p>


<p>Internship Reccomendation:
<select type="text" name="internship" value="<?php echo $row['status']; ?>" required>
    <option value="Yes">Yes</option>
     <option value="No">No</option>
     </select>
</p>

<p>Notes:
<input type="text" name="notes" value="<?php echo $row['notes']; ?>" >
</p>


<p>
<input class="notes-add-button" type="submit" name="submit" value="Edit Record" class="button"><br>

</p>
</form>

<a class="notes-add-button" href="<?php echo $redirect . $user_id2 ?> "><button id='submit' type='submit'>Return To User Details</button></a>

</main>
<?php
include 'footer.php';
?>

</body>
</html>


