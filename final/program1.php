<?php
include '../inc/dbConnection.php';
$dbConn = startConnection("final");

function loginAttempt() {
    global $dbConn;
    
    $sql = "SELECT * FROM `fe_login` WHERE 1"; 
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    if (empty($_GET['username'])) {
        return;
    }
    $usernameAttempt = $_GET['username'];
    $passwordAttempt = $_GET['password'];
    foreach ($records as $record) {
        if ($usernameAttempt == $record['username']) {
            if ($passwordAttempt == $record['username']) {
                if ($record['failedAttempts'] < 3) {
                    $id = $record['studentId'];
                    $sql = "UPDATE fe_login SET failedAttempts = '0' WHERE studentId=$id"; 
                    $stmt = $dbConn->prepare($sql);
                    $stmt->execute();
                    header('Location: welcome.php');
                    exit;
                }
                else {
                    echo "<h4>This Account Is Locked</h4>";
                    return;
                }
            }
            else {
                $id = $record['studentId'];
                $fail = $record['failedAttempts'];
                $fail = $fail + 1;
                $sql = "UPDATE fe_login SET failedAttempts = '$fail' WHERE studentId=$id"; 
                $stmt = $dbConn->prepare($sql);
                $stmt->execute();
                if ($fail == 3) {
                $sql = "INSERT INTO fe_lock (studentId, timestamp) 
                VALUES ($id, CURRENT_TIMESTAMP)"; 
                $stmt = $dbConn->prepare($sql);
                $stmt->execute();
                }
                echo "<h4>Wrong Credentials</h4>";
                return;
            }
        }
    }
    echo "<h4>Wrong Credentials</h4>";
    
}

function displayTableData() {
    global $dbConn;
    
    $sql = "SELECT * FROM `fe_login` WHERE 1"; 
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    echo "<table align ='center' border = 1 style='width: 75%'>";
    echo "<tr><td>studentId</td><td>username</td><td>failedAttempts</td><td>daysLeftPwdChange</td></tr>";
    $lockStudents = array();
    foreach ($records as $record) {
        $studentId = $record['studentId'];
        $username = $record['username'];
        $failedAttempts = $record['failedAttempts'];
        $daysLeftPwdChange = $record['daysLeftPwdChange'];
        echo "<tr><td>$studentId</td><td>$username</td><td>$failedAttempts</td><td>$daysLeftPwdChange</td></tr>";
        if ($failedAttempts > 2) {
            array_push($lockStudents, $studentId);
        }
    }
    echo "</table>";
    echo "<br><br>";
    echo "Locked Student Ids: ";
    foreach ($lockStudents as $student) {
        echo "$student ";
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title> Eric Viscarra's Final Program 1</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        $('document').ready(function() {
            $("#username").change(function() {
                var username = $("#username").val();
                $.ajax({

                    type: "GET",
                    url: "api/checkPasswordChange.php",
                    dataType: "json",
                    data: { "username": username },
                    success: function(data, status) {
                        if (data.daysLeftPwdChange > 0 && data.daysLeftPwdChange < 16) {
                             $("#usernameError").html("You have "+data.daysLeftPwdChange+" days to password change!");
                             $("#usernameError").css("color", "red");
                             
                        }
                        else if (data.daysLeftPwdChange == 0) {
                            $("#usernameError").html("You must change your password NOW!");
                            $("#usernameError").css("color", "red");
                        }
                        else {
                            $("#usernameError").html("");
                            $("#usernameError").css("color", "red");
                        }
                    
                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                    }

                }); //ajax


            });
        });
            
            
            
        </script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
    
            <h1>Login</h1>
            <hr>
        </header>
    
        <br />
        
        <form method="GET">
            
            <input id="username" type="text" name="username" placeholder="username" value="<?=$_GET['username']?>" > 
            
            <br/>
            <br>
            <input type="password" name="password" placeholder="password" value="<?=$_GET['password']?>">
            <br />
            <br>
            
            <input type="submit" value="Login">
        </form>
        
        <br><br>
        
        <span id="usernameError" class="error"></span>
        
        <br><br>
        <?= loginAttempt(); ?>
        
        
        
        <h2>"fe_login" Table Data</h2>
        
                <?= displayTableData(); ?>

<br>
<br>
   
  <table border="1" width="600" align="center">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
     <tr style="background-color:#99E999">
      <td>1</td>
      <td>The data from the fe_login table is displayed below the Login form  </td>
      <td width="20" align="center">10</td>
    </tr>
     <tr style="background-color:#99E999">
      <td>2</td>
      <td>The locked Student ids (from the fe_lock table) are displayed  </td>
      <td width="20" align="center">5</td>
    </tr>   
     <tr style="background-color:#99E999">
      <td>3</td>
      <td>The welcome.php file is shown when the user enters the right credentials AND the account is NOT locked.</td>
      <td width="20" align="center">5</td>
    </tr>    
     <tr style="background-color:#99E999">
      <td>4</td>
      <td>(AJAX) After typing the username, the number of days left to change the password is shown in red if the value of daysLeftPwdChange is between 1 and 15.
      	Hint: Use a "change" jQuery event, instead of "click"</td>
      <td width="20" align="center">10</td>
    </tr>     
     <tr style="background-color:#99E999">
      <td>5</td>
      <td>(AJAX) After typing the username, "You must change your Password NOW" is displayed in red if the value of daysLeftPwdChange is 0</td>
      <td width="20" align="center">10</td>
    </tr>      
     <tr style="background-color:#99E999">
      <td>6</td>
      <td>If the account is NOT locked, the "failedAttempts" field is reset to 0 when the user enters the right credentials.</td>
      <td width="20" align="center">15</td>
    </tr>      
    <tr style="background-color:#99E999">
      <td>7</td>
      <td>The "failedAttempts" field is increased by 1 when entering the wrong password</td>
      <td width="20" align="center">15</td>
    </tr> 
   <tr style="background-color:#99E999">
	 <td>8</td>
	 <td>The message "wrong credentials" is displayed when entering the wrong username/password</td>
	 <td width="20" align="center">5</td>
	</tr>     
    <tr style="background-color:#99E999">
      <td>9</td>
      <td>A new record is inserted in the "fe_lock" table when the "failedAttempts" field has a value of 3.</td>
      <td width="20" align="center">15</td>
    </tr>  
     <tr style="background-color:#99E999">
      <td>10</td>
      <td>The message "This account is locked" is displayed when the account is locked and entering the right username/password</td>
      <td width="20" align="center">10</td>
    </tr> 
     <tr style="background-color:#99E999">
      <td>11</td>
      <td>This rubric is properly included AND UPDATED</td>
      <td width="20" align="center">2</td>
    </tr>     
     <tr>
      <td></td>
      <td>T O T A L </td>
      <td width="20" align="center">102</td>
    </tr> 
  </tbody></table>
    </body>
</html>