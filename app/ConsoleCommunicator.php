<?php

namespace App;

use App\Contracts\Communicator;
use Fight\Fight;
use Hexopia\Map\ConsolePlotter\MapPlotter;

class ConsoleCommunicator implements Communicator
{
    public function askMovement(Fight $fight)
    {
        MapPlotter::draw($fight->dungeon->getMap())->plot();
        printf('%s%s', ' \\  |  /', PHP_EOL);
        printf('%s%s', '  q w e ', PHP_EOL);
        printf('%s%s', '  a s d ', PHP_EOL);
        printf('%s%s',' /  |  \\', PHP_EOL);

        $direction = readline('Move Hero: ');

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
                return null;
                break;
        }
    }

    public function show(Fight $fight)
    {
        $fight->nextTurn();
    }
}
