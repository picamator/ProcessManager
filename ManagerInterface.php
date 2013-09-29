<?php
/**
 * Manager Interface
 * 
 * @link        https://github.com/picamator/ProcessManager
 * @license     http://opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace ProcessManager;

interface ManagerInterface
{   
    /** 
     * @param array $config
     */
    public function __construct(array $config = array());
    
    /**
     * Sets Config
     * 
     * @param array $config
     * @return self
     */
    public function setConfig(array $config);
    
    /**
     * Sets Time
     * Time when sript starts to excecute
     * 
     * @param integer $time - microtime(true) format
     * @return self
     */
    public function setTime($time);
    
    /**
     * Start Process
     * 
     * @param \ProcessManager\Process\ProcessInterface $process
     * @return void
     */
    public function startProcess(Process\ProcessInterface $process);
    
    /**
     * Start only once before startProcess
     * 
     * @return void
     */
    public function preProcess();
   
    /**
     * Start only once after startProcess
     * Please don't add heavy calculation here
     * The best way of usage such method is a logging data
     * 
     * @return void
     */
    public function postProcess();
}
