<?php namespace Hive\Benchmark\Contract;

/**
 * Instance Interface.
 *
 * Interface for use with the instances.
 *
 * @author Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package Hive
 * @subpackage Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
interface Instance
{
    /**
     * Start a benchmark of given name.
     *
     * An Alias for the object's start method.
     *
     * @param string $name the benchmark to start.
     *
     * @return void
     */
    public static function start($name);

    /**
     * Stops a benchmark of given name.
     *
     * An Alias for the object's stop method.
     *
     * @param string $name the benchmark to stop.
     *
     * @return void
     */
    public static function stop($name);

    /**
     * Get a benchmark of given name.
     *
     * An Alias for the object's get method.
     *
     * @param string $name the benchmark to get.
     *
     * @return array
     */
    public static function get($name);

    /**
     * Get the details of a benchmark of given name.
     *
     * An Alias for the libraries' details method.
     *
     * @param string $name the benchmark to get details for.
     *
     * @return array
     */
    public static function details($name);

    /**
     * Get a summary of all benchmarks.
     *
     * An Alias for the object's summary method.
     *
     * @return array
     */
    public static function summary();

    /**
     * Start/Stop a benchmark with the current 'methods' name.
     *
     * @return void
     */
    public static function method();
}
