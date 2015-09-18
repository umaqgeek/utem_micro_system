<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms_users extends MY_Controller 
{
    var $parent_page = "ms_users";
	function __construct()
	{
            parent::__construct(); 
			// Load session library
			$this->load->library('session');
	}
        
    private function viewpage($page='ms_mainpage', $data=array())
    {
			echo $this->load->view('ms_header', $data, true);
            echo $this->load->view($this->parent_page.'/ms_menu', $data, true);
            echo $this->load->view($this->parent_page.'/'.$page, $data, true);
            echo $this->load->view('ms_footer', $data, true);
    }


        public function index()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');
                
                $crud->set_table('users');
				$crud->set_subject('users');
				$crud->columns('us_id','type_id','name','ic_no','address','email');
                $crud->set_rules('ic_no','ic number','numeric');
				$crud->required_fields('us_id','type_id', 'email', 'username', 'password');
				$crud->change_field_type('email', 'email');

				$crud->set_relation('type_id','typeofuser','type_id');
				
				$output = $crud->render();
				
                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function inventory()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');    
                $crud->set_table('inventory');
				/*$crud->field_type('body','multiselect',
            array('1' => 'active', '2' => 'private','3' => 'spam' , '4' => 'deleted'));*/

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function vendor()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');
                
                $crud->set_table('vendor');

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function sales()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');
                $crud->set_table('sales');

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }		

	
}
