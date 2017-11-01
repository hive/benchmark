<?php namespace Hive\Benchmark;

/**
 * Benchmark Trace Facade.
 *
 * Allows access to the benchmark instance with auto tracing,
 * this will basically trace where the benchmark was called from and prepend
 * that to the name of the mark. If no name is used it defaults to the trace itself.
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

    /**
     * Default namespace/class/method separator
     */
    const DEFAULT_SEPARATOR = '.';


    /**
     * Start a benchmark trace
     *
     * @param bool   $name
     * @param string $separator
     */
    public static function start($name = false, $separator = self::DEFAULT_SEPARATOR)
    {
        // Call the instance start with our traces' name.
        parent::start(self::name($name, $separator));
    }


    /**
     * Stop a benchmark trace
     *
     * @param bool   $name
     * @param string $separator
     */
    public static function stop($name = false, $separator = self::DEFAULT_SEPARATOR)
    {
        // Call the instance stop with our traces' name.
        parent::stop(self::name($name, $separator));
    }


    /**
     * Retrieve a benchmark trace
     *
     * @param bool   $name
     * @param string $separator
     * @return array
     */
    public static function get($name = false, $separator = self::DEFAULT_SEPARATOR)
    {
        // Call the instance get with our traces' name.
        return parent::get(self::name($name, $separator));
    }


    /**
     * Returns the name of the current benchmark trace
     *
     * @param bool   $name
     * @param string $separator
     *
     * @return bool|string
     */
    public static function name($name = false, $separator = self::DEFAULT_SEPARATOR)
    {
        $name = ($name) ? $separator . $name : $name;
        $name = self::trace(4, $separator) . $name;
        return $name;
    }

    /**
     * Simple debug_backtrace to get the name of the method which called.
     *
     * @param  int $stack How far in the stacktrace to go back.
     * @param string $separator how our namespaces in our trace should be visually separated
     *
     * @return string $name   The caller class/method.
     */
    private static function trace($stack = 2, $separator = '.')
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $stack)[$stack - 1];

        return str_replace('\\', $separator, strtolower($caller['class'])) . $separator . $caller['function'];
    }
}
