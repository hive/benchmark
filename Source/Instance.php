<?php namespace Hive\Benchmark;

    /**
     * Benchmark Instance.
     *
     * Allws access to the benchmark object through a instance.
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

        private static function init() {

            if (is_null(self::$object)) {
                self::$object = new Object();
            }

        }

        /**
         * Static Alias to the Benchmark/Object/Start
         * @param string $name name of the benchmark to start
         */
        public static function start ($name)
        {
            self::init();

            self::$object->start($name);
        }

        /**
         * Static Alias to the Benchmark/Object/Stop
         * @param string $name name of the benchmark to stop
         */
        public static function stop ($name)
        {
            self::init();

            self::$object->stop($name);
        }

        /**
         * Static Alias to the Benchmark/Object/Get
         * @param string $name name of the benchmark to get
         */
        public static function details($name)
        {
            self::init();

            return self::$object->details($name);
        }

        /**
         * Static Alias to the Benchmark/Object/Summary
         * @param string $name name of the benchmark to get a summary of
         */
        public static function get ($name)
        {
            self::init();

            return self::$object->get($name);
        }

        public static function summary() {
            self::init();

            return self::$object->summary();
        }

        /**
         * Auto Method for setting benchmarks on a method, with out requiring its name
         * or even setting whether to start/stop.
         *
         * @param string $action (auto|start|stop) auto wil determine whether to start or stop
         */
        public static function method($action = 'auto', $stack = 3)
        {
            // Get the name of the caller method
            $name = self::trace($stack);

            /**
             * If its an auto, find out what method to run
             */
            if ($action == 'auto')
            {
                /**
                 * We dont have an active benchmark for this method
                 * so it much be a start action.
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
         * Simple debug_backtrace to get the name of the method which called
         *
         * @param int $stack
         * @return string $name Name of the caller class/method
         */
        private static function trace($stack = 2)
        {
            $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,$stack)[$stack - 1];
            return $caller['class'] . '\\' .$caller['function'];
        }
    }