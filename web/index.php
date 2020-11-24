<?php

include_once 'srv/Weather.php';
include_once 'srv/Cache.php';
include_once 'ent/WeatherOnDay.php';

try {
    $srvWeather = new srv\Weather('Moscow', new srv\Cache);
    $date = DateTime::createFromFormat('Y-m-d', $_GET['date'] ?? date('Y-m-d'));
    $entWeather = $srvWeather->getWeatherOnDay($date);
    echo $entWeather->toJson();
} catch (Throwable $e) {
    echo json_encode([
        'error' => $e->getMessage(),
    ]);
}

