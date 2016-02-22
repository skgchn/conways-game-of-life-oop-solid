<?php

class ConsoleBoardRenderer implements BoardRenderer {
    public function render(Board $board, CellRenderer $cellRenderer) {
        $dimension = $board->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        echo "\n\n";
        for ($i = 0; $i < $numRows; $i++) {
            for ($j = 0; $j < $numCols; $j++) {
                if ($board->isActiveCell(new CellLocation($i, $j))) {
                    $cellRenderer->renderLiveCell();
                }
                else {
                    $cellRenderer->renderDeadCell();
                }
            }
            echo "\n";
        }
    }
}