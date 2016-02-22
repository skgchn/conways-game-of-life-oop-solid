<?php

class EdgesWrappedBoard extends Board {
    public function numNeighboursOfCell(CellLocation $loc) {
        $row = $loc->getRow();
        $col = $loc->getColumn();
        //echo "this cell: $row, $col\n";
        $numRows = $this->dimension->getNumRows();
        $numCols = $this->dimension->getNumCols();
        $numNeighbours = 0;
        foreach ($this->neighbourOffsets as $offset) {
            $neighbourRow = $row + $offset[0];
            $neighbourCol = $col + $offset[1];
            //echo "neigbour before adjustment: $neighbourRow, $neighbourCol\n";
            $neighbourRow = $this->adjustForWrappedEdges($neighbourRow, $numRows);
            $neighbourCol = $this->adjustForWrappedEdges($neighbourCol, $numCols);
            //echo "neigbour after adjustment: $neighbourRow, $neighbourCol\n";
            if (!empty($this->activeCells[$neighbourRow][$neighbourCol])) {
                $numNeighbours += 1;
            }
        }
        //echo "num neighbours = $numNeighbours\n";
        //echo "\n";
        
        return $numNeighbours;
    }
    
    private function adjustForWrappedEdges($value, $upperBound) {
        if ($value == $upperBound) {
            $value = 0;
        }
        else if ($value == -1) {
            $value = $upperBound - 1;
        }

        return $value;
    }
}
