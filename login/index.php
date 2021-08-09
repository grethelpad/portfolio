<?php
// 		connect to database
include('mysqli_connect.php');

if(isset($_POST['signup'])){
     // create variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $role = $_POST['role'];
    
    // bulid insert statement
    $query = "INSERT INTO SIGNUP (username, email, password, role) VALUES('$username','$email','$password','$role')";
    
    $result = mysqli_query($connection, $query);
    
    if($result){
        
        echo"<script>alert('You have successfully signup')</script>";
        header("Location:login.php");
        
    }else{
        echo"<script>alert('Failed to signup')</script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi User Login Demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="contatiner">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h3 class="text-center">Sign-up now</h3>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" autocomplete="off">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" autocomplete="off">
                        </div>
                        
                         <div class="form-group"> 
                            <label for="role">Select your role</label>
                           <select name="role" class="form-control">
                               <option value="">Select Your Role</option>
                               <option value="Admin">Admin</option>
                               <option value="User">User</option>
                           </select>
                        </div>
                        <input type="submit" name="signup" class="btn btn-success">
                        <br><br>
                        <a href="login.php">Already have an account</a>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

</body>
</html>