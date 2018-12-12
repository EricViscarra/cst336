<?php
session_start();

include 'Connection.php';
$dbConn = getDatabaseConnection("otterhats");
include 'inc/functions.php';
validateSession();

if (isset($_GET['addProduct'])) { //checks whether the form was submitted
    
    $productName = $_GET['productName'];
    $description =  $_GET['description'];
    $price =  $_GET['price'];
    $catId =  $_GET['catId'];
    $image = $_GET['productImage'];
    $colorId = $_GET['colorId'];
    
    
    $sql = "INSERT INTO products (productName, productDescription, productImage, price, colorId, catId) 
            VALUES (:productName, :productDescription, :productImage, :price, :colorId, :catId);";
    $np = array();
    $np[":productName"] = $productName;
    $np[":productDescription"] = $description;
    $np[":productImage"] = $image;
    $np[":price"] = $price;
    $np[":catId"] = $catId;
    $np[":colorId"] = $colorId;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    echo "New Product was added!";
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section: Add New Product </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <h1> Adding New Product </h1>
        
        <form>
           Product name: <input type="text" name="productName"><br>
           Description: <textarea name="description" cols="50" rows="4"></textarea><br>
           Price: <input type="text" name="price"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
              
              $categories = getCategories();
              
              foreach ($categories as $category) {
                  
                  echo "<option value='".$category['catId']."'>" . $category['catName'] . "</option>";
                  
              }
              
              
              
              ?>
           </select> <br />
           Color:
           <select name="colorId">
               <option value="">Select One</option>
               <?php
               
               $colors = getColors();
              
                foreach ($colors as $color) {
                    $upper = ucfirst($color['hatColor']);
                    echo "<option value='".$color['colorId']."'>" . $upper . "</option>";
                  
                }
              ?>
               
           </select> <br>
           
           Set Image Url: <input type="text" name="productImage"><br>
           <br>
           <input type="submit" name="addProduct" value="Add Product">
        </form>
        <br>
        <form action="admin.php">
              <input type="submit" value="Cancel">
          </form>
    </body>
</html>