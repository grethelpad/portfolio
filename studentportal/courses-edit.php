<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
$authorized_user = "";

switch ($_SESSION['user_role']) {
  case "Admin":
    $authorized_user = "Your are an Admin.";
    break;
  case "Faculty":
    $authorized_user = "You are a Faculty.";
    break;
  default:
   redirect_user('unauthorized-access.php');
}

$pagetitle = 'Edit a Course';

include 'includes/header.php';
?>

<main> 
<?php 
require('mysqli_connect.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // print_r($_POST);
    
    
    $status = $_POST['status'];
    $course_name = $_POST['course_name'];
    
    $update_query =
        "UPDATE COURSES
        SET status = '$status'
        WHERE course_name = '$course_name'";
    
    // testing
    // echo $update_query;
    
    $update_result = mysqli_query($connection, $update_query);
var_dump($update_query);
    if($update_result) {
      header("Location: courses.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit("testing");
}
else{
$course_id = $_GET['id'] ; //obtains id from courses page to query db to display
$query = "SELECT * FROM COURSES WHERE course_id = $course_id";
//var_dump($course_id);

// USER TESTING
// echo $department_id;
// echo $query;

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

}
?>
<?php

?>
<h1>Update Course</h1>

<form action="courses-edit.php" method="POST" id="form-admin">
    
<p>Course Name:<br />
<input type="text" name="course_name" readonly value="<?php echo $row['course_name']; ?>" required>
</p>

<p>Status:<br />
<select type="text" name="status" required>
    <option value="Active">Active</option>
     <option value="Inactive">Inactive</option>
     </select>
</p>

<p>
<input class="button" type="submit">
</p>
</form>

</main>
<?php include ('footer.php'); ?>