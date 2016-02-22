<?php

class ConsoleGameRenderer implements GameRenderer{
    public function render(Board $board, BoardRenderer $boardRenderer, CellRenderer $cellRenderer) {
        $boardRenderer->render($board, $cellRenderer);
    }
}
