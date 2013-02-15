<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY Controller extend CI_Controller
 *
 * @author      appleboy
 * @copyright   2012 appleboy
 * @link        http://blog.wu-boy.com
 * @package     CodeIgniter
 * @subpackage  CI_Controller
 */
class MY_Controller extends CI_Controller
{

    /**
     * timestamp
     *
     * @var int
     **/
    protected $_time;

    /**
     * __construct
     *
     * @return void
     **/
    public function __construct()
    {
        parent::__construct();
        // load native session
        $this->load->library(array('session'));
        $this->load->helper('form');
        // load template library
        $this->load->spark('codeigniter-template/1.0.2');

        // permission
        $this->_auth();

        // load some data
        $this->_load();

        // define variable
        $this->_time = time();
    }

    /**
     *
     * User Authentication
     *
     */
    private function _auth()
    {
        $ctrl = $this->router->class;
        $action = $this->router->method;

        $this->template->set('ctrl', $ctrl);
        $this->template->set('action', $action);
    }

    /*
     *  load css or javascript
     */
    private function _load()
    {
        $this->_house_type = array(
            '獨棟透天',
            '電梯大樓-華廈',
            '大樓公寓',
            '店面',
            '套房',
            '雅房',
            '辦公室',
            '其它'
        );
        $this->_decorating_type = array(
            '尚未裝潢',
            '簡易裝潢',
            '中檔裝潢',
            '高檔裝潢'
        );
        $this->_facility_type = array(
            '近便利商店',
            '近傳統市場',
            '近百貨公司',
            '近公園綠地',
            '近學校',
            '近醫療機構'
        );
        $this->_car_num = array(
            '有',
            '無',
            '皆可'
        );
        $this->_car_type = array(
            '平面',
            '機械'
        );
        $this->_house_agent = array(
            '屋主',
            '代理人',
            '仲介'
        );
        $this->template->set('_house_type', $this->_house_type);
        $this->template->set('_decorating_type', $this->_decorating_type);
        $this->template->set('_facility_type', $this->_facility_type);
        $this->template->set('_car_num', $this->_car_num);
        $this->template->set('_car_type', $this->_car_type);
        $this->template->set('_house_agent', $this->_house_agent);
        // load controller css
        $css_file_path = 'assets/css/'.$this->router->class.'.css';
        if (file_exists($css_file_path)) {
            $this->template->add_css($css_file_path);
        }
    }

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
