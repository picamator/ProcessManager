<?php
/**
 * ProcessManager Autoload
 *
 * @link https://github.com/picamator/ProcessManager
 * @license http://opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace ProcessManager;

function Autoload($class)
{
    $class = str_replace(__NAMESPACE__, '.', $class);
    
    include_once (str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php');
}

spl_autoload_register('ProcessManager\Autoload');