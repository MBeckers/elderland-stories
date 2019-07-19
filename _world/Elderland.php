<?php

namespace World;

use Hexopia\Contracts\MapGuard;
use Hexopia\Map\MapField;
use Hexopia\Map\Shapes\HexMap;
use Hexopia\Objects\Obstacle;

class Elderland extends HexMap
{
    public static function generate()
    {
        $map = static::hex(3);

        $map->putAll(static::createObstacles());

        return $map;
    }

    private static function createObstacles() {
        $obstacles[] = MapField::make(
            1, -1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            2, -1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            2, 0, new Obstacle()
        );

        $obstacles[] = MapField::make(
            2, 1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            1, 2, new Obstacle()
        );

        $obstacles[] = MapField::make(
            0, 2, new Obstacle()
        );

        $obstacles[] = MapField::make(
            -1, 2, new Obstacle()
        );

        $obstacles[] = MapField::make(
            -1, 1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            -2, 1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            -3, 2, new Obstacle()
        );

        $obstacles[] = MapField::make(
            -1, -1, new Obstacle()
        );

        $obstacles[] = MapField::make(
            0, -2, new Obstacle()
        );

        $obstacles[] = MapField::make(
            1, -3, new Obstacle()
        );

        return $obstacles;
    }
}


