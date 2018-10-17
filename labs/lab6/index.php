<?php
include "../../inc/dbConnection.php";
$dbConn = startConnection("ottermart");
function displayCategories() {
    global $dbConn;
    $sql = "SELECT * FROM om_category ORDER BY catName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<br />";
    foreach ($records as $record) {
        echo "<option>".$record['catName'] . "</option>";
    }
}
function filterProducts() {
    global $dbConn;
    $product = $_GET['productName'];
    //$sql = "SELECT * FROM om_product
    //        WHERE productName LIKE '%$product%' OR productDescription LIKE '%$product%";
    $sql = "SELECT * FROM om_product
            WHERE productName LIKE :product";
    
    $namedParameters = array();
    
    $namedParameters[':product'] = "%$products%";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($records);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Lab 6: Ottermart Product Search </title>
    </head>
    <body>
        <h1> Ottermart </h1>
        <h2> Product Search</h2></h1>
        
        <form>
            
            Product: <input type="text" name="productName" placeholder="Product Keyword" />
            
            <br />
            
            Category: <select name="category">
                <option value=""> Select one </option>
                <?=displayCategories()?>
            </select>
            <input type="submit" name="submit" value="Search!" />
        </form>
    </body>
</html>