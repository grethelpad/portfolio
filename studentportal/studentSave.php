<?php

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
?>

<main> 

<div class="row">
  <div class="side">  
  <div class="card"> 
  <div class="container">
      <img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br>
    <br><h2><i class="fas fa-user-circle"></i><b>  John Doe</b></h2><br>
    <h3><i class="fas fa-building"></i>Major:</h3>
        <h3>Web Development</h3><br>
        <h3><i class="fas fa-briefcase"></i></i>Student</h3><br>
    <h3><i class="fas fa-envelope"></i> Email:</h3>
    <h3>jdoe@lbcc.edu</h3><br>
    <h3><i class="fas fa-phone-alt"></i> Phone:</h3>
    <h3>(562)555-1635 ext 1234</h3><br>
      </div>
</div>
</div>
  
   <div class="main">
              <div class="edit_profile">
           <a class="button" href="edit_user.php">Edit Profile</a>
       </div>
      <div class="card card_pad"> 
<table class="content-table">
    <h3> Classes Complete</h3>
    <thead>
      <tr>
        <th>Course</th>
        <th>Course Title</th>
        <th>Semester</th>
        <th>Grade</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="active-row">COSW-200</td>
        <td>JavaScript</td>
        <td>Spring2019</td>
        <td>A</td>
        <td>A or I</td>
      </tr>
      
       <tr >
        <td class="active-row">COSW-30</td>
         <td>PHP-MySQL</td>
         <td>Fall2020</td>
         <td>A</td>
         <td>A or I</td>
      </tr>      
       <tr >
        <td class="active-row">COSW-10</td>
         <td>HTML and CSS</td>
         <td>Spring2019</td>
         <td>A</td>
         <td>A or I</td>
      </tr>
    </tbody>
  </table>
    </div>
          <div class="card card_pad"> 
<table class="content-table">
    <h3> Classes Needed</h3>
    <thead>
      <tr>
        <th>Course</th>
        <th>Course Title</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="active-row">COSW-230</td>
        <td>Framework</td>
        
      </tr>
      
       <tr >
        <td class="active-row">COSW-240</td>
         <td>Content Management</td>
        
      </tr>      
       <tr >
        <td class="active-row">COSP-38</td>
         <td>Data Base</td>
        
      </tr>
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
</main>

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