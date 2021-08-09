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

$pagetitle = 'Add a Department';

include 'includes/header.php';


// session_start(); // Start the session.

// // If no session value is present, redirect the user:
// if (!isset($_SESSION['user_id'])) {

// 	// Need the functions:
// 	require('login.php');
// 	header("Location: login.php");
// 	exit();

// }
?>

<?php
//intro text:
print '<main>';
print '<h1>Department Registration Form</h1>
<p>Enter the department information to add a new department.<br> You will be able to create additional departments anytime.</p>';

// has the form been submitted?
if($_SERVER{'REQUEST_METHOD'} == 'POST'){
	
	$problem = false; 
	
	// value check
	if(empty ($_POST{'department_name'})){
		$problem = true;
		print '<p class="input--error">Please input your department name!</p>';
	}
	
	if(empty ($_POST{'status'})){
		$problem = true;
		print '<p class="input--error">Please input a status!</p>';
	}
	
	if(!$problem){
		
		
// 		connect to database

    require('mysqli_connect.php');
    
    
    // create variables
    $department_name = $_POST{'department_name'};
    $status = $_POST{'status'};
    
    // bulid insert statement
    $add_department ="INSERT INTO DEPARTMENTS (department_name,  status) VALUES('$department_name','$status')";
    
    // Run Statement
    $result = mysqli_query($connection, $add_department);
    //var_dump($connection);
    // check if successful
    if($result){
        print'<div class="link">
        <p class="input--success">The department you added is now registered!</p>
</div>';
    }
		
		$_POST = [ ];
		
	} 
	else {
		print '<p class="input--error"> Please try again!';
	}
	
 } //end of handler
 
 
// start of form
print '</div>';
?>

<div class="reg--p">
<p class="reg-p"></p> </div>
    
    <div id="formTab">
    <form action="departments-add.php" method="post" id="form-admin">
	
	<p><label required for="department_name">Department Name:</label> <span>&#42;</span><br />
        
        <input type="text" placeholder="Enter the department name" name="department_name" size="15" value="<?php if(isset($_POST['department_name'])) { print htmlspecialchars($_POST['department_name']); } ?>"></p>
	<br>
	<p><label required  for="status">Department Status:</label><span>&#42;</span><br />	 
	<select placeholder="Select active" name="status" value="<?php if(isset($_POST['status'])) { print htmlspecialchars($_POST['status']); } ?>">>
        
      <option value="Active">Active</option>
      <option value="Inactive">Inactive</option>
    </select>
	
	<p><input type="submit" name="submit" value="Register" class="button">
            <button id="submit" type="submit"> <a href="departments.php">Go Back</button></p>
</form>

</div>
</main>
<?php include ('includes/footer.php'); ?>