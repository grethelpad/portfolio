<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
$authorized_user = "";

switch ($_SESSION['user_role']) {
  case "Admin":
    $authorized_user = "Your are an Admin.";
    break;
  case "Faculty":
    $authorized_user = "You are a Faculty.";
    break;
  default:
   redirect_user('unauthorized-access.php');
}

$pagetitle = 'Edit Department';

include 'includes/header.php';
?>
<main> 
<?php 
require('mysqli_connect.php');
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // print_r($_POST);
    
    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name'];
    $status = $_POST['status'];
    
    $update_query =
        "UPDATE DEPARTMENTS
        SET department_name = '$department_name',
        status = '$status'
        WHERE department_id = $department_id";
    
    // testing
    // echo $update_query;
    
    $update_result = mysqli_query($connection, $update_query);
//var_dump($connection);
    if($update_result) {
      header("Location: departments.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit("testing");
}
else{
$department_id = $_GET['id'] ;
$query = "SELECT * FROM DEPARTMENTS WHERE department_id = $department_id";

// USER TESTING
// echo $department_id;
// echo $query;

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

}
?>
<h1>Update Department Info</h1>

<form action="deparments-edit.php" method="POST" id="form-admin">
<p> Department ID:
<input type="text" name="department_id" readonly value="<?php echo $row['department_id']; ?>">
</p>

<p>Department Name:
<input type="text" name="department_name" value="<?php echo $row['department_name']; ?>" required>
</p>

<p>Status:
<select type="text" name="status"required>
	 <option value="Active"<?php if ($row[status] == 'Active') echo 'selected="selected"'; ?>>Active</option>
	 <option value="Inactive"<?php if ($row[status] == 'Inactive') echo 'selected="selected"'; ?>>Inactive</option>	 
     </select>
</p>

<p>
<input class="button" type="submit">
</p>
</form>

</main>
<?php
include ('footer.php'); ?>