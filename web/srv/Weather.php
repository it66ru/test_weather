<?php

namespace srv;

use DateTime;
use ent\WeatherOnDay;

class Weather
{
    private $url = 'https://api.openweathermap.org/data/2.5/weather';
    private $key = '45daca2c7abf6f2e1f479fd0948a5988';
    private $q;

    private $cache;

    public function __construct(string $q, Cache $cache)
    {
        $this->q = $q;
        $this->cache = $cache;
    }

    public function getWeatherOnDay(DateTime $date): WeatherOnDay
    {
        if ($this->cache) {
            $cacheKey = $date->format('Y-m-d');
            $str = $this->cache->get($cacheKey);
            if ($str) {
                return unserialize($str);
            } else {
                $obj = $this->loadData($date);
                $this->cache->set($cacheKey, serialize($obj));
                return $obj;
            }
        } else {
            return $this->loadData($date);
        }
    }

    private function loadData(DateTime $date): WeatherOnDay
    {
        $path = $this->url . '?' . http_build_query([
                'q' => $this->q,
                'date' => $date->format('Y-m-d'),
                'appid' => $this->key,
                'units' => 'metric',
                'lang' => 'ru',
            ]);
        $str = file_get_contents($path);
        $data = json_decode($str, true);
        return new WeatherOnDay($date,
            (float)$data['main']['temp'],
            (float)$data['wind']['speed'],
            (int)$data['wind']['deg'],
            (int)$data['main']['pressure'],
            (int)$data['main']['humidity']);
    }

}