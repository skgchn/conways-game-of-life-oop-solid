<?php

interface BoardPersister {
    public function store(Board $board);
    public function retrieve();
}
