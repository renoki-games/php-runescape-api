<?php

namespace RenokiGames\Runescape\Endpoints;

use Carbon\Carbon;
use RenokiGames\Runescape\Client;

class RsBuddy extends Client
{
    /**
     * The base URL for the calls.
     *
     * @var string
     */
    protected static $baseUrl = 'https://rsbuddy.com/';

    public function get3HoursGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/180/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    public function getDailyGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/1440/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    public function get30MinsGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/30/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    public function getQuarterlyGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/4320/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    protected function processGraph(array $response, string $format = null)
    {
        return collect($response)->map(function ($point) use ($format) {
            if ($format) {
                $point['ts'] = Carbon::createFromTimestamp($point['ts'] / 1000)->format($format);
            }

            return $point;
        })->sortBy('ts')->values()->toArray();
    }
}
