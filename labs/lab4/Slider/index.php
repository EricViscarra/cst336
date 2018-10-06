<?php

$backgroundImage = "img/sea.jpg";

if (isset($_GET['keyword'])) {
    include 'api/pixabayAPI.php';
    $keyword = $_GET['keyword'];
    if (!empty($_GET['category'])) {
      $keyword = $_GET['category'];
    }
    $layout = $_GET['layout'];
    $imageURLs = getImageURLs($keyword, $layout);
    shuffle($imageURLs);
    $backgroundImage = $imageURLs[array_rand($imageURLs)];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Lab 4: Pixabay Slideshow </title>
        <link rel= "stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
        <link rel= "stylesheet" href="css/styles.css" type="text/css" />
        <style>
        
            body {
                background-image: url(<?=$backgroundImage?>);
                background-size: cover;
            }
            #carouselExampleIndicators {
              width: 500px;
              margin: 0 auto;
            }
            
        </style>
    </head>     
    <body>
          <br />
            <form method "GET">
            <input type="text" name="keyword" size="15" placeholder="Keyword" />    
            <div id="orientation">
              <input type="radio" name="layout" value="horizontal"> Horizontal
              <br />
              <input type="radio" name="layout" value="vertical"> Vertical
            </div>
            <br />
            <select name="category">
              <div id="select">
              <option value="">Select One</option>
              <option value="ocean">Sea</option>
              <option value="mountains">Mountains</option>
              <option value="forest">Forest</option>
              <option value="sky">Sky</option>
              </div>
            </select>
                <input type="submit" name="submitBtn" value="Submit!" />
            </form>
            <br />
            <br />
            <?php
              if ( $_GET['keyword'] == '' && $_GET['category'] == '') {
                echo "<h2> You must type a keyword or select a category </h2>";
              }
              
              else {
                if (isset($imageURLs)) { ?>
        
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <?php
                      for ($i=1; $i < 7; $i++) {
                          echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
                      }
                      ?>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="<?=$imageURLs[0]?>" alt="First slide">
                      </div>
                      <?php
                        for ($i = 1; $i < 7; $i++) {
                          do {
                            $randomIndex = array_rand($imageURLs);
                          } while (!isset($imageURLs[$randomIndex]));
                          echo "<div class='carousel-item'>";
                          echo "<img class=\"d-block w-100\" src=\"".$imageURLs[$randomIndex]."\" alt=\"Second slide\">";
                          echo "</div>";
                          unset($imageURLs[$randomIndex]);
                        }
                      ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                
                <?php
                }
                else {
                  echo "<h1>Enter a Keyword or Select a Cetegory!</h1>";
                }
              }
                ?>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>