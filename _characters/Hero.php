<?php

namespace Characters;

use Hexopia\Hex\Types\HexHero;
use Hexopia\Hex\Types\HexTypes;

class Hero extends Character
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
