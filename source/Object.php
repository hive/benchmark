<?php namespace Hive\Benchmark;

/**
 * Object Library.
 *
 * Allows access to the library through an object.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Object extends Library implements Contract\Object
{
    /**
     * Default configuration settings.
     *
     * config['enabled'] boolean Whether or not the benchmark is enabled,
     * set to false if you wish to disabled on production.
     *
     * @var array config default object configuration for the library.
     */
    protected $config = [
        'enabled'  => true,
        'decimals' => 8
    ];

    /**
     * Object constructor.
     *
     * @param array $config
     *
     * @throws Exception\RequiresMemoryGetUsage
     */
    public function __construct($config = [])
    {
        // Merge the received config with the defaults
        $this->config = array_merge($this->config, $config);
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
        if ($this->config['enabled'])
        {
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
    public function stop($name)
    {
        // Config Check : Are Benchmarks enabled
        if ($this->config['enabled'])
        {
            parent::stop($name);
        }
    }

    /**
     * Get details of a benchmark.
     *
     * @param $name string benchmark name
     *
     * @return array
     */
    public function details($name)
    {
        // Config Check : Are Benchmarks enabled
        if ($this->config['enabled'])
        {
            return parent::details($name);
        }

        return [];
    }

    /**
     * Retrieve an summary of benchmark.
     *
     * Rather then retrieve all of the benchmark data, this instead
     * will gather all benchmarks with the same name and return an array
     * including, total, count, min, max, mean and median values of the benchmark
     *
     * @param $name
     *
     * @throws \Hive\Benchmark\Exception
     *
     * @return array
     */
    public function get($name = false)
    {
        try
        {
            // Initialise the variables
            $time = $memory = [];

            $marks = $this->retrieve($name);

            // Gather the totals
            foreach ($marks as $mark)
            {
                $time[] = $mark['time'];
                $memory[] = $mark['memory'];
            }

            $result = [
                'count'  => count($time),
                'time'   => $this->calculate($time, $this->config['decimals']),
                'memory' => $result['memory'] = $this->calculate($memory)
            ];
        }
        catch(Exception $e)
        {
            // Simply Rethrow any benchmark exceptions.
            throw $e;
        }
        catch (\Exception $e)
        {
            // Catch all, convert any unexpected exception into a benchmark exception.
            throw new Exception($e->getMessage(), $e->getCode());
        }

        return $result;
    }


    /**
     * Gathers all of the benchmarks results and returns a summary
     *
     * @return array
     */
    public function summary()
    {
        $results = [];

        // Loop through all marks
        foreach (array_keys($this->marks) as $mark)
        {
            // 'get' the actual marks results, and assign it.
            $results[$mark] = $this->get($mark);
        }

        return $results;
    }

    /**
     * Quick function for summary calculations.
     *
     * Does a bunch of calculations upon an array of values, returns
     * the result.
     *
     * @todo v1.1.0.0 whether or not the number format is ran should be a parameter
     *
     * @param $values
     * @param int $decimals
     *
     * @throws \Hive\Benchmark\Exception
     *
     * @return array
     */
    private function calculate($values, $decimals = 0)
    {
        // remove any values which are 0
        $values = array_values(array_filter($values));

        try
        {
            if (count($values))
            {
                return [
                    'total'  => number_format(array_sum($values), $decimals, '.', ''),
                    'min'    => number_format(min($values), $decimals, '.', ''),
                    'max'    => number_format(max($values), $decimals, '.', ''),
                    'mean'   => number_format(array_sum($values) / count($values), $decimals, '.', ''),
                    'median' => number_format($values[round(count($values) / 2) - 1], $decimals, '.', ''),
                ];
            }
            else
            {
                return [
                    'total'  => false,
                    'min'    => false,
                    'max'    => false,
                    'mean'   => false,
                    'median' => false,
                ];
            }
        }
        catch (\Exception $e)
        {
            // Catch all, convert any unexpected exception into a benchmark exception.
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
