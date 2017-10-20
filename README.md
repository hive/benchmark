# Hive Benchmark
[![Latest Stable Version](https://poser.pugx.org/hive/benchmark/v/stable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Latest Unstable Version](https://poser.pugx.org/hive/benchmark/v/unstable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![License](https://poser.pugx.org/hive/benchmark/license?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![composer.lock](https://poser.pugx.org/hive/benchmark/composerlock?format=flat-square)](https://packagist.org/packages/hive/benchmark)


Simple decoupled benchmark, Version 1.0 currently being developed

## Notes

## Installation

Recommended installation [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "Hive/Benchmark": "dev-master"
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
 
**Multiple Instances with the same name**

```php
     
     use Hive\Benchmark;
         
     // Start the benchmark
     Benchmark\Instance::start('FirstBenchmark');
 
     for ($i=rand(1,100); $i>0; $i--) {
 
         // start another benchmark
         Benchmark\Instance::start('SubBenchmark');
 
         // Do Some Actions
 
         // Stop the other benchmark
         Benchmark\Instance::stop('SubBenchmark');
     }
 
     sleep(1);
 
     // Stop the benchmark
     Benchmark\Instance::stop('FirstBenchmark');
 
     // Get a summary of all benchmarks
     print_r(Benchmark\Instance::summary());
         
```

The above example will output 
         
```php
         /**
          * Output
          */
         Array
         (
             [FirstBenchmark] => Array
             (
                 [count] => 1
                 [time] => Array
                 (
                     [total] => 1.00409699
                     [min] => 1.00409699
                     [max] => 1.00409699
                     [mean] => 1.00409699
                     [median] => 1.00409699
                 )
                 [memory] => Array
                 (
                     [total] => 117,120
                     [min] => 117,120
                     [max] => 117,120
                     [mean] => 117,120
                     [median] => 117,120
                 )
             )
         
             [SubBenchmark] => Array
             (
                 [count] => 79
                 [time] => Array
                 (
                     [total] => 0.08011698
                     [min] => 0.00003004
                     [max] => 0.00176811
                     [mean] => 0.00101414
                     [median] => 0.00101900
                 )
                 [memory] => Array
                 (
                     [total] => 1,183,976
                     [min] => 360
                     [max] => 29,712
                     [mean] => 14,987
                     [median] => 14,936
                 )
             )         
         )
         
```
   
Using the Method

```php
    
  public class foo {
   
      use Hive\Benchmark;
      
      class apple {
  
  
  
          public function foo () {
              Benchmark\Instance::method();
              $this->bar();
              Benchmark\Instance::method();
          }
  
          public function bar () {
  
              Benchmark\Instance::method();
              sleep(1);
              Benchmark\Instance::method();
          }
      }
      
      
          $helloWorld = new apple();
          $helloWorld->foo();
      
          print_r(Benchmark\Instance::summary());
          
```
  The above example will output 
  
```php
          
          /**
           * Output
           */
          Array
          (
              [apple\foo] => Array
              (
                  [count] => 1
                  [time] => Array
                  (
                      [total] => 1.00055385
                      [min] => 1.00055385
                      [max] => 1.00055385
                      [mean] => 1.00055385
                      [median] => 1.00055385
                  )
                  [memory] => Array
                  (
                      [total] => 2,328
                      [min] => 2,328
                      [max] => 2,328
                      [mean] => 2,328
                      [median] => 2,328
                  )
              )
              [apple\bar] => Array
              (
                  [count] => 1
                  [time] => Array
                  (
                      [total] => 1.00045204
                      [min] => 1.00045204
                      [max] => 1.00045204
                      [mean] => 1.00045204
                      [median] => 1.00045204
                  )
                  [memory] => Array
                  (
                      [total] => 496
                      [min] => 496
                      [max] => 496
                      [mean] => 496
                      [median] => 496
                  ) 
              )
          )
          
   
```   
   
All of which (other the instance::method()) can be called directly from the object 

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

## File Map

The code is split up into the following classes : 


1. /Tests : folder for any unit testing
2. /Examples : folder for any examples
3. /Documents : folder for any documentation  
4. /Source : folder for source code
    1. Library.php : The actual benchmarking library, useful for extending functionality.
        *  __construct( array $config )
        *  start         (string $nameOfBenchmark) 
        * stop          (string $nameOfBenchmark) 
        * details       (string $nameOfBenchmark) 
    2. Object.php : Class for accessing the benchmark object.
        * __construct( array $config )
        * start         (string $nameOfBenchmark)
        * stop          (string $nameOfBenchmark)
        * details       (string $nameOfBenchMark)
        * get           (string $nameOfBenchMark)
        * summary       ()
    3. Instance.php : Instance of the object class.
        * static start  (string $nameOfBenchmark)
        * static stop   (string $nameOfBenchmark)
        * static details(string $nameOfBenchMark)
        * static get    (string $nameOfBenchMark)
        * static summary()
        * static method (string $action, integer $stack)
    4. Exception : Folder for any exceptions the object will throw.
        * AlreadyRunning.php
        * NotRunning.php
        * StoppedRunning.php
    5. Contact : folder for any interfaces or abstract classes they implement
        * Instance.php
        * Library.php
        * Object.php