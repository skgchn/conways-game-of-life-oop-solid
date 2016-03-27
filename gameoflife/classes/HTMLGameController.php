<?php

class HTMLGameController extends GameController {
    public function __construct($boardType, BoardInitializer $boardInitializer, BoardPersister $boardPersister, GameAdvancer $gameAdvancer) {
        $gameRenderer = new HTMLGameRenderer();
        $boardRenderer = new HTMLBoardRenderer();
        $cellRenderer = new HTMLCellRenderer();       
        parent::__construct($boardType, $gameRenderer, $boardRenderer, $cellRenderer, $boardInitializer, $boardPersister, $gameAdvancer);
    }
    
    public function newGame(BoardDimension $dimension) {
        parent::newGame($dimension);
            $this->persistGame();
    }
    
    public function advanceGame() {
        parent::advanceGame();
        $this->persistGame();
    }
    
    public function renderGame() {
        parent::renderGame();
    }
    
    public function loadGame() {
        if (empty(parent::loadGame())) {
            return false;
        }
        return true;
    }
    
    public function run() {
        
    }
}
