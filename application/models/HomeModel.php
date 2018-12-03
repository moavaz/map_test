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
	function getAllCustomersDatatables($from,$to){
		if ($from == 'null' && $to =='null') {
			$query = $this->db->query("select * from customer");
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
			else{
				return $query->result();
			}
		}
		$query = $this->db->query("select * 
			from customer 
			where date >= str_to_date('".$from."', '%Y-%m-%d') and date <= str_to_date('".$to."', '%Y-%m-%d')");
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else{
			return $query->result();
		}
	}
}
?>