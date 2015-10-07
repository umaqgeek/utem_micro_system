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
			if(!$data==NULL)
			{ echo $this->load->view($this->parent_page.'/'.$page, $data, true);}
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
				$crud->columns('type_id','name','address','email');
				$crud->display_as('type_id','Type of User');
                $crud->set_rules('ic_no','ic number','numeric');
				$crud->required_fields('us_id','type_id', 'email', 'username', 'password');
				$crud->change_field_type('email', 'email');
				$crud->unset_add();
				$crud->unset_read_fields('username','password');
				$crud->unset_delete();
				$crud->edit_fields('name','ic_no','address','email','username','password');

				$crud->set_relation('type_id','typeofuser','user_type');
				
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
				$crud->columns('item_name','price','us_id');
				$crud->display_as('us_id','Name of User')
					 ->display_as('item_name','Name of Item')
					 ->display_as('price','Price RM');
				$crud->set_relation('us_id','users','name');
				//$crud->set_read_fields('fieldsname');
				$crud->unset_edit_fields('us_id');
				
				
				/*$crud->callback_before_insert('iv_id',array($this,'get_iv_id'));
                $crud->callback_field('iv_id',array($this,'get_iv_id'));*/
				
				
				
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
				$crud->set_relation('iv_id','inventory','item_name');
				$crud->display_as('iv_id','Name of Item')
					 ->display_as('qty','quantity')
					 ->display_as('qty_sold','Quantity sold');
				$crud->unset_edit_fields('sl_id');
				$crud->unset_columns('sl_id');
                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }		

	
}
