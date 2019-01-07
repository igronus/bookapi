<?php

namespace App;

use Illuminate\Support\Facades\Cache;

/**
 * The implementation is responsible for putting/getting cached data.
 *
 * @author igronus
 */
class Cacher implements CacherInterface
{
    private $minutes;

    public function __construct($minutes = 5)
    {
        $this->minutes = $minutes;
    }

    function put($key, $value)
    {
        Cache::put($key, $value, $this->minutes);
    }

    function get($key)
    {
        return Cache::get($key);
    }
}
