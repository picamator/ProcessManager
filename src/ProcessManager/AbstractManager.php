<?php
/**
 * ProcessManager Manager Abstract
 * 
 * @link        https://github.com/picamator/ProcessManager
 * @license     http://opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace ProcessManager;

abstract class AbstractManager implements ManagerInterface
{   
    /**
     * Time when execution start
     * It sould be time where you application start to execute
     * 
     * @var integer 
     */
    private $time;
    
    /**
     * Time when one execution of iteration began
     * 
     * @var integer 
     */
    private $time_begin;
    
    /**
     * Time when one execution of iteration end
     * 
     * @var integer 
     */
    private $time_end;
    
    /**
     * Memory size when one execution of iteration began
     * 
     * @var integer
     */
    private $memory_begin;
    
    /**
     * Memory size when one execution of iteration ended
     * 
     * @var integer
     */
    private $memory_end;
    
    /**
     * Config
     * 
     * @var Array
     */
    private $config = array(
        'memory_usage'   => 10485760, // 10Mb - decrease memory limit for making possible process end
        'time_execution' => 10 // sec - decreate execution time limit
    );

    /**
     * Constuctor 
     * 
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        if(!empty($config)) {
            $this->setConfig($config);
        }
        
        $this->updateTime('time');
    }
    
    /**
     * Sets Config
     * 
     * @param array $config
     * @return self
     */
    public function setConfig(array $config)
    {
        $this->config = array_merge($this->config, $config);
        
        return $this;
    }
    
    /**
     * Sets Time
     * Time when sript starts to excecute
     * 
     * @param integer $time - microtime(true) format
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;
        
        return $this;
    }
    
    /**
     * Start Process
     * 
     * @param \ProcessManager\Process\ProcessInterface $process
     * @return void
     */
    public function startProcess(Process\ProcessInterface $process)
    {
        // start preProcess
        $this->preProcess();
        
    	// start process manager
    	while($this->isLimitValid()) {
    
    		// update time and memory usage
    		$this->updateTime('time_begin');
    		$this->updateMemory('memory_begin');
    		
    		// start proceaas iteration   		
            $process->run();    
    				
    		// update time and memory usage
    		$this->updateTime('time_end');
    		$this->updateMemory('memory_end');
    	}
   
        //start postProcess
        $this->postProcess();
    }
    
    /**
     * Is Memory and Time Limit valid
     * 
     * @return boolean
     */
    private function isLimitValid()
    {
        $memory_limit  		= intval(ini_get('memory_limit'))*1024*1024 - $this->config['memory_usage'];
		$max_execution_time = ini_get('max_execution_time');
		$time_limit    		= $max_execution_time - $this->config['time_execution'];
	
		$memory_remained  = $memory_limit - $this->memory_end;
		$memory_iteration = $this->memory_end - $this->memory_begin;
			
		$time_execution   = ($this->time_end == 0)? 0: $this->time_end - $this->time;
			
		$time_remained	  = $time_limit - $time_execution;
		$time_iteration	  = $this->time_end - $this->time_begin;
			
		$result = false;
		if($max_execution_time == 0
				||	($time_execution < $time_limit
						&& $this->memory_end < $memory_limit
						&& $memory_remained > $memory_iteration
						&& $time_remained 	> $time_iteration)
		) {
	
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * Update Memory property
     * by actual data
     * 
     * @param string $type
     * @return void
     */
    private function updateMemory($type)
    {
        $this->{$type} = memory_get_usage();
    }
    
    /**
     * Update Memory propery
     * by actual data
     * 
     * @param string $type
     * @return void
     */
    private function updateTime($type)
    {
        $this->{$type} = microtime(true);
    }
    
    /**
     * Start only once before startProcess
     * 
     * @return void
     */
    abstract public function preProcess();
   
    /**
     * Start only once after startProcess
     * Please don't add heavy calculation here
     * The best way of usage such method is a logging data
     * 
     * @return void
     */
    abstract public function postProcess();
}
