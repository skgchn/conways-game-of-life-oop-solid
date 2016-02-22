<?php

interface BoardRenderer {
    public function render(Board $board, CellRenderer $cellRenderer);
}
