<?php
class ConsoleCellRenderer implements CellRenderer {
    public function renderLiveCell() {
        echo '$';
    }
    
    public function renderDeadCell() {
        echo '-';
    }
}
