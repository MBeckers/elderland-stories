<?php

namespace _units;

use Hexopia\Hex\Types\HexTypes;
use Hexopia\Map\Shapes\HexMap;
use Ramsey\Uuid\Uuid;

abstract class Unit
{
    protected $id;
    protected $map;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function getId()
    {
        return $this->id;
    }

    public function currentMap(): HexMap
    {
        return $this->map;
    }

    public function setCurrentMap(HexMap $map): Unit
    {
        $this->map = $map;

        return $this;
    }

    abstract public static function isPlayer() : bool;

    abstract protected static function getHexType() : HexTypes;
}
