ProcessManager
==============

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c5f81318-b53c-4a44-b55f-5d671db09639/mini.png)](https://insight.sensiolabs.com/projects/c5f81318-b53c-4a44-b55f-5d671db09639)

ProcessManager helps to run long time process as long as PHP memory and execution time limits allow it.

Requirements
------------
* PHP 5.3+

Usage
-----
```php
<?php
namespace ProcessManager;

// ProcessManager Autoload
require_once ('./src/autoload.php');

/**
 * Lets we have process
 */
class ExampleProcess implements Process\ProcessInterface 
{
    private $iteration = 1;
    
    public function run() 
    {
        echo '  === Iteration #'.$this->iteration++.' successfully finished ===  '."\n";
        sleep(5);
    }    
}

// 1. Identify time
$time = microtime(true);

// 2. Create Process
$process = new ExampleProcess();

// 3. Create Manager
$manager = new Manager();

// 4. Start Process
$manager->setTime($time)
    ->startProcess($process);

```

License
-------
BSD-3-Clause
