<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System
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
        $this->ci->load->helper('url');
        $this->ci->load->library('session');
    }

    /**
     *
     * Generate an activation code
     *
     * @param int
     * @param string
     * @return string
     */
    public function generate_code($length = 11, $type = 'auto')
    {
        $code = "";
        switch ($type) {
            case 'digit':
                $chars = '1234567890';
            break;
            case 'word':
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
            default:
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            break;
        }

        srand((double) microtime()*1000000);
        for ($i=0; $i<$length; $i++) {
            $code .= substr ($chars, rand() % strlen($chars), 1);
        }

        return $code;
    }
}

/* End of file system.php */
/* Location: ./application/libraries/system.php */
