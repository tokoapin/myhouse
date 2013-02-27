<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agentstore extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agentstore_model');
        $this->template->add_js('/assets/js/libs/jquery/jquery.twzipcode-1.4.1.js', true);
	}

    public function index()
    {
		$this->data = array(
			"error" => "",
			"upload_data" => ""
		);
		$this->template->render('agentstore/form', $this->data);
	}

	public function open()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');

        $dbData = array(
            'motto'     => $this->input->post('motto'),
            'area'      => $this->input->post('area'),
            'service'   => $this->input->post('service'),
            'skill'     => $this->input->post('skill'),
            'aboutme'   => $this->input->post('aboutme')
        );

        $ret = $this->Agentstore_model->insertNewStore($dbData);
		if($ret == FALSE) {
			$this->load->view('agentstore/error_view', array("message" => "Failed insertNewStore." ));
			return;
		} else {
			$this->load->view('agentstore/success_view', array("message" => "Success insertNewStore." ));
			return;
		}
	}

}

/* End of file agentstore.php */
/* Location: ./application/controllers/agentstore.php */