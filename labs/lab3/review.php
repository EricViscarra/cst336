<?php

    function displayArray() {
        global $symbols;
        echo "<hr>";
        print_r($symbols);
        
        for ($i=0; $i < count($symbols); $i++) {
            echo $symbols[$i] . ", ";
        }
    }
    
    $symbols = array("seven");
    //print_r($symbols); //displays array content
    
    array_push($symbols,"orange", "grapes");
    //print_r($symbols);
    
    $symbols[] = "cherry";
    //print_r($symbols);
    //displayArray();
    sort($symbols);
    //displayArray();
    rsort($symbols);
    //displayArray();
    
    unset($symbols[2]);
    //displayArray();
    
    $symbols = array_values($symbols);  //re-indexes the array
    //displayArray();
    
    shuffle($symbols);
    //displayArray();
    
    //echo "Random Item: ".$symbols[rand(0, count($symbols)-1)];
    
    //echo " Random item: ".$symbols[array_rand($symbols)];
    
    $indexes = array();
    
    for ($i = 0; $i < 3; $i++) {
        $indexes[] = $symbols[array_rand($symbols)];
        echo "<img src='../lab2/img/". $indexes[$i].".png' />";
    }
    
    echo "<hr>";
    print_r($indexes);
    if ($indexes[0] == $indexes[1] && $indexes[1] == $indexes[2]) {
        echo "Congrats!";
    }
?>





<!DOCTYPE html>
<html>
    <head>
        <title> Review:Arrays </title>
    </head>
    <body>

    </body>
</html>