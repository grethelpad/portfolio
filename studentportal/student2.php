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

require('mysqli_connect.php');
//////////////////////////////////////
$id=$_GET['id'];
// Retrieve the user's information:
	$q = "SELECT CONCAT(last_name, ', ', first_name) FROM USER WHERE user_id=$id";
	$r = @mysqli_query($connection, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array($r, MYSQLI_NUM);

		// Display the record :
	//	echo "<h2>$row[0]</h2>";
}
$this_user_id=$_SESSION['user_id'];

//$query = "SELECT * FROM USERS WHERE user_id=$this_user_id";
$query = "SELECT * FROM USERS WHERE user_id=$this_user_id";
$result = mysqli_query($connection, $query);
while ($row=mysqli_fetch_assoc($result)){


//////////////////////////////////////////

echo '<main>'; 

echo '<div class="row">';
echo  '<div class="side">';  
echo  '<div class="card">'; 
echo '<div class="container">';
echo '<img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br>';
      
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

echo '<div class="main">
      <div class="card card_pad">'; 
      
      //////////////////////////


  //////////////    
  
  $query2="SELECT GRADES.user_id, COURSES.course_name, COURSES.course_description, GRADES.semester, GRADES.grade
FROM COURSES INNER JOIN GRADES ON COURSES.course_id = GRADES.course_id WHERE user_id=$this_user_id ORDER BY course_name";
$result2 = mysqli_query($connection, $query2);


    
    
    
    
echo '<div class="content-table">
    <h3> Classes Complete</h3>';

echo '<div class="divTable">';

echo '<div class="divTableHeading">';
echo '<div class="divTableRow">';
echo "<div class='divTableHead'>Course </div>";
echo '<div class="divTableHead">Course Description</div>';
echo '<div class="divTableHead">Semester</div>';
echo '<div class="divTableHead">Grade</div>';
			echo '</div>';
			echo '</div>';					
				
					
//	

 while ($row = mysqli_fetch_assoc($result2)) {   
    		echo '<div class="divTableBody">';
			echo '<div class="divTableRow">';
	
	echo "<div class='divTableCell'>" . $row['course_name'] . "</div>";
	echo "<div class='divTableCell'>" . $row['course_description'] . "</div>";
					
	echo "<div class='divTableCell'>". $row['semester'] . "</div>";
	echo "<div class='divTableCell'>". $row['grade'] . "</div>";
	echo '</div>';
				
	echo '</div>';
 }
	echo '</div>';
 //}
    echo '</div>';
    ///echo '</div>';

echo "</main>";
?>
<?php include ('includes/footer.php'); ?>
<?php

//echo $_SESSION['user_id']; echo ' session user id';
// session_start(); // Start the session.

// if (is_null($_SESSION['user_id'])) {
//      header("Location:login.php");
//      exit;

// }  
// if ($_SESSION['user_role']== 'faculty') {
//   $lastlogin=$_SESSION['last_login'];
//   //$last_login=CONVERT_TZ($last_login,'+00:00','-02:00' );
//   //echo $lastlogin;
//     echo '<div class="navwelcome">';
//     print '<p class="textwelcome">Welcome, '.$_SESSION['first_name']; 
//          echo ' | You are log in as faculty '; print '</p>';   
//      print '</p>';
//     print '<p></p>';
//     echo '</div>';
// } else {
//     header("Location:login.php");
//     exit;
// }
?>