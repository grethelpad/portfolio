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

$pagetitle = 'Add a Degree or Certificate';

include 'includes/header.php';


// make a connection 
 require('mysqli_connect.php');


// has the form been submitted?
if($_SERVER{'REQUEST_METHOD'} == 'POST'){
	
	$problem = false; 
	
	// value check
	

	if(empty ($_POST{'cert_deg_name'})){
		$problem = true;
		print '<p class="input--error">Please input certificate degree name!</p>';
	}	
	if(!$problem){
		
		
    
    
    // create variables
   // $cert_deg_id = $_POST{'cert_deg_id'};
    
    $cert_deg_name = $_POST{'cert_deg_name'};
    $cert_deg_type = $_POST{'cert_deg_type'};
    
    // bulid insert statement
    $add_degcert ="INSERT INTO DEGREE_CERTIFICATE (cert_deg_name, cert_deg_type) VALUES('$cert_deg_name','$cert_deg_type')";
    
    // Run Statement
    $result = mysqli_query($connection, $add_degcert);
    //var_dump($connection);
    // check if successful
    if($result){
        print'<div class="link">
        <p class="input--success">The degree certificate you add is now registered!</p>
</div>';
    }
		
		$_POST = [ ];
		
	} 
	else {
		print '<p class="input--error"> Please try again!';
	}
	
 } //end of handler
 
 
// start of form

?>


<h1>Add Degree Certificate</h1>
<br />

<form action="degree-certificate-add.php" method="post" id="form-admin">
    <br>

<br>
	<p>
	    <strong>Certificate Degree Name:</strong><span style="color: red;">&#42;</span><br />
	    <input type="text" name="cert_deg_name" size="50" required>
	</p>

	<p>
	    <strong>Certificate Degree Type:</strong><span style="color: red;">&#42;</span><br />	    
	    <select  name="cert_deg_type">
	       <option value="Degree">Degree</option>
	       <option value="Certificate">Certificate</option>
    </p>

	<p><input type="submit" name="submit" value="Submit"></p>

</form>


<?php include('includes/footer.php'); ?>