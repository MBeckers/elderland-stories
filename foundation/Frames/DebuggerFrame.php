<?php

namespace Foundation\Frames;

use Foundation\ConsoleRenderer;
use Foundation\Debugger;

class DebuggerFrame
{
    protected $display;

    public function __construct()
    {
        $this->display = array_fill(0, ConsoleRenderer::DEBUGGER_HEIGHT , '.');

        for ($i = 0; $i < ConsoleRenderer::DEBUGGER_HEIGHT; $i++) {
            $this->display[$i] = array_fill(0, ConsoleRenderer::MAP_WIDTH, '.');
        }
    }

    public function render()
    {
        $headline = substr(
            "Debugger" .
            implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $fpsLine = substr(
            "FPS: " . Debugger::fps() . implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $updateMsLine = substr(
            "Update in Ms: " . Debugger::updateMs() . implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $this->display[0] = str_split( $headline );
        $this->display[2] = str_split($fpsLine);
        $this->display[3] = str_split($updateMsLine);
    }

    public function display()
    {
        return $this->display;
    }
}