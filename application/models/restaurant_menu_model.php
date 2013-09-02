<?php

class restaurant_menu_model extends CI_Model 
{
	var $Item_ID	= '';	//	int(11)
	var $Item_Name	= '';	//	varchar(255)
	var $Item_Price	= '';	//	int(11)
	var $User_ID	= '';	//	bigint(20)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_last_ten_entries()	// Get last 10 entires from db
    {
        $query = $this->db->get('restaurant_menu', 100);
        return $query->result_array();
    }
	
	function get_user_entries($user_id)	// Get entries for the user
    {
        $this->db->where('User_ID', $user_id);
		$query = $this->db->get('restaurant_menu');
        return $query->result_array();
    }
	
	function get_item_entry($Item_ID)	// Get entry for the Item ID
    {
        $this->db->where('Item_ID', $Item_ID);
		$this->db->limit(1);
		$query = $this->db->get('restaurant_menu');
        return $query->result_array();
    }
	
	function insert_entry()	// Insert an item in db
    {
		/*$this->db->select('Item_ID');
		$this->db->from('restaurant_menu');
		$this->db->where('Item_ID', $_POST['Item_ID']);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		*/
		//if(!count($result))	// If this Item ID is already in DB then don't insert it
		{
			//$this->Item_ID		= $_POST['Item_ID'];
			$this->Item_Name	= $_POST['Item_Name'];
			$this->Item_Price	= $_POST['Item_Price'];
			$this->User_ID		= $_POST['User_ID'];

			$this->db->insert('restaurant_menu', $this);
			
			if ($this->db->affected_rows()) {return true;}
			else 							{return false;}
		}
		//else return false;
    }
    
    function delete_entry($Item_ID)	// Delete a item from db
    {
		$this->db->delete('restaurant_menu', array('Item_ID' => $Item_ID)); 
		if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
	}
	
	function update_entry($Item_ID)	// Update a item in db
    {
		$data = array( 'Item_Name'  => $_POST['Item_Name'],
					   'Item_Price' => $_POST['Item_Price'],
					   'User_ID' 	=> $_POST['User_ID']
					);

		$this->db->where('Item_ID', $Item_ID);
		$this->db->update('restaurant_menu', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
}