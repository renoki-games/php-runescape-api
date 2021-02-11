<?php

namespace RenokiGames\Runescape;

use Illuminate\Support\ServiceProvider;

class RunescapeServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/runescape.php' => config_path('runescape.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/runescape.php', 'runescape'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
