<?php

/**
 * The instance::method() will automate the use of any benchmarks.
 * By not only assigning a name (based on the class/method its called with in), but also
 * automatically determining whether it is a start or a stop action
 */

// Include the package, using the simple php include
include __DIR__ . '/../include.php';

class Apple
{

    // Use the benchmark
    use Hive\Benchmark;

    public function foo ()
    {
        Benchmark\Instance::method();
        $this->bar();
        Benchmark\Instance::method();
    }

    public function bar ()
    {
        Benchmark\Instance::method();
        sleep(1);
        Benchmark\Instance::method();
    }
}

$helloWorld = new Apple();
$helloWorld->foo();

// print a summary of the benchmark
print_r(Benchmark\Instance::summary());