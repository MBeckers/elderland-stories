<?php

namespace Characters;

use Hexopia\Hex\Hex;
use Hexopia\Hex\Types\HexHero;
use Hexopia\Hex\Types\HexTypes;
use Ramsey\Uuid\Uuid;

abstract class Character implements Placeable
{
    /**
     * @var Hex
     */
    protected $position;
    protected $id;

    protected function __construct(Hex $hex)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->position = $hex;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCurrentHex() : Hex
    {
        return $this->position;
    }

    public final static function place(Hex $hex) : Character
    {
        $hex->type = static::getHexType();
        return new static($hex);
    }

    public final function moveTo(Hex $hex)
    {
        $hex->type = static::getHexType();
        $this->position = $hex;
    }

    abstract public static function isPlayer() : bool;

    abstract protected static function getHexType() : HexTypes;
}
