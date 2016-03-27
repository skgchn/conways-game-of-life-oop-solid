<?php
interface GameAdvancer {
    public function nextGen(Board $board, $boardType);
}
