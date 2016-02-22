<?php

class CellLocation {
    private $row;
    private $col;
    
    public function __construct($row, $col) {
        $this->row = $row;
        $this->col = $col;
    }
    
    public function getRow() {
        return $this->row;
    }
    
    public function getColumn() {
        return $this->col;
    }
}
