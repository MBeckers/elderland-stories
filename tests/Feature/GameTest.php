<?php

namespace Tests\Feature;

use Fight\Turn;
use Tests\TestCase;
use World\Game;

class GameTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | Scenes
    |--------------------------------------------------------------------------
    |
    | Scenes describe the current visualisation for the game. optional scenes are:
    | ~ WelcomePrologue – The Prologue between user and... no clue, story not written yet.
    | ~ Map – just the current map
    */


    /**
     * @test
     */
    public function a_basic_turn_start()
    {
        $game = Game::new();

        $this->assertEquals(Game::class, get_class($game));
            $this->assertEquals(World::class, get_class($game->world));
                $this->assertIsArray($game->world->maps);
                $this->assertIsArray($game->world->dungeons);

            $this->assertIsArray($game->units);
            $this->assertIsArray($game->history);


        $this->assertEquals(Turn::class, $game->currentTurn);
            $this->assertEquals(WelcomeProluge::class, get_class($game->currentTurn->scene));
            $this->assertIsArray($game->currentTurn->opportunities);
            $this->assertIsArray($game->currentTurn->changelog);

    }
}
