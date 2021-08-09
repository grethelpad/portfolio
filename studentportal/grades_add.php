<?php
session_start(); // Start the session.

include ('includes/header.php');

?>

<?php

 require('mysqli_connect.php');
$pagetitle = 'Add Class';

///////////////////////////


///////////lisa
$mysqli = new mysqli($host, $user, $pass, $db, $port);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$stmt = $mysqli->prepare("SELECT course_id, course_name FROM COURSES ORDER BY course_name");
$stmt->execute();

$coursesArray = [];

foreach ($stmt->get_result() as $row)
{
    $coursesArray[$row['course_id']] = $row['course_name'];
}


///////
/* close connection */
$mysqli->close();


$user_id=$_GET['id'];
$name=$_GET['name'];
// has the form been submitted?
if($_SERVER{'REQUEST_METHOD'} == 'POST'){
  
  $problem = false; 
  
  // value check
  if(empty ($_POST{'course_id'})){
    $problem = true;
    print '<p class="input--error">Please input course id!</p>';
  } 
  if(!$problem){
  
    // create variables
    $course_id = $_POST{'course_id'};
    $user_id = $_POST{'user_id'};
    $semester = $_POST{'semester'};
    $grade = $_POST{'grade'};
    
 /////////////   lisa

$sql="SELECT GRADES.*,CONCAT(first_name, ' ', last_name)
AS dupname FROM USERS INNER JOIN GRADES ON USERS.user_id = GRADES.user_id WHERE course_id='$_POST[course_id]' AND GRADES.user_id='$_POST[user_id]'";
if ($result3=mysqli_query($connection,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result3);
  $rowDuplicate = mysqli_fetch_array($result3);
//echo $rowDuplicate ;echo 'rowduplicate';

  //printf("Result set has %d rows.\n",$rowcount);
  // Free result set
  mysqli_free_result($result3);
  }

if ($rowcount==1){
   //print '<p class="input--error">Duplicate! Student has already taken that course</p>';
  echo '<p class="input--error">Duplicate! ';
  echo $rowDuplicate['dupname']. ' has already taken ';
  echo $rowDuplicate['course_name'];
  echo '</p>';
}
////////////////////////lisa
else {

    // bulid insert statement
    $add_grades ="INSERT INTO GRADES (course_id, user_id, course_name, semester,
    grade) VALUES('$course_id','$user_id','test','$semester','$grade')";
  $add_grades2="UPDATE GRADES INNER JOIN COURSES ON GRADES.course_id =COURSES.course_id SET GRADES.course_name = COURSES.course_name
WHERE GRADES.course_id=COURSES.course_id";
   
//   echo $add_grades;echo '<br>';
$select="SELECT course_name FROM COURSES WHERE course_id=$course_id";

$resultcoursename=mysqli_query($connection,$select);
if(mysqli_num_rows($resultcoursename) > 0 ){

$row = mysqli_fetch_assoc($resultcoursename);
$coursename = $row["course_name"]; 
}

echo $coursename;
$resultcertdegid=mysqli_query($connection,$query);
if(mysqli_num_rows($resultcertdegid) > 0 ){

$row = mysqli_fetch_assoc($resultcertdegid);
$name = $row["cert_deg_id"]; 
}
    // Run Statement
    $result = mysqli_query($connection, $add_grades);
    $result2 = mysqli_query($connection, $add_grades2);
    
    // check if successful
    if($result){
        //print'<div class="link">
        //<p class="input--success">Your Class is now added!</p>
//</div>';
      header("Location: student.php?msg=okadd&course=$coursename");
     exit;
    }
}    //lisa added 
  //  $_POST = [ ];
    exit();
  } 
  else {
    print '<p class="input--error"> Please try again!';
  }


  
 } //end of handler
 
//  echo $add_grades;echo '<br>';
// start of form
$query="SELECT USERS.user_id, USERS.first_name, USERS.last_name FROM USERS WHERE user_id=$user_id";

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
?>
<h1>Add Class</h1>
<div id="formTab">
<form action="grades_add.php" method="post" class="form--inline">
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
        
            // Iterating through the courses array
            foreach($coursesArray as $key => $value) {
                //do something with your $key and $value;
                echo "<option value='$key'>$value</option>";

            }
        ?>
    </select></p>

<br>
  <p>
        
      <input type="text" name="user_id" hidden value="<?php echo $user_id;?>"size="50" required>
      
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
