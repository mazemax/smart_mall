<?php

class notifications_model extends CI_Model 
{
	var $Notification_ID		= '';	//	int(11)
	var $Notification_Name		= '';	//	varchar(255)
	var $Notification_Details	= '';	//	varchar(255)
	var $Notification_StartDate	= '';	//	date
	var $Notification_EndDate	= '';	//	date
	var $User_ID				= '';	//	bigint(20)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_last_ten_entries()	// Get last 10 entires from db
    {
        $query = $this->db->get('notifications', 100);
        return $query->result_array();
    }
	
	function get_user_entries($user_id)	// Get entries for the user
    {
        $this->db->where('User_ID', $user_id);
		$query = $this->db->get('notifications');
        return $query->result_array();
    }
	
	function get_notification_entry($Notification_ID)	// Get entry for the Notification ID
    {
        $this->db->where('Notification_ID', $Notification_ID);
		$this->db->limit(1);
		$query = $this->db->get('notifications');
        return $query->result_array();
    }
	
	function insert_entry()	// Insert a notification in db
    {
		/*$this->db->select('Notification_ID');
		$this->db->from('notifications');
		$this->db->where('Notification_ID', $_POST['Notification_ID']);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		*/
		//if(!count($result))	// If this Notification ID is already in DB then don't insert it
		{
			//$this->Notification_ID		= $_POST['Notification_ID'];
			$this->Notification_Name		= $_POST['Notification_Name'];
			$this->Notification_Details		= $_POST['Notification_Details'];
			$this->Notification_StartDate	= $_POST['Notification_StartDate'];
			$this->Notification_EndDate		= $_POST['Notification_EndDate'];
			$this->User_ID					= $_POST['User_ID'];

			$this->db->insert('notifications', $this);
			
			if ($this->db->affected_rows()) {return true;}
			else 							{return false;}
		}
		//else return false;
    }
    
    function delete_entry($Notification_ID)	// Delete a notification from db
    {
		$this->db->delete('notifications', array('Notification_ID' => $Notification_ID));
		if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
	}
	
	function update_entry($Notification_ID)	// Update a notification in db
    {
		$data = array(
					   'Notification_Name' 		=> $_POST['Notification_Name'],
					   'Notification_Details' 	=> $_POST['Notification_Details'],
					   'Notification_StartDate' => $_POST['Notification_StartDate'],
					   'Notification_EndDate' 	=> $_POST['Notification_EndDate'],
					   'User_ID' 				=> $_POST['User_ID'],
					);

		$this->db->where('Notification_ID', $Notification_ID);
		$this->db->update('notifications', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
}