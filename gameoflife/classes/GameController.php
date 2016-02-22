<?php

abstract class GameController {
    private $board;
    private $boardRenderer;
    private $cellRenderer;
    private $boardPersister;
    private $boardType; // Value same as class name of a specialization of Board generalization
    private $gameRenderer;
    
    public function __construct($boardType, GameRenderer $gameRenderer, BoardRenderer $boardRenderer, CellRenderer $cellRenderer,
                                      BoardInitializer $boardInitializer, BoardPersister $boardPersister) {
        $this->boardType = $boardType;
        $this->gameRenderer = $gameRenderer;
        $this->boardRenderer = $boardRenderer;
        $this->cellRenderer = $cellRenderer;
        $this->boardInitializer = $boardInitializer;
        $this->boardPersister = $boardPersister;
    }
    
    protected function newGame(BoardDimension $dimension) {
        $this->board = new $this->boardType($dimension);
        $this->boardInitializer->initialize($this->board);
    }
    
    protected function loadGame() {
        return($this->board = $this->boardPersister->retrieve());
    }
    
    protected function advanceGame() {
        $this->board = $this->nextGen();
    }
    
    protected function renderGame() {
        $this->gameRenderer->render($this->board, $this->boardRenderer, $this->cellRenderer);
    }
    
    protected function persistGame() {
        $this->boardPersister->store($this->board);
    }
    
    abstract public function run();
    
    protected function getSuperGlobal($name, $superGlobal) {
        
    }
    
    private function nextGen() {
        $boardDimension = $this->board->getDimension();
        $numRows = $boardDimension->getNumRows();
        $numCols = $boardDimension->getNumCols();
        $newBoard = new $this->boardType($boardDimension);
        for ($row = 0; $row < $numRows; $row++) {
            for ($col = 0; $col < $numCols; $col++) {
                $cellLocation = new CellLocation($row, $col);
                $numNeighbours = $this->board->numNeighboursOfCell($cellLocation);
                if (($numNeighbours == 3) ||
                        $this->board->isActiveCell($cellLocation) && ($numNeighbours == 2)) {
                    $newBoard->addActiveCell($cellLocation);
                }
            }
        }
        
        return $newBoard;
    }
}
