<?php

namespace App;

/**
 * This interface is used to guarantee correct methods and arguments existing.
 *
 * @author igronus
 */
interface CacherInterface
{
    function put($key, $value);

    function get($key);
}
