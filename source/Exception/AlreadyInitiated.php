<?php namespace Hive\Benchmark\Exception;

/**
 * Extends Hive\Benchmark\Exception
 */
use Hive\Benchmark\Exception;

/**
 * Already Initiated Exception.
 *
 * Called when the instance attempts to change it's configuration settings after it has been previously initiated
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2017 Jamie Peake
 */
class AlreadyInitiated extends Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 4;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'The benchmark instance has already been initiated, changing its configuration must be done prior to it being called.';

    /**
     * Finished Running Constructor, assigns exception code and places the message.
     *
     * Will also place the name of the benchmark into the exception message if we have it
     */
    public function __construct()
    {
        $code = self::CODE;
        $message = self::MESSAGE;

        parent::__construct($message, $code);
    }
}
