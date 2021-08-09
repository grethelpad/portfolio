<?php

session_start(); // Start the session.

  // Need the functions:
  require('includes/login_functions_inc.php');

$authorized_user = "";

switch ($_SESSION['user_role']) {
  case "Admin":
    $authorized_user = "Your are an Admin.";
    break;
  case "Faculty":
    $authorized_user = "You are a faculty member.";
    break;
  case "Student":
    $authorized_user = "You are a student.";
    break;
  default:
   redirect_user('unauthorized-access.php');
}

$pagetitle = 'News';

include ('includes/header.php');

?>
        <section>
            <div id="news-banner">
                <div class="big-text">News</div>
        </section>
 <main class="news-body">

        <section>
            <article>
                <div class="news-three-column">
                    <div class="news-left-column left-font">
                        <h2>Navigation</h2>
                        <ul>
                            <li><a href="#">List Item</a></li>
                            <li><a href="#">List Item</a></li>
                            <li><a href="#">List Item</a></li>
                            <li><a href="#">List Item</a></li>
                            <li><a href="#">List Item</a></li>
                        </ul>
                        <p>&nbsp</p>
                        <h2>Announcements</h2>
                        <p><strong>Monday, December 13th 2020</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis consequuntur illum quos asperiores at sed, dolor, tenetur <a href="#">assumenda ad officiis</a> sit alias vel odio perferendis obcaecati aperiam neque, accusamus possimus.</p>
                        <p><strong>Monday, December 13th 2020</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis consequuntur illum quos asperiores at sed, dolor, tenetur assumenda ad officiis sit alias vel odio perferendis obcaecati aperiam neque, accusamus possimus.</p>
                        <p><strong>Monday, December 13th 2020</strong> - Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis consequuntur illum quos asperiores at sed, dolor, tenetur assumenda ad officiis sit alias vel odio perferendis obcaecati aperiam neque, accusamus possimus.</p>
                    </div>
                    <div class="news-center-column">
                        <h1>What is going on in Web Development</h1>
                        <p>Students will learn relevant and current web technologies including HTML5, CSS3, Javascript, PHP, MySQL, popular content management systems and web frameworks. Other topics include mobile web application development, responsive design, accessibility, and user-centered design. This program is designed to prepare students for employment in Web Development related fields including both front-end careers. Two industry certifications in web development are available with successful completion of coursework. We are proud to offer classes taught by passionate industry professionals committed to providing you with real-world project-based learning opportunities.</p>
                        <p>Students will learn relevant and current web technologies including HTML5, CSS3, Javascript, PHP, MySQL, popular content management systems and web frameworks. Other topics include mobile web application development, responsive design, accessibility, and user-centered design. This program is designed to prepare students for employment in Web Development related fields including both front-end careers. Two industry certifications in web development are available with successful completion of coursework. We are proud to offer classes taught by passionate industry professionals committed to providing you with real-world project-based learning opportunities.
                        </p>
                    </div>
                    <div class="news-right-column">
                        <p>Apply<br />
                            Speak to a Counselor<br />
                            Browse Classes<br />
                            Get Started<br />
                            LAC, M-123</p>
                        <p>Dena Laney<br />
                            Associate Professor, Computer & Office Studies</p>
                        <p>(562) 938-4714<br />
                            Send email</p>
                        <p>Program Resources<br />
                            Industry Certifications & Learning Tools for Students<br />
                            Advisory Board<br />
                            LBCC Community Partners & Career Opportunities<br/>
                            LBCC College Catalog<br />
                            Find Course Descriptions</p>
                    </div>
                </div>
            </article>
        </section>
    </main>
<?php
include 'includes/footer.php';
?>
