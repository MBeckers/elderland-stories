<?php

namespace Fight;

class Fight
{
    public $dungeon;
    private $characters;
    private $currentTurn;

    private function __construct(Dungeon $dungeon, array $characters)
    {
        $this->dungeon = $dungeon;
        $this->currentTurn = new Turn($this);

        foreach ($characters as $character) {
            $this->dungeon->addCharacter($character);
            $this->characters[$character->getId()] = $character;
        }
    }

    public static function initialize(Dungeon $dungeon, array $characters)
    {
        return new self($dungeon, $characters);
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function playTurn()
    {
        if (!$this->finished()) {
            return $this->currentTurn->play();
        }
    }

    public function nextTurn()
    {
        $this->currentTurn = $this->currentTurn->next();
    }

    public function finished()
    {
        return false;
    }
}
