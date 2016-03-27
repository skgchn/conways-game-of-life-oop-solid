<?php

class BoundedBoard extends Board {
    public function isActiveCell(CellLocation $loc) {
        $row = $loc->getRow();
        $col = $loc->getColumn();       
        $dimension = $this->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        
        if ($row < 0 || $col < 0 || $row >= $numRows || $col >= $numCols) {
            return false;
        }
        
        return parent::isActiveCell($loc);
    }
}
