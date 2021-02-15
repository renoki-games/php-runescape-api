<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class RsBuddyTest extends TestCase
{
    public function test_hourly_graph()
    {
        $graphs = Runescape::rsbuddy()->get3HoursGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }

    public function test_daily_graph()
    {
        $graphs = Runescape::rsbuddy()->getDailyGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }

    public function test_half_hour_graph()
    {
        $graphs = Runescape::rsbuddy()->get30MinsGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }

    public function test_quarterly_graph()
    {
        $graphs = Runescape::rsbuddy()->getQuarterlyGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }
}
