<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application/kickstart.php). dispatcher will request
 * the router (application/system/core/router.php based on the URI SERVER info so the router may 
 * call the correct controller and process the complete request.
 * 
 */

try
{
    /**
     * Route
     */
    Router::route($_SERVER['REQUEST_URI']);
}
catch (Exception $e)
{
    /**
     * Handle how the browser displays an error
     */
    echo $e->getMessage();
    exit;
}