<?php

/* Page created by Alex Green
Sole purpose is to direct user to the correct profile page.
*/

session_start(); // Start the session.

  // Need the functions:
  require('includes/login_functions_inc.php');

switch ($_SESSION['user_role']) {
  case "Admin":
    redirect_user('admin.php');
    break;
  case "Faculty":
    redirect_user('faculty.php');
    break;
  case "Student":
    redirect_user('student.php');
    break;
  default:
   redirect_user('unauthorized-access.php');
}

?>