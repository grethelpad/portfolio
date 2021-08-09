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

$pagetitle = 'Edit Degree or Certificates';

include 'includes/header.php';

// make a connection 
 require('mysqli_connect.php');

$mysqli = new mysqli($host, $user, $pass, $db, $port);


 require('mysqli_connect.php');
 $coursename  = $_GET['coursename'] ;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     //print_r($_POST);
    $cert_deg_id=$_POST['cert_deg_id'];
   
    $cert_deg_name = $_POST['cert_deg_name'];
    $cert_deg_type = $_POST['cert_deg_type'];

    $update_query =
        "UPDATE DEGREE_CERTIFICATE
        SET cert_deg_name = '$cert_deg_name',
        cert_deg_type='$cert_deg_type'
        WHERE cert_deg_id = $cert_deg_id";
    
    // testing
   echo '<br>';echo $update_query; echo '      update query';
    
    $update_result = mysqli_query($connection, $update_query);
//var_dump($connection);
    if($update_result) {
      header("Location: degree-certificate.php?msg=ok");
        exit;
    }
    else{
        echo "Update Failed.";
    }
    
    exit("testing");
}
else{
$cert_deg_id  = $_GET['id'] ;
$query = "SELECT * FROM DEGREE_CERTIFICATE WHERE cert_deg_id = $cert_deg_id";

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

}
?>
<h1>Update Degree Certificate</h1>
<br>
<form action="degree-certificate-edit.php" method="POST" id="form-admin">

<input type="text" name="cert_deg_id" hidden readonly value="<?php echo $row['cert_deg_id']; ?>">
</p>

<p>Certificate Degree Name:
<span>&#42;</span><br />
<input type="text" name="cert_deg_name" value="<?php echo $row['cert_deg_name']; ?>" required>
</p>
	<p>Certificate Degree Type:
<span>&#42;</span><br />
<select name="cert_deg_type" required>
	 <option value="Degree"<?php if ($row[cert_deg_type] == 'Degree') echo 'selected="selected"'; ?>>Degree</option>
	 <option value="Certificate"<?php if ($row[cert_deg_type] == 'Certificate') echo 'selected="selected"'; ?>>Certificate</option>	       
    </p>

<p>
<input class="button" type="submit" value="Submit">

</p>
</form>

</main>
<?php include ('includes/footer.php'); ?>