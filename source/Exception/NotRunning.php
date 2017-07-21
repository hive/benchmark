<?php namespace Hive\Benchmark\Exception;

/**
 * Finished Running Exception.
 *
 * Called when the library attempts to stop a benchmark which was not started.
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class NotRunning extends \Hive\Benchmark\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 3;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'A benchmark named :name was not started.';

    /**
     * Not Running Constructor, assigns exception code the message.
     *
     * Will also place the name of the benchmark into the exception message if we have it.
     *
     * @param string $name the name of the benchmark which was not started
     */
    public function __construct($name)
    {
        $code = self::CODE;
        $message = strtr(self::MESSAGE, [':name' => $name]);

        parent::__construct($message, $code);
    }
}
