<?php

namespace Units;

use Hexopia\Hex\Types\HexTypes;

class Ork extends Unit
{
    protected static function getHexType(): HexTypes
    {
        return new HexOrk();
    }

    public static function isPlayer() : bool
    {
        return false;
    }
}
