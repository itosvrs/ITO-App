<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via kickstart.php (application/kickstart.php). router will use the URI
 * provided through the route() method inside dispatcher.php (application/system/core/dispatcher.php).
 * The route() method will route the request to the the proper controller.
 * 
 */

class Router {

    /**
     * 
     * Route the request, see all other comments for an explaination
     * of how this method works / performs inside index.php (domain.com/index.php)
     * @param unknown_type $uri
     */
    public static function route($uri)
    {
        /**
         * First remove the query string
         * Next split the uri into components and then
         * Then remove blank keys/values using array_filter()
         * Then set the uri path using the $uri array
         */
        $uri = Registry::$_data['server']['uri'] = preg_replace('/\?.*/', '', $uri);
        $uri = Registry::$_data['server']['uri_array'] = explode('/', $uri);
        $uri = Registry::$_data['server']['uri_array'] = array_filter($uri);
        $uriPath = Registry::$_data['server']['uri_path'] = implode('/', $uri);

        /**
         * No controller or method was specified in the uri,
         * lets use the default with the registry config array
         */
        if ( empty($uriPath) )
        {
                $default_controller = APP_PATH . DS . 'controllers/' . Registry::$_config['default_controller'] . '.php';

                /**
                 * If the default controller ($default_controller) path exists, require it.
                 * If it does not exist, throw a system exception error.
                 */
                if ( file_exists($default_controller) )
                {
                        require_once($default_controller);

                        /**
                         * Instanite the default controller class and call the default method
                         */
                        $classname = ucfirst(Registry::$_config['default_controller']) . '_Controller';
                        if ( class_exists($classname) && method_exists($classname, Registry::$_config['default_method']) )
                                $controller = new $classname;
                                $controller->{Registry::$_config['default_method']}();

                        return true;
                }
        }
        else
        {
                $controller = APP_PATH . DS . 'controllers/' . $uriPath . '.php';
                $model = APP_PATH . DS . 'models/' . $uriPath . '.php';

                /**
                 * If the controller ($controller) path exists, reqyjuire it.
                 * If it does not exist, throw a system exception error.
                 */
                if ( file_exists($controller) )
                {
                        require_once($controller);
                        require_once($model);

                        /**
                         * Instanite the controller class and call the default method
                         */
                        $controllername = ucfirst(end($uri));
                        $classname = $controllername . '_Controller';
                        if ( class_exists($classname) && method_exists($classname, Registry::$_config['default_method']) )
                                $controller = new $classname($controllername);
                                $controller->{Registry::$_config['default_method']}();

                        return true;
                }
        }

        throw new Exception('Error [app-01]: The page requested could not be found. Please go back and try again.');
    }

}