<?php

namespace App\Http\Controllers;

use World\Game;

class GameController extends Controller
{
    public function play()
    {
        if (!$game = Game::load()) {
            $game = Game::start();
        }

        $response = $game->playTurn();

        $game->save();

        return $response;
    }
}
