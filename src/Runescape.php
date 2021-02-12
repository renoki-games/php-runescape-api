<?php

namespace RenokiGames\Runescape;

class Runescape
{
    public static function runeday()
    {
        return new Endpoints\Runeday;
    }

    public static function catalogue()
    {
        return new Endpoints\Catalogue;
    }

    public static function graph()
    {
        return new Endpoints\Graph;
    }

    public static function osrsbox()
    {
        return new Endpoints\OsrsBox;
    }

    public static function rsbuddy()
    {
        return new Endpoints\RsBuddy;
    }
}
