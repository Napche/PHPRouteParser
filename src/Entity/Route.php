<?php

namespace PHPRouteParser\Entity;

use PHPRouteParser\PointCalculation;

class Route
{

    const REDUCTION_TOLERANCE = 0.50;
    /**
     * @var array
     */
    private $points;

    /**
     * @var float
     */
    private $elevationGain;

    /**
     * @var float
     */
    private $distance;

    /**
     * Route constructor.
     */
    public function __construct()
    {
        $this->elevationGain = 0;
        $this->distance = 0;
    }

    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {
        $this->points[] = $point;
    }

    /**
     * @return float
     */
    public function getElevationGain(): float
    {
        return $this->elevationGain;
    }

    /**
     * @param float $elevationGain
     */
    public function setElevationGain(float $elevationGain)
    {
        $this->elevationGain = $elevationGain;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return \Generator
     */
    public function yieldPoints()
    {
        foreach ($this->points as $point) {
            yield $point;
        }
    }

    /**
     * Build Route statistics.
     */
    public function buildStats()
    {
        $distance = 0;
        $elevationGain = 0;
        $start = $end = null;
        foreach ($this->yieldPoints() as $point) {
            if ($start) {
                $distance += PointCalculation::getDistance($start, $point);
                $elevationGain += PointCalculation::getElevationGain($start, $point);
            }
            $start = $point;
        }
        $this->setDistance($distance);
        $this->setElevationGain($elevationGain);
    }


    public function reduce()
    {

        $tolerance = self::REDUCTION_TOLERANCE * pow(10, -8);

        $start = $end = null;
        foreach ($this->yieldPoints() as $point) {
            if ($start) {

            }
            $start = $point;
        }

        // Initialize
        $start = $arr->current();
        $arr->next();
        $pointkey = $arr->key();
        $arr->next();

//        while ($arr->valid()) {
//            $line = new geoLine(array($start, $arr->current()));
//            $point = $this->points[$pointkey];
//            $dist_to_line_squared = $line->distanceToPointSquared($point);
//            if ($dist_to_line_squared > $tolerance) {
//                $start = $arr->current();
//            } else {
//                unset($this->points[$pointkey]);
//            }
//            $pointkey = $arr->key();
//            $arr->next();
//        }
        $this->points = array_values($this->points); // reset keys
    }
}