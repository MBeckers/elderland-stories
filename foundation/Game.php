<?php

namespace Foundation;

use World\Elderland;

class Game
{
    const MS_PER_UPDATE = 1000;
    private $started = true;

    private $renderer;
    private $map;

    public function __construct()
    {
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

            while ($lag >= self::MS_PER_UPDATE)
            {
                // update();

                $lag -= self::MS_PER_UPDATE;
            }

            $this->renderer->plot();

            usleep(($current + self::MS_PER_UPDATE - (float) microtime()) * 10);
        }
    }
}