<?php

namespace AdventCode\Common;

class File
{
    public $filename;
    public $dimension;
    
    public function __construct($filename, $dimension)
    {
        $this->filename = $filename;
        $this->dimension = $dimension;
    }
    
    public function __toString()
    {
        return "{$this->filename} (file, size={$this->dimension})";
    }
}