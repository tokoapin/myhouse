<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: Db_type 
*
* Author: Hendry H.
*
*/

class Lib_agentstore
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;

    /**
     * __construct
     *
     * @return void
     * @author Ben
     **/
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library("session");
    }

    public function isStore_exist($iduser)
    {
        $iduser = $this->ci->session->userdata('user_id');
        $item = $this->ci->Agentstore_model->select('*')->where('iduser', $iduser)->items()->row_array();
        if(empty($item))
            return false;
        else 
            return true;
    }
}
