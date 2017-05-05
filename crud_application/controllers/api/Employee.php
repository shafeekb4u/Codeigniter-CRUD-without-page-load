<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Employee extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->firstvar = "sample";
        $this->load->model('employee_model','employee');        
    }
 
    public function fetch($id = '')
    {        
        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'GET'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        } else {

            $check_auth_client = $this->employee->check_auth_client();
            
            if($check_auth_client == true){

                $cnt = $this->employee->count_all($id);
                if($cnt == 1){
                  json_output(200 ,array('status' => 200,'message' => 'Employees data fetched successfully','result' => $this->employee->get_by_id($id)));  
                }
                elseif($cnt > 1){
                   json_output(200 ,array('status' => 200,'message' => 'Employees data fetched successfully','result' => $this->employee->get_all()));
                }
                else                
                    json_output(200 ,array('status' => 204,'message' => 'No data found'));
                
            }            
        }
    }        
 
}