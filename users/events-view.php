<?php
   //session start
   session_start();
   /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "barrio-liwanag"; //change niyo ito according sa name ng database niyo

    $conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    
?>


 <!-- Set variables here -->
 <?php
    
    $_SESSION['eventid'] = $_GET['eventid'];                                                                             //temporary 
    if (empty($_SESSION['eventid'] )){
        header('Location: events-user.php');
        die();
    }
    $queryname = $_SESSION['eventid'];
    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM events WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter to the prepared statement
    $stmt->bind_param("s", $queryname);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Check if the query was successful
    if ($result) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Each event found will go through here
            $eventname = $row['eventname'];                                                                 //CHANGE THESE VARIABLES
            $eventdate = $row['start_date'];
            $eventdesc = $row['description'];
            $event_enddate = $row['end_date'];
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
<link rel="stylesheet" href="../css/mainstyle.css">
<link href="../images/logo.png" rel="icon">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $eventname; ?></title>
    <!-- bootstrap carousel -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>

    .d-block:hover{
    color: #424242; 
        -webkit-transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -ms-transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        transition: all .3s ease-in;
        opacity: 1;
        transform: scale(1.15);
        -ms-transform: scale(1.15); /* IE 9 */
        -webkit-transform: scale(1.15); /* Safari and Chrome */

    }
    .carousel-control-prev-icon { /*carousel buttons color, change fill='%23fff' fffwith hex */ 
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23666666' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
    }
    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23666666' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
    }
    </style>

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
    
    <section>
        <div class="container">
            <!-- Left Container -->
            <div class="container-left">
                <strong style="font-size: 40px;"><?php echo $eventname; ?></strong> <!--Event Name -->
                <h4> 
                    <?php 
                    if( $eventdate == $event_enddate){  //for single day events
                        echo $eventdate;
                    }else{                              //for multiple day events
                        echo $eventdate." - " . $event_enddate ;
                    }
                    ?>
                </h4>
                <p style="padding-right: 20px; text-align:justify;"> 
                    <?php echo $eventdesc; ?>           
                </p>
            </div>
            <!-- Right Container -->
            <div class="container-right">
                <!-- Carousel -->
                <div id="demo" class="carousel slide" data-bs-ride="carousel">
                      <!-- The slideshow/carousel -->
                    <div class="carousel-inner">
                        <?php
                        // Using prepared statement to prevent SQL injection
                        $sql = "SELECT * FROM events WHERE id = ?";
                        
                        // Prepare the SQL statement
                        $stmt = $conn->prepare($sql);
                        
                        // Bind the parameter to the prepared statement
                        $stmt->bind_param("s", $queryname);
                        
                        // Execute the prepared statement
                        $stmt->execute();
                        
                        // Get the result
                        $result = $stmt->get_result();
                        while ($row = mysqli_fetch_assoc($result)) {
                        $imagecount = 0;
                        for ($i = 1; $i <= 4; $i++) {
                                if(!empty($row['event_images_' . $i])){
                                    $imagecount++;
                                    $image_data = base64_encode($row['event_images_' . $i]);
                                    $image_src = 'data:image/jpeg;base64,' . $image_data; 
                                    if($imagecount == 1){ //set the first image found active
                                        echo '<div class="carousel-item active"  style = "height:400px;">
                                            <img class="d-block" style="width:100%" src="' . $image_src . '">
                                            </div>';
                                    }else{
                                        echo '<div class="carousel-item"  style = "height:400px;">
                                            <img class="d-block" style="width:100%" src="' . $image_src . '">
                                            </div>';
                                    }
                                }
                            }
                        }
                        if( $imagecount== 0){ //incase 0 images were uploaded, default
                            echo '<img src="../images/cover-pic-fb.jpg" alt="Barrio Liwanag Cover" width="100%">';
                        }
                        ?>
                    </div>
                     <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <center>
        <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>