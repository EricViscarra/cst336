<?php
header('Access-Control-Allow-Origin: *');
include '../../inc/dbConnection.php';
$dbConn = startConnection("ottermart");


$sql = "SELECT * FROM om_admin WHERE username =:username ";

$parameters = array();
$parameters[":username"]=$_GET["username"];

$stmt = $dbConn->prepare($sql);
$stmt->execute($parameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

// print_r($record);
echo json_encode($record);

?>