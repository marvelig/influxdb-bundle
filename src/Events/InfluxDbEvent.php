<?php

declare(strict_types=1);

namespace Algatux\InfluxDbBundle\Events;

use InfluxDB\Point;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class InfluxDbEvent.
 */
abstract class InfluxDbEvent extends Event
{
    const NAME = 'influxdb.points_collected';

    /**
     * @var Point[]
     */
    protected $points;

    /**
     * @var string
     */
    protected $precision;

    /**
     * @var string|null
     */
    private $connection;

    /**
     * @param Point[] $points
     * @param string  $precision
     * @param string  $connection
     */
    public function __construct(array $points, string $precision, string $connection = null)
    {
        $this->points = $points;
        $this->precision = $precision;
        $this->connection = $connection;
    }

    /**
     * @return Point[]
     */
    final public function getPoints(): array
    {
        return $this->points;
    }

    /**
     * @return string
     */
    final public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @return string|null
     */
    final public function getConnection()
    {
        return $this->connection;
    }
}
