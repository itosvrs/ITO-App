<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application path). registry.php will be used
 * to globally set data through OOP so it may be used through our controllers and models and sofourth.
 * 
 */

class Registry {
    
    /**
     * Private static $_instance var holds the instances of our autoloaded files,
     * this is not used for anything outside this class.
     * 
     * @var type 
     */
    private static $_instance;
	
    /**
     * Private $_storage var stores data,
     * this is not used for anything outside this class.
     * 
     * @var type 
     */
    private $_storage;
	
    /**
     * Static $_config var stores configuration data,
     * this can be used outside of this class.
     * 
     * @var type 
     */
    public static $_config = array();
    
    /**
     * Static $_data var stores various things and data,
     * this can be used outside of this class.
     * 
     * @var type 
     */
    public static $_data = array();
	
    /**
     * Create our construct function as private so no other class can call it,
     * this is not used for anything outside this class.
     */
    private function __construct(){}

    /**
     * 
     * Get instance of a autoloaded class
     */
    public static function getInstance()
    {
        if ( !self::$_instance instanceof self )
        {
                self::$_instance = new Registry;
        }

        return self::$_instance;
    }

    /**
     * __set is used to set the data inside our registry and it will hold it for calls using __get
     * @param type $key
     * @param type $val 
     */
    public function __set($key, $val)
    {
        $this->_storage[$key] = $val;
    }

    /**
     * __get is used to retrive data that was set via our __set method
     * @param type $key
     * @return type 
     */
    public function __get($key)
    {
        if ( isset($this->_storage[$key]) )
        {
                return $this->_storage[$key];
        }

        return false;
    }
	
}