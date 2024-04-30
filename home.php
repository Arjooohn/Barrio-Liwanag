<?php
   //session start
   session_start();
   if(!isset($_SESSION['role'])) header('location: login.php');
?>
<!-- include calendar -->
<?php
    include 'Calendar.php';
    $calendar = new Calendar();
    //sample code to add event
    //$calendar->add_event('test', '2024-04-23', 1, 'green');
    //$calendar->add_event('multipledays', '2024-04-14', 5);

    require_once "config.php";
    $sql = "SELECT * FROM events "; //change events to database name
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Each event found will go through here
            $eventname = $row['eventname']; 
            if($row['start_date'] == $row['end_date']){  //for single day events
                $eventdate = $row['start_date'];
                $calendar->add_event($eventname, $eventdate, 1, 'green');
            }else{                                       //for multiple day events

                $start_timestamp = strtotime($row['start_date']);
                $end_timestamp = strtotime($row['end_date']);

                $number_of_seconds = $end_timestamp - $start_timestamp;
                $number_of_days = round($number_of_seconds / (60 * 60 * 24));

                $eventdate = $row['start_date'];
                $calendar->add_event($eventname, $eventdate, $number_of_days, 'green');
            }
        }
        // Free the result set
        mysqli_free_result($result);
    } else {
        // If the query fails, handle the error
        echo "Error: " . mysqli_error($conn);
    }
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
                <li><a href="home.php">Home</a></li>
                <li><a href="users/events-user.php">Events</a></li>
                <li><a href="users/contact-us.php">Contact Us</a></li>
                <li><a href="users/about-us.php">About Us</a></li>
                <li><a href="php/logout.php">Logout</a></li>
            </ul>
	</header> 

    <section class="parallax">
        <div class="notification">
            <p>Scroll Down to See the Events for this Month!</p>
        </div>
    </section>

    <!-- Javascript for the notification  -->
    <script>
        const notification = document.querySelector('.notification');
        window.addEventListener('scroll', () => {
            const scrollPosition = window.pageYOffset;
            if (scrollPosition > 0) {
                notification.style.display = 'none';
            } else {
                notification.style.display = 'block';
            }
        });        notification.style.display = 'block';
    </script>

    <!-- <section> -->
        <center>
            <div class="calendardiv">
                <!-- //calendar -->
                <?=$calendar?>
            </div>
        </center>
        
    <!-- </section> -->
    
    <footer>
        <center>
        <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>