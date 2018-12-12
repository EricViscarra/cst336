<?php
session_start();

include 'Connection.php';
$dbConn = getDatabaseConnection("otterhats");
include 'inc/functions.php';
validateSession();


if (isset($_GET['updateProduct'])){  //user has submitted update form
    $productName = $_GET['productName'];
    $description = $_GET['description'];
    $price =  $_GET['price'];
    $catId =  $_GET['catId'];
    $colorId = $_GET['colorId'];
    $image = $_GET['productImage'];
    $namedParameters = array();
    

    
    $sql = "UPDATE products 
            SET productName= :productName, 
               productDescription = :productDescription, 
               price = :price, 
               catId = :catId, 
               colorId = :colorId,
               productImage = :productImage 
            WHERE productId = " . $_GET['productId'];
    
    $namedParameters[":productName"] = $productName;
    $namedParameters[":productDescription"] = $description;
    $namedParameters[":price"] = $price;
    $namedParameters[":catId"] = $catId;
    $namedParameters[":colorId"] = $colorId;
    $namedParameters[":productImage"] = $image;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    
}


if (isset($_GET['productId'])) {

  $productInfo = getProductInfo($_GET['productId']);    
  
 // print_r($productInfo);
    
    
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Update Products! </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <h1> Updating Product </h1>
        
        <form>
            <input type="hidden" name="productId" value="<?=$productInfo['productId']?>">
           Product name: <input type="text" name="productName" value="<?=$productInfo['productName']?>"><br>
           Description: <textarea name="description" cols="50" rows="4"> <?=$productInfo['productDescription']?> </textarea><br>
           Price: <input type="text" name="price" value="<?=$productInfo['price']?>"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
              
              $categories = getCategories();
              
              foreach ($categories as $category) {
                  
                  echo "<option  "; 
                  echo  ($category['catId']==$productInfo['catId'])?"selected":"";
                  echo " value='".$category['catId']."'>" . $category['catName'] . "</option>";
                  
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
                  echo "<option  "; 
                  echo  ($color['colorId']==$productInfo['colorId'])?"selected":"";
                  echo " value='".$color['colorId']."'>" . $upper . "</option>";
                  
              }
              
              ?>
           </select> <br />
           Set Image Url: <input type="text" name="productImage" value="<?=$productInfo['productImage']?>"><br> <br>
           
           <input type="submit" name="updateProduct" value="Update Product">
        </form>
        <br>
        <form action="admin.php">
              <input type="submit" value="Return">
          </form>
        
        
    </body>
</html>