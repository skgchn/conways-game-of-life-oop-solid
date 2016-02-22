<?php

class BoardDimension {
    private $numRows;
    private $numCols;
    
    public function __construct($numRows, $numCols) {
        $this->numRows = $numRows;
        $this->numCols = $numCols;
    }
    
    public function getNumRows() {
        return $this->numRows;
    }
    
    public function getNumCols() {
        return $this->numCols;
    }
}
