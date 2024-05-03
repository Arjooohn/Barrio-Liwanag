<?php
//session start
session_start();
// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['role'])) {
    header('Location: ../login.php');
    exit();
}

// Include config file to establish database connection
require_once "../config.php";

// Retrieve events data with images from the database
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="../css/mainstyle.css">
    <link href="../images/logo.png" rel="icon">
</head>
<body>
    <header class="header">
        <h1 class="logo"><a href="../home.php"><img src="../images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="200" height="75"></a></h1>
        <ul class="main-nav">
            <li><a href="../home.php">Home</a></li>
            <li><a href="events-user.php">Events</a></li>
            <li><a href="../home.php#contact_us">Contact Us</a></li>
            <li><a href="../home.php#about_us">About Us</a></li>
            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
    </header>

    <!-- CSS for Dropdown Button (Filter Button). Nagkakaconflict kasi sa ibang tags kaya
    ginawa ko na lang dito sa loob ng events page. Minimize niyo na lang -->
    <style>
        .dropbtn {
            background-color: #EFBC9B;
            color: black;
            padding: 14px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 61px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #EFBC9B;
            border-radius: 20px;
        }
        .dropdown:hover .dropdown-content {
            display: block;
            border-radius: 20px;
        }

        .dropdown:hover .dropbtn {
            background-color: #EFBC9B;
            border-radius: 20px;
        }
        .event-images {
            display: none; /* Hide images by default */
        }
    </style>

    <section class="parallax-events">
        <div>
            <center>
                <br>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<button class="event-list" onclick="toggleEventDetails(' . $row['id'] . ')">';
                    echo '<div class="event-details" id="event-details-' . $row['id'] . '">';
                    $eventurl = "events-view.php?eventid=" . $row['id']; // Read more code
                    echo '<strong><b><h1>' . $row['eventname'] . '</strong></b></h1>';
                    echo '<h4>' . $row['description'] . '</h4>';
                    echo '<a href="' . $eventurl . '" class="read-more-link">Read More about this event. Click here!</a>'; // remove if not needed or put at the bottom when ui is fixed 
                    echo '<p>Start Date: ' . $row['start_date'] . '</p>';
                    echo '<p>End Date: ' . $row['end_date'] . '</p>';
                    echo '</div>';
                    echo '<div class="event-images" id="images-' . $row['id'] . '">';
                    for ($i = 1; $i <= 4; $i++) {
                        if(!empty($row['event_images_' . $i])){
                        $image_data = base64_encode($row['event_images_' . $i]);
                        $image_src = 'data:image/jpeg;base64,' . $image_data; 
                        echo '<img class="event-image" src="' . $image_src . '">';
                        }
                    }
                    echo '</div>';
                    echo '</button>';
                }
                ?>
                <br>
            </center>
        </div>
    </section>

    <footer>
        <center>
            <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>

    <script>
    function toggleEventDetails(eventId) {
        var eventDetails = document.getElementById('event-details-' + eventId);
        var eventImages = document.getElementById('images-' + eventId);
        if (eventDetails.style.display === 'block') {
            eventDetails.style.display = 'none';
            eventImages.style.display = 'block';
        } else {
            eventDetails.style.display = 'block';
            eventImages.style.display = 'none';
        }
    }
</script>

</body>
</html>
