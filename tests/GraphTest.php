<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class GraphTest extends TestCase
{
    public function test_get_all_time_graph()
    {
        $this->makeAssertionsOnGraph(
            Runescape::graph()->getAllTimePrices(1161, 'Y-m-d H:i:s')
        );
    }

    public function test_get_90d_graph()
    {
        $this->makeAssertionsOnGraph(
            Runescape::graph()->getLast90DaysGraph(1161, 'Y-m-d H:i:s')
        );
    }

    public function test_get_sample_graph()
    {
        $this->makeAssertionsOnGraph(
            Runescape::graph()->getSamplePricesGraph(1161, 'Y-m-d H:i:s')
        );
    }

    protected function makeAssertionsOnGraph(array $graph)
    {
        foreach ($graph as $point) {
            $this->assertTrue(is_string($point['timestamp']));
            $this->assertTrue(is_int($point['price']));
        }
    }
}
