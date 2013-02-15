<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __contruct()
    {
        $this->load->spark('codeigniter-template/1.0.2');
    }

    public function index()
    {
        $data = array(
            'house_type' => $this->_house_type,
            'car_type' => $this->_car_type,
            'car_num' => $this->_car_num
        );
        $this->template->render('sale/form', $data);
    }
}

/* End of file sale.php */
/* Location: ./application/controllers/sale.php */
