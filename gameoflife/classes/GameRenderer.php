<?php

interface GameRenderer {
    public function render(Board $board, BoardRenderer $boardRenderer, CellRenderer $cellRenderer);
}
