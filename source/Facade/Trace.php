<?php namespace Hive\Benchmark;

/**
 * Benchmark Trace Facade.
 *
 * Allows access to the benchmark instance with auto tracing
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


    public static function start($name = false, $separator = '.')
    {
        parent::start(self::name($name, $separator));
    }

    public static function stop($name = false, $separator = '.')
    {
        parent::stop(self::name($name,$separator));
    }

    public static function name ($name = false, $separator = '.')
    {
        $name = ($name) ? $separator . $name : $name;
        $name = self::trace(4, $separator) . $name;
        return $name;
    }



    public static function get($name = false, $separator = '.')
    {
        parent::get(self::name($name,$separator));
    }

    /**
     * Simple debug_backtrace to get the name of the method which called.
     *
     * @param  int $stack How far in the stacktrace to go back.
     *
     * @return string $name   The caller class/method.
     */
    private static function trace($stack = 2, $separator = '.')
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $stack)[$stack - 1];

        return str_replace('\\', $separator, strtolower($caller['class'])) . $separator . $caller['function'];
    }

}
