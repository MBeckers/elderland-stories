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

        $memoryUsage = substr(
            "Memory Usage / MB       : " .
            round( Debugger::memoryUsage() / (1000 * 1000), 3) .
            implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $memoryUsageReal = substr(
            "Memory Usage (real) / MB: " .
            round( Debugger::realMemoryUsage() / (1000 * 1000), 3) .
            implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $input = substr(
            "Input: " .
            Debugger::input().
            implode("", $this->display[0]), 0, ConsoleRenderer::MAP_WIDTH
        );

        $this->display[0] = str_split( $headline );
        $this->display[2] = str_split($fpsLine);
        $this->display[3] = str_split($updateMsLine);
        $this->display[5] = str_split($memoryUsage);
        $this->display[6] = str_split($memoryUsageReal);
        $this->display[7] = str_split($input);
    }

    public function display()
    {
        return $this->display;
    }
}