<?php

namespace Foundation;

class Game
{
    private $started = true;
    const MS_PER_UPDATE = 16;

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

            // render();
        }
    }
}