<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class GraphTest extends TestCase
{
    public function test_get_all_time_graph()
    {
        $graph = Runescape::graph()->getAllTimePrices(1161, 'Y-m-d H:i:s');

        foreach ($graph as $point) {
            $this->assertTrue(is_int($point['price']));
        }
    }
}
