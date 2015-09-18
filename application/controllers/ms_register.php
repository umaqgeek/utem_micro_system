<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to start session in order to access it through CI
class Ms_register extends CI_Controller 
{
    var $parent_page = "auth";
	function __construct()
	{
            parent::__construct(); 
			// Load session library
			$this->load->library('session');
	}
        
        private function viewpage($page='v_create_user',$data=array())
        {
			echo $this->load->view('ms_header', $data, true);
			echo $this->load->view('ms_menu', $data, true);
            echo $this->load->view($this->parent_page.'/'.$page, $data, true);
			echo $this->load->view('ms_footer', $data, true);
        }

        public function index()
	{
            $this->viewpage();
	}
        
        function checklogin()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $bol_login = $this->simpleloginsecure->login($username, $password);
            
            if ($bol_login) {
				$session_data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
				);
        		// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
                redirect(site_url('ms_users'));
            } else {
                redirect(site_url('ms_login'));
            }
        }
		
				
		
        function logout()
        {
            $this->simpleloginsecure->logout();
            redirect(site_url('ms_login'));
        }
}
