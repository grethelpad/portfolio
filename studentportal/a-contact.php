<?php
/* --------
Filename: registration.php
Author: Alex Green
Purpose: Form to add users to the database
--------  */

$pagetitle = 'Contact Form';

include ('includes/header.php');

function redirect_user($page = 'index.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	// Add the page:
	$url .= '/' . $page;

	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

}
?>

		<main>
            <div class="content"> 
                <section class="index-section">
                    <article class="index-article">
			<form action="a-contact.php" method="post" class="form-area">
			<h2>Contact</h2>
			<?php 
			// Check if the form has been submitted:
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$problem = false; // No problems so far.
				
				// Check for each value...
				if (empty($_POST['first-name'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your first name.</span></p>';
				}
				
				if (empty($_POST['last-name'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your last name.</span></p>';
				}

				if (empty($_POST['email'])) {
					$problem = true;
					print '<p><span class="form-error">Please enter your email address.</span></p>';
				}
				
				if (!$problem) { // If there weren't any problems...

					// Add user to database
					$firstname = $_POST['first-name'];
					$lastname = $_POST['last-name'];
					$email = $_POST['email'];


					/* email stuff here */
					/*

					$message = '<html><body>';
					$message .= '<style>';
					$message .= "@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');";
					$message .= "p { font-family: 'Poppins', sans-serif;'}";
					$message .= '</style>';
					$message .= '<img src="https://i.postimg.cc/9fn4FY5L/final-logo.png" alt="Student Tracker" />';
					$message .= "<p>Carina the keel of argonauts' ship pisces the fishes cassiopeia the queen of ethiopia sagitta the arrow canis minor the little dog corvus the crow sextans the sextant. Scutum the shield sextans the sextant horologium the clock hercules the hercules, son of zeus sextans the sextant canis minor the little dog. Indus the indian pyxis the compass on the argonauts' ship piscis austrinus the southern fish serpens the serpent sagitta the arrow grus the crane coma berenices the berenice's hair corvus the crow. Centaurus the centaur aries the ram orion the orion, the hunter leo the lion pyxis the compass on the argonauts' ship equuleus the little horse. </p>";
					$message .= "<button>Button Test</button>";
					$message .= "</body></html>";
					*/

					$message = '<html><body>';
					$message .= '<link rel="preconnect" href="https://fonts.gstatic.com">';
					$message .= '<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">';
					$message .= '<img src="https://i.postimg.cc/9fn4FY5L/final-logo.png" alt="Student Tracker" />';
					$message .= '<p style="font-family: ';
					$message .= "'Poppins'";
					$message .= ', sans-serif; font-size: 16pt;"><strong>' . strip_tags($firstname) . ' ' . strip_tags($lastname) . '</strong> - Carina the keel of argonauts&apos; ship pisces the fishes cassiopeia the queen of ethiopia sagitta the arrow canis minor the little dog corvus the crow sextans the sextant. Scutum the shield sextans the sextant horologium the clock hercules the hercules, son of zeus sextans the sextant canis minor the little dog. Indus the indian pyxis the compass on the argonauts&apos; ship piscis austrinus the southern fish serpens the serpent sagitta the arrow grus the crane coma berenices the berenice&apos;s hair corvus the crow. Centaurus the centaur aries the ram orion the orion, the hunter leo the lion pyxis the compass on the argonauts&apos; ship equuleus the little horse. </p>';
					$message .= '<a href="http://skillfulledu.com/alpha/week3-inprogress/"><button style="background-color: rgb(0, 50, 0); border-radius: 30px; border-left: none; border-bottom: none; border-right: none; border-top: none;color: white; font-weight: bold; padding: 20px 40px;">Button Test</button></a>';
					$message .= "</body></html>";

					$to = strip_tags($email);
			
					$subject = 'Web Contact Form';
					
					$headers = "From: no-reply@ingreen.net\r\n";
					$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
					$headers .= 'Bcc: info@devfarms.com';
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		            if (mail($to, $subject, $message, $headers)) {
		              echo 'Your message has been sent.';
		            } else {
		              echo 'There was a problem sending the email.';
		            }




					// Clear the posted values:
					$_POST = [];
				
				} else { // Forgot a field.
				
					print '<p><span class="form-error">Please try again!</span></p>';
					
				}

			} // End of handle form IF.
			?>

				<input type="text" name="first-name" id="first-name" placeholder="First Name" value="<?php if (isset($_POST['first-name'])) { print htmlspecialchars($_POST['first-name']); } ?>">
	
				<input type="text" name="last-name" id="last-name" placeholder="Last Name" value="<?php if (isset($_POST['last-name'])) { print htmlspecialchars($_POST['last-name']); } ?>">
	
				<input type="email" name="email" id="email" placeholder="Email" value="<?php if (isset($_POST['email'])) { print htmlspecialchars($_POST['email']); } ?>">
				
				<input type="submit">
			</form>
		</article>
	</section>
</main>

<?php include('includes/footer.php'); ?>