<?php
///lisa tested
session_start(); // Start the session.

  // Need the functions:
  require('includes/login_functions_inc.php');

$authorized_user = "";

switch ($_SESSION['user_role']) {
  case "Admin":
    $authorized_user = "Your are an Admin.";
    break;
  case "Faculty":
    $authorized_user = "You are a faculty member.";
    break;
  case "Student":
    $authorized_user = "You are a student.";
    break;
  default:
   redirect_user('unauthorized-access.php');
}

$pagetitle = 'Student Page';

include ('includes/header.php');

?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <script src="https://kit.fontawesome.com/a65682b47f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="student.css">
    <link rel="stylesheet" href="user.css">
</head>
<body>
-->
<?php 
require('mysqli_connect.php');
echo "<main>"; 

//////////////////////////////////////


$this_user_id = $_SESSION["user_id"];

//$query = "SELECT * FROM USERS WHERE user_id=$this_user_id";
$query = "SELECT * FROM USERS WHERE user_id=$this_user_id";
$result = mysqli_query($connection, $query);
while ($row=mysqli_fetch_assoc($result)){


//////////////////////////////////////////
$name=$row['first_name'].' ' .$row['last_name'];

echo '<main>'; 

echo '<div class="row">';
echo  '<div class="side">';  
echo  '<div class="card">'; 
echo '<div class="container">';
echo '<img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br>';

/////////////////////////////////
echo '<div class="main">';
echo "<button id='submit' type='submit'> <a href='profile_edit.php?id=". $this_user_id . "&name=$name'>Edit Profile</a></button>";;
      echo '</div>';
      ///////////////////////////////////////////


      
echo "<br><h2><i class='fas fa-user-circle'></i><b>".$row['first_name'].' ' .$row['last_name']."</b></h2><br>";
echo "<h3><i class='fas fa-building'></i>Major:</h3>
        <h3>" .$row['major']. "</h3><br>";
echo "<h3><i class='fas fa-briefcase'></i></i>" .$row['user_role']. "</h3><br>
    <h3><i class='fas fa-envelope'></i>Email:</h3>
    <h3>" .$row['email']. "</h3><br>";
echo "<h3><i class='fas fa-phone-alt'></i> Phone:</h3>
    <h3>".$row['phone_number']."</h3><br>";
echo "</div>";
echo "</div>";
echo "</div>";
}  

/////////////////////////////

echo '<div class="main">';
      
      
      //////////////////////////
 echo '<div class="edit_profile">';
echo "<button id='submit' type='submit'> <a href='grades_add.php?id=". $this_user_id . "&name=$name'>Add Class</a></button>";
      echo '</div>';
  //////////////    
  
 $query2="SELECT GRADES.user_id, COURSES.course_id,COURSES.course_name, COURSES.course_description, GRADES.semester, GRADES.grade, COURSES.status
FROM COURSES INNER JOIN GRADES ON COURSES.course_id = GRADES.course_id WHERE user_id=$this_user_id ORDER BY course_name";

$result2 = mysqli_query($connection, $query2);

//echo $query2;
//////////////////////////////////////////


      echo '<div class="card card_pad">'; 
echo '<table class="content-table">';
echo '<h3> Classes Complete</h3>';
if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}
echo '<thead>';
      echo '<tr>';
        echo '<th>Course</th>';
        echo '<th>Course Title</th>';
        echo '<th>Semester</th>';
        echo '<th>Grade</th>';
        echo '<th>Status</th>';
        echo '<th>Action</th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
     while ($row = mysqli_fetch_assoc($result2)) {   
      echo '<tr>';
        echo "<td class='active-row'>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['course_description'] . "</td>";
        echo "<td>" . $row['semester'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='grades_edit.php?id=". $row['course_id'] . "&userid=". $row['user_id'] ."&coursename=". $row['course_name'] ."&name=". $name ."'>Edit</a></td>";
      echo "</tr>";
     }
    echo "</tbody>";
  echo "</table>";
    echo "</div>";
//////////////////lisa added this portion
$query="SELECT DEGREE_CERTIFICATE.cert_deg_id FROM USERS INNER JOIN DEGREE_CERTIFICATE ON USERS.major = DEGREE_CERTIFICATE.cert_deg_name
WHERE USERS.user_id=$this_user_id";

$resultcertdegid=mysqli_query($connection,$query);
if(mysqli_num_rows($resultcertdegid) > 0 ){

$row = mysqli_fetch_assoc($resultcertdegid);
$name = $row["cert_deg_id"]; 
}
$tested="SELECT DEG_CERT_COURSE.course_id, COURSES.course_name,COURSES.course_description
FROM DEG_CERT_COURSE INNER JOIN COURSES ON DEG_CERT_COURSE.course_id = COURSES.course_id
WHERE (((DEG_CERT_COURSE.cert_deg_id)=$name) AND ((DEG_CERT_COURSE.course_id) Not In (SELECT course_id FROM GRADES WHERE user_id = $this_user_id)))
";
$results=mysqli_query($connection,$tested);

      echo '<div class="card card_pad">'; 
echo '<table class="content-table">';
echo '<h3> Classes Needed For Completion</h3>';
echo '<thead>';
      echo '<tr>';
        echo '<th>Course</th>';
        echo '<th>Course Title</th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
 
    while ($row = mysqli_fetch_assoc($results)) {
      echo '<tr>';
        echo "<td class='active-row'>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['course_description'] . "</td>";

      echo "</tr>";
     }
    echo "</tbody>";
  echo "</table>";
    echo "</div>";

echo "</main>";
?>
<?php include ('includes/footer.php'); ?>
<?php

?>