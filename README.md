# Hive Benchmark
[![Latest Stable Version](https://poser.pugx.org/hive/benchmark/v/stable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Latest Unstable Version](https://poser.pugx.org/hive/benchmark/v/unstable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![License](https://poser.pugx.org/hive/benchmark/license?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![composer.lock](https://poser.pugx.org/hive/benchmark/composerlock?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Build Status](https://img.shields.io/travis/hive/benchmark/1.0.1.3.svg?style=flat-square)](https://travis-ci.org/hive/benchmark)


Simple decoupled benchmark, Version 1.0.*


## Documentation

https://hive.github.io/benchmark/

## Notes

 * phpUnit is not currently running on the php7 branches, due to the changes in its namespaces.
 * PhpMetrics scores are not currently taking into account phpUnit test or code coverage.

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "Hive/Benchmark": "1.0.*"
    }
}
```

Via Composer Command line

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php

# Install the latest version
composer require Hive/Benchmark

```

```php
// With in your php file, include composers autoloader
require 'vendor/autoload.php';
```

Via Git

```bash
# Clone the repo
cd helloworld.dev
git clone https://github.com/hive/benchmark.git .
```

```php
// With in your php file, include composers autoloader
require 'hive/benchmark/include.php';
```

## Overview

The code is split up into the following classes :

1. Library.php : The actual benchmarking library, useful for extending functionality.
2. Object.php : Class for accessing the benchmark object.
3. Instance.php : Instance of the object class.

## Useage
-------
 ```php
    use Hive\Benchmark;
 ```


 Simple Instance
 ```php

    // Start the benchmark
    Benchmark\Instance::start('NameOfBenchmark');

    sleep(1);

    // Stop the benchmark
    Benchmark\Instance::stop('NameOfBenchmark');

 ```

**Multiple Instance**

 ```php
    use Hive\Benchmark;

    // Start the benchmark
    Benchmark\Instance::start('FirstBenchmark');

    // start a second benchmark
    Benchmark\Instance::start('SecondBenchmark');

    sleep(1);

    // Stop the second benchmark
    Benchmark\Instance::stop('SecondBenchmark');

    sleep(1);

    // Stop the benchmark
    Benchmark\Instance::stop('FirstBenchmark');
    echo '<pre>';
    // get the results of the benchmarks
    print_r(Benchmark\Instance::get('FirstBenchmark'));
    print_r(Benchmark\Instance::get('SecondBenchmark'));
```

The above example will output

```php
    /**
     * Output
     */
    Array
    (
        [count] => 1
        [time] => Array
        (
            [total] => 2.00218701
            [min] => 2.00218701
            [max] => 2.00218701
            [mean] => 2.00218701
            [median] => 2.00218701
        )
        [memory] => Array
        (
            [total] => 2,424
            [min] => 2,424
            [max] => 2,424
            [mean] => 2,424
            [median] => 2,424
        )
    )
    Array
    (
        [count] => 1
        [time] => Array
        (
            [total] => 1.00193310
            [min] => 1.00193310
            [max] => 1.00193310
            [mean] => 1.00193310
            [median] => 1.00193310
        )
        [memory] => Array
        (
            [total] => 648
            [min] => 648
            [max] => 648
            [mean] => 648
            [median] => 648
        )
    )

 ```


All of which can be called directly from the object

```php

    $bm = new \Hive\Benchmark\Object();

    $bm->start('MyNewBenchmark');

    $bm->stop('MyNewBenchmark');

    print_r($bm->summary());

```


Using the config

```php

    $config = [
        'enabled'   => true,    // whether or not the benchmark is enabled.
        'timer'     => true,    // whether or not to benchmark time.
        'memory'    => true,    // whether or not to benchmark memory.
        'decimaals' => 8        // number of decimal points to report on
    ];

    // disabling benchmarking on production servers is easy
    $config['enabled'] = (IN_DEVELOPMENT || IN_STAGING);

    $bench = new \Hive\Benchmark\Object($config);

```

## Advance

The benchmark library has many more options and features, to view them please see our [examples](https://github.com/hive/benchmark/tree/master/examples)


## File Map

The code is split up into the following classes :

1. [tests](tests) : folder for any unit testing
2. [examples](examples) : folder for any examples
3. [docs](docs) : folder for any documentation
4. [source](source) : folder for source code
    1. [Library](source/Library.php) : The actual benchmarking library, useful for extending functionality.
        *  __construct( array $config )
        *  start         (string $nameOfBenchmark)
        * stop          (string $nameOfBenchmark)
        * details       (string $nameOfBenchmark)
    2. [Object](source/Object.php) : Class for accessing the benchmark object.
        * __construct( array $config )
        * start         (string $nameOfBenchmark)
        * stop          (string $nameOfBenchmark)
        * details       (string $nameOfBenchMark)
        * get           (string $nameOfBenchMark)
        * summary       ()
    3. [Instance](source/Instance.php) : Instance of the object class.
        * static start  (string $nameOfBenchmark)
        * static stop   (string $nameOfBenchmark)
        * static details(string $nameOfBenchMark)
        * static get    (string $nameOfBenchMark)
        * static summary()
        * static method (string $action, integer $stack)
    4. [Exception](source/Exception) : Folder for any exceptions the object will throw.
        * [AlreadyRunning](source/Exception/AlreadyRunning.php)
        * [NotRunning](source/Exception/NotRunning.php)
        * [StoppedRunning](source/Exception/StoppedRunning.php)
    5. [Contract](source/Contract) : folder for any interfaces or abstract classes they implement
        * [Instance](source/Contract/Instance.php)
        * [Library](source/Contract/Library.php)
        * [Object](source/Contract/Object.php)

The full API documentation can be found [here](https://hive.github.io/benchmark/html/phpdox/index.xhtml) or all the documentation can be found [here](https://hive.github.io/benchmark/)