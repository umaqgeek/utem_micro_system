<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms_admin extends MY_Controller 
{
    var $parent_page = "ms_admin";
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
					$crud->set_table('users')
						->set_subject('Users')
						->columns('us_id','type_id','name','ic_no','address','email');
				 
					$crud->add_fields('us_id','type_id','name','ic_no');
					$crud->edit_fields('us_id','type_id','name');
				 
					$crud->required_fields('us_id','type_id');
					$crud->display_as('type_id','Type of User');
					$crud->set_relation('type_id','typeofuser','user_type');
					$crud->unset_fields('username','password');

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
				$crud->set_relation('us_id','users','name');
				//$crud->columns('iv_id','item_name','price','us_id');
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
				$crud->unset_columns('sl_id');
				$crud->set_relation('iv_id','inventory','item_name');
				$crud->display_as('iv_id','Name of Item')
					 ->display_as('qty','quantity')
					 ->display_as('qty_sold','Quantity sold');

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }			
}
