<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="form-container">
        <!-----------SIGN UP---------------->
        <center>
          <img src="images/logo-with-text.png" alt="barrio-liwanag-logo-with-text" width="250" height="100">
        </center>
        <form method="post" action="php/signup_check.php">
          <div class="form-group">
            <input type="text" name="username" required>
            <label>Username</label>
          </div>
          <div class="form-group">
            <input type="password" name="password" required>
            <label>Password</label>
          </div>
          <center>
            <input type="hidden" name="Action" value="create">
            <button input type="submit" value="Register">Sign up</button>
          </center>
          
        </form>
        <center>
          <p>Already have an account? <a class="link" href="login.php">Login</a></p>
        </center>
      </div>
</body>
</html>