<?php

namespace App\Console\Commands;

use _units\Hero;
use Fight\Dungeon;
use Fight\Fight;
use Hexopia\Map\ConsolePlotter\MapPlotter;
use Illuminate\Console\Command;
use World\Game;
use World\MapGenerator;

class StartFight extends Command
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
    protected $signature = 'game:start-fight';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a fight';

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

        while (true) {
            $this->game->playTurn();
        }
    }

    private function setUp()
    {
        $this->game = Game::start();
    }
}
