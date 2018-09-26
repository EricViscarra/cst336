<?php

include 'inc/charts.php';
$posters = array("ready_player_one","rampage","paddington_2","hereditary","alpha","black_panther","christopher_robin","coco","dunkirk","first_man");
$newP= array();
function movieReviews() {
    global $posters;
    global $newP;
    $randomPoster = array_pop($newP);
    $posterName = str_replace('_', ' ', $randomPoster);
    echo "<div class='poster'>";
    echo "<h2> ".ucwords($posterName)." </h2>";
    echo "<img width='100' src='img/posters/$randomPoster.jpg'>";    
    echo "<br>";
    
    //NOTE: $totalReviews must be a random number between 100 and 300
    $totalReviews = rand(100,300); 
    
    //NOTE: $ratings is an array of 1-star, 2-star, 3-star, and 4-star rating percentages
    //      The sum of rating percentages MUST be 100
    
    $four_star  = rand(0,100);
    $three_star = rand(0,(100-$four_star));
    $two_star = rand(0,(100-$four_star -$three_star));
    $one_star = 100-$four_star- $three_star-$two_star;
    $ratings = array($one_star,$two_star,$three_star,$four_star);
    
    //NOTE: displayRatings() displays the ratings bar chart and
    //      returns the overall average rating
    $overallRating = displayRatings($totalReviews,$ratings);
    
    //NOTE: The number of stars should be the rounded value of $overallRating
    $star= round($overallRating,0);
    echo $star;
    echo "<br>";
    for($i=0; $i<$star; $i++){   
        echo "<img src='img/star.png' width='25'>";
    }
    
    echo "<br>Total reviews: $totalReviews";
    echo "</div>";
}    
function makeRan() {
    global $newP;
    global $posters;
    shuffle($posters);
    for($i=0; $i<4; $i++){
        $randomPoster = array_pop($posters);
        $newP[] = $randomPoster;
    }
    rsort($newP);
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Movie Reviews </title>
        <style type="text/css">
            body {
                background-image: url("img/bg.jpg");
                color: white;
                text-align:center;
            }
            #main {
                background: rgba(100,100,100,.7);
                display:flex;
                justify-content: center;
            }
            .poster {
                padding: 0 10px;
            }
        </style>
    </head>
    <body>
       
       <h1> Movie Reviews </h1>
        <div id="main">
           <?php
           makeRan();
             //NOTE: Add for loop to display 4 movie reviews
             for ($i= 0; $i<4; $i++ ){
                movieReviews(); 
             }
             
           ?>
       </div>
       <br/>
       <hr>
       <h1>Based on ratings you should watch:</h1>
    </body>
</html>