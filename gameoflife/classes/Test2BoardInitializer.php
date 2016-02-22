<?php

class Test2BoardInitializer implements BoardInitializer {
    public function initialize(Board $board) {
        $dimension = $board->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        
        if ($numRows >= 3 && $numCols >= 3) {
            $board->addActiveCell(new CellLocation(0, 0));
            $board->addActiveCell(new CellLocation(0, 1));
            $board->addActiveCell(new CellLocation(0, 2));
        }
        else {
            echo "Error: Test2BoardInitializer: Insufficient rows or columns\n\n";
            die();
        }
    }
}
