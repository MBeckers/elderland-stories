<?php

namespace Units;

use Hexopia\Hex\Types\HexTypes;

class HexOrk extends HexTypes
{
    const ORK  = 'Ork';

    function __construct()
    {
        $this->value = self::ORK;
    }
}
