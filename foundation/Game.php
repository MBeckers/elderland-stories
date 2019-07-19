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

        $previous = microtime();
        $lag = 0.0;

        while ($this->started) {
            $current = microtime();
            $elapsed = $current - $previous;
            $previous = $current;
            $lag += $elapsed;

            // processInput();

            while ($lag >= self::MS_PER_UPDATE)
            {
                // update();

                $lag -= self::MS_PER_UPDATE;
            }

            sleep(self::MS_PER_UPDATE / 1000.0);

            $this->renderer->plot();
        }
    }
}