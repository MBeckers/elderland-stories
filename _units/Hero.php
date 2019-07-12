<?php

namespace _units;

use Hexopia\Hex\Types\HexHero;
use Hexopia\Hex\Types\HexTypes;

class Hero extends Unit
{
    protected static function getHexType(): HexTypes
    {
        return new HexHero();
    }

    public static function isPlayer(): bool
    {
        return true;
    }
}
