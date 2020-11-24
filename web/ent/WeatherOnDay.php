<?php

namespace ent;

use DateTime;

class WeatherOnDay
{
    private $date;
    private $temp;
    private $windSpeed;
    private $windDeg;
    private $pressure;
    private $humidity;

    public function __construct(DateTime $date, float $temp, float $windSpeed, int $windDeg, int $pressure, int $humidity)
    {
        $this->date = $date;
        $this->temp = $temp;
        $this->windSpeed = $windSpeed;
        $this->windDeg = $windDeg;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
    }

    public function toJson(): string
    {
        return json_encode([
            'date' => $this->date->format('Y-m-d'),
            'temp' => $this->temp,
            'wind' => [
                'speed' => $this->windSpeed,
                'deg' => $this->windDeg,
            ],
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
        ]);
    }

}

