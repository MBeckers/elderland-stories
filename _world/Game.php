<?php

namespace World;

use Characters\Hero;
use Fight\Dungeon;
use Fight\Fight;
use Illuminate\Support\Facades\Session;

class Game
{
    private $id;
    public $fight;
    private $dungeon;
    private $hero;

    private function __construct($id, $dungeon, $hero, $fight)
    {
        $this->id = $id;
        $this->dungeon = $dungeon;
        $this->hero = $hero;
        $this->fight = $fight;
    }

    public static function start()
    {
        $dungeon = new Dungeon(MapGenerator::generate());

        $hero = Hero::place($dungeon->getMap()->hexagons[0]);

        return new self(
            1,
            $dungeon,
            $hero,
            Fight::initialize($dungeon, [$hero])
        );
    }

    public function playTurn()
    {
        return $this->fight->playTurn();
    }

    public static function load()
    {
        return Session::get('game');
    }

    public function save()
    {
        Session::put('game', $this);
    }
}
