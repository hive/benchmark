<?php namespace Hive\Benchmark;

/**
 * Benchmark Instance.
 *
 * Allows access to the benchmark object through a instance as a singleton.
 *
 * @todo remove methods and add __callStatic, direct access to the object
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Trace extends Instance
{

    public static function start ($name = false, $separator = '.')
    {
        $name = ($name) ? $separator . $name : $name;
        self::method('start', 4, $name);
    }

    public static function stop ($name = false, $separator = '.')
    {
        $name = ($name) ? $separator . $name : $name;
        self::method('stop', 4, '.' . $name);
    }
}
