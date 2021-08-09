 <?php
 /* --------
 Filename: index.php
 Author: Alex Green
 Purpose: Welcome page. Users have the option to login or register.
--------  */

$pagetitle = 'Create an Account';
include ('includes/header.php');
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
                        <form class="index-form">
                            <h2 class="title">Welcome</h2>
                            <a class="button" href='login.php'>Login</a>
                            <a class="button" href='registration.php'>Register</a>
                        </form>
                    </article>
                </section>
                 <!--<button id="myBtn" onclick="myFunction()">Pause</button>-->
            </div>
            </div>

		</main>
<?php include('includes/footer.php'); ?>