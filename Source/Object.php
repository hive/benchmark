<?php namespace Hive\Benchmark;


    /**
     * Object Library.
     *
     * Allows access to the library through an object.
     *
     * @author Jamie Peake <jamie.peake@gmail.com>
     * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
     *
     * @package Hive
     * @subpackage Benchmark
     *
     * @copyright (c) 2016 Jamie Peake
     */
    class Object extends Library implements Contract\Object
    {
        /**
         * Default configuration settings.
         *
         * config['enabled'] boolean Whether or not the benchmark is enabled, set to false if you wish to disabled on production
         *
         * @var array config default object configuration for the library
         */
        private $config = [
            'enabled' => true,
            'decimals' => 9
        ];

        /**
         * Object constructor.
         *
         * @param array $config
         *
         * @throws Exception\RequiresMemoryGetUsage
         */
        public function __construct($config = []) {

            /**
             *  Merge the received config with the defaults
             */
            $this->config = array_merge($config, $this->config);

            parent::__construct($config);

        }

        /**
         * Start a benchmark.
         *
         * @param $name string benchmark name
         *
         * @return void
         */
        public function start($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                parent::start($name);
            }
        }

        /**
         * Stop a benchmark.
         *
         * @param $name string benchmark name
         *
         * @return void
         */
        public function stop ($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                parent::stop($name);
            }

        }

        /**
         * Get details of a benchmark.
         *
         * @param $name string benchmark name
         *
         * @return void
         */
        public function get($name)
        {
            // Config Check : Are Benchmarks enabled
            if ($this->config['enabled']) {
                return parent::get($name);
            }
        }

        /**
         * Retrieve an summary of benchmark.
         *
         * Rather then retreive all of the benchmark data, this instead
         * will gather all benchmarks with the same name and return an array
         * including, total, count, min, max, mean and median values of the benchmar
         *
         * @param $name
         *
         * @throws \Hive\Benchmark\Exception
         *
         * @return array
         */
        public function summary($name = false)
        {
            try
            {
                // Initialise the variables
                $time = $memory = [];

                $marks = $this->retrieve($name);

                // Gather the totals
                foreach ($marks as $mark) {
                    $time[] = $mark['time'];
                    $memory[] = $mark['memory'];
                }

                $result = [
                    'count' => count($time),
                    'time' => $this->calculate($time, $this->config['decimals']),
                    'memory' => $result['memory'] = $this->calculate($memory)
                ];

            }
            catch (\Exception $e)
            {
                throw new Exception($e->getMessage(), $e->getCode());
            }

            return $result;
        }

        /**
         * Quick function for summary calculations
         *
         * Does a bunch of calculations upon an array of values, returns
         * the result
         *
         * @param $values
         * @param int $decimals
         *
         * @return array
         */
        private function calculate ($values, $decimals = 0)
        {
            return [
                'total' =>  number_format(array_sum($values), $decimals),
                'min' =>  number_format(min($values), $decimals),
                'max' =>  number_format(max($values), $decimals),
                'mean' =>  number_format(array_sum($values) / count($values), $decimals),
                'median' =>  number_format($values[round(count($values) / 2) - 1], $decimals),
            ];
        }

        // @todo : enable
        //public function summary () {
        //
        //    /**
        //     *They want a summary of all results
        //     */
        //    $results = [];
        //
        //    $names = array_keys($this->marks);
        //
        //    // Loop through all the benchmarks we have
        //    foreach ($names as $name)
        //    {
        //        $results[$name] = $this->get($name);
        //
        //    }
        //
        //    return $results;
        //
        //}

    }

