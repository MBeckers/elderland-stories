<?php

namespace Foundation;

use Foundation\Contracts\ScreenRenderer;
use Foundation\Frames\DebuggerFrame;
use Foundation\Frames\HistoryFrame;
use Hexopia\Map\ConsolePlotter\Frames\HexFrame;
use Hexopia\Map\Shapes\HexMap;

class ConsoleRenderer implements ScreenRenderer
{
    const MAP_WIDTH         = 53; // note 1 column padding left and right
    const MAP_HEIGHT        = 29;
    const HISTORY_WIDTH     = 47;
    const DEBUGGER_HEIGHT   = 10;

    protected $map;
    protected $history;
    protected $debugger;
    protected $display;

    public function __construct(HexMap $map)
    {
        $this->map = $map;

        $this->display = array_fill(0, $this->rows() , ' ');

        for ($i = 0; $i < $this->rows(); $i++) {
            $this->display[$i] = array_fill(0, $this->colums(), ' ');
        }
    }

    public function plot()
    {
        //system('clear');
        print("\033[2J\033[;H");
        $this->buildFrame();
        $this->buildMap();
        $this->buildDebugger();
        $this->buildHistory();

        foreach ($this->display as $line) {
            printf("%s" . PHP_EOL, implode("", $line));
        }
    }

    protected function buildHistory()
    {
        $frame = new HistoryFrame();

        $frame->render(60);

        for ($row = 0;
             $row < $this->rows() - 2;
             $row++
        ) {
            for ($displayColumn = static::MAP_WIDTH + 2, $histoyColumn = 0; 
                $histoyColumn < count($frame->display()[$row]); 
                $displayColumn++, $histoyColumn++) {
                $this->display[$row + 1][$displayColumn] = $frame->display()[$row][$histoyColumn];
            }
        }
    }

    protected function buildDebugger()
    {
        $frame = new DebuggerFrame();

        $frame->render(60);

        for ($displayRow = static::MAP_HEIGHT + 2, $debuggerRow = 0;
             $displayRow < $this->rows() - 1;
             $displayRow++, $debuggerRow++
        ) {
            for ($column = 0; $column < count($frame->display()[$debuggerRow]); $column++) {
                $this->display[$displayRow][$column + 1] = $frame->display()[$debuggerRow][$column];
            }
        }
    }

    protected function buildMap() {
        $frame = new HexFrame($this->map);

        $frame->render();

        for ($row = 0; $row < static::MAP_HEIGHT; $row++) {
            for ($column = 0; $column < static::MAP_WIDTH - 2; $column++) {
                $this->display[$row + 1][$column + 2] = $frame->display[$row][$column];
            }
        }
    }

    protected function buildFrame() {
        for($colum = 1; $colum < $this->colums() - 1; $colum++) {
            $this->display[0][$colum] = '═';
            $this->display[$this->rows() - 1][$colum] = '═';

            if ($colum < static::MAP_WIDTH + 1) {
                $this->display[static::MAP_HEIGHT + 1][$colum] = '═';
            }
        }

        for($row = 1; $row < $this->rows() - 1; $row++) {
            $this->display[$row][0] = '║';
            $this->display[$row][$this->colums() - 1] = '║';
            $this->display[$row][static::MAP_WIDTH + 1] = '║';
        }

        $this->display[0][0] = '╔';
        $this->display[$this->rows() - 1][0] = '╚';
        $this->display[0][$this->colums() - 1] = '╗';
        $this->display[$this->rows() - 1][$this->colums() - 1] = '╝';
        $this->display[0][static::MAP_WIDTH + 1] = '╦';
        $this->display[$this->rows() - 1][static::MAP_WIDTH + 1] = '╩';
        $this->display[static::MAP_HEIGHT + 1][0] = '╠';
        $this->display[static::MAP_HEIGHT + 1][static::MAP_WIDTH + 1] = '╣';
    }

    protected function rows() {
        return static::MAP_HEIGHT + static::DEBUGGER_HEIGHT + 3;
    }

    protected function colums() {
        return static::MAP_WIDTH + static::HISTORY_WIDTH + 3;
    }
}
