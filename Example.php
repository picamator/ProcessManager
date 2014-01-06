<?php
/**
 * =====================================
 *    Example of usage ProcessManager
 * =====================================
 */

namespace ProcessManager;

// ProcessManager Autoload
require_once ('./src/Autoload.php');

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
