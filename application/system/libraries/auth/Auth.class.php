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

class Auth {
	
    public function __construct()
    {
            // Start the session
            session_start();

            // Get directory
            $this->uri = explode('/', $_SERVER['REQUEST_URI']);
            $this->uri = array_filter($this->dir);
            $this->directory = $this->uri[1];
            
    }

    /**
     * Start a SESSION login for the publisher account
     */
    public function createSession($loggedID)
    {
            $_SESSION['sess_1'] = md5(sha1($loggedID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
            $_SESSION['sess_2'] = string_encrypt($loggedID, md5($_SESSION['sess_1']), true);

            return true;
    }

    /**
     * Start a COOKIE login for the publisher account
     */
    public function createCookie($loggedID, $directory = '')
    {
            setcookie('sess_1', md5(sha1($loggedID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])), (time() + (3600 * 12)), '/'.$this->request->getModule().'/');
            setcookie('sess_2', string_encrypt($loggedID, md5($_COOKIE['sess_1']), (time() + (3600 * 12)), '/'.$this->directory.'/'));

            return true;
    }

    /**
     * Check if a session is valid
     */
     public function isLogged()
     {
            $loggedID = $this->loggedID();

            if (isset($_SESSION['sess_1']) && isset($_SESSION['sess_2']))
            {	
                    // Does the pub_sess1 match the one when they logged in?
                    if ($_SESSION['sess_1'] !== md5(sha1($loggedID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])))
                            return false;
                    else
                            return true;
            }
            else if (isset($_COOKIE['sess_1']) && isset($_COOKIE['sess_2']))
            {	
                    // Does the pub_sess1 match the one when they logged in?
                    if ($_COOKIE['sess_1'] !== md5(sha1($loggedID.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])))
                            return false;
                    else
                            return true;
            }
            else
            {
                    return false;
            }
     }

    /**
     * Logged ID
     */
    public function loggedID()
    {
            if (isset($_SESSION['sess_1']) && isset($_SESSION['sess_2']))
            {
                    return string_decrypt($_SESSION['sess_2'], md5($_SESSION['sess_1']), true);
            }
            else if (isset($_COOKIE['sess_1']) && isset($_COOKIE['sess_2']))
            {
                    return string_decrypt($_COOKIE['sess_2'], md5($_COOKIE['sess_1']), true);
            }
            else
            {
                    return 0;
            }
    }

    /**
     * Must be either logged in or logged out to access the page requested
     */
    public function forceAuth($type = '', $dir = '')
    {
            if ($type == 'LoggedIn')
            {
                    if (!$this->isLogged())
                    {
                            // Set the path
                            $goto = $this->directory . '/' . $this->request->getPage();
                            $page = '/' . $this->directory . '/login?goto='.urlencode($goto);

                            header('Location: http://'.$_SERVER['HTTP_HOST'].$page);
                            exit;
                    }
            }
            else if ($type == 'LoggedOut')
            {
                    if ($this->isLogged())
                    {
                            header('Location: http://'.$_SERVER['HTTP_HOST']);
                            exit;
                    }
            }
    }

    /**
     * End the session
     */
    /*public function logout($directory = CURRENT_DIR)
    {
            // Remove cookies
            if (isset($_COOKIE['sess_1']) && isset($_COOKIE['sess_2']))
            {
                    setcookie('sess_1', '', (time() - (3600 * 12)), '/'.$directory.'/');
                    setcookie('sess_2', '', (time() - (3600 * 12)), '/'.$directory.'/');
            }

            // Remove sessions
            if (isset($_SESSION['sess_1']) && isset($_SESSION['sess_2']))
            {
                    // Empty the sessions
                    $_SESSION['sess_1'] = '';
                    $_SESSION['sess_2'] = '';

                    // Unset the sessions
                    unset($_SESSION['sess_1']);
                    unset($_SESSION['sess_2']);
            }

            return true;
    }*/
	
}