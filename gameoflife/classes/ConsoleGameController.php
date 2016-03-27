<?php

class ConsoleGameController extends GameController {

    public function __construct() {
        $gameRenderer = new ConsoleGameRenderer();
        $boardRenderer = new ConsoleBoardRenderer();
        $cellRenderer = new ConsoleCellRenderer();
        parent::__construct($gameRenderer, $boardRenderer, $cellRenderer);
    }

    public function run() {
        $options = $this->validateCLIOptions();
        if (isset($options['n'])) {
            $this->newGame(new BoardDimension($options['r'], $options['c']));
        } else {
            if (!$this->loadGame()) {
                $this->newGame(new BoardDimension(5, 5)); // Should instead inform user to start a new game
            } else if (isset($options['a'])) {
                $this->advanceGame();
            } else {
                $this->renderGame();
            }
        }
    }
    
    private function validateCLIOptions() {
        $options = getopt("nar:c:");
        if (((isset($options['r']) || isset($options['c'])) && !isset($options['n'])) ||
                (isset($options['n']) && (empty($options['r']) || empty($options['c']))) ||
                (isset($options['n']) && isset($options['a']))) {
            echo "Usage:\n";
            echo "  php " . basename(__FILE__) . "\n";
            echo "  php " . basename(__FILE__) . " -n -r<num_rows> -c<num_cols>\n";
            echo "  php " . basename(__FILE__) . " -a\n\n";
            exit();
        }
        return $options;
    }
}
