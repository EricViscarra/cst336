<?php
 include 'Coords.php';
    class Game {
        
        private $board;
        private $posLeft = array(0,1,2,3,4,5,6,7,8);
        private $used = array();
                        
        public function __construct() {
             $this->board = array(
                        array(0,0,0), //0 = 00. 1 = 01, 2 = 02
                        array(0,0,0), //3 = 10, 4 = 11, 5 = 12
                        array(0,0,0));//6 = 20, 7 = 21, 8 = 22
        }
                        
        public function getBoard() {
            return $this->board;
        }
        
        public function getPosLeft() {
            return $this->posLeft;
        }
        
        public function getUsed() {
            return $this->used;
        }
        
        public function setPosLeft($updated) {
            $this->posLeft = $updated;
        }
        
        public function setUsed($updated) {
            $this->used = $updated;
        }
        
        public function playerTurn($row, $column) {
            $this->board[$row][$column] = 1;
        }
        
        public function isValid($row, $column) {
            if ($this->board[$row][$column] == 0) {
                return true;
            }
            else {
                return false;
            }
        }
        
        public function compTurn() {
            shuffle($this->posLeft);
            $cSquare = new Coords(array_pop($this->posLeft));
            $this->board[$cSquare->getRow()][$cSquare->getColumn()] = 2;
            $this->used[] = $cSquare;
        }
        
        public function display() {
            for ($i=0;$i<count($this->used);$i++) {
                $temp = $this->used[$i];
                if ($this->board[$temp->getRow()][$temp->getColumn()] == 1) {
                    echo "
                        <div id='marks' style='left:".$temp->getLateral()."px; top:".$temp->getVertical()."px; position:absolute;'>
                            <img src='img/X.png' alt='X' />
                        </div>
                        ";
                }
                else if ($this->board[$temp->getRow()][$temp->getColumn()] == 2) {
                    echo "
                        <div id='marks' style='left:".$temp->getLateral()."px; top:".$temp->getVertical()."px; position:absolute;'>
                            <img src='img/O.png' alt='O' />
                        </div>
                        ";
                }
            }
        }
        
        public function checkWinner() {
            for ($i=0;$i<3;$i++) { //Checks all row win cases
                if ($this->board[$i][0] == $this->board[$i][1] && $this->board[$i][1] == $this->board[$i][2]) {
                    if ($this->board[$i][0] == 1) {
                        $_SESSION["result"] = "win";
                        return true;
                    }
                    else if ($this->board[$i][0] == 2) {
                        $_SESSION["result"] = "lose";
                        return true;
                    }
                }
            }
            for ($i=0;$i<3;$i++) { //Checks all col win cases
                if ($this->board[0][$i] == $this->board[1][$i] && $this->board[1][$i] == $this->board[2][$i]) {
                    if ($this->board[0][$i] == 1) {
                        $_SESSION["result"] = "win";
                        return true;
                    }
                    else if ($this->board[0][$i] == 2) {
                        $_SESSION["result"] = "lose";
                        return true;
                    }
                }
            }
            if ($this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2]) { //checks one diag
                if ($this->board[1][1] == 1) {
                    $_SESSION["result"] = "win";
                    return true;
                }
                else if ($this->board[1][1] == 2) {
                    $_SESSION["result"] = "lose";
                    return true;
                }
            }
            else if ($this->board[2][0] == $this->board[1][1] && $this->board[1][1] == $this->board[0][2]) { //checks other diag
                if ($this->board[1][1] == 1) {
                    $_SESSION["result"] = "win";
                    return true;
                }
                else if ($this->board[1][1] == 2) {
                    $_SESSION["result"] = "lose";
                    return true;
                }        
            }
            return false;
        }
        public function forceEnd() {
            if (!$this->checkWinner()) {
                $_SESSION["result"] = "tie";
            }
        }
    }
    
    function play($num) {
        if (strcmp($_SESSION["saved"], "yes") == 0) {
            $playing = $_SESSION["game"];
        }
        if (!isset($playing)) {
            $playing = new Game();
        }
        $square = new Coords($num);
        if ($playing->isValid($square->getRow(),$square->getColumn())) {
            $playing->playerTurn($square->getRow(),$square->getColumn());
            $temp1 = $playing->getPosLeft();
            $index = array_search("$num",$playing->getPosLeft());
            unset($temp1[$index]);
            $playing->setPosLeft($temp1);
            //$playing->setPosLeft(unset($playing->getPosLeft()[array_search("$num",$playing->getPosLeft())]));
            $temp2 = $playing->getUsed();
            $temp2[] = $square;
            $playing->setUsed($temp2);
            if (!$playing->checkWinner()) {
                if (count($playing->getPosLeft()) > 0) {
                    $playing->compTurn();
                }
                else {
                    $_SESSION["end"] = "yes";
                }
            }
            $playing->display();
            $_SESSION["game"] = $playing;
            $_SESSION["saved"] = "yes";
            $playing->checkWinner();
            return true;
        }
        else {
            $playing->display();
            return false;
        }
    }
?>