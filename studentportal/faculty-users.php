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

$pagetitle = 'Faculty Profile Page';

include 'includes/header.php';
?>
<main>
<?php 
session_start(); // Start the session.

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>List of Students</h1>";

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}

$query = "SELECT * FROM USERS WHERE user_role = 'student'";
$result = mysqli_query($connection, $query);


echo "<table><thead><td>Profile</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Phone Number</td><td>Major</td><td>Status</td><td>User Details</td><td>Add Notes</td></thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td><a href='faculty-user-details.php?id=" . $row['user_id'] ."'> View Profile</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] ."</td><td>" . $row['email'] . "</td><td>" . $row['phone_number'] . "</td><td>" . $row['major'] . "</td><td>". $row['status'] . "</td><td><a href='faculty-user-details.php?id=" . $row['user_id'] ."'> View Notes</td><td><a href='notes-add.php?id=". $row['user_id'] . "'>Add Note</a></td>
</tr>";
}
echo "</table>"; // close table

?>
</main>
<?php
include 'includes/footer.php';
?>
</body>
</html>