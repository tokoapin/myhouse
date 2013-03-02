<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: User Library
*
* Author: Hendry H
*
*/

class User
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function isAdmin()
    {
        if($this->ci->session->userdata('user_id') == ADMIN_USER_ID)
            return true;
        else 
            return false;
    }
}
