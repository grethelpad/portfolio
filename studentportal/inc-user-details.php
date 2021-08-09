<?php
require('mysqli_connect.php');

// $session_id = '36';

$session_id = $_GET['id'];
$user_profile="Select USERS.first_name, USERS.last_name, USERS.email, USERS.phone_number, USERS.user_role, DEPARTMENTS.department_name FROM USERS INNER JOIN DEPARTMENTS ON USERS.department_id = DEPARTMENTS.department_id WHERE user_id = $session_id";

$user_profile_results=mysqli_query($connection,$user_profile);

while ($user_profile_answer = mysqli_fetch_assoc($user_profile_results)) {
  $first = $user_profile_answer['first_name'];
  $last = $user_profile_answer['last_name'];
  $email = $user_profile_answer['email'];
  $department_name = $user_profile_answer['department_name'];
  $phone_number = $user_profile_answer['phone_number'];
  $role = $user_profile_answer['user_role'];
}

$post_its = ['rgb(200, 246, 155);', 'rgb(255, 238, 165);', 'rgb(255, 203, 165);', 'rgb(255, 177, 175);', 'rgb(214, 212, 255);', 'rgb(179, 238, 255);'];

?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap');
    .notes-header {
    color: rgb(80, 80, 80);
    font-family: 'Poppins';
    font-weight: bolder;
    font-size: 400%;
    margin: 0 auto;
    padding: 0;
    text-align: center;
    width: 100%;
  }

  .notes {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding-bottom: 100px;
  }

  .notes > div {
    width: 300px;
  }

  .note {
    background-color: pink;
    margin: 6px;
    padding: 60px 20px;
  }

  .note p {
    font-family: 'Architects Daughter', cursive;
    font-size: 18pt;
    font-weight: normal;
    line-height: 16pt;
  }

  p.small {
    font-family: 'Poppins';
    font-size: 8pt;
    font-weight: normal;
    line-height: 12pt;
  }
</style>
</head>
<main> 

<div class="row">
  <div class="side">  
  <div class="card"> 
  <div class="container">
      <img src="images/img_avatar.png" alt="Avatar" style="width:100%"><br><br>
             <div class="edit_profile">
           <a class="button" href="edit_user.php">Edit Profile</a>
       </div>
    <br><h2><i class="fas fa-user-circle"></i><b><?php echo $first . " " . $last;?></b></h2><br>
    <p>
      <i class="fas fa-building"></i><strong>Department:</strong> <?php echo $department_name;?><br />
      <i class="fas fa-briefcase"></i><?php echo $role; ?><br>
      <i class="fas fa-envelope"></i><strong>Email:</strong> <?php echo $email; ?><br>
      <i class="fas fa-phone-alt"></i><strong>Phone:</strong><?php echo $phone_number; ?>
    </p>
      </div>
</div>
</div>
  
  <div class="main">
    <div class="card">

<?php
$this_user_id = $_GET['id'];
//$this_user_id = '36';

$notes_query = "SELECT NOTES.*, USERS.first_name, USERS.last_name FROM NOTES left JOIN USERS on NOTES.faculty_id = USERS.user_id WHERE NOTES.user_id = $this_user_id"; 

$notes_result = mysqli_query($connection, $notes_query);

  echo "<h1 class='notes-header'>Notes from Faculty</h1>";
  echo '<div class="notes">'; // open table and include table headings

  while ($row = mysqli_fetch_assoc($notes_result)) {
  echo '<div class="note" style="background-color: ' . $post_its[rand(0,5)] . '">
  <p>' . $row['notes'] . '</p>
  <p class="small">' . $row['course_name'] . '<br />
  Scholarship Recommended <strong>: ' . $row['scholarship'] . '</strong><br />
  Internship Recommended: <strong>' . $row['internship'] . '</strong></p>' . '
  <p class="small">By : <strong>' . $row['first_name'] . ' ' . $row['last_name'] . '</strong><br />
  Note Created on ' . $row['date_created'] . '<br />
  Updated on ' . $row['last_modified'];
  echo '</div>';
 }
 
 //echo "</div>"; // close table
 //echo "<a href='notes-add.php?id=". $this_user_id . "'><button id='submit' type='submit'>Add A New Note</button></a>";

mysqli_close($connection);
?>

    </div></div></div></main>