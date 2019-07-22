<?php

namespace Game;

use Foundation\ConsoleRenderer;
use Foundation\GameLoop;
use Foundation\Input\InputProcessor;
use World\Elderland;

final class Game
{
    private $map;
    private $gameLoop;
    private $renderer;
    private $inputProcessor;

    private function __construct()
    {
        $this->map = Elderland::generate();

        $this->renderer = new ConsoleRenderer( $this->map );

        $this->inputProcessor = new InputProcessor();

        $this->gameLoop = new GameLoop(
            $this->inputProcessor, $this->renderer
        );
    }

    public static function start()
    {
        $game = new self();

        $game->gameLoop->loop();
    }
}
