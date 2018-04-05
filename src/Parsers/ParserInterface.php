<?php

namespace PHPRouteParser\Parsers;

use PHPRouteParser\Entity\Route;


interface ParserInterface
{
    public static function import($data): Route;

    public static function export(Route $route);
}