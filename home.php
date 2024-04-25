<?php
   //session start
   session_start();
   if(!isset($_SESSION['role'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>
<body>
    <h1 style="text-align: center;">Welcome to Home Page</h1>

    <!-- TEMP LOG OUT BUTTON -->
    <a href="php/logout.php">Log Out</a>
</body>
</html>