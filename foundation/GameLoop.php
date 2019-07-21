<?php

namespace Foundation;

use Foundation\Input\InputProcessor;
use World\Elderland;

class GameLoop
{
    const FPS = 8;
    private $µsPerUpdate;
    private $msPerUpdate;
    private $started = true;

    private $renderer;
    private $inputProcessor;

    public function __construct(InputProcessor &$inputProcessor, ConsoleRenderer &$renderer)
    {
        $this->msPerUpdate = round(1000 / self::FPS);
        $this->µsPerUpdate = $this->msPerUpdate * 1000;

        $this->inputProcessor = $inputProcessor;
        $this->renderer = $renderer;
    }

    public function loop()
    {
        $previous = microtime(true);
        $lag = 0.0;

        while ( $this->started) {
            $current = microtime(true);
            $elapsed = $current - $previous;
            $previous = $current;
            $lag += $elapsed;

            $this->inputProcessor->process();

            while ($lag >= $this->µsPerUpdate)
            {
                // update();

                $lag -= $this->µsPerUpdate;
            }

            if ($elapsed) {
                Debugger::putFps( round(1/$elapsed) );
            }

            $this->renderer->plot();

            $sync = ($current - microtime(true))*1000*1000 + $this->µsPerUpdate ;

            usleep($sync > 0 ? $sync : 0);
        }
    }
}
