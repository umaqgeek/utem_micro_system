<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

   function __construct()
    {
        parent::__construct();
		$unlocked = array('ms_login', 'ms_users', 'ms_admin');

				if ( ! $this->simpleloginsecure->is_logged_in() OR ! in_array(strtolower(get_class($this)), $unlocked))
				{
					redirect('ms_login');
				}/*elseif($this->simpleloginsecure->is_logged_in() AND  in_array(strtolower(get_class($this)), $unlocked)){
					redirect('admin/');
				}*/

				//$this->output->cache(5);
    }

}