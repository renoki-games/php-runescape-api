<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class OsrsBoxTest extends TestCase
{
    public function test_items()
    {
        $items = Runescape::osrsbox()->getItems([], 1);

        foreach ($items['_items'] as $item) {
            $this->assertNotNull($item['name']);
        }
    }
}
