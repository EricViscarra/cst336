<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
    </head>
    <body>
        
        <?php
        
        function displaySymbol($random_value) {
        
            //$random_value = rand(0,2); //Generates a random number from 0 to 2 inclusive
           /* 
            if ($random_value == 0) {
                
                $symbol = "seven";
            }
            else if ($random_value == 1) {
                
                $symbol = "orange";
            }
            else {
                
                $symbol = "cherry";
            }
            */
            switch($random_value) {
                
                case 0: $symbol = "seven";
                        break;
                case 1: $symbol = "orange";
                        break;
                case 2: $symbol = "cherry";
                        break;
                        
            }
        
            echo "<img src='img/$symbol.png' alt='$symbol' title='".ucfirst($symbol)."'/>";
                    
        } //displaySymbol()
        
        function displayPoints($num1, $num2, $num3) {
            
            echo "<div id='output'>";
            if ($num1 == $num2 && $num2 == $num3) {
                switch ($num1) {
                    case 0: $totalPoints = 1000;
                            echo "<h1>Jackpot!</h1>";
                                    break;
                    case 1: $totalPoints = 500;
                            break;
                    case 2: $totalPoints = 250;
                            break;
                }
                
                echo "<h2> You won $totalPoints points!</h2>";
            }
            
            else {
                echo "<h3> Try Again! </h3>";
            }
            
            echo "</div>";
        } //displayPoints()
        $random_value1 = rand (0,2);
        displaySymbol($random_value1);
        $random_value2 = rand(0,2);
        displaySymbol($random_value2);
        $random_value3 = rand(0,2);
        displaySymbol($random_value3);
        
        echo "<br>Random value 1: $random_value1 <br />";
        echo "Random value 2: $random_value2 <br />";
        echo "Random value 3: $random_value3 <br />";
        
        displayPoints($random_value1, $random_value2, $random_value3);
        
        ?>
        
    </body>
</html>