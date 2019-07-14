<?php

namespace World;

use Units\Unit;
use Hexopia\Hex\Helpers\HexArr;
use Hexopia\Hex\Hex;
use Hexopia\Hex\Types\HexHero;
use Hexopia\Hex\Types\HexTypes;
use Hexopia\Map\Shapes\HexMap;

class Elderland extends HexMap
{
    protected $unitPositions;

    public function __construct($radius = null)
    {
        parent::__construct($radius);

        $this->unitPositions = [];
    }

    public function placeUnits(array $units)
    {
        foreach($units as $unit) {
            $this->placeUnit($unit);
        }
    }

    public function place(Hex $replacement)
    {


        if (HexArr::search($replacement, $this->unitPositions) !== false) {
                    dd($replacement, $this->unitPositions);
            throw new \Exception('Cannot overwrite a units hex');
        }

        return parent::place($replacement);
    }

    public function placeUnit(Unit $unit)
    {
        if(! $placement = $this->findAppropriatePlacement()) {
            throw new Exception("Unit cannot be placed due to missing valid fields");
        }

        $hex = new Hex($placement->q, $placement->r, new HexHero());

        $this->place($hex);
        
        $this->unitPositions[$unit->getId()] = $hex;
    }

    protected function findAppropriatePlacement()
    {
        $must = null;
        $should = null;
        
        $hexagons = $this->hexagons;
        shuffle($hexagons);

        foreach ($hexagons as $candidate) {

            if ($candidate->type->value != HexTypes::EMPTY) {
                continue;
            }

            $neighbors = $this->approachableNeighbors($candidate);

            if (count($neighbors) == 0) {
                continue;
            }

            $must = $candidate;

            $enemies = array_filter($neighbors, function($neighbor){
                return $neighbor->type->value != HexTypes::EMPTY;
            });

            if (count($enemies) == 0) {
                $should = $candidate;
            }

            if (count($this->neighbors($candidate)) == 6 && count($enemies) == 0) {
                return $candidate;
            }
        }

        return $should ?? $must;
    }

    function __get($name)
    {
        if (property_exists(static::class, $name)) {
            return $this->$name;
        }

        if (method_exists(static::class, $name)) {
            return $this->$name();
        }
    }
}


