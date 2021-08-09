<?php

$pagetitle = 'Login';

include ('includes/header.php');

if(isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
    <p>The following error(s)  occurred: <br> ';
    foreach($errors as $msg) {
        echo " - $msg<br>\n";
    }
    echo '</p><p>Please try again!</p>';
}

?>

<main>
<div class="video-block">
            <video autoplay muted loop id="myVideo">
             <source src="lbcc.mp4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" type="video/mp4">
             Your browser does not support HTML5 video.
            </video>
            <div class="content"> 
                <section class="index-section">
                    <article class="index-article">
			<form action='login.php' method="post">
				<h2>Login to continue...</h2>			
				<input type='email' name='email' size='20' maxlength='60' placeholder="Email Address">

				<input type='password' name='password' size='20' maxlength='20' placeholder="Password">

				<input type='submit' name='submit' value='Login'>
                <p class="for-pass">Forgot <a href="forgotpassword.php">password?</a></p>
			</form>
			
		</article>
	</section>
</main>

<?php include('includes/footer.php'); ?>