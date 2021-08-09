<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $pagetitle; ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="faculty.css">
    <link rel="stylesheet" href="assets-user.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="https://use.typekit.net/orz0dyh.css">
    <script src="https://kit.fontawesome.com/8f98c091c3.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    

</head>

<body class="w3-light-grey">
    <header>
        <!-- <span style="color: white"><?php //print_r($_SESSION); ?></span><br /> -->
        <a class="site_logo" href="index.php">
            <img class="site_logo_lbc" src="https://i.postimg.cc/9fn4FY5L/final-logo.png" />
        </a>
            <!-- <span class="site_name"> Alpha Team </span> -->
    </header>

    <div class="navbar">
        <a href="profile.php">Profile</a>
        <a href="directory.php">Directory</a>

<?php 

if ($_SESSION['user_role'] == "Admin") {

echo '<!-- admin navigation -->
        <div class="dropdown">
            <button class="dropbtn">Admin
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="admin-users.php" class="w3-bar-item w3-button">Users</a>
                <a href="departments.php" class="w3-bar-item w3-button">Departments</a>
                <a href="degree-certificate.php" class="w3-bar-item w3-button">Degrees and Certificates</a>
                <a href="courses.php" class="w3-bar-item w3-button">Course</a>
            </div>
        </div>';
}


if ($_SESSION['user_role'] == "Faculty") {

echo '<!-- faculty navigation -->
        <div class="dropdown">
          <button class="dropbtn">Faculty
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="faculty-users.php" class="w3-bar-item w3-button">Students</a>
            <a href="faculty-departments.php" class="w3-bar-item w3-button">Departments</a>
            <a href="faculty-degree_certificate.php" class="w3-bar-item w3-button">Degrees and Certificates</a>
            <a href="faculty-courses.php" class="w3-bar-item w3-button">Course</a>
          </div>
        </div>';
}

if ($_SESSION['user-role'] == "Student") {

  echo '<!-- student navigation -->
          <div class="dropdown">
            <button class="dropbtn">Student
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="student-home.php" class="w3-bar-item w3-button">Dashboard</a>
            </div>
          </div>';
        }
          
?>
        <a href="logout.php">Logout</a>
    </div>