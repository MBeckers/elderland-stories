<?php

namespace Tests\Feature;

use Tests\TestCase;
use Game\Game;
use World\MapGenerator;
use World\Elderland;

class MapGeneratorTest extends TestCase
{

    /**
     * @test
     */
    public function creation_of_elderland()
    {

        list($name, $elderland) = MapGenerator::createElderland();

        $this->assertEquals($name, 'Elderland');
        $this->assertEquals(Elderland::class, get_class($elderland));
    }
}
