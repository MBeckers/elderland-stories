<?php

namespace App;

use App\Contracts\Communicator;
use Fight\Fight;
use Hexopia\Map\ConsolePlotter\MapPlotter;
use Illuminate\Support\Facades\Redirect;

class WebCommunicator implements Communicator
{
    public function askMovement(Fight $fight)
    {
        $direction = request()->input('command');

        switch ($direction) {
            case "d":
                return 0;
                break;
            case "e":
                return 1;
                break;
            case "w":
                return 2;
                break;
            case "q":
                return 3;
                break;
            case "a":
                return 4;
                break;
            case "s":
                return 5;
                break;
            default:
                return response(MapPlotter::draw($fight->dungeon->getMap())->plot());
                break;
        }
    }

    public function show(Fight $fight)
    {
        $fight->nextTurn();
        return Redirect::to(env('APP_URL'));
    }
}
