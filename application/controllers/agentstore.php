<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agentstore extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agentstore_model');
        $this->load->library(array("user", "lib_agentstore"));
        $this->template->add_js('/assets/js/libs/jquery/jquery.twzipcode-1.4.1.js', true);
	}

    public function index()
    {
        redirect('agentstore/view/' .$this->session->userdata('user_id'));
	}

    public function add()
    {
        if($this->lib_agentstore->isStore_exist($this->session->userdata('user_id')))
        {
            $this->load->view("agentstore/error_view", array("message" => "Can't Add Shop, already existed"));
            return;
        }

        $data = array(
            'mode' => 'add'
        );
        $this->template->render('agentstore/form', $data);
    }
    
    public function edit()
    {
        $iduser = $this->session->userdata("user_id");
        $row = $this->Agentstore_model->select('*')->where('iduser', $this->db->escape_str($iduser))->items()->row_array();
        if (empty($row)) {
            $this->load->view('agentstore/error_view', array("message" => "Can't find agent shop !"));
        }
        $data = array(
            'item' => $row,
            'mode' => 'edit'
        );
        $this->template->render('agentstore/form', $data);
    }

    public function save()
    {
        $mode = $this->input->post('mode', true);
        $this->load->library('form_validation');
        $this->load->helper('url');
        $dbData = array(
            'motto'     => $this->input->post('motto', true),
            'county'    => $this->input->post('county', true),
            'service'   => $this->input->post('service', true),
            'skill'     => $this->input->post('skill', true),
            'aboutme'   => $this->input->post('aboutme', true)
        );

        $iduser = $this->session->userdata('user_id');
        
        switch ($mode) {
            case 'add':
                if($this->lib_agentstore->isStore_exist($iduser))
                {
                    $this->load->view('agentstore/error_view', array("message" => "Can't Add. Store Already existed "));
                    return ;
                }
                $dbData['iduser'] = $iduser;
                $ret = $this->Agentstore_model->insert($dbData);
            break;
            case 'edit':
                $item = $this->Agentstore_model->select('*')->where('iduser', $iduser)->items()->row_array();
                $ret = $this->Agentstore_model->hupdate( array("iduser" => $iduser), $dbData);
            break;
        }

        if($ret == FALSE) {
            $this->load->view('agentstore/error_view', array("message" => "Failed insertNewStore." ));
            return;
        } else {
            $message = ($mode=="add") ? "Success addNewStore": "Success updateNewStore" ;
            $this->load->view('agentstore/success_view', array("message" => $message ));
            return;
        }
    }

    public function view($iduser)
    {
        if (!isset($iduser) or empty($iduser)) {
            $this->load->view('/agentstore/error_view', array("message" => "Id user not specified"));
            return;
        }

        $store = $this->Agentstore_model->getAgentStore($iduser);
        $data = array(
            'item'  => $store,
        );

        $this->template->render('agentstore/store_view', $data);
    }

    public function agentlists()
    {
        $this->load->model('User_model');
        $data = array(
            'rows' => $this->User_model->select('*')->where('role', 'AGENT')->items()->result_array()
        );
        $this->template->render('agentstore/store_lists', $data);
    }
}

/* End of file agentstore.php */
/* Location: ./application/controllers/agentstore.php */