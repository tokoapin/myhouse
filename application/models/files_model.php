<?php
/*
 * Files Model
 * Author: Bo-Yi Wu <appleboy.tw@gmail.com>
 * Date: 2012-04-14
 */

class Files_model extends MY_Model
{
    protected $_table = "files";
    protected $_category_table = "files_category";
    protected $_category_table_id = "id";
    protected $_id = "file_id";
    protected $_upload_path = "./upload/";

    public function __construct()
    {
        parent::__construct();
        $this->tables['file']    = 'files';
        $this->_time = time();
    }

    /**
     * files
     *
     * @return object Categories
     * @author appleboy
     **/
    public function files()
    {
        // define in MY_Model
        $this->handle_process();

        $this->response = $this->db->get($this->tables['file']);

        return $this;
    }

    /**
     * file
     *
     * @return object
     * @author appleboy
     **/
    public function file($id = NULL)
    {
        $this->limit(1);
        $this->where($this->tables['file'].'.id', $id);

        $this->files();

        return $this;
    }

    /**
     * Add file
     *
     * @return int
     * @author appleboy
     **/
    public function insert($data = array())
    {
        if(empty($data))

            return false;

        $another = array(
            'add_time'   => time(),
            'edit_time'  => time()
        );
        $data = array_merge($data, $another);

        $this->db->insert($this->tables['file'], $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function delete($id = 0)
    {
        if (is_array($id) AND !empty($id)) {
            $result = $this->where('file_id', $id)->files()->result_array();
            foreach ($result as $row) {
                $this->delete_file($row['file_name']);
            }
            $this->db->where_in($this->_id, $id);
            $this->db->delete($this->_table);
        } else {
            $id = intval($id);
            $row = $this->where('file_id', $id)->files()->row_array();
            // if data exist, delete file.
            if(!empty($row))
                $this->delete_file($row['file_name']);

            $this->db->where($this->_id, $id);
            $this->db->delete($this->_table);
        }
    }

    private function delete_file($filename = NULL)
    {
        if(!isset($filename))

            return FALSE;

        $path = $this->_upload_path . $filename;

        if (file_exists($path)) {
            @unlink($path);
        }

        return TRUE;
    }

    public function update($id, $data = array())
    {
        $id = intval($id);
        $data['edit_time'] = $this->_time;
        $this->db->where($this->_id, $id);
        $this->db->update($this->_table, $data);
    }

    public function update_file_list($id, $data = array())
    {
        $id = intval($id);
        $data['edit_time'] = $this->_time;
        $this->db->where('category_id', $id);
        $this->db->update($this->_category_table, $data);
    }

    public function update_view($id)
    {
        $id = intval($id);
        $data['edit_time'] = $this->_time;
        $this->db->set('download', 'download+1', FALSE);
        $this->db->where($this->_id, $id);
        $this->db->update($this->_table, $data);
    }
}
/* End of file files_model.php */
/* Location: ./application/models/files_model.php */
