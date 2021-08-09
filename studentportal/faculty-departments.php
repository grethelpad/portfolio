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
<?php 


require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries


echo "<h1>Departments</h1>";

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}
$query = "SELECT * FROM DEPARTMENTS";
$result = mysqli_query($connection, $query);


echo "<table><thead><td class='center'>Department ID</td><td>Department Name</td><td>Status</td></thead>"; // open table and include table headings


while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td class='center'>" . $row['department_id'] . "</td><td>" . $row['department_name'] . "</td><td>" . $row['status'] . "</td></tr>";
}
//  for status in the future
echo "</table>"; // close table

?>
</main>
<?php 
// require('mysqli_connect.php');

include 'includes/footer.php';
?>
