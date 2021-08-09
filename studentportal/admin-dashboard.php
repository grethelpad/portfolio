<?php 

require('mysqli_connect.php');

$query_users ="";
$result_users = "";

$query_users = 'SELECT * FROM USERS';
$result_users = mysqli_query($connection, $query_users);

$users_admin = "0";
$users_faculty = "0";
$users_student = "0";
$users_total = "0";
$users_active = "0";
$users_inactive = "0";
$users_bussiness_information = "0";
$users_business_information = "0";
$users_computer_science = "0";
$users_security_networking = "0";
$users_support_specialist = "0";
$users_computer_technology = "0";
$users_database_management = "0";
$users_web_development = "0";

	while ($row_users = mysqli_fetch_assoc($result_users)) {

		if ($row_users['user_role'] == "Admin"){
			$users_admin++;
		}
		if ($row_users['user_role'] == "Faculty"){
			$users_faculty++;
		}
		if ($row_users['user_role'] == "Student"){
			$users_student++;
		}
		if ($row_users['status'] == "Active"){
			$users_active++;
		}
		if ($row_users['status'] == "Inactive"){
			$users_inactive++;
		}
		if ($row_users['major'] == "Bussiness Information"){
			$users_bussiness_information++;
		}
		if ($row_users['major'] == "Business Information"){
			$users_business_information++;
		}
		if ($row_users['major'] == "Computer Science"){
			$users_computer_science++;
		}
		if ($row_users['major'] == "Computer Security &amp; Networking"){
			$users_security_networking++;
		}
		if ($row_users['major'] == "Computer Support Specialist"){
			$users_support_specialist++;
		}
		if ($row_users['major'] == "Computer Technology"){
			$users_computer_technology++;
		}
		if ($row_users['major'] == "Database Management"){
			$users_database_management++;
		}
		if ($row_users['major'] == "Web Development"){
			$users_web_development++;
		}
	}

	$users_total = $users_admin + $users_faculty + $users_student;
?>


<style>

	.dashboard-header {
		color: rgb(80, 80, 80);
		font-weight: bolder;
		font-size: 400%;
		margin: 0 auto;
		padding: 0;
		text-align: center;
		width: 100%;
	}

	.dashboard-section {
		color: rgb(80, 80, 80);
		font-weight: bolder;
		font-size: 200%;
		margin: 0 auto;
		padding: 0;
		text-align: left;
		width: 100%;
	}

	.dashboard-circle {
		background-color: #30505B;
		color: white;
		border-radius: 50%;
		height: 200px ;
		margin: 0 auto;
		padding: 50px 0 0 0;
		text-align: center;
		width: 200px;
	}

	.dashboard {
		background-color: #30505B;
		color: white;
	}

	.dashboard-items {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		padding: 0 0 100px 0;
		width: 100%;
	}

	.dashboard-item-number {
		font-size: 48pt;
		margin: 0;
		padding: 0;	
	}

	.dashboard-item {
		background-color: #8AB0AB;
		border-left: 3px solid #3E505B;
		color: white;
		font-size: 12pt;
		margin-top: 4px;
		padding: 0 20px 20px 20px;
		text-shadow: 1px 1px #3E505B;
		width: 180px;
	}


	.lg-icon {
		font-size: 100px !important;
	}
	.sm-icon {
		font-size: 50px !important;
	}

	.add-edit {
		text-align: center;
		width: 100%;
	}


	.add-edit li {
		display: inline;
		padding: 10px 150px;
	}

	.add-edit a {
		color: #30505B;
		text-decoration: none;
	}
	
	.add-edit a:visited {
		color: #30505B;
	}


</style>

<div class="card card_pad">
	<h3 class="dashboard-header">Users</h3>

		<div class="dashboard-circle">
			<i class="fas fa-users lg-icon"></i>
		</div><!-- dashboard-users -->
		
		
		<ul class="add-edit">
			<li><a href="add-user.php">Add New <i class="fas fa-plus-circle sm-icon"></i></a></li>
			<li><a href="admin-users.php"><i class="fas fa-edit sm-icon"></i> View / Edit</a></li>
		</ul>

	<h2 class="dashboard-section">Users Overview</h2>
	<div class="dashboard-items">
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_admin; ?></div>
			Admins
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_faculty; ?></div>
			Faculty
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_student; ?></div>
			Students
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_active; ?></div>
			Active Users
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_inactive; ?></div>
			Inactive Users</li>
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_total; ?></div>
			Total Users
		</div>
	</div>
</div>
	
<div class="card card_pad">
	<h3 class="dashboard-header">Courses</h3>	
	<div class="dashboard-circle">
		<i class="fas fa-book lg-icon"></i>
	</div><!-- dashboard-courses -->

	<ul class="add-edit">
		<li><a href="courses-add.php">Add New <i class="fas fa-plus-circle sm-icon"></i></a></li>
		<li><a href="courses.php"><i class="fas fa-edit sm-icon"></i>View / Edit</a></li>
	</ul>

	<div class="dashboard-items">&nbsp;</div>
</div>

<div class="card card_pad">
	<h3 class="dashboard-header">Degrees and Certifications</h3>	
	
	<div class="dashboard-circle">
		<i class="fas fa-graduation-cap lg-icon"></i>
	</div>



	<ul class="add-edit">
		<li><a href="degree-certificate-add.php">Add New <i class="fas fa-plus-circle sm-icon"></i></a></li>
		<li><a href="degree-certificate.php"><i class="fas fa-edit sm-icon"></i>View / Edit</a></li>
	</ul>

<h2 class="dashboard-section">Student Major Selections</h2>
	<div class="dashboard-items">
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_bussiness_information; ?></div>
			Bussiness Information
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_business_information; ?></div>
			Business Information
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_computer_science; ?></div>
			Computer Science
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_security_networking; ?></div>
			Computer Security Networking
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_support_specialist; ?></div>
			Computer Support Specialist
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_computer_technology; ?></div>
			Computer Technology
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_database_management; ?></div>
			Database Management
		</div>
		<div class="dashboard-item">
			<div class="dashboard-item-number"><?php echo $users_web_development; ?></div>
			Web Development
		</div>
	</div>

</div>