<?php

/**
 * Files Model
 * Author: Bo-Yi Wu <appleboy.tw@gmail.com>
 */

class Files_model extends MY_Model
{
    protected $_category_table = "files_category";
    protected $_category_table_key = "id";

    public function __construct()
    {
        parent::__construct();
        $this->tables['master'] = FILE_TABLE;
        $this->_time = time();
    }

    public function delete($id = 0)
    {
        if (is_array($id) and !empty($id)) {
            $result = $this->where($this->_key, $id)->items()->result_array();
            foreach ($result as $row) {
                $this->delete_file($row['name']);
            }
            $this->db->where_in($this->_key, $id);
            $this->db->delete($this->tables['master']);
        } else {
            $id = intval($id);
            $row = $this->item($id)->row_array();
            // if data exist, delete file.
            if(!empty($row))
                $this->delete_file($row['name']);

            $this->db->where($this->_key, $id);
            $this->db->delete($this->tables['master']);
        }
    }

    private function delete_file($filename = NULL)
    {
        if (!isset($filename)) {
            return false;
        }

        $path = UPLOAD_PATH . $filename;

        if (file_exists($path)) {
            @unlink($path);
        }

        return true;
    }

    public function update_file_list($id, $data = array())
    {
        $id = intval($id);
        $data['edit_time'] = $this->_time;
        $this->db->where('category_key', $id);
        $this->db->update($this->_category_table, $data);
    }

    public function update_view($id)
    {
        $id = intval($id);
        $this->db->set('download', 'download+1', false);
        $this->db->where($this->_key, $id);
        $this->db->update($this->tables['master'], $data);
    }
}

/* End of file files_model.php */
/* Location: ./application/models/files_model.php */
