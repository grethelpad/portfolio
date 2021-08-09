<?php
// 		connect to database
include('mysqli_connect.php');

session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM SIGNUP WHERE username= '$username' AND password= '$password'";
 
    $result = mysqli_query($connection,$query);

    if(mysqli_num_rows($result) == 1){

        echo"<script>alert('You are now logged in.')</script>";

        $role = "SELECT role FROM SIGNUP WHERE username='$username' AND password='$password'";
        
        $roles = mysqli_query($connection,$role);

        $row = mysqli_fetch_array($roles);
        
        if($row['role'] == "Admin"){
            $_SESSION['admin'] = $username;
            header("Location: admin.php");
        
        }
        else if($row['role'] == "User"){
            $_SESSION['user'] = $username;
            header("Location: user.php");

        }

    }else{
        echo"<script>alert('Invalid Account')</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h4 class="text-center">Login</h4>

                <form action="http://grethelcreations.com/COSW30/login/login.php" method="post">

                    <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter your username." value="">
                    </div>

                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                    </div>
                    <input type="submit" name="login" class="btn btn-info" value="Login">
                </form>
            </div>
            <div class="col-md-3"></div>
            </div>
            

        </div>
    </div>
</body>
</html>