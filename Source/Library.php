<?php namespace Hive\Benchmark;

/**
 * Benchmark Library.
 *
 * The actual benchmark library, which does the core operations.
 *
 * @author Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package Hive
 * @subpackage Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Library implements Contract\Library
{

    /**
     * Default configuration settings.
     *
     * config['memory'] array Whether or not to benchmark memory useage, uses memory_get_usage()
     *
     * @var array ['enabled'] : boolean : Whether or not the benchmark is enabled, set to false if you wish to disabled on production
     * @var array ['memory'] : boolean : Whether or not to benchmark memory useage, uses memory_get_usage()
     * @var array ['decimals'] : integer : The number of decimals to benchmark against
     */
    private $config = [
        'timer'     => true,
        'memory'    => true,
        'decimals'  => 9
    ];

    /**
     * Internal storage for benchmarks.
     *
     * @var array
     */
    protected $marks = [];


    /**
     * Library constructor.
     *
     * @param array $config
     *
     * @throws Exception\RequiresMemoryGetUsage
     */
    public function __construct(array $config = [])
    {
        /**
         * Merge the received config with the defaults.
         */
        $this->config = array_merge($config, $this->config);

        // sanity check upon memory
        if ($this->config['memory']) {

            // if enabled ensure we can get it
            if (!function_exists('memory_get_usage')) {
                
                throw new Exception\RequiresMemoryGetUsage();
            }
        }
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
        // create the parent holder
        if (!isset($this->marks[$name])) {
            $this->marks[$name] = [];
        }

        // initialise the variable
        $mark = [];

        // get the benchmarks
        $this->timer($mark['timer']['start']);
        $this->memory($mark['memory']['start']);

        // Add the item to the top of its array
        array_unshift($this->marks[$name], $mark);
    }

    /**
     * Stop a benchmark.
     *
     * @param $name string benchmark name
     *
     * @throws \Hive\Benchmark\Exception\StoppedRunning
     * @throws \Hive\Benchmark\Exception\NotRunning
     *
     * @return void
     */
    public function stop($name)
    {
        // GIGO : The benchmark we are attempting to stop has been started
        if (isset($this->marks[$name])) {

            // Just an alias
            $mark = &$this->marks[$name][0];

            // GIGO : It hasn't already been stopped
            if (!isset($mark['timer']['stop'])) {

                // Assign the stop values
                $this->timer($mark['timer']['stop']);
                $this->memory($mark['memory']['stop']);

            } else {

                throw new Exception\StoppedRunning($name);
            }

        } else {

            throw new Exception\NotRunning($name);
        }
    }

    /**
     * Sets the current time into supplied variable.
     * @param $variable
     */
    private function timer(&$variable)
    {
        // If the timer benchmark is enabled
        if ($this->config['timer']) {
            $variable = microtime(true);
        }
    }

    /**
     * Sets the current memory usage into supplied variable.
     * @param $variable
     */
    private function memory(&$variable)
    {
        // If the memory benchmark is enabled
        if ($this->config['memory']) {
            $variable = memory_get_usage();
        }
    }


    /**
     * Get a benchmark.
     *
     * @param $name string the name of the benchmark to get
     *
     * @throws \Hive\Benchmark\Exception
     * @throws \Hive\Benchmark\Exception\StoppedRunning
     * @throws \Hive\Benchmark\Exception\NotRunning
     *
     * @return array|bool Either an array of requested marks or false on fail
     */
    public function details($name)
    {
        $result = false;

        if (isset($this->marks[$name])) {
            /**
             * Trying to get the details on a benchmark still running!
             * Auto stop any running benchmarks in-case of error.
             */
            if (!isset($this->marks[$name][0]['timer']['stop'])) {
                $this->stop($name);
            }

        } else {
            /**
             * There is no exception with that name running
             */
            throw new Exception\NotRunning($name);
        }

        $result = $this->retrieve($name);

        return $result;
    }

    /**
     * Retrieve an all benchmarks of a perticular name
     * from the internal marks storage array.
     *
     * Internal process, no gigo/sanity
     *
     * @param $name
     *
     * @throws \Hive\Benchmark\Exception
     *
     * @return array
     */
    protected function retrieve($name)
    {
        try
        {
            // Initialise the variables
            $time       = 0;
            $memory     = 0;
            $results    = [];

            /**
             * Return the time between the start and stop points for each
             * of the benchmarks with the requested name. Then update them
             * as a whole.
             */
            for ($i = 0; $i < count($this->marks[$name]); $i++) {

                // Just an alias
                $mark = &$this->marks[$name][$i];
                $time += $mark['timer']['stop'] - $mark['timer']['start'];

                if (isset($mark['memory'])) {
                    $memory += $mark['memory']['stop'] - $mark['memory']['start'];
                }

                $result = [
                    'time'   => number_format($time, $this->config['decimals']),
                    'count'  => count($this->marks[$name])
                ];

                // If memory has been assigned
                if ($memory) {
                    $result['memory'] = $memory;
                }

                $results[] = $result;
            }

        } catch (\Exception $e) {

            throw new Exception($e->getMessage(), $e->getCode());
        }

        return $results;
    }

}