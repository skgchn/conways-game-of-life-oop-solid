<?php

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

if (empty($options = getopt("r:c:n:t::i::")) || empty($options['r']) || empty($options['c']) || empty($options['n'])) {
    echo "Usage: php ";
    echo basename(__FILE__);
    echo " -r<num_rows> -c<num_cols> -n<num_steps> [-t<board_type>] [-i<board_initializer>\n\n";
    exit();
}
//print_r($options);
$numSteps = $options['n'];
$boardType = empty($options['t'])? 'BoundedBoard' : $options['t'];
$boardInitializer = empty($options['i'])? new RandomBoardInitializer() : new $options['i']();
$boardPersister = new FileBoardPersister();

$gameController = new ConsoleGameController($boardType, $boardInitializer, $boardPersister);

$gameController->newGame(new BoardDimension($options['r'], $options['c']));

for ($i = 0; $i < $numSteps; $i++) {
    sleep(3);
    $gameController->advanceGame();
}
$gameController->persistGame();
