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

$pagetitle = 'Courses';

include 'includes/header.php';
?>
<main>
<?php

require('mysqli_connect.php');

echo "<h1>Courses</h1>";

$query="select DEPARTMENTS.department_name as 'Department', COURSES.course_name as 'Course', COURSES.course_id as 'Course ID', COURSES.status as 'Status'
from COURSES 
left join DEPARTMENTS
on COURSES.department_id = DEPARTMENTS.department_id
ORDER BY department_name";



// we want to have the courses appear to the students so they can select what courses they have taken and not taken...


$result = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result);
//var_dump($result);
//var_dump($row);
//var_dump($query);

echo "<div>";
if(isset($_GET['msg'])) {
    echo "<h4 class='alert'> Your record has been updated.</h4>";
}
echo "<table><thead><td>Department Name</td><td>Course Name</td><td>Course ID </td><td>Status</td><td>Action</td></thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>
<td>" . $row['Department'] . "</td>
<td>" .$row['Course'] . "</td>
<td>" .$row['Course ID'] . "</td>
<td>" . $row['Status'] . "</td>
<td>" ."<a href='courses-edit.php?id=". $row['Course ID'] . 
"'>Edit</a></td></tr>" ;
}

echo "</table>"; // close table
echo "</div>";


?>
</main>
<?php 
// require('mysqli_connect.php');

include 'includes/footer.php';
?>