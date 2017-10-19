<?php namespace Hive\Benchmark\Exception;

/**
 * Extends Hive\Benchmark\Exception
 */
use Hive\Benchmark\Exception;

/**
 * Finished Running Exception.
 *
 * Called when the library attempts to stop a benchmark which has already been stopped.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class StoppedRunning extends Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 1;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'A benchmark named :name has already been stopped.';

    /**
     * Finished Running Constructor, assigns exception code and places the message.
     *
     * Will also place the name of the benchmark into the exception message if we have it
     *
     * @param string $name of the benchmark which has already finished
     */
    public function __construct($name)
    {
        $code = self::CODE;
        $message = strtr(self::MESSAGE, [':name' => $name]);

        parent::__construct($message, $code);
    }
}
