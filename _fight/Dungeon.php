<?php

namespace Fight;

use _units\Unit;
use Hexopia\Hex\Types\HexEmpty;
use Hexopia\Map\Map;

class Dungeon
{
    protected $map;
    protected $characters = [];

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function getMap()
    {
        return $this->map;
    }

    public function addCharacter(Unit $character)
    {
        $this->characters[$character->getId()] = $character;
    }

    public function move(Unit $character, int $direction) : bool
    {
        $target = $character->getCurrentHex()->neighbor($direction);

        $character->getCurrentHex()->type = new HexEmpty();

        $this->map->place($target);

        $character->moveTo($target);

        return true;
    }
}
