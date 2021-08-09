<?php

session_start();
$admin = $_SESSION['admin'];

echo"Welcome $admin!";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div>
      <a href="logout.php">Logout</a>  
    </div>
    
    <h1>THIS IS THE ADMIN PAGE</h1>
    <div class="wrapper">
        <div class="left">
            <img src="avatarme.svg" alt="Girl in a jacket" width="100">
            <h4>Grethel Padilla</h4>
            <p>PHP Student</p>
        </div>
        <div class="right">
            <div class="info">
                <h3>Information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>Email</h4>
                        <p>grethelpad@gmail.com</p>
                    </div>
                    <div class="data">
                        <h4>Phone</h4>
                        <p>1(562)555-6632</p>
                    </div>                    
                </div>
            </div>
            
            <div class="projects">
                <h3>Projects</h3>
                <div class="projects_data">
                    <div class="data">
                        <h4>Recent</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="data">
                        <h4>Most Viewed</h4>
                        <p>dolor sit amet.</p>
                    </div>                    
                </div>
            </div>            
            
        </div>
    </div>
</body>
</html>