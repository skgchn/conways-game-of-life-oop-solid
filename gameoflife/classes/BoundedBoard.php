<?php

class BoundedBoard extends Board {
   public function numNeighboursOfCell(CellLocation $loc) {
        $row = $loc->getRow();
        $col = $loc->getColumn();
        //echo "cellloc = $row, $col\n";
        $numRows = $this->dimension->getNumRows();
        $numCols = $this->dimension->getNumCols();
        $numNeighbours = 0;
        foreach ($this->neighbourOffsets as $offset) {
            $neighbourRow = $row + $offset[0];
            $neighbourCol = $col + $offset[1];
            //echo "neighbour = $neighbourRow, $neighbourCol\n";
            if ($neighbourRow < $numRows && $neighbourCol < $numCols &&
                    $neighbourRow >= 0 && $neighbourCol >= 0 &&
                        !empty($this->activeCells[$neighbourRow][$neighbourCol])) {
                $numNeighbours += 1;
            }
        }
        
        return $numNeighbours;
    }
}
