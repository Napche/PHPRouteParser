<?php

namespace PHPRouteParser;

use PHPRouteParser\Entity\Point;

class PointCalculation
{
    const EARTH_RADIUS = 6371000;

    /**
     * Returns distance in meters between two Points according to GPX coordinates.
     * @see Point
     * @param Point $point1
     * @param Point $point2
     * @return float
     */
    public static function getDistance(Point $point1, Point $point2)
    {
        $latFrom = deg2rad($point1->getLatitude());
        $lonFrom = deg2rad($point1->getLongitude());
        $latTo = deg2rad($point2->getLatitude());
        $lonTo = deg2rad($point2->getLongitude());

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
        $angle = atan2(sqrt($a), $b);

        return $angle * self::EARTH_RADIUS;
    }

    /**
     * @param Point $point1
     * @param Point $point2
     * @return float|int
     */
    public static function getElevationGain(Point $point1, Point $point2)
    {
        $start = $point1->getElevation();
        $end = $point2->getElevation();

        if ($start && $end && $end > $start) {
            return $end - $start;
        }
        return 0;
    }
}