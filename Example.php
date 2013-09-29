<?php
/**
 * =====================================
 *    Example of usage ProcessManager
 * =====================================
 */

// ProcessManager Autoload
require_once ('./Autoload.php');

/**
 * Lets we have process
 */
class ExampleProcess implements \ProcessManager\Process\ProcessInterface 
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
$manager = new \ProcessManager\Manager;

// 4. Start Process
$manager->setTime($time)
    ->startProcess($process);
