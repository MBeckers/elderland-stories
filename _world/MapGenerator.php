<?php

namespace World;

use Hexopia\Hex\Hex;
use Hexopia\Map\Map;

class MapGenerator
{
    public static function generate($radius = 5) : Map
    {

    }

    public static function createElderland()
    {
        $elderland =  Elderland::hex(5);

        $elderTree = new Hex(0, 0, new HexElderTree());

        $elderland->place($elderTree);

        return ['Elderland', $elderland];
    }
}
