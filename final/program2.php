<?php
include '../inc/dbConnection.php';
$dbConn = startConnection("final");

function displayLockedAccounts() {
    global $dbConn;
    
    $sql = "SELECT * FROM `fe_login` WHERE 1"; 
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    echo "<table align ='center' border = 1 style='width: 75%'>";
    echo "<tr><td>Username</td><td>Failed Attempts</td><td>Action</td></tr>";
    
    foreach ($records as $record) {
      if ($record['failedAttempts'] < 3) {
        continue;
      }
        $username = $record['username'];
        $failedAttempts = $record['failedAttempts'];
        echo "<tr><td>$username</td><td>$failedAttempts</td><td><form><input type ='submit' value='Unlock'></form></td></tr>";
    }
    echo "</table>";
    echo "<br><br>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Eric Viscarra's Final Program 2</title>
            
        </script>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
    
            <h1>Locked Out Accounts</h1>
            <hr> <br>
        </header>
        
                <?= displayLockedAccounts(); ?>
  
      <br>
      <br>
       
      <table border="1" width="600" id="rubric" align="center">
			<tbody>
				<tr>
					<th>#</th><th>Task Description</th><th>Points</th>
				</tr>
				<tr style="background-color:#99E999">
					<td>1</td>
					<td>The list of locked accounts is properly displayed, including the username and failed attempts.</td>
					<td width="20" align="center">15</td>
				</tr>
				<tr style="background-color:#FFC0C0">
					<td>2</td>
					<td>When clicking on any of the "unlock" buttons a JavaScript function is executed (any function). </td>
					<td width="20" align="center">10</td>
				</tr>
				<tr style="background-color:#FFC0C0">
					<td>3</td>
					<td>(AJAX) When clicking on any of the "unlock" buttons, an AJAX function deletes properly the record from the fe_lock table.</td>
					<td width="20" align="center">15</td>
				</tr>
				<tr style="background-color:#FFC0C0">
					<td>3</td>
					<td>(AJAX) When clicking on the "unlock" button, the AJAX function updates the value of the failedAtttempts field back to 0</td>
					<td width="20" align="center">15</td>
				</tr>
				<tr style="background-color:#FFC0C0">
					<td>4</td>
					<td>When clicking on the "Unlock" button, the button is disabled and its label changes to "Account Successfully Unlocked" 
					</td>
					<td width="20" align="center">10</td>
				</tr>
				<tr style="background-color:#99E999">
					<td>5</td>
					<td>This rubric is properly included AND UPDATED</td>
					<td width="20" align="center">2</td>
				</tr>
				<tr>
					<td></td>
					<td>T O T A L </td>
					<td width="20" align="center">17</td>
				</tr>
			</tbody>
		</table>  
    </body>
</html>