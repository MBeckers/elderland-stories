<?php

namespace World;

use Hexopia\Map\Map;
use Hexopia\Map\Shapes\HexMap;

class MapGenerator
{
    public static function generate($radius = 5) : Map
    {
        return HexMap::hex($radius);
    }
}
