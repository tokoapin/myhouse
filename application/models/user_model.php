<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	public function __construct()
	{
        parent::__construct();
        $this->tables['master'] = USER_TABLE;
	}
}
?>