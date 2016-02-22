<?php

class Test1BoardInitializer implements BoardInitializer {
    public function initialize(Board $board) {
        $dimension = $board->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        
        if ($numRows >= 3 && $numCols >= 3) {
            $board->addActiveCell(new CellLocation(1, 0));
            $board->addActiveCell(new CellLocation(1, 1));
            $board->addActiveCell(new CellLocation(1, 2));
        }
        else {
            echo "Error: Test1BoardInitializer: Insufficient rows or columns\n\n";
            die();
        }
    }
}
