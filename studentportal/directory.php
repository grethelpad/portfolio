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

$pagetitle = 'Directory';

include ('includes/header.php');

?>
<main>
<?php 
session_start(); // Start the session.

// // If no session value is present, redirect the user:
// if (!isset($_SESSION['user_id'])) {

// 	// Need the functions:
// 	require('login.php');
// 	header("Location: login.php");
// 	exit();

// }
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>Facutly Directory</h1>";

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}

$query = "SELECT * FROM USERS WHERE user_role = 'faculty'";
$result = mysqli_query($connection, $query);


echo "<table><thead><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Phone Number</td><td>Department</td></thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] ."</td><td>" . $row['email'] . "</td><td>" . $row['phone_number'] . "</td><td>" . $row['major'] . "</td>
</tr>";
}
echo "</table>"; // close table

?>
</main>
<?php
include 'includes/footer.php';
?>
