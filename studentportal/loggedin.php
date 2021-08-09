<?php
/* --------
Filename: loggedin.php
Author: George Di lorio
Purpose: 
--------  */

session_start(); // Start the session.

if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != sha1($_SERVER['HTTP_USER_AGENT']) )) {

	// Need the functions:
	require('login_functions_inc.php');
	redirect_user();
}

$pagetitle = 'Logged In!';
include('includes/header.php');
// Print a customized message:
echo "<main><section><article><h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['first_name']}!</p>
<p><a href=\"logout.php\">Logout</a></p></article></section></main>";

include('includes/footer.php'); ?>