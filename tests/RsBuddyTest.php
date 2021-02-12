<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class RsBuddyTest extends TestCase
{
    public function test_weekly_graphs()
    {
        $graphs = Runescape::rsbuddy()->getWeeklyGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }

    public function test_monthly_graphs()
    {
        $graphs = Runescape::rsbuddy()->getMonthlyGraph(1511, 'Y-m-d H:i:s');

        foreach ($graphs as $graph) {
            $this->assertNotNull($graph['ts']);
        }
    }
}
