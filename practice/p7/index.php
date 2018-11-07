<?php
include "../../inc/dbConnection.php";
$dbConn = startConnection("practice7");

function displayCategories() {
    global $dbConn;
    
    $sql = "SELECT quote, author FROM p1_quote ORDER BY quote";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<br />";
    
    foreach ($records as $record) {
        echo "<option value='".$record["quoteId"]."' >" . $record["category"]. "</option>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Quote Finder </title>
    </head>
    <body>
        <h1>Famous Quote Finder</h1>
        
        <form>
            Enter Quote Keyword
            <input type="text" name="keyword">
            <br />
            <br />
            Category: 
            <select>
                
                <option>Select One</option>
                
                
            </select>
            
            
        </form>
    </body>
</html>