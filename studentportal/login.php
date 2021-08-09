<?php
/* --------
Filename: loggedin.php
Author: George Di lorio
Purpose: 
--------  */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('includes/login_functions_inc.php');
	require('mysqli_connect.php');

	// Check the login:
	list ($check, $data) = check_login($connection, $_POST['email'], $_POST['password']);

	if ($check) { // OK!

		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['first_name'] = $data['first_name'];
		$_SESSION['user_role'] = $data['user_role'];
		$_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);

		switch ($_SESSION['user_role']) {
		  case "Admin":
		    redirect_user("admin.php");
		    break;
		  case "Faculty":
		    redirect_user("faculty.php");
		    break;
		 case "Student":
		    redirect_user("student.php");
		    break;
		  default:
		    redirect_user("index.php");
		}

	} else {


		$errors = $data;

	}

	mysqli_close($connection); 

}
include('includes/login_page_inc.php');
?>