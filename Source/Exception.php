<?php namespace Hive\Benchmark;

/**
 * Requires Memory Get Usage Exception.
 *
 * Called when the library has memory benchmarks enabled but no way to get the memory data.
 *
 * @author Jamie Peake <jamie.peake@gmail.com>
 * @licence https://github.com/hive/benchmark/blob/master/LICENSE (BSD-3-Clause)
 *
 * @package Hive
 * @subpackage Benchmark
 *
 * @copyright (c) 2016 Jamie Peake
 */
class Exception extends \Exception
{

    /**
     * Arbitrarily assigned vendor exception code
     * used to prefix all hive exceptions.
     */
    const VENDOR = 8883;

    /**
     * Package exception code, sequential package numbers.
     */
    const PACKAGE = 1;

    /**
     * Exception constructor, assigns the message and code and calls the exception handler.
     *
     * It will prepend the error code with the vendor code, package code and exception code,
     * so that we have a unique exception code.
     *
     * @param null|string $message The exceptions message.
     * @param null|int    $code    The exception code.
     */
    public function __construct($message = null, $code = null)
    {
        // Call the parent with the message and our now unique error code
        parent::__construct($message, self::VENDOR.self::PACKAGE.$code);
    }
}
