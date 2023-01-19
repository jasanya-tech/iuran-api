<?php

namespace App\Helpers;


class Helper
{
    public static function test($text = "Helo")
    {
        return $text;
    }

    public static function reImagePath($path)
    {
        $path = explode("/", $path);
        $newPath = [$path[2], $path[3]];
        return "/" . join("/", $newPath);
    }
}
