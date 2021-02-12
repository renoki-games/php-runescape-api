<?php

namespace RenokiGames\Runescape\Endpoints;

use RenokiGames\Runescape\Client;

class Runeday extends Client
{
    public function getDay()
    {
        return $this->get('/info.json')->json();
    }
}
