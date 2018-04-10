<?php

namespace PHPRouteParser\Parsers;


use PHPRouteParser\Entity\Route;

class JsonParser implements ParserInterface
{
    public static function import($data): Route
    {
        // TODO: Implement import() method.
    }

    public static function export(Route $route)
    {
        return json_encode($route);
    }

}