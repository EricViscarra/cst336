<?php

include "Player.php";
include "Deck.php";

class Game {
    private $players;
    private $deck;
    private $timeElapsed;
    private $totalScore;
    private $totalRounds;
    
    private $winners = array();
    private $playerNames = array("Jeremy", "Andy", "Elizabeth", "Eric");
    private $playerImages = array("imgs/p1.png", "imgs/p2.png", "imgs/p3.png", "imgs/p4.png");
    
    
    public function __construct() {
        session_start();
        shuffle($this->playerNames);
        shuffle($this->playerImages);
        $this->deck = new Deck();
        $this->players = array(
            new Player($this->playerNames[0], $this->playerImages[0]),
            new Player($this->playerNames[1], $this->playerImages[1]),
            new Player($this->playerNames[2], $this->playerImages[2]),
            new Player($this->playerNames[3], $this->playerImages[3])
            );
        
        $totalRounds = 0;
    }
    
    // play function
    public function play() {
        $starttime = microtime(true);
        
        $hits = array(true, true, true, true);
        
        while ($this->deck->size() > 0 && $hits[0] || $hits[1] || $hits[2] || $hits[3]) {
            if ($hits[0]) {
                $this->players[0]->addCard($this->deck->hit());
                $hits[0] = $this->players[0]->hit();
            }
            
            if ($hits[1]) {
                $this->players[1]->addCard($this->deck->hit());
                $hits[1] = $this->players[1]->hit();
            }
            
            if ($hits[2]) {
                $this->players[2]->addCard($this->deck->hit());
                $hits[2] = $this->players[2]->hit();
            }
            
            if ($hits[3]) {
                $this->players[3]->addCard($this->deck->hit());
                $hits[3] = $this->players[3]->hit();
            }
            
            $this->totalRounds++;
        }
        
        foreach ($this->players as $player) {
            $player->displayPlayer();
            $player->displayHand();
        }
        $endtime = microtime(true);
        $this->timeElapsed = $endtime - $starttime;
        $_SESSION["averageTime"] = ($_SESSION["averageTime"] + $this->timeElapsed) / 2;
        $_SESSION["averageRounds"] = ($_SESSION["averageRounds"] + $this->totalRounds) / 2;
        $this->displayWinner();
    }
    
    // determine winner
    public function winner() {
        $p0 = 42 - $this->players[0]->getScore();
        $p1 = 42 - $this->players[1]->getScore();
        $p2 = 42 - $this->players[2]->getScore();
        $p3 = 42 - $this->players[3]->getScore();
        $sum = $this->players[0]->getScore() + $this->players[1]->getScore() + 
                $this->players[2]->getScore() + $this->players[3]->getScore();

        $winner = array( $p0 < 0 ? $p0 * -100 : $p0,
                         $p1 < 0 ? $p1 * -100 : $p1,
                         $p2 < 0 ? $p2 * -100 : $p2,
                         $p3 < 0 ? $p3 * -100 : $p3);
        sort($winner);
        $playerWin;
        if ($winner[0] == $p0) {
            $playerWin = $this->players[0];
        } else if ($winner[0] == $p1) {
            $playerWin = $this->players[1];
        } else if ($winner[0] == $p2) {
            $playerWin = $this->players[2];
        } else {
            $playerWin = $this->players[3];
        }
        $winningScore = $playerWin->getScore();
        $countWon = 0;
        for ($i = 0; $i < 4; $i++) {
            if ($winningScore == $this->players[$i]->getScore()) {
                array_push($this->winners, $this->players[$i]);
                $countWon++;
            }
        }
        // $this->totalScore = 0;
        // for ($i = 1; $i < 4; ++$i) {
        //     $this->totalScore += $winner[$i];
        // }
        $this->totalScore = $sum;
        for ($i = 0; $i < $countWon; $i++) {
            $this->totalScore -= $this->winners[$i]->getScore();
        }
        $this->totalScore = abs($this->totalScore);
        return $playerWin;
    }
    
    // Display Winner
    public function displayWinner() {
        $playerWin = $this->winner();
         echo "<div id= 'displayWin'>";
         if (count($this->winners) < 2) {
            echo "<h2 id = 'winner'>" . $playerWin->getName() . " won " . $this->totalScore . " points!! </h2>";
         }
         else {
             echo "<h2 id = 'winner'>";
             for ($i = 0; $i < count($this->winners); $i++) {
                 if ($i == count($this->winners)-1) {
                    echo "and " . $this->winners[$i]->getName() . " ";
                 }
                 else {
                     echo $this->winners[$i]->getName() . " ";
                 }
             }
             echo "won " . $this->totalScore . " points!! </h2>";
         }
        echo "</div>";
        echo "<br />";
        echo "<div id= 'displayWin2'>";
        echo "<h5> Time elapsed: " . number_format($this->timeElapsed, 8) . " secs </h5>";
        echo "<h6> Rounds played: " . $this->totalRounds . "</h6>";
        echo "<h5> Average Time Elapsed: " . number_format($_SESSION["averageTime"], 8) . " secs </h5>";
        echo "<h6> Average Rounds Played: " . number_format($_SESSION["averageRounds"], 8) . "</h6>";
        echo "</div>";
        
    }

    
    
}

?>