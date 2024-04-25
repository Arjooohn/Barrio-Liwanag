<?php
session_start();
// Configuration
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "barrio-liwanag"; //change niyo ito according sa name ng database niyo

// Connect to Database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// LOGIN
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0) {
    // Valid Login
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['role'] = $row['role'];

    // FOR REDIRECTING HOME PAGE
    header('Location: ../home.php');

  } else {
    // Invalid Login
    $_SESSION['error'] = "Invalid username or password";
    header('Location: ../login.php?error=1');
    exit();
  }
}
?>