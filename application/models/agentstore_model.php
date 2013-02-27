<?php
class Agentstore_model extends CI_Model
{
	public function __construct()
	{
        $this->load->library("lib_dbtype");
	}

	public function insertNewStore($data)
	{
        $data = $this->lib_dbtype->cast_fieldtypes($data, AGENT_STORE_TABLE);
		return $this->db->insert('agentstore', $data);
	}
}
?>