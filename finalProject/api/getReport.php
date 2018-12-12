<?php

include 'Connection.php';
$dbConn = getDatabaseConnection("otterhats");

$sql ="SELECT * FROM products";
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$record = $stmt->fetchAll(PDO::FETCH_ASSOC); //we're expecting just one record

echo json_encode($record);
?>