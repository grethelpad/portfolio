<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
if ($_SESSION['user_role'] == "Student") {

  // Need the functions:
  require('includes/login_functions_inc.php');
  redirect_user('unauthorized-access.php');
}

$pagetitle = 'Dashboard';

include 'includes/header.php';
 
require('mysqli_connect.php');

$student_query = 
"SELECT USERS.first_name, USERS.last_name, GRADES.course_name, GRADES.semester, GRADES.grade, USERS.user_id
FROM USERS
INNER JOIN GRADES ON USERS.user_id = GRADES.user_id
WHERE GRADES.course_id = 11 OR GRADES.course_id = 1 OR GRADES.course_id = 5
OR GRADES.course_id = 20";

$student_results = mysqli_query($connection,$student_query);

while ($student = mysqli_fetch_assoc($student_results)) {
  $first_name = $student['first_name'];
  $last_name = $student['last_name'];
  $fullName = $first_name . $last_name ;
  $course = $student['course_name'];
  $semester = $student['semester'];
  $user_id = intval($student['user_id']);
?>

    <style>
        .div-table {
  display: table;         
  width: 60%%;         
  background-color: #F1F1F1;         
  border: 1px solid #666666;         
  border-spacing: 5px; /* cellspacing:poor IE support for  this */
}
.div-table-row {
  display: table-row;
  width: auto;
  clear: both;
}
.div-table-col {
  float: left; /* fix for  buggy browsers */
  display: table-column;         
  width: 200px;         
  background-color: lightblue;  
}
    </style>
<body>

<main class="student-home"> 
<div class="student-welcome">
    <h1>Welcome to your dashboard!</h1>
</div>
<br>
 <img class="data-img" src="http://grethelcreations.com/COSW30/alpha/images/data.png" alt="data">
 
  <img class="data-img" src="http://grethelcreations.com/COSW30/alpha/images/data-img-2.png" alt="data">
  
 <h3>Students in your COSW 10 class</h3>
 <div class="main">
      <div class="card card_pad"> 
        <div class="div-Table">
            <div class="div-table-row">
                <div class="div-table-col" align="center">Student</div>
                <div  class="div-table-col" align="center">Course</div>
                <div class="div-table-col" align="center">Semester</div>
                <div  class="div-table-col" align="center">Profile</div>
             </div>
             
             <?php
            while ($student = mysqli_fetch_assoc($student_results)) {
                $studentCount = 0;
                if($studentCount < 3){
                    $studentCount = 0;  
                    echo "<div class='div-table-row'>" ;
                    echo "<div class='div-table-col ' align='center'>".$student['first_name']. " ".$student['last_name']."</div>"; 

                    echo "<div class='div-table-col ' align='center'>".$student['course_name']."</div>"; 

                    echo "<div class='div-table-col ' align='center'>".$student['semester']."</div>"; 

                    echo "<div class='div-table-col ' align='center'> <a href='../student/student.php?id=". $student['user_id'] . "'>".$student['user_id']."</a></div></div>";

                    $studentCount++;
                    if($studentCount==3){
                    echo "<div class='div-table-row'>" ;
                    $studentCount = 0;
                }
            }
                
        }
}
            ?>
            
            </div>
            </div>

  <img class="data-img" src="http://grethelcreations.com/COSW30/alpha/images/data-img-3.png" alt="data">
</main>
<?php include('includes/footer.php'); ?>