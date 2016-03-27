<?php

abstract class GameController {
    private $board;
    private $boardRenderer;
    private $cellRenderer;
    private $boardPersister;
    private $boardType; // Value same as class name of a specialization of Board generalization
    private $gameRenderer;
    private $gameAdvancer;
    
    public function __construct(GameRenderer $gameRenderer,
                                  BoardRenderer $boardRenderer,
                                    CellRenderer $cellRenderer) {
        $this->gameRenderer = $gameRenderer;
        $this->boardRenderer = $boardRenderer;
        $this->cellRenderer = $cellRenderer;
        
        $this->boardType = 'EdgesWrappedBoard';
        $this->boardInitializer = new RandomBoardInitializer();
        $this->boardPersister = new FileBoardPersister();
        $this->gameAdvancer = new LegacyGameAdvancer();
    }
    
    public function newGame(BoardDimension $dimension) {
        $this->board = new $this->boardType($dimension);
        $this->boardInitializer->initialize($this->board);
        $this->persistGame();
        $this->renderGame();
    }
    
    public function loadGame() {
        if (empty($this->board = $this->boardPersister->retrieve())) {
            return false;
        }
        return true;
    }
    
    public function advanceGame() {
        $this->board = $this->gameAdvancer->nextGen($this->board, $this->boardType);
        $this->persistGame();
        $this->renderGame();
    }
    
    public function renderGame() {
        $this->gameRenderer->render($this->board, $this->boardRenderer, $this->cellRenderer);
    }
    
    public function persistGame() {
        $this->boardPersister->store($this->board);
    }
    
    abstract public function run();
}
