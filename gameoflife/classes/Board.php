<?php

abstract class Board {
    private $dimension;
    private $activeCells;

    public function __construct(BoardDimension $dimension) {
        $this->dimension = $dimension;
    }
    
    public function getDimension() {
        return $this->dimension;
    }
    
    public function addActiveCell(CellLocation $loc) {
        $this->activeCells[$loc->getRow()][$loc->getColumn()] = true;
    }
    
    public function isActiveCell(CellLocation $loc) {
        if (!empty($this->activeCells[$loc->getRow()][$loc->getColumn()])) {
            return true;
        }
        
        return false;
    }
}
