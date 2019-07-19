<?php

namespace Foundation;

use Hexopia\Map\Shapes\HexMap;

class ConsoleRenderer
{
    const MAP_WIDTH         = 51;
    const MAP_HEIGHT        = 29;
    const HISTORY_WIDTH     = 41;
    const DEBUGGER_HEIGHT   = 10;

    protected $map;
    protected $history;
    protected $debugger;
    protected $display;
    
    public function __construct()
    {
        $this->map = HexMap::hex(3);

        $this->display = array_fill(0, $this->rows() , ' ');

        for ($i = 0; $i < $this->rows(); $i++) {
            $this->display[$i] = array_fill(0, $this->colums(), ' ');
        }

        $this->buildFrame();
    }
    
    public function plot()
    {
        system('clear');

        foreach ($this->display as $line) {
            printf("%s" . PHP_EOL, implode("", $line));

        }
    }

    protected function buildFrame() {
        $this->display[0][0] = '╔';
        $this->display[$this->rows() - 1][0] = '╚';
        $this->display[0][$this->colums() - 1] = '╗';
        $this->display[$this->rows() - 1][$this->colums() - 1] = '╝';

    }

    protected function rows() {
        return static::MAP_HEIGHT + static::DEBUGGER_HEIGHT + 3;
    }

    protected function colums() {
        return static::MAP_WIDTH + static::HISTORY_WIDTH + 3;
    }
}