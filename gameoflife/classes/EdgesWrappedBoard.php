<?php

class EdgesWrappedBoard extends Board {
    public function isActiveCell(CellLocation $loc) {
        $row = $loc->getRow();
        $col = $loc->getColumn();
        $dimension = $this->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        
        $adjustedRow = $this->adjustForWrappedEdges($row, $numRows);
        $adjustedCol = $this->adjustForWrappedEdges($col, $numCols);
        
        return parent::isActiveCell(new CellLocation($adjustedRow, $adjustedCol));
    }
    
    private function adjustForWrappedEdges($value, $upperBound) {
        if ($value >= $upperBound) {
            while ($value >= $upperBound) {
                $value -= $upperBound;
            }
        }
        else if ($value < 0) {
            while ($value < 0) {
                $value += $upperBound;
            }
        }
        return $value;
    }
}
