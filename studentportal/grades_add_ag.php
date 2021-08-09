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

include ('includes/header.php');

require('mysqli_connect.php');

$pagetitle = 'Add Class';

$user_id = $_SESSION['user_id'];

$query_get_name = 'SELECT * FROM USERS WHERE user_id = "' . $user_id . '"';
          $result_get_name = mysqli_query($connection, $query_get_name);

          $row_get_name = mysqli_fetch_assoc($result_get_name);
          $name = $row_get_name['first_name'] . ' ' . $row_get_name['last_name'];





?>
<h1>Add Class</h1>
<div id="formTab">
<form action="grades_add.php" method="post" id="form-admin">
    <br>
<br>
<p>
	    Name:
<input style="border:none" type="text" name="name" readonly value="<?php echo $name ?>">

	</p>
<br>
<p>
	    Course Name
	<span>&#42;</span>
	<select name="course_id" required>
	  <br>  
        <option selected="selected"  value="" required>Choose one</option>
	     <?php
 
          $query_select_course = "SELECT * FROM COURSES ORDER BY course_id";
          $result_select_course = mysqli_query($connection, $query_select_course);

          while ($row_select_course = mysqli_fetch_assoc($result_select_course)) {
          echo '<option value="' . $row_select_course['course_name'] . '">' . $row_select_course['course_name'] . '</option>';
            }
        ?>
    </select></p>

<br>
	<p>
	      
	    <input type="text" name="user_id" hidden value="<?php echo $user_id; ?>"size="50" required>
	    
	</p>

	<p>
	    Semester
	    <span>&#42;</span>
	    <input type="text" name="semester" size="50" required>
	</p>

<br>
	<p>
	    Grade:
	    <select  name="grade">
	       <option value="A">A</option>
	       <option value="B">B</option>
	       	<option value="C">C</option>
	       <option value="D">D</option>
    </p>
<br><br>

	<p><input type="submit" name="submit" value="Submit"></p>

</form>
</div>
	
<?php include ('includes/footer.php'); ?>
