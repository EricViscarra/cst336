<?php

    include "../../inc/dbConnection.php";
    
    $dbConn = startConnection("ottermart");
    
    $productId = $_GET['productId'];
    
    $sql = "SELECT * FROM om_product NATURAL JOIN om_purchase WHERE productId = :pId";
    
    $np = array();
    $np[":pId"] = $productId;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo $records[0]['productName'] . "<br />";
    echo "<img src='" . $records[0]['productImage'] . "' width='200'/><br />";
    
    foreach ( $records as $record) {
        
        echo "Purchase Date: " . $record["purchaseDate"] . "<br />";
        echo "Unit Price: " . $record["unitPrice"] . "<br />";
        echo "Quantity: " . $record["quantity"] . "<br />";
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <footer>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <hr>
            
            CST336 Internet Programming. 2018 &copy; Eric Orozco Viscarra <br />
            
            <strong>Disclaimer:</strong> The information in this website is ficticious. <br /> It is used for academic purposes only. <br />
            <br />
            
            <img src="../../img/csumb.png" alt="CSUMB logo" />
            <img src="../../img/buddy.png" alt="Buddy Ribbon" />
            
        </footer>
    </body>
</html>