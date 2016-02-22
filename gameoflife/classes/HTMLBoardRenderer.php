<?php

class HTMLBoardRenderer implements BoardRenderer {
    public function render(Board $board, CellRenderer $cellRenderer) {
        $dimension = $board->getDimension();
        $numRows = $dimension->getNumRows();
        $numCols = $dimension->getNumCols();
        
        $this->renderHTMLTableStart();
        for ($i = 0; $i < $numRows; $i++) {
            $this->renderHTMLTableRowStart();
            for ($j = 0; $j < $numCols; $j++) {
                $this->renderHTMLTableCellStart();
                if ($board->isActiveCell(new CellLocation($i, $j))) {
                    $cellRenderer->renderLiveCell();
                }
                else {
                    $cellRenderer->renderDeadCell();
                }
                $this->renderHTMLTableCellEnd();
            }
            $this->renderHTMLTableRowEnd();
        }
        $this->renderHTMLTableEnd();
    }
    
    private function renderHTMLTableStart() {
        ob_start(); ?>
            <style>
                table {
                    border: 2px solid red;
                    border-collapse: collapse;
                }
                table td {
                    border: 1px solid green;
                }
             </style>
            <table>
        <?php echo ob_get_clean();
    }
    
    private function renderHTMLTableEnd() {
        ob_start(); ?>
            </table>
        <?php echo ob_get_clean();
    }
    
    private function renderHTMLTableRowStart() {
        ob_start(); ?>
            <tr>
        <?php echo ob_get_clean();
    }
    
    private function renderHTMLTableRowEnd() {
        ob_start(); ?>
            </tr>
        <?php echo ob_get_clean();        
    }
    
        private function renderHTMLTableCellStart() {
        ob_start(); ?>
            <td>
        <?php echo ob_get_clean();        
    }
    
    private function renderHTMLTableCellEnd() {
        ob_start(); ?>
            </td>
        <?php echo ob_get_clean();
    }
}
