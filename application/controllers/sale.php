<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('lib_sale'));
        $this->template->add_js('/assets/js/libs/jquery/jquery.twzipcode-1.4.1.js', true);
        $this->template->add_js('/assets/js/sale.js', true);
    }

    public function index()
    {
        $data = array();
        $this->template->render('sale/form', $data);
    }

    public function add()
    {
        $data = array('mode' => 'add');
        $this->template->render('sale/form', $data);
    }

    public function edit($uid = '')
    {
        if (!isset($uid) and empty($uid)) {
            redirect('sale/lists');
        }

        $item = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();

        if (empty($item)) {
            redirect('sale/lists');
        }

        if (!empty($item['facility_type'])) {
            $item['facility_type'] = explode(',', $item['facility_type']);
        }

        $data = array(
            'item' => $item,
            'mode' => 'edit'
        );

        $this->template->render('sale/form', $data);
    }

    public function lists()
    {
        $data = array(
            'rows' => $this->lib_sale->select('*')->items()->result_array(),
        );
        $this->template->render('sale/lists', $data);
    }

    public function save()
    {
        $facility_type = $this->input->post('facility_type', true);
        $mode = $this->input->post('mode', true);
        if ( ! is_array($facility_type)) {
            $facility_type = array();
        }
        $data = array(
            'uid' => 'S' . $this->system->generate_code('6', 'digit'),
            'type' => $this->input->post('type', true),
            'title' => $this->input->post('title', true),
            'price' => $this->input->post('price', true),
            'per_price' => $this->input->post('per_price', true),
            'total_feet' => $this->input->post('total_feet', true),
            'major_feet' => $this->input->post('major_feet', true),
            'attach_feet' => $this->input->post('attach_feet', true),
            'public_feet' => $this->input->post('public_feet', true),
            'land_feet' => $this->input->post('land_feet', true),
            'room' => $this->input->post('room', true),
            'parlor' => $this->input->post('parlor', true),
            'bathroom' => $this->input->post('bathroom', true),
            'balcony' => $this->input->post('balcony', true),
            'floor' => $this->input->post('floor', true),
            'total_floor' => $this->input->post('total_floor', true),
            'age' => $this->input->post('age', true),
            'car_num' => $this->input->post('car_num', true),
            'car_type' => $this->input->post('car_type', true),
            'house_title' => $this->input->post('house_title', true),
            'county' => $this->input->post('county', true),
            'district' => $this->input->post('district', true),
            'zipcode' => $this->input->post('zipcode', true),
            'address' => $this->input->post('address', true),
            'number' => $this->input->post('number', true),
            'hidden_number' => $this->input->post('hidden_number', true),
            'manager_price' => $this->input->post('manager_price', true),
            'position' => $this->input->post('position', true),
            'decorating_type' => $this->input->post('decorating_type', true),
            'facility_type' => implode(',', $facility_type),
            'is_lease' => $this->input->post('is_lease', true),
            'traffic' => $this->input->post('traffic', true),
            'is_submit' => $this->input->post('is_submit', true),
            'submit_date' => $this->input->post('submit_date', true),
            'is_owner' => $this->input->post('is_owner', true),
            'agent_type' => $this->input->post('agent_type', true),
            'agent_name' => $this->input->post('agent_name', true),
            'agent_phone' => $this->input->post('agent_phone', true),
            'description' => $this->input->post('description', true)
        );

        $this->lib_sale->insert($data);
        redirect('sale/add');
    }
}

/* End of file sale.php */
/* Location: ./application/controllers/sale.php */
