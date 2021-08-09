<style>

	.profile-cards {
		display: flex;
		flex-wrap: wrap;
		font-family: 'Poppins';
		justify-content: center;
	}

	.profile-cards > div {
		width: 300px;
	}

	 .profile-cards h3 {
	 	color: rgb(50, 50, 50);
	 	font-weight: bold;
	 	font-size: 22px;
	 	line-height: 18px;
	 }

	 .profile-cards p {
	 	font-weight: normal;
	 	font-size: 16px;
	 	line-height: 24px;
	 }

	 .profile-cards h3 {
	 	margin: 20px auto 0 auto;
	 	width: 80%;
	 }

	 .profile-cards img {
	 	width: 300px;
	 }

	 .profile-card {
	 	background-color: white;
	 	margin: 20px;
	 	padding-bottom: 50px;
	 }


</style>

<?php 

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

$query = "SELECT * FROM USERS ORDER BY last_name";
$result = mysqli_query($connection, $query);

echo '<div class="profile-cards">';

while ($row = mysqli_fetch_assoc($result)) {

echo '<div class="profile-card">
		<img src="images/img_avatar.png" />
		<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>
		<p>
			' . $row['email'] . '<br />
			' . $row['phone_number'] . '<br />
			' . $row['major'] . '<br />
			' . $row['user_role'] .'<br />
			' . $row['status'] . '<br />
			<a href="admin-user-details.php?id=' . $row['user_id'] .'"> View Notes</a> - 
			<a href="notes-add.php?id='. $row['user_id'] . '">Add Note</a><br /><a href="admin-user-edit.php?id='. $row['user_id'] . '">Edit User</a>
		</p>
	</div>';
}

echo '</div>';

?>