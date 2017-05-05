<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function __construct() {
        $this->table = 'users';
    }


    function loginCheck($params = array()){
        
        $this->db->select('*');
        //$this->db->from($this->table);        
        
        if(array_key_exists("conditions",$params)){
            //$this->db->or_where(array('email' => $params['conditions']['username'], 'password' => $params['conditions']['password'], 'status' => $params['conditions']['status']));
            $this->db->or_group_start()
                ->where(array('username' => $params['conditions']['username'], 'password' => $params['conditions']['password'], 'status' => $params['conditions']['status']))
            ->group_end();
            $this->db->or_group_start()    
                ->where(array('email' => $params['conditions']['username'], 'password' => $params['conditions']['password'], 'status' => $params['conditions']['status']))
            ->group_end();    
        }

        $query = $this->db->get($this->table);    
        //$this->db->last_query();
        
        $data = array('status' => false,'result' => array());
        if($query->num_rows() == 1)
            $data = array('status' => true,'result' => $query->row_array());

        //return fetched data
        return $data;
        exit;
        
    }

    /*
     * get rows from the users table
     */
    function getRows($params = array()){

        $this->db->select('*');
        $this->db->from($this->table);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
            }else{
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }

        //return fetched data
        return $result;
    }
    
    /*
     * Insert user information
     */
    public function insert($data = array()) {
        //add created and modified data if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        //insert user data to users table
        $insert = $this->db->insert($this->table, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }

}
