<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class RunedayTest extends TestCase
{
    public function test_runeday()
    {
        $this->assertNotNull(
            Runescape::runeday()->getDay()['lastConfigUpdateRuneday']
        );
    }
}
