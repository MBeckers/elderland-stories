<?php

namespace Foundation;

use World\Elderland;

class Game
{
    const FPS = 40;
    private $µsPerUpdate;
    private $msPerUpdate;

    private $started = true;

    private $renderer;
    private $map;

    public function __construct()
    {
        $this->msPerUpdate = round(1000 / self::FPS);
        $this->µsPerUpdate = round(1000*1000 / self::FPS);

        $this->map = Elderland::generate();
        $this->renderer = new ConsoleRenderer(
            $this->map
        );
    }

    public function loop() {

        $previous = microtime(true);
        $lag = 0.0;

        while ($this->started) {
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

            $this->renderer->plot();
            
            usleep( (microtime(true) - $current + $this->µsPerUpdate ));
        }
    }
}
