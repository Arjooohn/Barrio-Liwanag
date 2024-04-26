<?php
   //session start
   session_start();
   if(!isset($_SESSION['role'])) header('location: login.php');
?>
<!-- include calendar -->
<?php
    include 'Calendar.php';
    $calendar = new Calendar();
    //code to add event
    $calendar->add_event('test', '2024-04-23', 1, 'green');
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/mainstyle.css">
<link rel="stylesheet" href="css/calendar.css">
<title>Barrio Liwanag</title>
<link href="images/logo.png" rel="icon">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>
<body>
    <header class="header">
		<h1 class="logo"><a href="#"><img src="images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="200" height="75"></a></h1>
            <ul class="main-nav">
                <li><a href="php/home.php">Home</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
	</header> 

    <section class="parallax" style="background-image: url('images/barrio-liwanag-background-cover.png');">
        <div>
            
        </div>
    </section>

    <section>
        <div class="calendardiv">
            <!-- //calendar -->
            <?=$calendar?>
	    </div>
    </section>
    
    <footer>
        <center>
        <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>