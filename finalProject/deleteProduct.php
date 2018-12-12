<?php
session_start();

include 'Connection.php';
$dbConn = getDatabaseConnection("otterhats");
include 'inc/functions.php';
validateSession();

$sql = "DELETE FROM products WHERE productId = " . $_GET['productId'];
$stmt=$dbConn->prepare($sql);
$stmt->execute();

header("Location: admin.php");



?>