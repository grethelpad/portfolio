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

$pagetitle = 'Degree and Certificates';

include 'includes/header.php';
?>
<main>
<h1>Degrees & Certificates</h1>
    <a href="degree-certificate-add.php"><button id="submit" type="submit">Add Item</button></a>
<?php 


require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries
 

if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}
//$query = "SELECT * FROM DEGREE_CERTIFICATE";
$query="SELECT cert_deg_id,cert_deg_name,cert_deg_type FROM DEGREE_CERTIFICATE
";
$result = mysqli_query($connection, $query);


echo "<table><thead><td class='center'>Certificate Degree ID</td>
<td>Certificate Degree Name</td>
<td>Certificate Degree Type</td>
<td>Actions</td>
</thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
   
echo "<tr><td>" . $row['cert_deg_id'] . "</td>
<td>" .$row['cert_deg_name'] . "</td>
<td>" .$row['cert_deg_type'] . "</td>
<td><a href='degree-certificate-edit.php?id=". $row['cert_deg_id'] ."'>Edit</a></td></tr>";
}
//  for status in the future
echo "</table>"; // close table


?>
</main>

<?php include ('includes/footer.php'); ?>