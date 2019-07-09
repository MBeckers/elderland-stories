<?php

namespace App\Contracts;

use Fight\Fight;

interface Communicator
{
    public function askMovement(Fight $fight);
    public function show(Fight $fight);
}
