<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminAuth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(ADMIN.'/authmodel');
        $this->load->helper('security');
    }

	public function dashboard()
	{		
        $this->auth_session();
		//$this->load->view(ADMIN.'/dashboard');
        $this->load->view('employee_view');
	}

	public function auth_session()
	{
		if(!$this->session->has_userdata('username') || !$this->session->has_userdata('email') || 
            !$this->session->has_userdata('logged_in') || $this->session->userdata('logged_in') != '1')
		redirect(ADMIN.'/login');	
	}

    public function clear_user_session()
    {
        $array_items = array('id','username','email','logged_in');
        $this->session->unset_userdata($array_items);  
    }

    public function logout(){

        $this->clear_user_session();
        redirect(ADMIN.'/login');             
    }

	public function login($data = array()){

        $this->clear_user_session();
        $this->load->view(ADMIN.'/login', $data);
    }


    public function loginverify(){
        
        $this->clear_user_session();        

        if($this->input->post('signin')){ // required|xss_clean|valid_email|max_length[50]
            
            $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|max_length[50]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|min_length[8]');

            $this->session->set_flashdata('login_inputs',array('username'=>$this->input->post('username'),
                    'password' => $this->input->post('password'))); 
                    
            if ($this->form_validation->run() == true) {
                
                $con['conditions'] = array(
                    'username'=>$this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'status' => '1'
                );
 
                $checkLogin = $this->authmodel->logincheck($con);
                if($checkLogin['status']){

                    $userdata = array(
                        'id'  => $checkLogin['result']['id'],
                        'username'  => $checkLogin['result']['username'],
                        'email'     => $checkLogin['result']['email'],
                        'logged_in' => $checkLogin['result']['status']
                    );

                    /*
                    // Friendly URL Slug Creator
                    $config = array(
                        'table' => 'users',
                        'field' => 'username',
                        'title' => 'title',
                        'id' => 'id',
                        'replacement' => 'dash' // Either dash or underscore
                    );
                    $this->load->library('slug', $config);

                    $id = 1; // Not Mandatory
                    $data = array(
                        'username' => 'shafeek',
                    );
                    //echo $data['uri'] = $this->slug->create_uri($data,$id);
                    //echo $this->slug->get_keybyslug('shafeek-2');
                    //echo $this->slug->get_slugbykey(2);
                    exit;
                    */

                    $this->session->set_userdata($userdata);
                    $this->session->set_flashdata('success',array('User logged in successfully!!'));
                    redirect(ADMIN.'/dashboard');
                    exit;
                }else{
                    $this->session->set_flashdata('error',array('Invalid input given!!'));                    
                }            
            }
            else
                $this->session->set_flashdata('error', validation_errors_array());
            
            //$this->load->view(ADMIN.'/login');            
            redirect(ADMIN.'/login');
        }
    }    

}
