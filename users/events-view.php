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
    $_SESSION['eventid'] = "6";                                                                             //temporary 
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
                <img src="../images/cover-pic-fb.jpg" alt="Barrio Liwanag Cover" width="100%">
                <center>
                    <strong style="font-size: 20px;"><h1>QR Code</h1></strong>
                </center>
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