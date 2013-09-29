<?php
/**
 * ProcessManager Manager
 * For configuration preProcess and postProcess methods
 * 
 * @link        https://github.com/picamator/ProcessManager
 * @license     http://opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace ProcessManager;

class Manager extends AbstractManager
{       
    /**
     * Start only once before startProcess
     * 
     * @return void
     */
     public function preProcess()
     {
         
     }
   
    /**
     * Start only once after startProcess
     * Please don't add heavy calculation here
     * The best way of usage such method is a logging data
     * 
     * @return void
     */
    public function postProcess()
    {
        
    }
}
