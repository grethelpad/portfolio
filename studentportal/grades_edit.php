<?php
session_start(); // Start the session.

include ('includes/header.php');

?>
<?php


 require('mysqli_connect.php');
$pagetitle = 'Update Class';

$mysqli = new mysqli($host, $user, $pass, $db, $port);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$stmt = $mysqli->prepare("SELECT course_id, course_name FROM COURSES ORDER BY course_name");
$stmt->execute();
$coursesArray = [];

foreach ($stmt->get_result() as $row)
{
    $coursesArray[$row['course_id']] = $row['course_name'];
}
/////////////////

///////
/* close connection */
$mysqli->close();
 require('mysqli_connect.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // print_r($_POST);
   $userid=$_POST['user_id'];
    $courseid=$_POST['course_id'];

// echo $_POST['course_id'];echo ' courseid';  
    $semester = $_POST['semester'];
    $grade = $_POST['grade'];

    $update_query =
        "UPDATE GRADES
        SET semester='$semester',
        grade='$grade'
        WHERE course_id ='$courseid' AND user_id='$userid'";
    
    // testing
  // echo '<br>';echo $update_query; echo '      update query';
    
    $update_result = mysqli_query($connection, $update_query);
//var_dump($connection);

/////
$select="SELECT course_name FROM COURSES WHERE course_id=$courseid";

$resultcoursename=mysqli_query($connection,$select);
if(mysqli_num_rows($resultcoursename) > 0 ){

$row = mysqli_fetch_assoc($resultcoursename);
$coursename = $row["course_name"]; 
}

////
    if($update_result) {
        //echo '<p class="input--success">Update Class successfully!</p>';
      header("Location: student.php?msg=ok&course=$coursename");
      exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit();
}
else{
$courseid  = $_GET['id'] ;
$coursename  = $_GET['coursename'] ;
$userid=$_GET['userid'];
$name=$_GET['name'];

$query="SELECT USERS.user_id, USERS.first_name, USERS.last_name, GRADES.course_name, GRADES.semester, GRADES.grade,GRADES.course_id FROM USERS INNER JOIN GRADES ON USERS.user_id = GRADES.user_id WHERE course_id = $courseid AND GRADES.user_id=$userid";
//echo $query;
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

}
?>
<i>Edit Semester and Grade only</i>
<h1>Update Class</h1>
<br>
<form action="grades_edit.php" method="POST">
    <p> 
<input type="text" name="course_id" hidden value="<?php echo $row['course_id']; ?>">
</p>


<p>Course Name:
<input style="border:none" type="text" name="course_name" readonly value="<?php echo $row['course_name']; ?>">

<br>
	<p>
	   
<input type="text" name="user_id" hidden value="<?php echo $row['user_id']; ?>">

	</p>
<br>
<p>
	    Name:
<input style="border:none" type="text" name="name" readonly value="<?php echo $row['first_name'].', '.$row['last_name']; ?>">

	</p>
<br>
	<p>
	    Semester:
	    <span>&#42;</span>
	    <input type="text" name="semester" required value="<?php echo $row['semester']; ?>" required size="50">
	</p>
<br>

<p>Grade:
<span>&#42;</span>
<select name="grade" required>
	 <option value="A"<?php if ($row[grade] == 'A') echo 'selected="selected"'; ?>>A</option>
	 <option value="B"<?php if ($row[grade] == 'B') echo 'selected="selected"'; ?>>B</option> 
	 <option value="C"<?php if ($row[grade] == 'C') echo 'selected="selected"'; ?>>C</option>
	 <option value="D"<?php if ($row[grade] == 'D') echo 'selected="selected"'; ?>>D</option>
    </p>


<br><br>

<p>
<input class="button" type="submit" value="Submit">

</p>
</form>

</main>
<?php
include 'footer.php';
?>

</body>
</html>
