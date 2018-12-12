<?php

function displayResults() {
    global $dbConn;

    
    $namedParameters= array();
    $product = $_GET['productName'];
    $sql= "SELECT * FROM products WHERE 1";
    
    if (isset($_GET) && !empty($_GET)) {
        if (isset($product)){
            if (!empty($product)) {
                $sql .=  " AND productDescription LIKE :product";
                $namedParameters[':product'] = "%$product%";   
            } else {
                echo "<h2> Product name cannot be empty! </h2>";
                return; 
            }
        }

        if (!empty($_GET['color'])){
            $sql .=  " AND colorId =  :color";
            $namedParameters[':color'] = $_GET['color'];
        }
        
        if (!empty($_GET['category'])){
            $sql .=  " AND catId =  :category";
            $namedParameters[':category'] = $_GET['category'];
        }
        
        $sql .= " ORDER BY productName " . $_GET["order"];
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        if (empty($records)) {
            echo "<h2> No product results! </h2>";
            return;
        }
        
        $i = 0;
        
        echo "<table border = '1' align='center' width='75%'>";
        
        while ($i < 20 && $i < count($records)) {
            $record = $records[$i];
            
            echo "<tr>";
            echo "<td><img src = '". $record["productImage"] . "'></td>";
            echo "<td><h4>". $record["productName"] . "<br />";
            showAdditionalInfo($record["productDescription"], $record["productImage"], $record["productName"], $record["price"], $i);
            echo "</h4></td>";
            echo "<td><h4>$" . $record["price"]. "</h4></td>";
        
            echo "<form method='post'>";
            echo "<input type='hidden' name='productName' value='".$record["productName"]. "'>";
            echo "<input type='hidden' name='productId' value='".$record["productId"]. "'>";
            echo "<input type='hidden' name='productImage' value='".$record["productImage"]. "'>";
            echo "<input type='hidden' name='productPrice' value='".$record["price"]. "'>";
            
            echo "</form>";
            
            echo "</tr>";
            
            $i++;
        }
        
        echo "</table>";
        
    }
}

function includeNavBar() {
    echo "<nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'><makeitwhite>OtterHats</makeitwhite></a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'><makeitwhite>Search</makeitwhite></a></li>
                        <li><a href='login.php'><makeitwhite>Login</makeitwhite></a></li>
                    </ul>
                </div>
            </nav>";
}

function showAdditionalInfo ($desc, $img, $name, $price, $num) {
        echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter$num'>";
      echo "Additional Product Info";
    echo "</button>";
    
    echo "<div class='modal fade' id='exampleModalCenter$num' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>";
      echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
        echo "<div class='modal-content'>";
          echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='exampleModalCenterTitle'>Full Product Info</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
              echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
          echo "</div>";
          echo "<div class='modal-body'>";
            echo "<img src = '$img'>";
            echo "<br />";
            echo $name;
            echo "<br />";
            echo $desc;
            echo "<br />";
            echo "$$price";
          echo "</div>";
          echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
}

function validateSession(){
    if (!isset($_SESSION['adminFullName'])) {
        header("Location: index.php");  //redirects users who haven't logged in 
        exit;
    }
}


function displayAllProducts(){
    global $dbConn;
    
    $sql = "SELECT * FROM products ORDER BY productName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records

        $i = 0;
        
        echo "<table border = '1' align='center' width='99%'>";
        
        while ($i < 30 && $i < count($records)) {
            $record = $records[$i];
            
            echo "<tr>";
            echo "<td><img src = '". $record["productImage"] . "'></td>";
            echo "<td><h4>". $record["productName"] . "<br />";
            showAdditionalInfo($record["productDescription"], $record["productImage"], $record["productName"], $record["price"], $i);
            echo "</h4></td>";
            echo "<td><h4>$" . $record["price"]. "</h4></td>";
            echo "<td><a class='btn btn-primary' role='button' href='updateProduct.php?productId=".$record['productId']."'>Update</a></td>";
            echo "<td> <form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
            echo "<input type='hidden' name='productId' value='".$record['productId']."'>";
            echo "<button class='btn btn-outline-danger' type='submit'>Delete</button>";
            echo "</form></td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='productName' value='".$record["productName"]. "'>";
            echo "<input type='hidden' name='productId' value='".$record["productId"]. "'>";
            echo "<input type='hidden' name='productImage' value='".$record["productImage"]. "'>";
            echo "<input type='hidden' name='productPrice' value='".$record["price"]. "'>";
            
            echo "</form>";
            
            echo "</tr>";
            
            $i++;
        }
        
        echo "</table>";
        echo "<br><br>";
        // echo "<a class='btn btn-primary' role='button' href='updateProduct.php?productId=".$record['productId']."'>Update</a>";
        // //echo "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
        // echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
        // echo "   <input type='hidden' name='productId' value='".$record['productId']."'>";
        // echo "   <button class='btn btn-outline-danger' type='submit'>Delete</button>";
        // echo "</form>";
        
        // echo "[<a 
        
        // onclick='openModal()' target='productModal'
        // href='productInfo.php?productId=".$record['productId']."'>".$record['productName']."</a>]  ";
        // echo " $" . $record[price]   . "<br><br>";
        
    }

function getColors() {
    global $dbConn;
    
    $sql = "SELECT * FROM color ORDER BY hatColor";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    return $records;
    
}

function getCategories() {
    global $dbConn;
    
    $sql = "SELECT * FROM category ORDER BY catName";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    //print_r($records);
    
    return $records;
    
}

function getProductInfo($productId) {
     global $dbConn;
    
    $sql = "SELECT * FROM products WHERE productId = $productId";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //we're expecting multiple records   
    
    return $record;
}

?>