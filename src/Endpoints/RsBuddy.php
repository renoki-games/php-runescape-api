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

    public function getWeeklyGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/180/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    public function getMonthlyGraph(string $id, string $format = null)
    {
        $response = $this->get("/exchange/graphs/1440/{$id}.json")->json();

        return $this->processGraph($response, $format);
    }

    protected function processGraph(array $response, string $format = null)
    {
        return collect($response)->map(function ($point) use ($format) {
            if ($format) {
                $point['ts'] = Carbon::createFromTimestamp($point['ts'])->format($format);
            }

            return $point;
        })->sortBy('ts')->values()->toArray();
    }
}
