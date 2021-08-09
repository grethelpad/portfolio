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

$pagetitle = 'Departments';

include 'includes/header.php';
?>
<main>
    <h1>Departments</h1>
        <a href="departments-add.php"><button id="submit" type="submit">Add Department</button></a>
<?php 

 // Start the session.
// session_start();
// If no session value is present, redirect the user:
// if (!isset($_SESSION['user_id'])) {

// 	// Need the functions:
// 	require('login.php');
// 	header("Location: login.php");
// 	exit();

// }

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}
$query = "SELECT * FROM DEPARTMENTS";
$result = mysqli_query($connection, $query);


echo "<table><thead><td class='center'>Department ID</td><td>Department Name</td><td>Status</td><td>Actions</td></thead>"; // open table and include table headings


while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td class='center'>" . $row['department_id'] . "</td><td>" . $row['department_name'] . "</td><td>" . $row['status'] . "</td><td><a href='deparments-edit.php?id=". $row['department_id'] . "'>Edit</a></td></tr>";
}
//  for status in the future
echo "</table>"; // close table

?>
</main>
<?php include ('includes/footer.php'); ?>