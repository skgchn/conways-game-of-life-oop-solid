<?php

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

$boardType = 'BoundedBoard';
$boardInitializer = new RandomBoardInitializer();
$boardPersister = new FileBoardPersister();

$gameController = new HTMLGameController($boardType, $boardInitializer, $boardPersister);

if (!$gameController->loadGame()) {
    $newBoardDimension = new BoardDimension(5, 5);
    $gameController->newGame($newBoardDimension);
}
//print_r($_GET);
if (!empty($_GET['q'])) {
    if ($_GET['q'] == 'advance') {
        $gameController->advanceGame();
    }
    elseif ($_GET['q'] == 'newgame') {
        $newBoardDimension = new BoardDimension($_GET['r'], $_GET['c']);
        $gameController->newGame($newBoardDimension);
    }
}
$gameController->renderGame();