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

class Database {
    
    /**
    *	Master Configuration
    */
    private $masterServer = array(
        'host' => '10.179.128.107',
        'user' => 'admin',
        'pass' => 'jTWYwr57',
        'port' => 3306
    );

    /**
    *	Slave Configuration
    */
    private $slaveServer = array(
        'host' => '10.179.128.174',
        'user' => 'admin',
        'pass' => 'jTWYwr57',
        'port' => 3306
    );

    /**
     * Execute a WRITE mysql query
     */
     public function write($sql)
     {
         // Connect to the master database
         $this->masterConnect = mysql_connect($this->masterServer['host'], $this->masterServer['user'], $this->masterServer['pass']);
         if ($this->masterConnect == false)
                 throw new Exception('Error [app-01]: An error occurred connecting to the database (M-01).');

         // Select the database
         mysql_select_db(str_replace('www.', '', $_SERVER['HTTP_HOST']), $this->masterConnect);

         // Run the query
         return mysql_query($sql, $this->masterConnect);
     }

    /**
     * Execute a READ mysql query
     */
     public function read($sql)
     {
         // Connect to the master database
         $this->slaveConnect = mysql_connect($this->slaveServer['host'], $this->slaveServer['user'], $this->slaveServer['pass']);
         if ($this->slaveConnect == false)
                 throw new Exception('Error [app-01]: An error occurred connecting to the database (S-01).');

         // Select the database
         mysql_select_db(str_replace('www.', '', $_SERVER['HTTP_HOST']), $this->slaveConnect);

         // Run the query
         return mysql_query($sql, $this->slaveConnect);
     }

    /**
     * Fetch the data from the query in an array
     */
     public function fetch_array($query)
     {
        return mysql_fetch_array($query);
     }

    /**
     * Fetch the data from the query in an object
     */
     public function fetch_object($query)
     {
        return mysql_fetch_object($query);
     }

    /**
     * Get the num rows
     */
     public function num_rows($query)
     {
        return mysql_num_rows($query);
     }

    /**
     * Get the the last inserted ID of the previous query
     */
     public function last_id()
     {
        return mysql_insert_id();
     }

}