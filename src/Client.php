<?php

namespace RenokiGames\Runescape;

use Illuminate\Http\Client\Factory;

class Client
{
    /**
     * The API caller instance.
     *
     * @var \Illuminate\Http\Client\Factory
     */
    protected $caller;

    /**
     * The Guzzle options.
     *
     * @var array
     */
    protected $options = [
        //
    ];

    /**
     * The base URL for the calls.
     *
     * @var string
     */
    protected static $baseUrl = 'https://secure.runescape.com/m=itemdb_rs/api/';

    /**
     * Initialize the client.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reinitCaller();
    }

    /**
     * Pass query parameters.
     *
     * @param  array  $query
     * @return $this
     */
    public function query(array $query)
    {
        $this->options['query'] = $query;

        return $this->reinitCaller();
    }

    /**
     * Renitialize the caller.
     *
     * @return $this
     */
    protected function reinitCaller()
    {
        $this->caller = (new Factory)->withOptions($this->getOptions());

        return $this;
    }

    /**
     * Get the Guzzle options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return array_merge($this->options, [
            'base_uri' => static::$baseUrl,
        ]);
    }

    /**
     * Proxy the calls to the factory.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->caller->{$method}(...$parameters);
    }
}
