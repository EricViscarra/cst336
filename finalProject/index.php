<?php
session_start();
include 'Connection.php';
include "inc/functions.php";
$dbConn = getDatabaseConnection("otterhats");

function displayColor() { 
    global $dbConn;
    
    $sql = "SELECT * FROM color ORDER BY hatColor";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        $upper = $record['hatColor'];
        $upper = ucfirst($upper);
        echo "<option value='".$record['colorId']."'>" . $upper . "</option>";
    }
}

function displayCategory() { 
    global $dbConn;
    
    $sql = "SELECT * FROM category ORDER BY catName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        echo "<option value='".$record['catId']."'>" . $record['catName'] . "</option>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> OtterHats </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        
        <script>
        
        $("document").ready(function() {

            $("#zip").change(function() {

                $.ajax({

                    type: "GET",
                    url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                    dataType: "json",
                    data: { "zip": $("#zip").val() },
                    success: function(data, status) {

                        if (!data) {
                            $("#zipcodeError").html("Zip code not found");
                        }
                        else if (data.city == "Salinas") {
                            $("#zipcodeError").html("There is a store nearby!");
                        }
                        else {
                            $("#zipcodeError").html("There are no nearby stores!");
                        }

                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                        //alert(status);
                    }

                }); //ajax

            }); //zipEvent
        })
        </script>
    </head>
        <br />
            <img src= "img/mb.png">
    <body>
        <h1>OTTERHATS</h1>
        <?= includeNavBar() ?>
        
        <form method = "GET">
            
            Product: <input type="text" name="productName" placeholder="Product keyword" value = "<?php if (isset($_GET["productName"]) && !empty($_GET["productName"])) { echo $_GET["productName"];}  ?>"/> <br />
            
            Category: 
            <select name="category">
               <option value=""> Select one </option>  
               <?=displayCategory()?>
            </select>
            
            
            Hat Color: 
            <select name="color">
               <option value=""> Select one </option>  
               <?=displayColor()?>
            </select>
            <br />
            
            Select Order:
            <input type = "radio" name = "order" value = "ASC" > A-Z </input>
            <input type = "radio" name = "order" value = "DESC"> Z-A </input>
            
            <br />

            <input type="submit" name="searchForm" value="Search"/>
        </form>
        
        <hr>
        
        Is there an OtterHats near you? Input zipcode to find out!
        <form onsubmit="return validateForm()">
        <fieldset>
            <br> Zip Code: <input type="text" id="zip"> <span id="zipcodeError" class="error">

            <br>
            <button type="submit" value="Location?" class="btn btn-primary"></button>

            </fieldset>
    
        </form>
        <hr>
        <?= displayResults() ?>
        <br><br><br>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>