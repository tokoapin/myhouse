<?php

class Register_model extends CI_Model
{
	public function __construct()
	{
	}

	public function insertNewUser($data)
	{
		return $this->db->insert('user', $data);
	}

	public function insertAgentInfo($data, $iduser)
	{
		$data["iduser"] = $iduser;
		return $this->db->insert('user_detail_agent', $data);
	}

	public function insertOrganizationInfo($data, $iduser)
	{
		$data["iduser"] = $iduser;
		return $this->db->insert('user_detail_organization', $data);
	}

	public function isPhoneUnique($phonenumber) {
		$phonenumber = $this->db->escape($phonenumber);
		$query = $this->db->query("SELECT * FROM user WHERE phone=$phonenumber;");
		if($query->num_rows() > 0) {
			return false;
		} else 
			return true;
	}

	public function insertVerifyData($data) {
		// save verification code and phone in DB with phone number
		// attempts to delete existing entries first
		$phone = $this->db->escape($data["phone"]);
		$code = $this->db->escape($data["code"]);
		$query = $this->db->query("DELETE FROM user_verify WHERE phone=$phone;");
		$query = $this->db->query("INSERT INTO user_verify (phone, code) VALUES ($phone, $code);");
	}

	public function getVerifyData($data) {
		$phone = $this->db->escape($data["phone"]);
		$query = $this->db->query("SELECT * FROM user_verify WHERE phone=$phone LIMIT 1;");
		if ($query->num_rows() > 0)
			return $query->row_array(); 
		else 
			return 0;
	}
}
?>