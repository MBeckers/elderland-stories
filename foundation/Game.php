<?php

namespace Foundation;

use World\Elderland;

class Game
{
    const FPS = 1000;
    private $µsPerUpdate;
    private $msPerUpdate;
    private $started = true;

    private $renderer;
    private $map;

    public function __construct()
    {
        $this->msPerUpdate = round(1000 / self::FPS);
        $this->µsPerUpdate = $this->msPerUpdate * 1000;


        $this->map = Elderland::generate();
        $this->renderer = new ConsoleRenderer(
            $this->map
        );
    }

    public function loop() {

        $previous = microtime(true);
        $lag = 0.0;

        while ($this->started) {
            $bs = microtime(true);
            $current = microtime(true);
            $elapsed = $current - $previous;
            $previous = $current;
            $lag += $elapsed;

            // processInput();

            while ($lag >= $this->µsPerUpdate)
            {
                // update();

                $lag -= $this->µsPerUpdate;
            }

            if ($elapsed) {
                Debugger::putFps(
                    round(1/$elapsed)
                );
            }

            $this->renderer->plot();

  

            $sync = ($current - microtime(true))*1000*1000 + $this->µsPerUpdate ;


            usleep($sync > 0 ? $sync : 0);
          
        }
    }
}
