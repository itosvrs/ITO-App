<?php
/**
 * @version 1.0
 * @author Justin Wilson <justin@itrackoffers.com>
 * @copyright Copyright (c) 2012, iTrack Solutions, LLC.
 * @license This script and any files it may cooperate with may not be redistributed, 
 * used or modified in any way without written permission from its rightful author.
 * 
 * This file was called via router.php (application/system/core/router.php).
 * 
 */

class Default_Controller extends Base_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->smarty = $this->load->library('smarty');
    }

    public function index()
    {
        $this->smarty->view('default.tpl.php');
    }
	
}