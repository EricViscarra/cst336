<?php
    class Card {
        
        private $suit = null;
        private $value = null;
        
        public function __construct($suit, $value) {
            $this->suit = $suit;
            $this->value = $value;
        }
        
        //Getters
        public function getVal() {
            // Arguments: None
            // Abstract: Returns the numerical value of the card
            return $this->value;
        }
        
        public function getSuit() {
            // Arguments: None
            // Abstract: Returns the suit name of the card
            return $this->suit;
        }
        
        public function displayCard() {
            // Arguments: None
            // Abstract: displays the image of the card in a div called "displayCard"
            echo "
                <div id='displayCard' style='display: inline'>
                    <img src='imgs/".$this->suit."/".$this->value.".png' border= \"6\" style= \"border-color: #504C4D\" alt='The ".$this->value." of ".$this->suit."' />
                    </div>
                  
                    ";
        }
    }
?>