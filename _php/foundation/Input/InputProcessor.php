<?php

namespace Foundation\Input;

use Foundation\Debugger;
use \Foundation\Contracts\InputProcessor as InputProcessorInterface;

class InputProcessor implements InputProcessorInterface
{
    public function process()
    {
        $input = null;

        $this->read($input);

        $this->interpret($input);
    }
    
    protected function interpret(&$input)
    {
        Debugger::putInput($input);
    }

    protected function read(&$char)
    {
        readline_callback_handler_install('', function() { });

        $read = array(STDIN);
        $write = array();
        $except = array();
        $result = stream_select($read, $write, $except, 0);

        if($result === false) throw new \Exception('stream_select failed');

        if($result === 0) return false;

        $char = stream_get_contents(STDIN, 1);

        return true;
    }
}