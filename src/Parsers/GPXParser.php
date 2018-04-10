<?php

namespace PHPRouteParser\Parsers;


use PHPRouteParser\Entity\Point;
use PHPRouteParser\Entity\Route;

/**
 * Class GPXParser
 * @package PHPRouteParser\Parsers
 */
class GPXParser implements ParserInterface
{
    /**
     * @param $data
     * @return Route
     * @throws \Exception
     */
    public static function import($data): Route
    {
        if(!is_subclass_of($data, \SplFileInfo::class)) {
            throw new \Exception("Invalid data type for GPXParser.");
        }
        $xml = new \XMLReader();
        $xml->open($data->getPathname());

        while ($xml->read() && $xml->name != 'trkpt')
        {
            ;
        }

        $route = new Route();
        while ($xml->name == 'trkpt') {
            $element = new \SimpleXMLElement($xml->readOuterXML());
            $point = self::trkPtToPoint($element);
            $route->addPoint($point);
            $xml->next('trkpt');
            unset($element);
        }
        $xml->close();

        return $route;
    }

    public static function export(Route $route)
    {
        // TODO: Implement export() method.
    }

    /**
     * @param \SimpleXMLElement $element
     * @return Point
     */
    protected static function trkPtToPoint(\SimpleXMLElement $element): Point
    {
        $point = new Point();
        $point->setLongitude((float)$element->attributes()->lon);
        $point->setLatitude((float)$element->attributes()->lat);
        $point->setElevation((float)$element->ele);
        return $point;
    }
}