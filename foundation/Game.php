<?php

namespace Foundation;

use World\Elderland;

class Game
{
    const FPS = 60;
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

        $previous = (float) microtime();
        $lag = 0.0;

        while ($this->started) {
            $current = (float) microtime();
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

            usleep(($current + $this->µsPerUpdate - (float) microtime()) * 1000 * 1000);
        }
    }
}
