<?php
/**
 * 
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application/kickstart.php). load.php will contain a
 * class that ALL our framework controllers will have access to ($this->load) created inside
 * base_controller.php, see (application/system/core/base_controller.php) for info.
 * 
 */

class Load {
    
    /**
     * Construct the class as an empty or
     * non-functioning method.
     */
    public function __construct(){}
    
    /**
     * Requires a called librarys config.php file
     * then returns its object.
     * @param type $lib
     * @param type $instantiate
     * @return type object
     */
    public function library($lib, $instantiate = true)
    {
        $libPath = APP_PATH . DS . 'system/libraries/' . $lib . '/config.php';
        
        if ( file_exists($libPath) )
        {
            require_once($libPath);

            $classname = ucfirst($lib);
            if ( class_exists($classname) && $instantiate == true)
            {
                $this->$lib = new $classname();
                return $this->$lib;
            }
            
            return true;
        }
        
        throw new Exception('Error [app-01]: A library requested via load does not exist.');
    }
    
    public function model($classname, $instantiate = true)
    {
        
        $path = APP_PATH . DS . 'models/' . $classname . '.php';
        echo $path;
        if ( file_exists($path) )
        {
            require_once($path);

            if ( class_exists($classname) && $instantiate == true)
            {
                $this->model = new $classname();
                return $this->model;
            }
            
            return true;
        }
        
        throw new Exception('Error [app-01]: The model requested does not exist.');
    }
	
}