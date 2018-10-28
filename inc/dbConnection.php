<?php
function startConnection($dbName = "ottermart") {
    //Creating database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    
    //when connecting from Heroku
     if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = "heroku_621330f66ea5ba3";
        $username = "bc241451b56c3b";
        $password = "bf09f02f";
    } 


    $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
}
?>