<?php

class HTMLGameController extends GameController {

    public function __construct() {
        $gameRenderer = new HTMLGameRenderer();
        $boardRenderer = new HTMLBoardRenderer();
        $cellRenderer = new HTMLCellRenderer();
        parent::__construct($gameRenderer, $boardRenderer, $cellRenderer);
    }

    public function run() {
        //print_r($_GET);
        if ((!empty($_GET['q'])) && ($_GET['q'] == 'newgame')) {
            $this->newGame(new BoardDimension($_GET['r'], $_GET['c']));
        } else {
            if (!$this->loadGame()) {
                $this->newGame(new BoardDimension(5, 5)); // Should instead inform user to start a new game
            } else if ((!empty($_GET['q'])) && ($_GET['q'] == 'advance')) {
                $this->advanceGame();
            } else {
                $this->renderGame();
            }
        }
    }
}
