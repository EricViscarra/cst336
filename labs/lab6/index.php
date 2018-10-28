<?php
include "../../inc/dbConnection.php";
$dbConn = startConnection("ottermart");

function displayCategories() {
    global $dbConn;
    
    $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<br />";
    
    foreach ($records as $record) {
        echo "<option value='".$record["catId"]."' >" . $record["catName"]. "</option>";
    }
}
function displaySearchResults() {
    global $dbConn;
    
    if (isset($_GET["s"])) {
        
        echo "<h3>Products Found: </h3>";
        
        $namedParameters = array();
        
        $sql = "SELECT * FROM om_product WHERE 1";
        
        if (!empty($_GET['product'])) {
            $sql .= " AND productName LIKE :productName OR productDescription LIKE :productName";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
        
        if (!empty($_GET['category'])) {
            $sql .= " AND catId = :categoryId";
            $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
        }
        
        if (!empty($_GET['priceFrom'])) {
            $sql .= " AND price >= :priceFrom";
            $namedParameters[":priceFrom"] = $_GET['priceFrom'];
        }
        
        if (!empty($_GET['priceTo'])) {
            $sql .= " AND price <= :priceTo";
            $namedParameters[":priceTo"] = $_GET['priceTo'];
        }
        
        if (!empty($_GET['orderBy'])) {
            if ($_GET['orderBy'] == "price") {
                
                $sql .= " ORDER BY price";
            }
            else {
                $sql .= " ORDER BY productName";
            }
            
        }
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($records as $record) {
            
            echo "<a href=\"purchaseHistory.php?productId=".$record["productId"]. "\"> History </a>";
            echo $record["productName"] . " " . $record["productDescription"] . " $" . $record["price"] . "<br /><br />";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Lab 6: Ottermart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1> Ottermart Product Search</h1>
        
        <form>
            
            Product: <input type="text" name="product" placeholder="Product Keyword" />
            
            <br />
            
            Category: 
                <select name="category">
                    <option value=""> Select one </option>
                <?=displayCategories()?>
                </select>
            <br />
            Price: From <input type="text" name="priceFrom" size="7"/>
                    to <input type="text" name="priceTo" size="7"/>
            <br />
            Order result by:
            <br />
            
            <input type = "radio" name="orderBy" value="price"/> Price <br />
            <input type = "radio" name="orderBy" value="name"/> Name <br />
            <br />
            <input type="submit" value="Search!" name="s"/>
        </form>
        
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <hr>
        <?= displaySearchResults() ?>
        <footer>
            
            <hr>
            
            CST336 Internet Programming. 2018 &copy; Eric Orozco Viscarra <br />
            
            <strong>Disclaimer:</strong> The information in this website is ficticious. <br /> It is used for academic purposes only. <br />
            <br />
            
            <img src="../../img/csumb.png" alt="CSUMB logo" />
            <img src="../../img/buddy.png" alt="Buddy Ribbon" />
            
        </footer>
    </body>
</html>