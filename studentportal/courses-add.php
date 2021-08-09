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

$pagetitle = 'Add a Course';

include 'includes/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // print_r($_POST);
    require('mysqli_connect.php');
    $department_name = $_POST['department_name'];
    $department_id = $_POST['department_id'];
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $units = $_POST['units'];
    
    
    // insert data
    $isInDB = "SELECT * FROM DEPARTMENTS WHERE department_name = '$department_name'";
    $dbResult = mysqli_query($connection,$isInDB);
    $dbAnswer = mysqli_fetch_assoc($dbResult);
    $dbRow = mysqli_num_rows($dbResult);
    
    if($dbRow == 0) {
        $update_Dquery =
        "INSERT INTO DEPARTMENTS (department_name)
         VALUES ('$department_name')";
         $update_Dresult = mysqli_query($connection, $update_Dquery);
    }
    
    // new query to get department id
    $query = "SELECT department_id FROM DEPARTMENTS WHERE department_name ='$department_name'";
    $add = mysqli_query($connection,$query);
    $answer = mysqli_fetch_assoc($add);
    $answer2 = $answer['department_id'];


    
    // updated query to grab department_id to insert into Cquery
    
    $update_Cquery =
        "INSERT INTO COURSES (course_name, course_description, department_id,units)
         VALUES ('$course_name', '$course_description', $answer2, $units)";
         
         
    $update_Cresult = mysqli_query($connection, $update_Cquery);
    

    if($update_Cresult) {
      header("Location: courses.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
        var_dump($update_Dresult);
        var_dump($update_Cresult);
        var_dump($update_Dquery);
        var_dump($update_Cquery);
        var_dump($answer);
        var_dump($answer2);
    }
    
    exit("testing");
}
    ?>

<div class="add_course">
<h1>Add Department And Course</h1>

<form action="courses-add.php" method="POST" id="form-admin">
<p><label for="department_name">Enter New Department Name or Enter existing:</label><br>
<input type="text" name="department_name" required>
</select>
</p>


<p><label for="course_name">Course Name:</label><br>
<input type="text" name="course_name" required>
</p>

<p><label for="course_description">Course Description:</label><br>
<input type="text" name="course_description">
</p>

<p><label for="units">Units:</label><br>
<input type="text" name="units">
</p>

<p>
<input type="submit">
</p>

</form>
</div>

<?php include ('includes/footer.php'); ?>