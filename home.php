<?php
   //session start
session_start();
// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
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
                $number_of_days++; 
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

</head>
<body>
    <header class="header">
		<h1 class="logo"><a href="#"><img src="images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="200" height="75"></a></h1>
            <ul class="main-nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="users/events-user.php">Events</a></li>
                <li><a href="home.php#contact_us">Contact Us</a></li>
                <li><a href="home.php#about_us">About Us</a></li>
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

    <!-- CALENDAR SECTION -->
    <section>
        <center>
            <div class="calendardiv">
                <!-- //calendar -->
                <?=$calendar?>
            </div>
        </center>
        
    </section>

    <!-- CONTACT US SECTION-->
    <section id="contact_us">
        <div class="container" style="padding:50px;" >
            <!-- Left Container -->
            <div class="container-left" style="padding:50px;" >
                <strong style="font-size: 40px;">Contact Us mga Ka-BARRIO!</strong>
                <p style="padding-right: 50px; text-align:justify;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras convallis turpis id odio convallis commodo. 
                    Maecenas eget tortor leo. Sed elementum, arcu sed dictum iaculis, ante dui commodo enim, 
                    id tincidunt dui nulla non massa. Nunc ac ex quis orci tempus molestie id nec leo. Aliquam erat volutpat. 
                    Pellentesque sed consectetur urna, id consectetur elit. Donec placerat elit nec lobortis fringilla. Morbi
                </p>
                <strong style="padding-right: 20px;"><p style="padding-right: 50px;">Social Media Account</p></strong>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <center>
                    <div class="social-media-container">
                        <a href="https://www.facebook.com/barrioliwanag" class="social-media-link" target="_blank"><i class="fab fa-facebook"></i> Facebook</a>
                        <!-- <a href="https://www.twitter.com/" class="social-media-link" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="https://www.instagram.com/" class="social-media-link" target="_blank"><i class="fab fa-instagram"></i> Instagram </a> -->
                    </div>
                </center>
            </div>
            <!-- Right Container -->
            <div class="container-right">
                <img src="images/cover-pic-fb.jpg" alt="Barrio Liwanag Cover" width="100%">
                <center>
                    <strong style="font-size: 20px;"><h1>Barrio-Liwanag</h1></strong>
                </center>
            </div>
        </div>
    </section>

    <br>

    <!-- ABOUT US SECTION -->
    <section id="about_us">
        <div class="container">
            <center>
                <div>
                    <img src="images/cover-pic-fb.jpg" alt="Barrio Liwanag Cover" width="40%">
                <!-- </div> -->
                <p style="padding: 50px; text-align:justify;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras convallis turpis id odio convallis commodo. 
                    Maecenas eget tortor leo. Sed elementum, arcu sed dictum iaculis, ante dui commodo enim, 
                    id tincidunt dui nulla non massa. Nunc ac ex quis orci tempus molestie id nec leo. Aliquam erat volutpat. 
                    Pellentesque sed consectetur urna, id consectetur elit. Donec placerat elit nec lobortis fringilla. Morbi
                </p>
            </center>
            
        </div>
    </section>
    
    <!-- Back to Top Button with Up Arrow Icon -->
    <button id="back-to-top" onclick="scrollToTop()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="24" style="margin-top:6px;">
            <path d="M12 2L0 15h9.5v7h5V15H24L12 2z" />
        </svg>
    </button>

    <footer>
        <center>
        <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>

        <!-- Smooth Scroll JavaScript -->
    <script>
        // Function to scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show or hide back to top button based on scroll position
        window.onscroll = function() {
            var backButton = document.getElementById('back-to-top');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backButton.style.display = 'block';
            } else {
                backButton.style.display = 'none';
            }
        };
    </script>
</body>
</html>