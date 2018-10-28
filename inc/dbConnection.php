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
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 


    $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
}
?>