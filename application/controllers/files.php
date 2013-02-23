<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends MY_Controller
{
    protected $_upload_path = "./uploads/";
    protected $_allowed_types = "*";

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('lib_files', 'image_lib'));
        $this->load->helper(array('url', 'form', 'download'));
        $this->load->config('images');

        // check thumbs exist()
        if (!is_dir($this->_upload_path . 'thumbs')) {
            mkdir($this->_upload_path . 'thumbs');
        }
    }

    public function index()
    {
        $this->data = array(
            "error" => "",
            "upload_data" => ""
        );
        $this->template->render('upload', $this->data);
    }

    public function upload($allow_types = "all")
    {
        $type = $this->input->get_post('type');

        $this->set_allow_types($allow_types);
        $config = array(
            'upload_path' => $this->_upload_path,
            'allowed_types' => $this->_allowed_types,
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);

        $this->data = array(
            "error" => "",
            "upload_data" => ""
        );

        if ( ! $this->upload->do_upload()) {
            $this->data['error'] = $this->upload->display_errors('<div class="form-msg-warning">', '<a class="close">x</a></div>');
        } else {
            $this->data['upload_data'] = $this->upload->data();
            $this->data['upload_data']['id'] = $this->lib_files->upload($this->upload->data());
            (!empty($type)) and $this->image_resize($this->upload->data(), $type);
        }

        echo json_encode($this->data);
    }

    public function image_resize($image, $type = '')
    {
        $this->load->library('image_lib');
        if (empty($type)) {
            return;
        }

        $filename = $image['raw_name'] . $image['ext'];
        $filepath = $this->_upload_path . $filename;

        $size = $this->config->item('image_size');
        if (isset($size[$type])) {
            foreach ($size[$type] as $row) {
                $image_array = array();
                $image_array = explode('x', $row);
                $image_array[] = $filename;
                $thumbpath = $this->_upload_path . 'thumbs/' . implode('_', $image_array);
                $thumb_config = array(
                    'thumb_marker' => '',
                    'create_thumb' => TRUE,
                    'source_image' => $filepath,
                    'width' => $image_array[0],
                    'height' => $image_array[1],
                    'master_dim' => 'auto',
                    'new_image' => $thumbpath
                );
                $thumb_config = array_merge($this->config->item('gd2'), $thumb_config);
                $this->image_lib->initialize($thumb_config);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        }

        return;
    }

    public function get($filename = NULL, $width = NULL, $height = NULL)
    {
        // origin file path
        $filepath = $this->_upload_path . $filename;

        // output default image when file is not exist
        if (!$filename || !file_exists($filepath)) {
            $filename = 'no_image.png';
            $filepath = './assets/images/' . $filename;
        }

        if ($width && $height) {
            // thumbnail path
            $thumbpath = $this->_upload_path . 'thumbs/' . join('_', array($width, $height, $filename));

            // output exist image
            if (file_exists($thumbpath)) {
                header("Location: " . base_url($thumbpath));
            } else {
                $thumb_config = array(
                    'thumb_marker' => '',
                    'create_thumb' => TRUE,
                    'source_image' => $filepath,
                    'width' => $width,
                    'height' => $height,
                    'master_dim' => 'auto',
                    'new_image' => $thumbpath,
                );
                $thumb_config = array_merge($this->config->item('gd2'), $thumb_config);
                $this->image_lib->initialize($thumb_config);
                $this->image_lib->resize();

                $this->get($filename, $width, $height);
            }
        }
        // if no input image width and height, it will output origin picture
        else {
            header("Location: " . base_url($filepath));
        }
    }

    public function set_allow_types($allow_types = "all")
    {
        switch ($allow_types) {
            case "image":
                $type = "jpg|jpeg|png|gif";
            break;
            case "all":
            default:
                $type = "*";
        }

        $this->_allowed_types = $type;

        return $this;
    }

    public function download($id = 0)
    {
        $id = (int) $id;
        $row = $this->lib_files->get_file($id);

        $path = $this->_upload_path . $row['name'];

        if (!file_exists($path)) {
            header("Location:" . $this->config->site_url());
        }
        $data = file_get_contents($path); // Read the file's contents
        $orig_name = $row['orig_name'];

        // update view count
        $this->lib_files->update_view($id);
        force_download($orig_name, $data);
    }

    public function ajax()
    {
        if ($this->input->is_ajax_request()) {
            $mode = (string) $this->input->post('mode');

            switch ($mode) {
                case "delete":
                    $id = intval($this->input->post('id'));
                    $this->lib_files->delete($id);
                break;
                case "update":
                    $id = intval($this->input->post('id'));
                    $name = $this->input->post('name', TRUE);
                    $data = array(
                        "alias_name" => $name
                    );
                    $this->lib_files->update($id, $data);
                break;
                case 'get_file_list':
                    $id = intval($this->input->post('id'));
                    $group_mode = $this->input->post('group_mode') ? $this->input->post('group_mode') : 'ul';
                    $file_list = $this->lib_files->select_file_list($id);
                    $response = (!empty($file_list)) ? $this->lib_files->get_files($file_list, $group_mode) : $this->lib_files->get_files(NULL, $group_mode);
                    echo $response;
                break;
            }
            $data = array("success_text" => "ok");
            echo json_encode($data);
        }
    }
}

/* End of file files.php */
/* Location: ./application/controllers/files.php */
