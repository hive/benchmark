<?php

/**
 * Class MockException
 *
 * Extend the benchmark object and force an exception
 */
class MockException extends \Hive\Benchmark\Object
{
   public function setUpException()
   {
       $this->marks= ['test' => []];
   }
}

