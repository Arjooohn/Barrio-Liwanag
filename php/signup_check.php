<?php
// Configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "main";

// Connect to Database
$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create or retrieve operation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form was submitted
    if ($_POST['Action'] == 'create') {

            // Unique username check
            $username = $_POST['username'];

            // Check if the username has at least 5 characters
            if (strlen($username) < 5) {
                $error_message = "Username must be at least 5 characters long.";
                echo "<script>
                alert('$error_message');
                window.location.href='../signup.php';
                </script>";
                exit;
            }
            
            $query = "SELECT * FROM user WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Username already exists
                $error_message = "Username already exists. Please choose a different one.";
                echo "<script>
                alert('$error_message');
                window.location.href='../signup.php';
                </script>";
                exit;
            } 
            else {
                mysqli_query($conn, "INSERT INTO user (username, Password, role) VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', 'user')");
                $message = "Record Inserted Successfully";
                $result = mysqli_query($conn, "SELECT * FROM user");
                $row = mysqli_fetch_array($result);
                echo "<script>
                alert('Account Created Successfully');
                window.location.href='../login.php';
                </script>";
            }
    }

    // Retrieve user by username and password
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
    }
}
?>