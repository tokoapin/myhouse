<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agentstore_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->tables['master'] = AGENT_STORE_TABLE;
	}

    public function getAgentStore($iduser)
    {
        $query = $this->db->query("SELECT * FROM ".USER_TABLE." u 
                                    LEFT JOIN ".AGENT_STORE_TABLE." ag 
                                    ON u.iduser = ag.iduser 
                                    WHERE u.iduser=?;", $iduser);
        return $query->row_array();
    }
}
?>