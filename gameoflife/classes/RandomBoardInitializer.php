<?php

class RandomBoardInitializer implements BoardInitializer {
    public function initialize(Board $board) {
        $dimension = $board->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        for ($row = 0; $row < $numRows; $row++) {
            for ($col = 0; $col < $numCols; $col++) {
                if (1 == mt_rand(0, 1)) {
                    $board->addActiveCell(new CellLocation($row, $col));
                }
            }
        }
    }
}
