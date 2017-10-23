<?php namespace Hive\Benchmark\Exception;

/**
 * Bad Method Call Exception.
 *
 * Attempted to call a method which does not exist.
 * This Exception exists to handle invalid calls with in __call()
 *
 * @author        Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/locator/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package       Hive
 * @subpackage    Benchmark
 *
 * @copyright (c) 2017 Jamie Peake
 */
class BadMethodCall extends \Hive\Benchmark\Exception
{
    /**
     * Exception code, sequential exception numbers.
     */
    const CODE = 5;

    /**
     *  Exception Message to be displayed.
     */
    const MESSAGE = 'Call to undefined method :class:::method()';

    /**
     * Bd Method Call constructor, assigns exception code the message.
     *
     * Will also place the name of the class into the exception message if we have it.
     * @param string $class the class which was called
     * @param string $method the method which doesn't exist
     */
    public function __construct($class, $method)
    {
        $code = self::CODE;

        $message = strtr(self::MESSAGE, [':class' => $class, ':method' => $method]);

        parent::__construct($message, $code);
    }
}
