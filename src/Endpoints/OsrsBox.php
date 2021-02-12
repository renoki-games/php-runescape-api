<?php

namespace RenokiGames\Runescape\Endpoints;

use Carbon\Carbon;
use RenokiGames\Runescape\Client;

class OsrsBox extends Client
{
    /**
     * The base URL for the calls.
     *
     * @var string
     */
    protected static $baseUrl = 'https://api.osrsbox.com/';

    public function getItems(array $filter = [], int $page = 1)
    {
        return $this->query([
            'where' => $filter ? json_encode($filter) : null,
            'page' => $page,
        ])->get('/items')->json();
    }
}
