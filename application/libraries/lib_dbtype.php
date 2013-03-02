<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name: Db_type 
*
* Author: Hendry H.
*
*/

class Lib_dbtype
{
    /**
     * CodeIgniter global
     *
     * @var string
     **/
    protected $ci;

    /**
     * __construct
     *
     * @return void
     * @author Ben
     **/
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function getFieldTypes($tablename)
    {   
        switch ($tablename) {
            case AGENT_STORE_TABLE: 
                $fields = array(
                    'idagentstore'  => 'int'
                    ,'motto'        => 'varchar'
                    ,'area'         => 'varchar'
                    ,'service'      => 'varchar'
                    ,'skill'        => 'varchar'
                    ,'aboutme'      => 'text'
                    ,'test'         => 'float'
                );
                break;

            case SALE_HOUSE_TABLE : 
                $fields = array(
                    'type'          => 'int'
//                    ,'title'        => ''
//                    ,'price'        => ''
//                    ,'per_price'    => ''
//                    ,'total_feet'   => ''
//                    ,'major_feet'   => ''
//                    ,'attach_feet'  => ''
//                    ,'public_feet'  => ''
//                    ,'land_feet'    => ''
                    ,'room'         => 'int'
                    ,'parlor'       => 'int'
                    ,'bathroom'     => 'int'
                    ,'balcony'      => 'int'
                    ,'floor'        => 'int'
                    ,'total_floor'  => 'int'
                    ,'age'          => 'int'
                    ,'car_num'      => 'int'
                    ,'car_type'     => 'int'
//                    ,'house_title'  => ''
//                    ,'county'       => ''
//                    ,'district'     => ''
//                    ,'zipcode'      => ''
//                    ,'address'      => ''
//                    ,'number'       => ''
                    ,'hidden_number'=> 'int'
//                    ,'manager_price'=> ''
//                    ,'position'     => ''
                    ,'decorating_type'=> 'int'
//                    ,'facility_type'=> ''
                    ,'is_lease'     => 'int'
//                    ,'traffic'      => ''
                    ,'is_submit'    => 'int'
//                    ,'submit_date'  => ''
                    ,'is_owner'     => 'int'
                    ,'agent_type'   => 'int'
//                    ,'agent_name'   => ''
//                    ,'agent_phone'  => ''
//                    ,'description'  => ''
                    ,'view_count'   => 'int'
                    ,'phone_count'  => 'int'
                    ,'favorite_count'=>'int' 
                    ,'question_count'=>'int' 
                    ,'reply_count'  => 'int'
                    ,'status'       => 'int'
//                    ,'file_list'    => ''
                    ,'sale_price'   => 'int'
                );
                break;
            default:
                $fields = array();
                break;
        }
        return $fields;
    }


	public function cast_fieldtypes($record, $tablename) {
        $fieldTypes = $this->getFieldTypes($tablename);
	    foreach($record as $fieldName => $value) {
	        if(isset($fieldTypes[$fieldName])) {
	            $type = $fieldTypes[$fieldName];
	            $value = $record[$fieldName];
	            switch ($type) {
	                case 'd':
	                case 'date': 
	                case 'f':
	                case 'float':
	                case 'i':
	                case 'integer':
	                case 'int':
	                    $value = ($value == "") ? null : $value ;
	                    break;
	                case 's':
	                case 'string':
	                case 'varchar':
	                case 'text':
	                    $value = (string) $value;
	                    break;
	                default:
	                    break;
	            }
	            $record[$fieldName] = $value;
	        }
	    }
	    return $record;
	}
}
