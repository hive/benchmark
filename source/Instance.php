<?php namespace Hive\Benchmark;

/**
 * Benchmark Instance.
 *
 * Allows access to the benchmark object through a instance as a singleton.
 *
 * @todo 1.0.1.0 add the ability to get the total time.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 *
 * @method static void start(string $name)
 * @method static void stop(string $name)
 * @method static array details(string $name)
 * @method static array get(string $name)
 */
class Instance implements Contract\Instance
{
    /**
     * Singleton.
     * @var \Hive\Benchmark\Object
     */
    private static $object;

    /**
     * Stores method names, for use the the method().
     * @var array
     */
    private static $methods = [];


    /**
     * Benchmark can access the object methods directly.
     *
     * @example Hive\Benchmark::start();
     *
     * @param $name name of the static function called
     * @param $arguments any arguments supplied.
     *
     * @return \Hive\Benchmark\Object
     *
     * @throws Exception\AlreadyInitiated
     * @throws Exception\BadMethodCall
     */
    public static function __callStatic($name, $arguments)
    {
        if (method_exists(self::load(), $name))
        {
            return self::load()->$name($arguments[0]);
        }

        // Throw a Bad Method call as the method wasn't found.
        throw new Exception\BadMethodCall(__CLASS__, $name);
    }


    /**
     * Load the instance.
     *
     * Will create the object if it does not exist or return it if previously created.
     *
     * @throws Exception\AlreadyInitiated
     * @return \Hive\Benchmark\Object the instance
     */
    public static function load($config = [])
    {
        if (is_null(self::$object))
        {
            self::$object = new Object($config);
        }
        else
        {
            // If the user is attempting to change the config after the object was previously created
            if (count($config))
            {
                throw new Exception\AlreadyInitiated();
            }
        }
        return self::$object;
    }


    /**
     * Static Alias to the Benchmark/Object/Summary.
     *
     * We use this rather then relying on the __callStatic, due to
     * not having php5.6 support and the unpack.
     *
     * @return array
     */
    public static function summary()
    {
        return self::load()->summary();
    }


    /**
     * Auto Method for setting benchmarks on a method.
     *
     * Adds the ability to start and stop a mark with out requiring its name.
     * or even setting whether to start/stop.
     *
     * @param string $action (auto|start|stop) auto will determine whether to start or stop.
     * @param int $stack     how far in the stacktrace to go back.
     * @param string $append any additional text to append to the method.
     *
     * @depreciated Please use the trace facade instead.
     * @see \Hive\Benchmark\Trace
     */
    public static function method($action = 'auto', $stack = 3, $append = '')
    {
        // Get the name of the caller method
        $name = self::trace($stack) . $append;

        /**
         * If its an auto, find out what method to run.
         */
        if ($action == 'auto')
        {
            /**
             * We don't have an active benchmark for this method
             * so it must be a start action.
             */
            if (!isset(self::$methods[$name]))
            {
                // Set the benchmark to start()
                $action = 'start';

                // Add the benchmark to our list of running methods
                self::$methods[$name] = true;
            }
            else
            {
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
     * @param  int $stack How far in the stacktrace to go back.
     *
     * @return string $name   The caller class/method.
     */
    private static function trace($stack = 2)
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $stack)[$stack - 1];
        return $caller['class'] . '\\' . $caller['function'];
    }


    /**
     * Allows the destruction of the instance.
     *
     * This is used for Unit testing the instance.
     */
    public static function destroy()
    {
        self::$object = null;
    }
}
