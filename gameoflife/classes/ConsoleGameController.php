<?php

class ConsoleGameController extends GameController {
    public function __construct($boardType, BoardInitializer $boardInitializer, BoardPersister $boardPersister) {
        $gameRenderer = new ConsoleGameRenderer();
        $boardRenderer = new ConsoleBoardRenderer();
        $cellRenderer = new ConsoleCellRenderer();        
        parent::__construct($boardType, $gameRenderer, $boardRenderer, $cellRenderer, $boardInitializer, $boardPersister);
    }
    
    public function newGame(BoardDimension $dimension) {
        parent::newGame($dimension);
        $this->renderGame();
    }
    
    public function advanceGame() {
        parent::advanceGame();
        $this->renderGame();
    }
    
    public function persistGame() {
        parent::persistGame();
    }
    
    public function run() {
        
    }
}
