<?php
/**
 * 
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application/kickstart.php). base_controller.php will contain a
 * class that ALL our framework controllers will extend to have access to our registry.
 * 
 */

abstract class Base_Controller {
    
    /**
     * Protected $_registry is used for accessing our Registry class,
     * this is used in our controller classes since they extend Base_Controller
     */
    protected $_registry;
    
    /**
     * Protected $load is used to load the smarty templates and rendering our pages
     * to the clients browser. See load.php (application/core/load.php) for more info 
     */
    protected $load;
    
    /**
     * Protected $model is used to load the model class and access
     * the methods it contains. See Dynamic_Model_Name.php for more info 
     */
    protected $model;
    
    /**
     * Base_Controller __construct allows us to call our Registry getInstance method
     * that allows us to use the Registry class throughout any class that extends Base_Controller.
     * 
     * Then create an instance of our load class so the controller can load the model and view.
     */
    public function __construct()
    {
        // Get the registries instance
        $this->_registry = Registry::getInstance();
        
        // Start the Load class so we may use it inside the controller(s)
        $this->load = new Load;
        
        // Start the Model class so we may use it inside the controller(s)
        $this->model = new Model;
    }

    /**
     * 
     * Get the registry data
     * @param unknown_type $key
     */
    final public function __get($key)
    {
        if ( $return = $this->_registry->$key )
        {
                return $return;
        }

        return false;
    }
	
}