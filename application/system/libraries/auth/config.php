<?php
/**
 * 
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via load.php (application/system/core/load.php). config.php will contain 
 * configuration data for the library being called. Then it will require all libraries files needed
 * to work with the application.
 * 
 */

/**
 * Require Auth.class.php (application/system/libraries/auth/Auth.class.php) used for login, sessions, cookies etc
 */
 require_once(APP_PATH . DS . 'system/libraries/auth/Auth.class.php');