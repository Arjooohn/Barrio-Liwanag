<?php
//session start
session_start();
// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['role'])) {
    header('Location: ../login.php');
    exit();
}

// Include config file
require_once "../config.php";

// Process form submission to create events
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $eventname = $_POST['eventname'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Prepare and execute SQL statement to insert event details
    $sql = "INSERT INTO events (eventname, description, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $eventname, $description, $start_date, $end_date);
    $stmt->execute();

    // Get the ID of the inserted event
    $event_id = $stmt->insert_id;

    // Close the statement
    $stmt->close();

    // Process image uploads and store them in the database
    for ($i = 1; $i <= 4; $i++) {
        // Check if an image was uploaded for the current field
        if ($_FILES['image'.$i]['size'] > 0) {
            // Get the image data
            $image_tmp = $_FILES['image'.$i]['tmp_name'];
            $image_data = file_get_contents($image_tmp);

            // Prepare and execute SQL statement to update the event image
            $sql = "UPDATE events SET event_images_$i = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("bi", $image_data, $event_id);
            $stmt->send_long_data(0, $image_data);
            $stmt->execute();

            // Close the statement
            $stmt->close();
        }
    }

    // Redirect back to the content dashboard or any other page
    header("Location: content_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../admin-css/content_dashboard.css">
<link href="../images/admin-logo.jpg" rel="icon">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Dashboard</title>
</head>
<body>
    <header class="header">
        <h1 class="logo"><a href="content_dashboard.php"><img src="../images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="200" height="75"></a></h1>
        <ul class="main-nav">
            <li><a href="content_dashboard.php">CONTENT DASHBOARD</a></li>
            <li><a href="logs.php">LOGS</a></li>
            <li><a href="admins.php">ADMINS</a></li>
            <li><a href="../php/logout.php">LOGOUT</a></li>
        </ul>
    </header>

    <section>
        <div class="page-title">
            <p>EVENTS HANDLING</p>
        </div>
        
        <!-- Form to create events -->
        <div class="event-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <label for="eventname">Event Name:</label>
                <input type="text" id="eventname" name="eventname" required><br><br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
                
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required><br><br>
                
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required><br><br>
                
                <!-- File input fields for uploading images -->
                <label for="image1">Event Image 1:</label>
                <input type="file" id="image1" name="image1"><br><br>
                
                <label for="image2">Event Image 2:</label>
                <input type="file" id="image2" name="image2"><br><br>
                
                <label for="image3">Event Image 3:</label>
                <input type="file" id="image3" name="image3"><br><br>
                
                <label for="image4">Event Image 4:</label>
                <input type="file" id="image4" name="image4"><br><br>
                
                <input type="submit" value="Create Event">
            </form>
        </div>
    </section>

    <footer>
        <center>
            <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>
