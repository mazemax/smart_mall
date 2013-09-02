<?php

class store_data_model extends CI_Model 
{
	var $Product_Code			= '';	//	int(11)
	var $Product_Name			= '';	//	varchar(255)
	var $Product_Brand			= '';	//	varchar(255)
	var $Product_QuantityInStore= '';	//	int(11)
	var $Product_UnitPrice		= '';	//	int(11)
	var $Product_Poster			= '';	//	varchar(255)
	var $User_ID				= '';	//	bigint(20)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_last_ten_entries()	// Get last 10 user from db
    {
        $query = $this->db->get('store_data', 100);
        return $query->result_array();
    }
	
	function get_user_entries($user_id)	// Get entries for the user
    {
        $this->db->where('User_ID', $user_id);
		$query = $this->db->get('store_data');
        return $query->result_array();
    }
	
	function get_product_entry($Product_Code)	// Get entry for the product code
    {
        $this->db->where('Product_Code', $Product_Code);
		$this->db->limit(1);
		$query = $this->db->get('store_data');
        return $query->result_array();
    }
	
	function insert_entry()	// Insert a user in db
    {
		$this->db->select('Product_Code');
		$this->db->from('store_data');
		$this->db->where('Product_Code', $_POST['p_code']);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		
		if(!count($result))	// If this product code is already in DB then don't insert it
		{
			$this->Product_Code	 			= $_POST['p_code'];
			$this->Product_Name	 			= $_POST['p_name'];
			$this->Product_Brand	 		= $_POST['p_brand'];
			$this->Product_QuantityInStore	= $_POST['p_quantity'];
			$this->Product_UnitPrice		= $_POST['p_price'];
			$this->Product_Poster			= $_POST['p_poster'];
			$this->User_ID					= $_POST['user_id'];

			$this->db->insert('store_data', $this);
			
			if ($this->db->affected_rows()) {return true;}
			else 							{return false;}
		}
		else return false;
    }
    
    function delete_entry($p_code)	// Delete a user from db
    {
		$this->db->delete('store_data', array('Product_Code' => $p_code)); 
		if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
	}
	
	function update_entry($p_code)	// Update a user in db
    {
		$data = array( //'Product_Code' 			=> $_POST['p_code'],
					   'Product_Name' 			=> $_POST['p_name'],
					   'Product_Brand' 			=> $_POST['p_brand'],
					   'Product_QuantityInStore'=> $_POST['p_quantity'],
					   'Product_UnitPrice' 		=> $_POST['p_price'],
					   'Product_Poster' 		=> $_POST['p_poster'],
					   'User_ID' 				=> $_POST['user_id'],
					);

		$this->db->where('Product_Code', $p_code);
		$this->db->update('store_data', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
}