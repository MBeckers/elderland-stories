<?php

namespace Fight;

use App\Contracts\Communicator;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class Turn
{
    /**
     * @var Fight
     */
    private $fight;
    protected $round;

    public function __construct(Fight $fight, $round = 1)
    {
        $this->round = $round;
        $this->fight = $fight;
    }

    public function play()
    {
        $communicator = resolve(Communicator::class);

        $result = $communicator->askMovement($this->fight);

        if ($result instanceof Response) {
            return $result;
        }

        $this->fight->dungeon->move(Arr::first($this->fight->getCharacters()), $result);

        return $communicator->show($this->fight);
    }

    public function next()
    {
        return new static($this->fight, $this->round + 1);
    }
}
