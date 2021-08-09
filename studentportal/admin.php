<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
if ($_SESSION['user_role'] != "Admin") {

  // Need the functions:
  require('includes/login_functions_inc.php');
  redirect_user('unauthorized-access.php');
}

$pagetitle = 'Administration Profile Page';

include 'includes/header.php';
$session_id = $_SESSION['user_id'];

require('mysqli_connect.php');
$courses_taught = 
"SELECT course_name as 'Course', course_description as 'Course Title' 
FROM COURSES LEFT JOIN USERS on COURSES.department_id = USERS.department_id
WHERE user_id = $session_id";
$courses_taught_return= mysqli_query($connection,$courses_taught);

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
</head>
<main> 

<div class="row">
  <div class="side">  
  <div class="card"> 
  <div class="container">
      <img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br><br>
             <div class="edit_profile">
           <a class="button" href="profile_edit.php">Edit Profile</a>
       </div>
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

      <?php include('admin-dashboard.php'); ?>

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
</main>
<?php include('includes/footer.php'); ?>