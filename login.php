<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="form-container">
        <!-- <h2>Login</h2> -->
        <center>
          <img src="images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="250" height="100">
        </center>
        <form action="/login" method="post">
          <div class="form-group">
            <label for="name">Username:</label>
            <input type="text" id="name" name="username" placeholder="Enter Your Username" required autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input class="button" type="password" id="password" name="password" placeholder="Password" required>
          </div>
          <center>
            <button type="submit" class="submit-btn">Login</button>
          </center>
        </form>
        <center>
          <p>Don't have an account? <a class="link" href="signup.php">SignUp</a></p>
        </center>
      </div>
    
</body>
</html>