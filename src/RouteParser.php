<?php

namespace PHPRouteParser;

use PHPRouteParser\Entity\Route;

use PHPRouteParser\Parsers\GPXParser;

class RouteParser
{
    /**
     * @param string $data
     * @return Route
     */
    public static function parseGPX(string $data) {
        $route = GPXParser::parse($data);
        self::buildStats($route);
        return $route;
    }

}