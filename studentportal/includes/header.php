 <?php 
//   Create a login/logout link:
    if (isset($_SESSION['user_id'])) {
        include('includes/header-loggedin.php');
    } else {
        include('includes/header-loggedout.php');
    }
?>