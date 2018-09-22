<!DOCTYPE html>
<html>
<?php

function generate() {
    $player_1 = rand(0, 2);
    $player_2 = rand(0, 2);
    do {
        $player_2 = rand(0, 2);
    } while ($player_1 == $player_2);
    switch ($player_1) {
        case 0: $symbol1 = "rock";
            break;
        case 1: $symbol1 ="paper";
            break;
        case 2: $symbol1 = "scissors";
                break;
    }
    switch ($player_2) {
        case 0: $symbol2 = "rock";
            break;
        case 1: $symbol2 = "paper";
            break;
        case 2: $symbol2 = "scissors";
             break;
    }
    $game = array();
    array_push($game, $symbol1, $symbol2);
    return $game;
}
$count = 0;

function checkWinner($game, &$count) {
    $winner = array();
    if ($game[0] == "rock" && $game[1] == "scissors") {
        ++$count;
        array_push($winner, ", matchWinner'", "'");
    } 
    else if ($game[0] == "paper" && $game[1] == "rock") {
        ++$count;
        array_push($winner, ", matchWinner'", "'");
    } 
    else if ($game[0] == "scissors" && $game[1] == "paper") {
        ++$count;
        array_push($winner, ", matchWinner'", "'");
    } 
    else if ($game[1] == "rock" && $game[0] == "scissors") {
        array_push($winner, "'", ", matchWinner'");
    } 
    else if ($game[1] == "paper" && $game[0] == "rock") {
        array_push($winner, "'", ", matchWinner'");
    } 
    else if ($game[1] == "scissors" && $game[0] == "paper") {
        array_push($winner, "'", ", matchWinner'");
    } 
    return $winner;
}


?>
<head>
    <title> RPS </title>
    <style type="text/css">
        body {
            background-color: black;
            color: white;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col {
            text-align: center;
            margin: 0 70px;
        }

        .matchWinner {
            background-color: yellow;
            margin: 0 70px;
        }

        #finalWinner {
            margin: 0 auto;
            width: 500px;
            text-align: center;
        }
        
        hr {
            width:33%;
        }        
    </style>
</head>

<body>

    <h1> Rock, Paper, Scissors </h1>
    <h2> by: Jeremy Shaw, Eric Orozco Viscarra</h2>
    <div class="row">
        <div class="col">
            <h2>Player 1</h2>
        </div>
        <div class="col">
            <h2>Player 2</h2>
        </div>
    </div>
    
    <div class="row">
<?php   
        $game = generate();
        $winner = checkWinner($game, $count);
        echo "<div class='col".$winner[0]."><img src='img/".$game[0].".png' alt='".$game[0]."' width='150'></div>"; 
        echo "<div class='col".$winner[1]."><img src='img/".$game[1].".png' alt='".$game[1]."' width='150'></div>"; ?>
    </div>
    <hr>

    <div class="row">
<?php   
        $game = generate();
        $winner = checkWinner($game, $count);
        echo "<div class='col".$winner[0]."><img src='img/".$game[0].".png' alt='".$game[0]."' width='150'></div>"; 
        echo "<div class='col".$winner[1]."><img src='img/".$game[1].".png' alt='".$game[1]."' width='150'></div>"; ?>
    </div>
    <hr>
    
    <div class="row">
<?php   
        $game = generate();
        $winner = checkWinner($game, $count);
        echo "<div class='col".$winner[0]."><img src='img/".$game[0].".png' alt='".$game[0]."' width='150'></div>"; 
        echo "<div class='col".$winner[1]."><img src='img/".$game[1].".png' alt='".$game[1]."' width='150'></div>"; ?>
    </div>
    <hr>

    <div id="finalWinner">

<?php       
        $player = "1";
        if ($count < 2) {
            $player = "2";
        }
        echo "<h1>The winner is Player ".$player."</h1>"; ?>

    </div>
    Images source: https://www.kisspng.com/png-rockpaperscissors-game-money-4410819/
</body>

</html>
