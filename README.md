# Hive Benchmark
[![Latest Stable Version](https://poser.pugx.org/hive/benchmark/v/stable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Latest Unstable Version](https://poser.pugx.org/hive/benchmark/v/unstable?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![License](https://poser.pugx.org/hive/benchmark/license?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![composer.lock](https://poser.pugx.org/hive/benchmark/composerlock)](https://packagist.org/packages/hive/benchmark)

Simple decoupled benchmark, Version 1.0 currently being developed

Version 1.0 Outstanding Items 
 * Unit Tests
 * Method names to change to
    * get  -> detail : returns the full details
    * summary -> get : returns useful information
    * new method summary : returns all benchmarks useful infomormarion

## Installation

Via Composer

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

```bash
# Install the latest version
composer require hive/benchmark
```

```php
<?php
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
<?php
// With in your php file, include composers autoloader
require 'hive/benchmark/include.php';
```


Code Only

1. [Download the Repo](https://github.com/hive/benchmark/archive/master.zip) 
2. Copy the files to your project
2. Require the include file
```php
    require 'hive/benchmark/include.php';
```

## Overview

The code is split up into the following classes : 

1. Library.php : The actual benchmarking library, useful for extending functionality.
2. Object.php : Class for accessing the benchmark object.
3. Instance.php : Instance of the object class.

## Useage

 ```php
    use hive\benchmark;
 ```
 
 
 Simple Instance
 ```php
 
    // Start the benchmark
    benchmark/instance::start('NameOfBenchmark);
    
    sleep(1);
    
    // Stop the benchmark 
    benchmark/instance::stop('NameOfBenchmark);
 
 ```
 
 Multiple Instance
 ```php
      
    // Start the benchmark
    benchmark/instance::start('NameOfBenchmark);
     
    // start another benchmark
    benchmark/instance::start('AnotherBenchmark);
       
    sleep(1);
       
    // Stop the other benchmark 
    benchmark/instance::stop('AnotherBenchmark);
    
    sleep(1);
      
    // Stop the benchmark 
    benchmark/instance::stop('NameOfBenchmark);
      
    // get a summary of the results 
    print_r(benchmark/instance::summary('NameofBenchmark'));
    print_r(benchmark/instance::summary('AnotherBenchmark'));
    
    // get the complete details of one benchmark name
    print_r(benchmark/instance::get('AnotherBenchmark'));
    
    // @todo get a summary of all benchmarks
    // print_r(benchmark/instance::all());
       
 ```
 
 
 Multiple Instances with the same name
```php
     
     // Start the benchmark
    benchmark/instance::start('NameOfBenchmark);
    
    for ($i=rand(1,100); $i<0; $i--) {
    
      // start another benchmark
      benchmark/instance::start('AnotherBenchmark);
      
      // Do Some Actions
      
      // Stop the other benchmark 
      benchmark/instance::stop('AnotherBenchmark);
    }
    
    sleep(1);
     
    // Stop the benchmark 
    benchmark/instance::stop('NameOfBenchmark);
     
    // @todo get a summary of all benchmarks
    // print_r(benchmark/instance::all());
    
    // get a summary of just one benchmark name
    print_r(benchmark/instance::summary('NameofBenchmark'));
      
    // Get ALL of the results for ONE benchmark name
    print_r(benchmark/instance::get('AnotherBenchMark');   
```
   
Using the Method
 ```php
    
  public class foo {
   
      public method bar() {
          // Will create a benchmark named after the method
          /hive/benchmark/instance::method(); 
            
          // so some actions
          sleep(1)
            
          // Will stop this methods benchmark
          /hive/benchmark/instance::method(); 
      }
        
  }
   
   $object = new foo(); 
   $object->bar();
   
    // @todo get a summary of all benchmarks
    // print_r(benchmark/instance::all());
   
 ```   
   
All of which (other the instance::method()) can be called directly from the object 

 ```php

    $bm = new /hive/benchmark/object(); 
    
    $bm->start('MyNewBenchmark'); 
    
    $bm->stop('MyNewBenchmark');
    
    print_r($bm->all()); 

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

    $bench = new /hive/benchmark/object($config); 

 ```

## File Map

The code is split up into the following classes : 

1. /Tests : folder for any unit testing
2. /Examples : folder for any examples
3. /Documents : folder for any documentation  
4. /Source : folder for source code
  1. Library.php : The actual benchmarking library, useful for extending functionality.
    * __construct( array $config )
    * start         (string $nameOfBenchmark) 
    * stop          (string $nameOfBenchmark) 
    * get           (string $nameOfBenchmark) 
  2. Source/Object.php : Class for accessing the benchmark object.
    * __construct( array $config )
    * start         (string $nameOfBenchmark)
    * stop          (string $nameOfBenchmark)
    * get           (string $nameOfBenchMark)
    * summary       (string $nameOfBenchMark)
  3. Source/Instance.php : Instance of the object class.
    * static start  (string $nameOfBenchmark)
    * static stop   (string $nameOfBenchmark)
    * static get    (string $nameOfBenchMark)
    * static summary(string $nameOfBenchMark)
    * static method (string $action, integer $stack)
  4. Source/Exception : Folder for any exceptions the object will throw
  5. Source/Contact : folder for any interfaces or abstract classes they implement
 
  

[![Build Status](https://travis-ci.org/hive/benchmark.svg?branch=master)](https://travis-ci.org/hive/benchmark) [![StyleCI](https://styleci.io/repos/61770165/shield?style=flat)](https://styleci.io/repos/61770165)
[![Total Downloads](https://poser.pugx.org/hive/benchmark/downloads?format=flat-square)](https://packagist.org/packages/hive/benchmark)
[![Daily Downloads](https://poser.pugx.org/hive/benchmark/d/daily?format=flat-square)](https://packagist.org/packages/hive/benchmark)

