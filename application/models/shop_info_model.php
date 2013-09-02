<?php

class shop_info_model extends CI_Model 
{
	var $Shop_No	= '';	//	int(11)
	var $Shop_Name	= '';	//	varchar(255)
	var $User_ID	= '';	//	bigint(20)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_last_ten_entries()	// Get last 10 entires from db
    {
        $query = $this->db->get('shop_info', 100);
        return $query->result_array();
    }
	
	function get_s_shops()
	{
		$this->db->select('shop_info.Shop_No, shop_info.Shop_Name, shop_info.Shop_Logo, shop_info.User_ID');
		$this->db->from('shop_info');
		$this->db->where('user.User_Type', 2);
		$this->db->join('user', 'user.User_ID = shop_info.User_ID');

		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_r_shops()
	{
		$this->db->select('shop_info.Shop_No, shop_info.Shop_Name, shop_info.Shop_Logo, shop_info.User_ID');
		$this->db->from('shop_info');
		$this->db->where('user.User_Type', 3);
		$this->db->join('user', 'user.User_ID = shop_info.User_ID');

		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_user_entries($user_id)	// Get entries for the user
    {
        $this->db->where('User_ID', $user_id);
		$query = $this->db->get('shop_info');
        return $query->result_array();
    }
	
	function get_shop_entry($Shop_No)	// Get entry for the Notification ID
    {
        $this->db->where('Shop_No', $Shop_No);
		$this->db->limit(1);
		$query = $this->db->get('shop_info');
        return $query->result_array();
    }
	
	function is_Shop_No($Shop_No)	// Check Shop_No when it is matched from db
    {
		$this->db->select('Shop_No');
		$this->db->where('Shop_No', $Shop_No);
		$this->db->from('shop_info');
		$count = $this->db->count_all_results();
		var_dump($count);
		return $count;
	}
	
	function insert_entry()	// Insert a shop in db
    {
		$this->db->select('Shop_No');
		$this->db->from('shop_info');
		$this->db->where('Shop_No', $_POST['Shop_No']);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		
		if(!count($result))	// If this Shop No is already in DB then don't insert it
		{
			$this->Shop_No		= $_POST['Shop_No'];
			$this->Shop_Name	= $_POST['Shop_Name'];
			$this->User_ID		= $_POST['User_ID'];

			$this->db->insert('shop_info', $this);
			
			if ($this->db->affected_rows()) {return true;}
			else 							{return false;}
		}
		else return false;
    }
    
    function delete_entry($Shop_No)	// Delete a shop from db
    {
		$this->db->delete('shop_info', array('Shop_No' => $Shop_No));
		if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
	}
	
	function update_entry()	// Update a shop in db
    {
		$data = array(
					   'Shop_Name' 	=> $_POST['Shop_Name'],
					   'Shop_Logo' 	=> $_POST['Shop_Logo'],
					   'User_ID' 	=> $_POST['User_ID'],
					);

		$this->db->where('Shop_No', $_POST['Shop_No']);
		$this->db->update('shop_info', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
}