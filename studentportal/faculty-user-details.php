<?php

/* Session and Redirect by Alex Green */
session_start(); // Start the session.
if ($_SESSION['user_role'] != "Admin") {
    if ($_SESSION['user_role'] != "Faculty") {

  // Need the functions:
  require('includes/login_functions_inc.php');
  redirect_user('unauthorized-access.php');
}
}
$pagetitle = 'Faculty - User Details';

include 'includes/header.php';
?>
<main> 
<?php 

include('inc-user-details.php');


// require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries
// // require('mysqli_connection.php');

// // this would nee to change
// $this_user_id = $_GET['id'];

// $query = "SELECT * FROM USERS WHERE user_id = $this_user_id";
// $notesquery = "SELECT NOTES.*, USERS.first_name, USERS.last_name FROM NOTES left JOIN USERS on NOTES.faculty_id = USERS.user_id WHERE NOTES.user_id = $this_user_id"; 

// $result = mysqli_query($connection, $query);
// $notesresult = mysqli_query($connection, $notesquery);
// echo "<h1>User Details</h1>";
// //And now to perform a simple query to make sure it's working


// while ($row = mysqli_fetch_assoc($result)) {
// echo "<p><img class='image_user user' src='uploads/". $row['profile_image'] . "'></p>";
// echo "<h1 class='user-name user'>Name: ". $row['first_name']. " ". $row['last_name']. "</h1>";   
// echo "<p class='user'>User Id: " . $row['user_id'] . "</p>";
// echo "<p class='user'>Email Address: " . $row['email'] . "</p>";
// echo "<p class='user'>Phone Number: " . $row['phone_number'] . "</p>";
// echo "<p class='user'>User Role: " . $row['user_role'] . "</p>";
// echo "<p class='user'>Major: " . $row['major'] . "</p>";
// echo "<p class='user'>Status: " . $row['status'] . "</p>";

// // // make this section only display for faculty or admin accounts.  while loop?.  edit button should only work where faculty id=session ID

// echo "<h1 class='user-name user'>Faculty Notes </h1>";  

//  echo "<table><thead><td class='center'>Faculty ID</td> <td>Course Name</td> <td>Scholarship</td> <td>Internship</td> <td>Date Created</td> <td>Last Modified</td> <td>Notes</td> <td>Edit</td> </thead>"; // open table and include table headings



//  while ($row2 = mysqli_fetch_assoc($notesresult)) {
//  echo "<tr><td class='center'> ". $row2['first_name']. " ". $row2['last_name']. "</td>
//  <td>" . $row2['course_name'] . "</td>
//  <td>" . $row2['scholarship'] . "</td>
//  <td>" . $row2['internship'] . "</td>
//  <td>" . $row2['date_created'] . "</td>
//  <td>" . $row2['last_modified'] . "</td>
//   <td>" . $row2['notes'] . "</td>
//  <td><a href='notes-edit.php?record_id=". $row2['record_id'] . "'>Edit</a></td></tr>";
//  }
 
//  echo "</table>"; // close table
//  echo "<a href='notes-add.php?id=". $this_user_id . "'><button id='submit' type='submit'>Add A New Note</button></a>";
// }

?>
</main>   
<?php
include 'includes/footer.php';
?>