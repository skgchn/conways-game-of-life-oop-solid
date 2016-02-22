<?php

class FileBoardPersister implements BoardPersister {
    private $fileName = 'data/gol.txt';
    
    public function store(Board $board) {
        file_put_contents($this->fileName, serialize($board));
    }
    
    public function retrieve() {  // returns Board object
        $board = null;
        if (file_exists($this->fileName)) {
            $board = unserialize(file_get_contents($this->fileName));
        }
        return $board;
    }
}
