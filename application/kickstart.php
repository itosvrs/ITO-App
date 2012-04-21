<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via index.php (root path /). kickstart.php will load
 * all required files, call the router.
 * 
 */

/**
 * Require registry.php (application/system/core/registry.php) used for all global information used throughout controllers & models
 */
 require_once(APP_PATH . DS . 'system/core/registry.php');
 
/**
 * Require config.php for global configuration data such as default controllers, autoloaded helpers, database info etc
 */
 require_once(APP_PATH . DS . 'config.php');
 
/**
 * Require common.php for common functions
 */
 require_once(APP_PATH . DS . 'system/core/common.php');
 
 /**
 * Require load.php (application/system/core/load.php) used for loading the smarty view and model access
 */
 require_once(APP_PATH . DS . 'system/core/load.php');
 
/**
 * Require base_controller.php (application/system/core/base_controller.php) used for extends with our page controllers so they have
 * access to everything Base_Controller class (base_controller.php) has access to.
 */
 require_once(APP_PATH . DS . 'system/core/base_controller.php');
 
/**
 * Require base_model.php (application/system/core/base_model.php) used for extends with our models so they have access to
 * everything Base_Model class (base_model.php) has access to.
 */
 require_once(APP_PATH . DS . 'system/core/base_model.php');
 
/**
 * Require router.php (application/system/core/router.php) used to route HTTP Requests to the proper controller,
 * default controller and method can be found in config.php (application/config.php)
 */
 require_once(APP_PATH . DS . 'system/core/router.php');
 
 /**
 * Require dispatcher.php (application/system/core/dispatcher.php) used to call our Router class (application/system/core/router.php)
 * which routes to the controller (see router.php for more info)
 */
 require_once(APP_PATH . DS . 'system/core/dispatcher.php');
 
YAYYYY