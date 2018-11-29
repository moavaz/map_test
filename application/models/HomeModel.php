<?php
class HomeModel extends CI_Model{

	function createCustomer($data){

		$query = $this->db->insert('customer',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}
}
?>