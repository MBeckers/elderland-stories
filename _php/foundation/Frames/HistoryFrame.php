<?php

namespace Foundation\Frames;

use Foundation\ConsoleRenderer;

class HistoryFrame
{
    protected $display;

    public function __construct()
    {    
        $this->display = array_fill(0, ConsoleRenderer::MAP_HEIGHT - 2 , '.');

        for ($i = 0; $i < ConsoleRenderer::HISTORY_WIDTH; $i++) {
            $this->display[$i] = array_fill(0, ConsoleRenderer::HISTORY_WIDTH, '.');
        }
    }

    public function render()
    {
        $headline = substr(
            "History" . implode("", $this->display[0]), 
            0, 
            ConsoleRenderer::HISTORY_WIDTH
        );

        $this->display[0] = str_split( $headline );
    }

    public function display()
    {
        return $this->display;
    }
}