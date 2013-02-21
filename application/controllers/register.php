<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_model');
	}

	public function index()
	{
		$data["title"] = "Welcome to Sweet House";
		$this->load->helper('form');
		$this->load->view('register_view', $data);
	}

	public function registerUser()
	{
		$this->load->library('form_validation');

		$this->load->helper('url');
		$this->form_validation->set_rules('username','User Name', 'trim|required');
		$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone','Phone Number', 'trim|required|numeric');
		$this->form_validation->set_rules('password','Password', 'trim|required');

		$role = $this->input->post('role');
		if($role == "AGENT") {
			$this->form_validation->set_rules('org_type','Organization Type', 'trim|required');
			$this->form_validation->set_rules('agent_nick','Agent Nickname', 'trim|required');			
		}

		if($role == "ORGANIZATION") {
			$this->form_validation->set_rules('org_name','Organization Name', 'trim|required');
			$this->form_validation->set_rules('org_phone','Organization Phone', 'trim|required');			
			$this->form_validation->set_rules('org_fax','Organization Fax', 'trim|required');
			$this->form_validation->set_rules('org_address','Organization Address', 'trim|required');			
			$this->form_validation->set_rules('org_class','Organization Class', 'trim|required');
			$this->form_validation->set_rules('org_services','Organization Services', 'trim|required');						
		}
		
		if ( $this->form_validation->run() == FALSE )
		{
			$this->load->view('error_view');
			return;
		}
		
		$dbData = array(
			'role'		=> $this->input->post('role'),
			'phone'		=> $this->input->post('phone'),
			'password'	=> $this->input->post('password'),
			'username'	=> $this->input->post('username'),
			'gender'	=> $this->input->post('gender'),
			'email'		=> $this->input->post('email')
		);

		$ret = $this->Register_model->insertNewUser($dbData);
		$new_id = null;
		if($ret == FALSE) {
			$this->load->view('error_view', array("message" => "Failed insertNewUser." ));
			return;
		} else {
			$new_id = $this->db->insert_id();
		}

		if(empty($new_id)) {
			$this->load->view('error_view', array("message" => "New inserted Id is 0. Should never happen.! "));
			return;
		}

		if ($role == "AGENT")
		{
			$dbData = array(
				//'company_area'	=> $this->input->post('company_area'),
				'company_type'	=> $this->input->post('org_type'),
				'nickname'		=> $this->input->post('agent_nick')
			);

			$ret = $this->Register_model->insertAgentInfo($dbData, $new_id);
		}
		else if ($role == "ORGANIZATION")
		{
			$dbData = array(
				'company_name'		=> $this->input->post('org_name'),
				'company_phone'		=> $this->input->post('org_phone'),
				'company_fax'		=> $this->input->post('org_fax'),
				'company_address'	=> $this->input->post('org_address'),
				'company_class'		=> $this->input->post('org_class'),
				'company_services'	=> $this->input->post('org_services')
			);
			$ret = $this->Register_model->insertOrganizationInfo($dbData, $new_id);
		}

		if($ret == FALSE) {
			$this->load->view('error_view', array("message" => "Failed insertAgentInfo or insertOrganizationInfo." ));
			return;
		}
		
		$this->load->view('success_view', array("message" => "Congratulations. You have successfuly registered. ~!"));
	}

	/*	
		called via validation plugin jQuery 
		via GET
		must return "true" or "false"
	*/
	public function checkPhoneDuplicate()
	{
		$phone = $this->input->get('phone');
		$isUnique = $this->Register_model->isPhoneUnique($phone);

		if($isUnique == false) {
			echo "false";
			exit(); //important, otherwise it will print any html in this page	
		} else {
			echo "true";
			exit(); //important, otherwise it will print any html in this page					
		}
	}

	/*
		called via ajax
		return array["result"] = "duplicate" (phone number is already registered)
		return array["result"] = "ok"
			If verified, register the user data to DB. 
	*/
	public function smsVerifySendSms()
	{
		$phone = $this->input->post('phone');
		$action = $this->input->post('action');
		$isUnique = $this->Register_model->isPhoneUnique($phone);
		if($isUnique == false)
		{
			$data = array("result" => "duplicate");
			echo json_encode($data);
			exit(); //important, otherwise it will print any html in this page					
		}
		// generate "random" 6-digit verification code
		$code = rand(100000, 999999);
		$this->Register_model->insertVerifyData(array("code" => $code, "phone" => $phone));
		// send sms via Nexmo
		$response = $this->nexmoSendSms($phone, $code);
		if($response["result"] != "ok") {
			$data = array("result" => "send_sms_error", "message" => $response["message"]);
			echo json_encode($data);
			exit(); //important, otherwise it will print any html in this page
		}
		$data = array("result" => "ok");
		echo json_encode($data);
		exit(); //important, otherwise it will print any html in this page
	}

	public function nexmoSendSms($phone, $msg)
	{
		//replace 0 with 886 (Taiwan Country Code)
		if($phone[0]=="0") {
			$phone = "886" . substr($phone, 1);
		}

		$this->load->spark('CodeIgniter-Nexmo-Message/1.0.3');
		$this->nexmo->set_format('json');
		$from = 'Sweet668';
		$to = $phone;
		$message = array(
			'text' => '認證嗎: '.$msg.'. www.sweet668.com 輕鬆找到甜蜜的家. 請不要回覆本簡訊.'
		);
		$response = $this->nexmo->send_message($from, $to, $message);
		if($response->messages[0]->status != 0) {
			return array("result" => "not valid", "message" => $response->messages[0]->{"error-text"});
		}
		return array("result" => "ok");
	}

	/*
		called via ajax
		return array["result"] = "ok"
		return array["result"] = "not valid" (code isn't correct)
	*/

	public function smsVerifyCheckCode()
	{
		$code = $this->input->post('code');
		$phone = $this->input->post('phone');
		$action = $this->input->post('action');

		$dataDB = $this->Register_model->getVerifyData( array("phone"=> $phone));
		if(empty($dataDB["code"])) {
			$data = array("result" => "not valid", "message" => "Can't retrieve verification from DB !!");
			echo json_encode($data);
			exit(); //important, otherwise it will print any html in this page
		}

		$codeDB = $dataDB["code"];
		if(strcasecmp($code, $codeDB) != 0) {
			$data = array("result" => "not valid", "message" => "Code is incorrect. Please retry !");
			echo json_encode($data);
			exit(); //important, otherwise it will print any html in this page
		}

		//finally, write new user data to DB
		$this->registerUser();

		$data = array("result" => "ok");
		echo json_encode($data);
		exit(); //important, otherwise it will print any html in this page
	}


}
