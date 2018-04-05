<?php

namespace PHPRouteParser\Parsers;


use PHPRouteParser\Entity\Point;
use PHPRouteParser\Entity\Route;

class GPXParser implements ParserInterface
{
    public static function import($data): Route
    {
        $route = new Route();
        $xml = simplexml_load_string($data);
        if (isset($xml->trk)) {
            $track = $xml->trk;
            if (isset($track->trkseg) ) {
                foreach ($track->trkseg as $node) {
                    if (isset($node->trkpt)) {
                        foreach ($node->trkpt as $node) {
                            $point = new Point();
                            $point->setLatitude($node->lat);
                            $point->setLongitude($node->lon);
                            $route->addPoint($point);
                        }
                    }
                }
            }
        }

        return $route;
    }

    public static function export(Route $route)
    {
        // TODO: Implement export() method.
    }
}