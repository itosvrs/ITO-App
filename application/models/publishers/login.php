<?php

class Login_Model extends Base_Model {
    
    public function test()
    {
        $this->db->write("INSERT INTO `reports` (`id`, `sub1`) VALUES (NULL, 'hello')");
        return array(
            'name' => 'justin wilson',
            'phone' => '555-666-3567'
        );
    }
    
}