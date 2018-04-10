<?php

namespace PHPRouteParser;

use PHPRouteParser\Entity\Route;

use PHPRouteParser\Parsers\GPXParser;
use PHPRouteParser\Parsers\JsonParser;

class RouteParser
{
    private $parsers;

    /**
     * RouteParser constructor.
     */
    public function __construct()
    {
        $this->parsers = [
          'gpx' => new GPXParser(),
          'json' => new JsonParser(),
        ];
    }

    /**
     * @param string $data
     * @param string $import
     * @param string $export
     * @throws \Exception
     *
     * @return Route
     */
    public function parse($data, $import, $export)
    {
        if (!isset($this->parsers[$import], $this->parsers[$export])) {
            throw new \Exception('Format not supported for route parsing.');
        }
        $importParser = $this->parsers[$import];
        $route = $importParser->import($data);
        $route->buildStats();
        //$route->reduce();
        $exportParser = $this->parsers[$export];

        return $exportParser->export($route);
    }

}