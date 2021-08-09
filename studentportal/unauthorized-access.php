<?php
/* --------
Filename: index.php
Author: Alex Green
Purpose: Welcome page. Users have the option to login or register.
--------  */

$pagetitle = 'Unauthorized Access';
include ('includes/header.php');
?>
		<main>
			<section>
				<article>
					<h1><?php echo $pagetitle; ?></h1>
					<p>Your account does not have access to the requested page.</p>

					<p>Please return to the <a href="index.php">homepage</a>.</p> 
				</article>
			</section>
		</main>
<?php include('includes/footer.php'); ?>