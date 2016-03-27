<?php
class LegacyGameAdvancer implements GameAdvancer {
    private $neighbourOffsets = [
        [-1, -1], 
        [-1,  0],
        [-1,  1],
        [ 0,  1],
        [ 1,  1],
        [ 1,  0],
        [ 1, -1],
        [ 0, -1]
    ];
    
    public function nextGen(Board $board, $boardType) {
        $boardDimension = $board->getDimension();
        $numRows = $boardDimension->getNumRows();
        $numCols = $boardDimension->getNumCols();
        $newBoard = new $boardType($boardDimension);
        for ($row = 0; $row < $numRows; $row++) {
            for ($col = 0; $col < $numCols; $col++) {
                $cellLocation = new CellLocation($row, $col);
                $numNeighbours = $this->numNeighboursOfCell($cellLocation, $board);
                if (($numNeighbours == 3) ||
                        $board->isActiveCell($cellLocation) && ($numNeighbours == 2)) {
                    $newBoard->addActiveCell($cellLocation);
                }
            }
        }
        
        return $newBoard;
    }

    private function numNeighboursOfCell(CellLocation $loc, Board $board) {
        $row = $loc->getRow();
        $col = $loc->getColumn();
        $numNeighbours = 0;
        foreach ($this->neighbourOffsets as $offset) {
            $neighbourRow = $row + $offset[0];
            $neighbourCol = $col + $offset[1];
            if ($board->isActiveCell(new CellLocation($neighbourRow, $neighbourCol))) {
                $numNeighbours += 1;
            }
        }
        return $numNeighbours;
    }
}
