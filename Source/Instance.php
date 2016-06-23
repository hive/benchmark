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
    class Instance extends Object
    {

        public static function start ($name = false)
        {

           $name = ($name) ? $name : self::trace(3);

           parent::start($name);

        }

        public static function stop ($name = false)
        {

            $name = ($name) ? $name : self::trace(3);
            
            parent::stop($name);

        }

        /**
         * Todo move to debug package?
         * 
         * @param int $stack
         */
        public static function trace($stack = 2)
        {
            $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,$history)[$history - 1];
            $name = $caller['class'] . '\\' .$caller['function'];
        }
    }