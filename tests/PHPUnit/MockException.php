<?php

/**
 * Class MockException
 *
 * Extend the benchmark object and force an exception
 */
class MockException extends \Hive\Benchmark\Object
{
   public function SetMarksToNull()
   {
       $this->marks= null;
   }

   public function SetMarksTimeToZero($name){

       $this->marks[$name][0]['time']['start'] = 0;
       $this->marks[$name][0]['time']['stop'] = 0;
   }

    public function SetConfigToNull()
    {
        $this->config= null;
    }
}

