<?php
  class M_conndb extends CI_Model {
	  
	  function getAll($table) {
		  $this->db->select('*');
		  $this->db->from($table);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
	  
	  function get($table, $pri, $id) {
		  $this->db->select('*');
		  $this->db->from($table);
		  $this->db->where($pri, $id);
		  $q = $this->db->get();
		  if($q->num_rows() > 0) {
			  foreach($q->result() as $r) {
				  $d[] = $r;
			  }
			  return $d;
		  }
	  }
     //get the username & password from tbl_usrs
     function get_user($usr)
     {
          $sql = "select * from users where username = '" . $usr ."' and type_id = 'S2'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
	  
	  function add($table, $data) {
		  if($this->db->insert($table, $data)) {
			  return $this->db->insert_id();
		  } else {
			  return 0;
		  }
	  }
	  
	  function edit($table, $pri, $id, $data) {
		  $this->db->where($pri, $id);
		  return $this->db->update($table, $data);
	  }
	  
	  function delete($table, $pri, $id) {
		  $this->db->where($pri, $id);
		  return $this->db->delete($table);
	  }
	
  }

?>