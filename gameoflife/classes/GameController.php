<?php

abstract class GameController {
    private $board;
    private $boardRenderer;
    private $cellRenderer;
    private $boardPersister;
    private $boardType; // Value same as class name of a specialization of Board generalization
    private $gameRenderer;
    private $gameAdvancer;
    
    public function __construct($boardType, GameRenderer $gameRenderer, BoardRenderer $boardRenderer, CellRenderer $cellRenderer,
                                      BoardInitializer $boardInitializer, BoardPersister $boardPersister, GameAdvancer $gameAdvancer) {
        $this->boardType = $boardType;
        $this->gameRenderer = $gameRenderer;
        $this->boardRenderer = $boardRenderer;
        $this->cellRenderer = $cellRenderer;
        $this->boardInitializer = $boardInitializer;
        $this->boardPersister = $boardPersister;
        $this->gameAdvancer = $gameAdvancer;
    }
    
    protected function newGame(BoardDimension $dimension) {
        $this->board = new $this->boardType($dimension);
        $this->boardInitializer->initialize($this->board);
    }
    
    protected function loadGame() {
        return($this->board = $this->boardPersister->retrieve());
    }
    
    protected function advanceGame() {
        $this->board = $this->gameAdvancer->nextGen($this->board, $this->boardType);
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
}
