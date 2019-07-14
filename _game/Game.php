<?php

namespace Game;

use Units\Hero;
use Units\Ork;
use Fight\Dungeon;
use Fight\Fight;
use World\MapGenerator;
use Hexopia\Map\Shapes\HexMap;
use Illuminate\Support\Facades\Session;

final class Game
{
    protected $id;
    protected $currentScene;
    protected $maps = [];
    protected $dungeons = [];
    protected $units = [];
    protected $changelog = [];

    private function __construct($id)
    {
        $this->id = $id;
    }

    public static function new()
    {
        $game = new self(1);

        list($mapName, $map) = MapGenerator::createElderland();

        $game->maps[$mapName] = $map;

        $game->units[] = new Hero();

        $game->units[] = new Ork();

        $map->placeUnits($game->units);

        return $game;
    }

    public static function load()
    {
        return Session::get('game');
    }

    public function save()
    {
        Session::put('game', $this);
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \ErrorException('Undefined property: ' . get_class($this) . '::$' . $name);
    }
}
