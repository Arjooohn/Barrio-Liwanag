<?php
//session start
session_start();
// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['role'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../admin-css/admins.css">
<link href="../images/admin-logo.jpg" rel="icon">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
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

    

    <footer>
        <center>
            <p>&copy; Copyright Barrio Liwanag. All Rights Reserved 2024</p>
        </center>
    </footer>
</body>
</html>