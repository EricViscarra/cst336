<?php
session_start();


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Practice 5: Password Generator</title>
    </head>
    <body>
            <h1> Custom Password Generator</h1>
            <form action="index.php" method="get">
                How many passwords?
                <input type="text" name="number" size="5" value="<?=$_GET['keyword']?>"/>
                (No more than 8) <br />
                Password Length <br />
                <input type = "radio" name="length" value = 6> 6 characters 
                <input type = "radio" name="length" value = 8> 8 characters 
                <input type = "radio" name="length" value = 10> 10 characters <br />
                <input type = "checkbox" name ="digits" value = true> 
                Include digits (up to 3 digits will be part of the password) 
            </form>
    </body>
</html>