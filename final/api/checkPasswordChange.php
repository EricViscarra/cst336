<?php
header('Access-Control-Allow-Origin: *');
include '../../cst336/inc/dbConnection.php';
$dbConn = startConnection("final");


$sql = "SELECT daysLeftPwdChange FROM fe_login WHERE username =:username ";

$parameters = array();
$parameters[":username"]=$_GET["username"];

$stmt = $dbConn->prepare($sql);
$stmt->execute($parameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($record);

?>