<?php
$unit_price = $_POST['resident'];
$unit_qty = $_POST['units'];
$student_fee = 20.00;
$upi = intval($unit_price);
$uqi = intval($unit_qty);
$enrollment = ($upi * $uqi);
$card_price = $_POST['card'];
$parking_price = $_POST['park'];

$total_enrollment = ($enrollment + $student_fee + $card_price + $parking_price);

$scholarship = rand(1,$total_enrollment);
$balance = ($total_enrollment - $scholarship) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuition Calculations</title>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Caveat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="calculator.css">
</head>
<body>
	<nav class="nav">

          <ul>
              <li>
            <img src="https://www.lbcc.edu/sites/default/themes/dtheme/img/logo-theme.svg" alt="LBClogo">
           </li>
          <li>
           <a href="index.html">Home</a>
           </li>
           <li>
           <a href="https://www.lbcc.edu/admissions-aid" target="_blank">Contact</a>
           </li>
           </ul>
         </nav>
  
	<div class="confirmation">
		<div class="confirmation-container">
		  <p class="confirmation_name"> 
		  Thank you for using the LBCC Tuition Calculator! 
		  </p>
		 
		 <div class="confirmation_info">
		  <p>
		  	 Cost of Tuition: <?php echo $unit_qty; ?> units x $<?php echo $unit_price; ?> = $<?php echo $enrollment; ?> 
		 </p>
		  <p>
		  	  Student Health Fee: $<?php echo $student_fee; ?> 
		 </p>
		  <p>
		  	  College Services card: $<?php echo $card_price; ?>
		 </p>
		 <p>
		  	  Parking Permit: $<?php echo $parking_price; ?>
		 </p>
		 <p>
		  	  Total Registration Costs: $<?php echo $total_enrollment; ?>
		 </p>
		  <p>
		  	  Scholarship Award: $<?php echo $scholarship; ?>
		 </p>
		 <p>
		  	  Total College Balance Due: $<?php echo $balance; ?>
		 </p>
		<p>
			To become a Viking today please use the contact button at the top to start your journey!
		</p>
</div>
		</div>
	</div>
  </div>
</body>
<footer>
            <img src="https://i1.wp.com/www.longbeachlocalnews.com/wp-content/uploads/Long-Beach-City-College.jpg?fit=1000%2C562&ssl=1">
        </footer>
</html>


