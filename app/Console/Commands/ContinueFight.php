<?php

namespace App\Console\Commands;

use _units\Hero;
use Fight\Dungeon;
use Fight\Fight;
use Hexopia\Map\ConsolePlotter\MapPlotter;
use Illuminate\Console\Command;
use World\MapGenerator;

class ContinueFight extends Command
{
    /**
     * @var Fight
     */
    protected $fight;

    /**
     * @var Dungeon
     */
    protected $dungeon;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:continue-fight {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Continue a fight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setUp();

        $this->fight->start();
    }

    private function setUp()
    {
        $this->dungeon = new Dungeon(MapGenerator::generate());

        $this->hero = Hero::place($this->dungeon->getMap()->hexagons[0]);

        $this->fight = Fight::initialize($this->dungeon, [$this->hero]);
    }
}
