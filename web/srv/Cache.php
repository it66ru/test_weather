<?php

namespace srv;

use Redis;

class Cache
{
    private static $redis;

    private static function conn()
    {
        if (!self::$redis) {
            self::$redis = new Redis();
            self::$redis->connect('redis', 6379);
        }
        return self::$redis;
    }

    public function get(string $key): ?string
    {
        return self::conn()->get($key);
    }

    public function set(string $key, string $str): void
    {
        self::conn()->set($key, $str);
    }

}