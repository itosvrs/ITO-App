<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * .htaccess file will route all incoming HTTP Requests to this index.php file
 * so it may load all the proper classes, functions and helpers then pass them
 * through to the controller and model. The model will have access to a Registry
 * which allows global information to be passed inside its set and view methods.
 * 
 */

/**
 * HTTP Request example
 * 
 * Client Browser
 * --> http://domain.com --> .htaccess
 * --> index.php (root, domain.com/)
 * --> kickstart.php (application/kickstart.php)
 * --> registry, config, base_controller, base_model, router, dispatcher
 * --> dispatcher.php (application/system/core/dispatcher.php)
 * --> calls router.php (application/system/core/router.php)
 * --> route() method will require the page controller based on URI
 * --> controller loads the smarty view (domain.com/web/) and renders to the client browser
 */

/**
 * Error reporting
 */
 ini_set('display_errors', true);
 error_reporting(E_ALL);

/**
 * Define some constants
 * 
 * DS is used as a short call for DIRECTORY_SEPARATOR
 * ROOT_PATH is used for the complete root path
 * APP_PATH is used for the application path
 * WEB_PATH is used for the smarty templates, and all data displayed to the client browser
 * 
 */
 define('DS', DIRECTORY_SEPARATOR);
 define('ROOT_PATH', realpath(dirname(__FILE__)) . '/');
 define('APP_PATH', '/var/www/vhosts/application');
 define('WEB_PATH', ROOT_PATH . 'web');

/**
 * Require the kickstart.php file
 * 
 * The kickstart.php file will call all the necessary application files (see kickstart.php for info)
 */
 require_once(APP_PATH . DS . 'kickstart.php');
 
 echo 'This is the new php FILE for Git. YAY v2!!';