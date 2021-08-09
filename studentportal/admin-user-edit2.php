<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
if ($_SESSION['user_role'] != "Admin") {

  // Need the functions:
  require('includes/login_functions_inc.php');
  redirect_user('unauthorized-access.php');
}

$pagetitle = 'Admin - User Edit';

include 'includes/header.php';

$session_id = $_SESSION['user_id'];

require('mysqli_connect.php');

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

<main>
<div class="row">
    <div class="side">
        <div class="card">
            <div class="container">

<h2>Users</h2>
              

              <?php 
               require('mysqli_connect.php');
               $side_query = "SELECT * FROM USERS ORDER BY last_name";
               $side_result = mysqli_query($connection, $side_query);

               while ($side_row = mysqli_fetch_assoc($side_result)) {

                 echo '<p><strong>' . $side_row['first_name'] . ' ' . $side_row['last_name'] . '</strong><br />
                     <strong>Major :</strong> ' . $side_row['major'] . '<br />
                     ' . $side_row['email'] . ' ' . $side_row['phone_number'] . '
                     <br /><a href="admin-user-edit.php?id='. $side_row['user_id'] . '">Edit User</a>
                     </p><hr style="margin: 20px auto; width: 80%;">';
                 }

                 $side_row = '';
                 mysqli_close($connection);
              ?>

            </div><!-- container -->
        </div><!-- card -->
    </div><!-- side -->
    <div class="main">
        <div class="card">
<?php 
require('mysqli_connect.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // print_r($_POST);
     
    $user_id = $_POST['user_id'];    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $major = $_POST['major'];
    $user_role = $_POST['user_role'];
    $status = $_POST['status'];
    
        $update_query =
        "UPDATE USERS
        SET first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        phone_number = '$phone_number',
        major = '$major',
        user_role = '$user_role',
        status = '$status'
        WHERE user_id = '$user_id'";
    
    // testing
    // echo $update_query;
    
    $update_result = mysqli_query($connection, $update_query);
    
    
    if($update_result) {
        header("Location: admin-user-edit.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit("testing");
}
else{
$user_id = $_GET['id'] ;
$query = "SELECT * FROM USERS WHERE user_id = $user_id";

// USER TESTING
// echo $user_id;
// echo $query;

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

}
?>
<h1>Update User Info</h1>

<form action="admin-user-edit.php" method="POST" id="form-admin">

<input type="text" name="user_id" hidden value="<?php echo $row['user_id']; ?>">


<div id="avatar"><img src="images/img_avatar.png" alt="Avatar" style="width:100%"></div>


<p>First Name:
<input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required>
</p>

<p>Last Name:
<input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required>
</p>


<p>Email:
<input type="text" name="email" value="<?php echo $row['email']; ?>" required>
</p>

<p>Phone:
<input type="tel" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
</p>

<p>Role:
<select type="text" name="user_role" value="<?php echo $row['user_role']; ?>" required>
    <option value="Student">Student</option>
    <option value="Faculty">Faculty</option>
    <option value="Admin">Admin</option>
    </select>
</p>


<p>Major:
<select type="text" name="major" value="<?php echo $row['major']; ?>" required>
    <option value="Business Information">Business Information</option>
    <option value="Computer Science">Computer Science</option>
    <option value="Computer Security &amp; Networking">Computer Security &amp; Networking</option>
    <option value="Computer Support Specialist">Computer Support Specialist</option>
    <option value="Computer Technology">Computer Technology</option>
    <option value="Database Management">Database Management</option>
    <option value="Web Development">Web Development</option>
    </select>
</p>

<p>Status:
<select type="text" name="status" value="<?php echo $row['status']; ?>" required>
    <option value="Active">Active</option>
     <option value="Inactive">Inactive</option>
     </select>
</p>  


<p>
<input class="notes-add-button" type="submit" value="Update User">
</p>
</form>
    </div>
    </div>
</div><!-- row -->  
</main>

<?php include ('includes/footer.php'); ?>