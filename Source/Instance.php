<?php namespace Hive\Benchmark;

/**
 * Benchmark Instance.
 *
 * Allows access to the benchmark object through a instance.
 *
 * @author Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package Hive
 * @subpackage Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Instance implements Contract\Instance
{

    private static $object;
    private static $methods = [];

    /**
     * Initialise the instance.
     *
     * Will create the object if it does not exist.
     */
    private static function init()
    {
        if (is_null(self::$object)) {
            self::$object = new Object();
        }
    }

    /**
     * Static Alias to the Benchmark/Object/Start.
     *
     * @param  string $name The benchmark to start.
     * @return void
     */
    public static function start($name)
    {
        self::init();

        self::$object->start($name);
    }

    /**
     * Static Alias to the Benchmark/Object/Stop.
     *
     * @param  string $name The benchmark to stop.
     * @return void
     */
    public static function stop($name)
    {
        self::init();

        self::$object->stop($name);
    }

    /**
     * Static Alias to the Benchmark/Object/Details.
     *
     * @param  string $name The benchmark to get
     * @return array
     */
    public static function details($name)
    {
        self::init();

        return self::$object->details($name);
    }

    /**
     * Static Alias to the Benchmark/Object/Get.
     *
     * @param  string $name The benchmark to get a summary of.
     * @return array
     */
    public static function get($name)
    {
        self::init();

        return self::$object->get($name);
    }

    /**
     * Static Alias to the Benchmark/Object/Summary.
     *
     * @return array
     */
    public static function summary()
    {
        self::init();

        return self::$object->summary();
    }


    /**
     * Auto Method for setting benchmarks on a method, with out requiring its name.
     * or even setting whether to start/stop.
     *
     * @param string $action (auto|start|stop) auto will determine whether to start or stop.
     * @param int    $stack  how far in the stacktrace to go back.
    */
    public static function method($action = 'auto', $stack = 3)
    {
        // Get the name of the caller method
        $name = self::trace($stack);

        /**
         * If its an auto, find out what method to run.
         */
        if ($action == 'auto') {

            /**
             * We dont have an active benchmark for this method
             * so it much be a start action.
             */
            if (!isset(self::$methods[$name])) {

                // Set the benchmark to start()
                $action = 'start';

                // Add the benchmark to our list of running methods
                self::$methods[$name] = true;

            } else {

                // Set the benchmark to stop()
                $action = 'stop';

                // Remove the benchmark from our list of running methods
                unset(self::$methods[$name]);

            }
        }

        // run the action
        self::$action($name);
    }


    /**
     * Simple debug_backtrace to get the name of the method which called.
     *
     * @param  int    $stack How far in the stacktrace to go back.
     * @return string $name   The caller class/method.
     */
    private static function trace($stack = 2)
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $stack)[$stack - 1];
        return $caller['class'] . '\\' .$caller['function'];
    }
}