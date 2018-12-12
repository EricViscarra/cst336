<?php
session_start();

include 'Connection.php';
$dbConn = getDatabaseConnection("otterhats");

include 'inc/functions.php';
validateSession();

function generateReports(){
    global $dbConn;
    
    $sql = "SELECT price FROM products";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $totalPrice = 0;
    $counter = 0;
    foreach( $records as $record) {
        $totalPrice = $totalPrice+$record['price'];
        $counter = $counter+1;
    }
    $average = $totalPrice/$counter;
    echo "<h2>Total Quantity of Products: ". $counter;
    echo "<br>";
    echo "Total Price of all Items: $".$totalPrice;
    echo "<br>";
    echo "Average Price of all Items: $". $average;
    echo "</h2>";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <style>
            form {
                display: inline-block;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
        
        <script>
        
            function confirmDelete() {
                return confirm("Really??");
                
            }
            
            function openModal() {
                
                $('#myModal').modal("show");
            }
            
        </script>
    
    </head>
    <body>
        
        <h1> OTTERHATS - WEBSITE MAINTENANCE </h1>
        
         <h3>Welcome <?= $_SESSION['adminFullName'] ?> </h3>

          <form action="addProduct.php">
              <input type="submit" value="Add New Product">
          </form>
         <form action="logout.php">
              <input type="submit" value="Logout">
          </form>

           <br><br>
        <h2>Reports:</h2>
        
        
        <?php
            generateReports();
            displayAllProducts();
        ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Product Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe name="productModal" width="450" height="250"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>        
        
        
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
    </body>
</html>