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


require('mysqli_connect.php');

$pagetitle = 'Edit Profile';

include ('includes/header.php');

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
  var_dump($update_query);
    var_dump($connection);
    $update_result = mysqli_query($connection, $update_query);
    
    
    if($update_result) {
        header("Location: profile_edit.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit("testing");
}
else{
$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM USERS WHERE user_id = $user_id";

// USER TESTING
// echo $user_id;
// echo $query;

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

// var_dump($result);
// var_dump($row);
}
?>
<main>
<h1>Update User Info</h1>
<div class="profile_edit_wrapper">
<form action="profile_edit.php" method="POST" id="profile_edit">

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


<select type="text" name="user_role" hidden value="<?php echo $row['user_role']; ?>" required>
    <option value="Student">Student</option>
    <option value="Faculty">Faculty</option>
    <option value="Admin">Admin</option>
    </select>


<p>Major:
<select type="text" name="major" value="<?php echo $row['major']; ?>" required>
    <option value="Web Development">Web Development</option>
    </select>
</p>


<select type="text" name="status" hidden value="<?php echo $row['status']; ?>" required>
    <option value="Active">Active</option>
     <option value="Inactive">Inactive</option>
     </select>


<p>
<input class="notes-add-button" type="submit" value="Update User">
</p>
</form>
    </div>
</main>

<?php include ('includes/footer.php'); ?>