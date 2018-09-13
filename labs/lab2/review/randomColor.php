<?php
function getLuckyNumber() {
    do {
       $lucky = rand(1,10);
    } while ($lucky == 4);
    echo $lucky;
}
function getRandomColor() {
     echo "rgba(".rand(0,255).",".rand(0,255).",".rand(0,255).",".(rand(0,10)/10).");";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Random Colors & Numbers
        </title>
        
        <style>
            
            body {
                
                <?php
                
                    echo "background-color:".getRandomColor()."";
                
                ?>
                
            }
            
            h1 {
                
                <?php
                
                    echo "background-color: ".getRandomColor()."";
                    echo "color: ".getRandomColor()."";
                
                ?>
                
            }
            
        </style>
        
    </head>
    <body>
        <h1>
        
        My lucky number is:
        <?php
        
            getLuckyNumber();
        
        ?>
        
        </h1>
    </body>
    
</html>