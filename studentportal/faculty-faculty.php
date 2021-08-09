<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facultiy Page</title>
    <script src="https://kit.fontawesome.com/a65682b47f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="faculty.css">
</head>
<?php
include 'faculty-header.php';
?>

<?php
require('mysqli_connect.php');
$courses_taught = 
"SELECT course_name as 'Course', course_description as 'Course Title' 
FROM COURSES
WHERE course_description = 'Intro to IT Concepts & Applications'
OR course_description = 'Database Concepts'
OR course_description= 'Introduction to Computer Science - Java'";
$courses_taught_return= mysqli_query($connection,$courses_taught);

$user_profile=
"Select USERS.first_name, USERS.last_name, USERS.email, USERS.phone_number, USERS.user_role, DEPARTMENTS.department_name
FROM USERS
INNER JOIN DEPARTMENTS ON USERS.department_id = DEPARTMENTS.department_id";

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

</head>
<main> 

<div class="row">
  <div class="side">  
  <div class="card"> 
  <div class="container">
      <img src="img_avatar.png" alt="Avatar" style="width:100%"><br>
    <br><h2><i class="fas fa-user-circle"></i><b><?php echo $first . " " . $last;?></b></h2><br>
    <h3><i class="fas fa-building"></i> Department:</h3>
        <h3><?php echo $department_name;?></h3><br>
        <h3><i class="fas fa-briefcase"></i></i> <?php echo $role; ?></h3><br>
    <h3><i class="fas fa-envelope"></i> Email:</h3>
    <h3><?php echo $email; ?></h3><br>
    <h3><i class="fas fa-phone-alt"></i> Phone:</h3>
    <h3><?php echo $phone_number; ?></h3><br>
      </div>
</div>
</div>
  
   <div class="main">
      <div class="card card_pad"> 
<table class="content-table">
    <h3> Teaching This Semester</h3>
    <thead>
      <tr>
        <th>Course</th>
        <th>Course Title</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($answer= mysqli_fetch_assoc($courses_taught_return)){
        echo "<tr><td class='active-row'>" . 
        $answer['Course'] . "</td><td>" .
        $answer['Course Title'] . "</td></tr>";
      }
      ?>
    </tbody>
  </table>
    </div>
  </div>
</div>
    </tbody>
  </table>
    </div>
  </div>
</div>

</body>
</html>
</main>
<?php 
require('mysqli_connect.php');
?>
<?php
include 'footer.php';
?>
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