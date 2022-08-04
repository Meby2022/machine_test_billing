<?php
Class Login_db extends CI_Model
{
	

	
	function get_products()
	{
		$this->db->select('*');
		$this->db->from('products');
		$data=$this->db->get();
		return $data->result();

	}
	
	
	function get_purchase_details()
	{
		$this->db->select('*');
		$this->db->from('customer_details');
		$data=$this->db->get();
		return $data->result();

	}
	
	
	
}
?>