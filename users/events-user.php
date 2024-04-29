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
            <li><a href="contact-us.php">Contact Us</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="../php/logout.php">Logout</a></li>
        </ul>
    </header>

    <!-- CSS for Dropdown Button. Nagkakaconflict kasi sa ibang tags kaya
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
    </style>

    <section class="parallax-events">
        <div>
            <center>
                <!-- IF ICCLICK NI USER YUNG ISANG EVENT, DAPAT MAPUNTA SIYA SA INDIVIDUAL EVENT DETAIL NA PAGE (SEE FIGMA) -->
                <br>
                <!-- Add the dropdown button here -->
                <div class="dropdown">
                    <button class="dropbtn">Filter Events! &nbsp; ▼</button>
                    <div class="dropdown-content">
                    <a href="#">Ongoing Events</a>
                    <a href="#">Upcoming Events</a>
                    <a href="#">Closed Events</a>
                    </div>
                </div>

                <!-- INSERT COLUMN HERE FOR THE EVENT DETAILS. CHECK EVENTS PAGE SA FIGMA -->
                <div class="event-list">
                    <div class="event-image">
                        <img src="../images/logo-with-text.png" alt="Event Image">
                    </div>
                    <div class="event-text">
                        <h2>Event Name</h2>
                        <h4>Event Description</h4>
                    </div>
                </div>
                <!-- Another Event Sample  -->
                <div class="event-list">
                    <div class="event-image">
                        <img src="../images/logo-with-text.png" alt="Event Image">
                    </div>
                    <div class="event-text">
                        <h2>Event Name</h2>
                        <h4>Event Description</h4>
                    </div>
                </div>
                <br>
            </center>

        </div>
    </section>


    <section >
        <center>
            <div>

            </div>
        </center>

    </section>

    <footer>
        <center>
        <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>