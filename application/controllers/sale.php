<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __contruct()
    {
        $this->load->spark('codeigniter-template/1.0.2');
    }

    public function index()
    {
        $data = array();
        $this->template->add_js('assets/js/libs/jquery/jquery.twzipcode-1.4.1.js', true);
        $this->template->add_js('assets/js/sale.js', true);
        $this->template->render('sale/form', $data);
    }
}

/* End of file sale.php */
/* Location: ./application/controllers/sale.php */
