<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application/kickstart.php). config.php will be used
 * to define all our default configuration variables. Edit as needed.
 * 
 */

/**
 * Default controller is used to load the default_method inside the controllers class
 * automatically. This option MUST be set and being empty will break the code.
 */
 Registry::$_config['default_controller'] = "default";
 
 /**
 * Default method is used to load the method automatically once the controller
 * has been called. This option MUST be set and being empty will break the code.
 */
 Registry::$_config['default_method'] = "index";