<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <h1> OtterHats - Admin Login </h1>
        
        <form method="post" action="loginProcess.php">
          Username:  <input type="text" name="username"/> <br>
          Password:  <input type="password" name="password"/> <br>
          <br>
          <input type="submit" value="Login">
        </form>
        <br>
        
        <form action="index.php">
              <input type="submit" value="Cancel">
        </form>
        

    </body>
</html>