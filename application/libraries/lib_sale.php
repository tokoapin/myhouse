<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: Sale Library
*
* Author: appleboy
*
*/

class Lib_sale
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;

    /**
     * extra where
     *
     * @var array
     **/
    public $_extra_where = array();

    /**
     * extra set
     *
     * @var array
     **/
    public $_extra_set = array();

    /**
     * __construct
     *
     * @return void
     * @author Ben
     **/
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('sale_model');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     **/
    public function __call($method, $arguments)
    {
        if (!method_exists( $this->ci->sale_model, $method) ) {
            throw new Exception('Undefined method category::' . $method . '() called');
        }

        return call_user_func_array( array($this->ci->sale_model, $method), $arguments);
    }
}
