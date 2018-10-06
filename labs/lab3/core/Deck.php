<?php

  include "Card.php";
  
    class Deck {
        
        private $cards = array();
        
        public function __construct() {
            for ($i = 0; $i < 52; $i++) {
                if ($i < 13) {
                    $this->cards[] = new Card("clubs", ($i%13)+1);
                }
                else if ($i < 26) {
                    $this->cards[] = new Card("diamonds", ($i%13)+1);
                }
                else if ($i < 39) {
                    $this->cards[] = new Card("hearts", ($i%13)+1);
                }
                else {
                    $this->cards[] = new Card("spades", ($i%13)+1);
                }
            }
            
            $this->shuffleDeck();
        }
        
        public function size() {
            return count($this->cards);
        }
        
        public function shuffleDeck() {
            // Arguments: None
            // Abstract: Shuffles the deck
            shuffle($this->cards);
        }
        
        public function hit() {
            // Arguments: None
            // Abstract: Deletes and returns the card at the top of the deck
            return array_pop($this->cards);
        }
        
        public function displayRemainingCards() {
            // Arguments: None
            // Abstract: Displays all the cards left in the deck
            for ($i = 0; $i < count($cards); $i++) {
                $this->cards[$i]->displayCard();
            }
        }
    }  
?>