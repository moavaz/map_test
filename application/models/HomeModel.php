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
	function getAllCustomers(){
		$query = $this->db->query("select * from customer");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return false;
		}
	}
}
?>