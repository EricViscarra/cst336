<?php

    class Coords {
        private $row;
        private $column;
        private $lateral;
        private $vertical;
        
        public function __construct($num) {
            $this->row = floor($num/3);
            $this->column = $num%3;
            $this->lateral = 700+(($num%3)*205);
            $this->vertical = 530;
            $num = floor($num/3);
            while ($num > 0) {
                $this->vertical +=145;
                $num--;
            }
        }
        
        public function getRow() {
            return $this->row;
        }
        public function getColumn() {
            return $this->column;
        }
        public function getLateral() {
            return $this->lateral;
        }
        public function getVertical() {
            return $this->vertical;
        }
    }
    ?>