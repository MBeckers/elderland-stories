<?php
namespace Characters;

use Hexopia\Hex\Hex;

interface Placeable
{
    public function getCurrentHex() : Hex;

    public function moveTo(Hex $hex);
}
