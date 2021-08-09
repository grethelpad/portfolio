<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>    
    <script src="https://kit.fontawesome.com/a65682b47f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <?php 
require('mysqli_connect.php');
?>
<?php
include 'student-header.php';
?>
<body>

<main> 
<div class="student-welcome">
    <h1>Welcome to your student dashboard!</h1>
    
</div>


<div class="help">
<h1>Helpful Links</h1>    
<!-- The grid: three columns -->
<div class="row">
  <div class="column" onclick="openTab('b1');" style="background:#A8C69F;">Program Resources</div>
  <div class="column" onclick="openTab('b2');" style="background:#83A0A0;">Get an Educational plan</div>
  <div class="column" onclick="openTab('b3');" style="background:#4C5F6B;">Box 3</div>
</div>

<!-- The expanding grid (hidden by default) -->
<div id="b1" class="containerTab" style="display:none;background:#A8C69F">
  <!-- If you want the ability to close the container, add a close button -->
  <span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
  <h2>Industry Certifications & Learning Tools for Students</h2>
  <h5>The Web Development Department has created a hands on environment with teaches you the standards of the industry. To do so they use the following websites.</h5>
  <p><a href="https://github.com/" target="_blank">GitHub</a></p>
  <p><a href="https://github.com/" target="_blank">GitHub</a></p>
  <p><a href="https://github.com/" target="_blank">GitHub</a></p>
</div>

<div id="b2" class="containerTab" style="display:none;background:#83A0A0">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
  <h2>See a LBCC Counselor</h2>
  <a href="https://www.lbcc.edu/counseling">Start today!</a>
</div>

<div id="b3" class="containerTab" style="display:none;background:#4C5F6B">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
  <h2>Box 3</h2>
  <p>Lorem ipsum..</p>
</div>

</div>


<div class="slideshow">
    <h1>What do other students say about LBCC Web Devolpment Department</h1>
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width slides/quotes -->
  <div class="mySlides">
          <h2>Star Rating</h2>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
    <br>
    <q>Long Beach City College has been a wonderful experience for me. I had reservations about going to college at my age. The majority of the student body is young, right out of high school.</q>
<p class="author">- Freshman</p>
  </div>

  <div class="mySlides">
          <h2>Star Rating</h2>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star"></span>
<br>
    <q>While attending Long Beach City college, I have had the opportunity to have all great teachers throughout my two years attending. The professors are always helpful and intrigued with their teachings. I have also had many teachers be very helpful with offering letter of recommendations and tools to applying for transfer. The Long Beach City college campus is very safe day and night. </q>

    <p class="author">- Freshman</p>
  </div>

  <div class="mySlides">
          <h2>Star Rating</h2>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star checked-star"></span>
<span class="fa fa-star "></span>
<span class="fa fa-star "></span>
<br>
    <q>Everyone there is very helpful and nice. Whenever I had a question the staff was their to help me nicely.</q>

    <p class="author">- Sophomore2</p>
  </div>

  <!-- Next/prev buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
</div>
<!-- Dots/bullets/indicators -->
<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>



<div class="social">
    <a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>

</div>

</main>

<?php
include 'footer.php';
?>
