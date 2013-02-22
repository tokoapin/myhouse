<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lib_files
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $_ci;
    protected $_upload_path = './upload/';

    public function __construct()
    {
        $this->_ci =& get_instance();
        $this->_ci->load->model('files_model');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     **/
    public function __call($method, $arguments)
    {
        if (!method_exists( $this->_ci->files_model, $method) ) {
            throw new Exception('Undefined method files_model::' . $method . '() called');
        }

        return call_user_func_array( array($this->_ci->files_model, $method), $arguments);
    }

    public function upload($data = array())
    {
        $data = array(
            'name' => (string) $data['name'],
            'ext' => (string) strtolower($data['ext']),
            'path' => (string) $this->_upload_path,
            'size' => (string) $data['size'],
            'type' => (string) $data['type'],
            'orig_name' => (string) $data['orig_name'],
            'raw_name' => (string) $data['raw_name'],
            'image_height' => (int) $data['image_height'],
            'image_width' => (int) $data['image_width'],
            'is_image' => (int) $data['is_image']
        );
        $id = $this->_ci->files_model->insert($data);
        return $id;
    }

    public function process_upload_files()
    {
        // process upload data
        if ( ! $this->_ci->input->post('id')) {
            $file_list = "";
        } else {
            if (is_array($this->_ci->input->post('id'))) {
                $file_list = implode(",", $this->_ci->input->post('id'));
            }
        }
        return $file_list;
    }

    public function get_files($data = array(), $mode = 'ul')
    {
        $result_html = "";

        if (!isset($data)) {
            switch ($mode) {
                case 'table':
                    $result_html = '<table id="file_list" class="admin-table" style="display:none">';
                    $result_html .= '<tr>';
                    $result_html .= '<th width="50">選取</th>';
                    $result_html .= '<th>標題</th>';
                    $result_html .= '<th width="150">動作</th>';
                    $result_html .= '</tr>';
                    $result_html .= '</table>';
                break;
                case 'ul':
                    $result_html = '<ul id="file_list" style="display:none"></ul>';
                break;
                case 'image':
                    $result_html = '<div id="file_list" class="media-grid" style="display:none"></div>';
                break;
            }

            return $result_html;
        }

        if (!is_array($data)) {
            $file_list = explode(",", $data);
        }

        $file_list_array = array_flip($file_list);
        $result = $this->_ci->files_model->get_all_files($file_list);
        $show = (empty($result)) ? 'style="display:none"' : "";

        $html = array();
        switch ($mode) {
            case 'ul':
                $result_html = '<ul id="file_list" ' . $show . '>';
                foreach ($result as $row) {
                    $file_name = (empty($row['alias_name'])) ? $row['orig_name'] : $row['alias_name'];
                    $html[$file_list_array[$row['id']]] = '<li class="list"><input type="checkbox" name="id[]" value="' . $row['id'] . '" checked>&nbsp;&nbsp;<img src="http://techpromot.ccu.edu.tw/images/icon/Download.png">&nbsp;<span file_id="' . $row['id'] . '" class="name">' . $file_name . '</span>&nbsp;&nbsp;<div style="float:right"><button type="button" class="blue-button" onclick="location.href=\'/files/download/' . $row['id'] . '\'">下載</button>&nbsp;<button type="button" file_id="' . $row['id'] . '" class="red-button delete_file">刪除</button></div></li>';
                }
                // sort file
                ksort($html);
                foreach ($html as $row) {
                    $result_html .= $row;
                }
                $result_html .= '</ul>';
            break;
            case 'table':
                $result_html = '<table id="file_list" class="admin-table" ' . $show . '>';
                $result_html .= '<tr>';
                $result_html .= '<th width="50">選取</th>';
                $result_html .= '<th>標題</th>';
                $result_html .= '<th width="150">動作</th>';
                $result_html .= '</tr>';
                foreach ($result as $row) {
                    $file_name = (empty($row['alias_name'])) ? $row['orig_name'] : $row['alias_name'];
                    $html[$file_list_array[$row['id']]] = '<tr>';
                    $html[$file_list_array[$row['id']]] .= '<td><input type="checkbox" name="id[]" value="' . $row['id'] . '" checked></td>';
                    $html[$file_list_array[$row['id']]] .= '<td style="text-align:left;"><img style="vertical-align: middle;" src="http://techpromot.ccu.edu.tw/images/icon/Download.png">&nbsp;<span file_id="' . $row['id'] . '" class="name">' . $file_name . '</span></td>';
                    $html[$file_list_array[$row['id']]] .= '<td><button type="button" class="blue-button" onclick="location.href=\'/files/download/' . $row['id'] . '\'">下載</button>&nbsp;<button type="button" file_id="' . $row['id'] . '" class="red-button delete_file">刪除</button></td>';
                    $html[$file_list_array[$row['id']]] .= '</tr>';
                }
                // sort file
                ksort($html);
                foreach ($html as $row) {
                    $result_html .= $row;
                }
                $result_html .= '</table>';
            break;
            case 'image':
                $result_html = '<div id="file_list" class="media-grid" ' . $show . '>';
                foreach ($result as $row) {
                    $file_name = (empty($row['alias_name'])) ? $row['orig_name'] : $row['alias_name'];
                    $html[$file_list_array[$row['id']]] = '<div class="thumbnail"><a rel="group" href="/files/get/' . $row['name'] . '/600/400/"><img alt="" src="/files/get/' . $row['name'] . '/100/100"></a><br /><input type="checkbox" name="id[]" value="' . $row['id'] . '" checked><button type="button" file_id="' . $row['id'] . '" class="red-button cover_file">封面</button></div>';
                }
                // sort file
                ksort($html);
                foreach ($html as $row) {
                    $result_html .= $row;
                }
                $result_html .= '</div>';
            break;
            case 'attachment':
                $image_array = array();
                $file_array = array();
                foreach ($result as $row) {
                    if ($row['is_image']) {
                        $image_array[$file_list_array[$row['id']]] = $row;
                    } else {
                        $file_array[$file_list_array[$row['id']]] = $row;
                    }
                }
                // sort array
                ksort($file_array);
                ksort($image_array);
                $data = array(
                    "image_array" => $image_array,
                    "file_array" => $file_array
                );

                $result_html = $this->_ci->load->view("files/attachment", $data, true);
            break;
            case 'album':
                $data = array(
                    "image_array" => $result
                );

                $result_html = $this->_ci->load->view("files/album", $data, true);
            break;
        }

        return $result_html;
    }
}
