<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
if ($_SESSION['user_role'] != "Admin") {

  // Need the functions:
  require('includes/login_functions_inc.php');
  redirect_user('unauthorized-access.php');
}

$pagetitle = 'Admin - View All Users';

include 'includes/header.php';

?>
<main>
<?php 
// session_start(); // Start the session. - Commented out by Alec Green - 12/05/2020

// // If no session value is present, redirect the user:
// if (!isset($_SESSION['user_id'])) {

// 	// Need the functions:
// 	require('login.php');
// 	header("Location: login.php");
// 	exit();

// }
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo '<h1 style="color: rgb(80, 80, 80); font-family: Poppins; font-weight: bold; font-size: 300%; text-align: left;">List of Website Users</h1>';

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}

include('inc-users.php');


// $query = "SELECT * FROM USERS";
// $result = mysqli_query($connection, $query);


// echo "<table><thead><td>Profile</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Phone Number</td><td>Major</td><td>User Role</td><td>Status</td><td>Action</td><td>User Details</td><td>Add Notes</td></thead>"; // open table and include table headings

// while ($row = mysqli_fetch_assoc($result)) {
// echo "<tr><td><a href='admin-user-details.php?id=" . $row['user_id'] ."'>View Profile</a></td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] ."</td><td>" . $row['email'] . "</td><td>" . $row['phone_number'] . "</td><td>" . $row['major'] . "</td><td>" . $row['user_role'] ."</td>
// <td>". $row['status'] . "</td><td><a href='admin-user-edit.php?id=". $row['user_id'] . "'>Edit</a></td><td><a href='faculty-user-details.php?id=" . $row['user_id'] ."'> View Notes</td><td><a href='notes-add.php?id=". $row['user_id'] . "'>Add Note</a></td>
// </tr>";
// }
// echo "</table>"; // close table

?>
</main>
<?php include ('includes/footer.php'); ?>