<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('lib_sale', 'lib_files'));
        $this->template->add_js('/assets/js/libs/jquery/jquery.twzipcode-1.4.1.js', true);
    }

    public function index()
    {
        $data = array();
        $this->template->render('sale/form', $data);
    }

    public function add()
    {
        $data = array(
            'mode' => 'add'
        );
        $this->template->add_css('/assets/js/libs/jquery/uploadify/uploadify.css');
        $this->template->add_js('/assets/js/sale.js', true);
        $this->template->add_js('/assets/js/libs/jquery/uploadify/swfobject.js', true);
        $this->template->add_js('/assets/js/libs/jquery/uploadify/jquery.uploadify.v2.1.4.js', true);
        $this->template->add_js('/assets/js/file_upload.js', true);
        $this->template->render('sale/form', $data);
    }

    public function setting($uid = '')
    {
        if (!isset($uid) and empty($uid)) {
            exit();
        }

        $row = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();

        if (empty($row)) {
            exit();
        }

        if ($this->input->is_ajax_request()) {
            // check permission
            if ($row['user_id'] != $this->session->userdata('user_id')) {
                exit();
            }
            $mode = $this->input->post('mode', true);
            switch ($mode) {
                case 'open':
                case 'close':
                    $key = $this->input->post('key', true);
                    $value = $this->input->post('value', true);
                    $data[$key] = $value;
                    break;
                break;
                case 'update_reservation':
                    $data = array(
                        'is_submit' => $this->input->post('is_submit', true),
                        'submit_date' => $this->input->post('submit_date', true),
                        'is_owner' => $this->input->post('is_owner', true),
                        'agent_type' => $this->input->post('agent_type', true),
                        'agent_name' => $this->input->post('agent_name', true),
                        'agent_phone' => $this->input->post('agent_phone', true)
                    );
                    break;
                case 'update_deal';
                    $data = array(
                        'sale_price' => $this->input->post('sale_price', true),
                        'status' => 2
                    );
                    break;
            }

            $this->lib_sale->update($row['id'], $data);
            $data = array(
                "success_text" => "ok"
            );
            echo json_encode($data);
        }
    }

    public function delete($uid = '')
    {
        if (!isset($uid) and empty($uid)) {
            exit();
        }

        $row = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();

        if (empty($row)) {
            exit();
        }

        if ($this->input->is_ajax_request()) {
            // check permission
            if ($row['user_id'] != $this->session->userdata('user_id')) {
                exit();
            }

            // delete all image files
            if (!empty($row['file_list'])) {
                $file_list = explode(',', $row['file_list']);
                $this->lib_files->delete($file_list);
            }

            $this->lib_sale->delete($row['id']);
            $data = array(
                "success_text" => "ok"
            );
            echo json_encode($data);
        }
    }

    public function item($uid = '')
    {
        if (!isset($uid) and empty($uid)) {
            exit();
        }

        $row = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();
        $row['agent_type'] = form_dropdown('agent_type', $this->_agent_type, (isset($row['agent_type'])) ? $row['agent_type'] : '', 'class="input-small"');
        if ($this->input->is_ajax_request()) {
            $data = array(
                "success_text" => "ok",
                "item" => $row
            );
            echo json_encode($data);
        }
    }

    public function edit($uid = null)
    {
        if (!isset($uid) or empty($uid)) {
            redirect('sale/lists');
        }

        $row = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();
        if (isset($row['file_list']) and !empty($row['file_list'])) {
            $files = $this->lib_files->where('id', explode(',', $row['file_list']))->order_by_field('id', $row['file_list'])->items()->result_array();
            $row['image_list'] = $files;
        }

        if (empty($row)) {
            redirect('sale/lists');
        }

        if (!empty($row['facility_type'])) {
            $row['facility_type'] = explode(',', $row['facility_type']);
        }

        $data = array(
            'item' => $row,
            'mode' => 'edit'
        );

        $this->template->add_css('/assets/js/libs/jquery/uploadify/uploadify.css');
        $this->template->add_js('/assets/js/sale.js', true);
        $this->template->add_js('/assets/js/libs/jquery/uploadify/swfobject.js', true);
        $this->template->add_js('/assets/js/libs/jquery/uploadify/jquery.uploadify.v2.1.4.js', true);
        $this->template->add_js('/assets/js/file_upload.js', true);
        $this->template->render('sale/form', $data);
    }

    public function lists()
    {
        $data = array(
            'rows' => $this->lib_sale->select('*')->where('user_id', $this->session->userdata('user_id'))->order_by('add_time', 'desc')->items()->result_array(),
        );

        $this->template->add_js('/assets/js/libs/jquery/jquery.serialize.js', true);
        $this->template->add_js('/assets/js/sale.js', true);
        $this->template->render('sale/lists', $data);
    }

    public function save()
    {
        $mode = $this->input->post('mode', true);
        $facility_type = $this->input->post('facility_type', true);
        $file_list = $this->input->post('file_list', true);

        if ( ! is_array($facility_type)) {
            $facility_type = array();
        }

        $file_list = (is_array($file_list) and !empty($file_list)) ? implode(',', $file_list) : '';

        $data = array(
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
            'description' => $this->input->post('description', true),
            'file_list' => $file_list
        );

        switch ($mode) {
            case 'add':
                $another = array(
                    'uid' => 'S' . $this->system->generate_code('6', 'digit'),
                    'user_id' => $this->session->userdata('user_id')
                );

                $data = array_merge($another, $data);
                $this->lib_sale->insert($data);
            break;
            case 'edit':
                $uid = $this->input->post('uid', true);
                $item = $this->lib_sale->select('*')->where('uid', $this->db->escape_str($uid))->items()->row_array();

                if (empty($item) or $this->session->userdata('user_id') != $item['user_id']) {
                    redirect('sale/lists');
                }

                $this->lib_sale->update($item['id'], $data);
            break;
        }

        redirect('sale/lists');
    }
}

/* End of file sale.php */
/* Location: ./application/controllers/sale.php */
