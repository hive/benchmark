<?php namespace Hive\Benchmark;

    /**
     * @todo :: Code
     */
    class Instance extends Object
    {

        public static function start ($name = false) {

           $name = ($name) ? $name : self::trace(3);

           parent::start($name);

        }

        public static function stop ($name = false) {

            $name = ($name) ? $name : self::trace(3);
            
            parent::stop($name);

        }

        /**
         * Todo move to debug package?
         * 
         * @param int $stack
         */
        public static function trace($stack = 2) {
            $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,$history)[$history - 1];
            $name = $caller['class'] . '\\' .$caller['function'];
        }
    }