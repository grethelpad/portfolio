<?php
/* --------
Filename: loggedin.php
Author: George Di lorio
Purpose: 
--------  */

session_start(); 

if (!isset($_SESSION['user_id'])) {
	
	require('includes/login_functions_inc.php');
	redirect_user();

} else {

	$_SESSION = []; 
	session_destroy(); 
	setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);

}

// Set the page title and include the HTML header:
$pagetitle = 'Logged Out!';
include ('includes/header.php');

// Print a customized message:
echo "<main><section><article><h1>Logged Out!</h1>
<p>You are now logged out!</p></article></section></main>";

include ('includes/footer.php'); ?>