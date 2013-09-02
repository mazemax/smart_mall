<?php

class cinema_data_model extends CI_Model 
{
	var $Movie_ID			= '';	//	int(11)
	var $Movie_Name			= '';	//	varchar(255)
	var $Movie_TicketPrice	= '';	//	int(11)
	var $Movie_ShowDate		= '';	//	date
	var $Movie_ShowTime		= '';	//	time
	var $Movie_Format		= '';	//	varchar(255)
	var $Movie_CinemaHall	= '';	//	varchar(255)
	var $Movie_Description	= '';	//	longtext
	var $Movie_TrailerURL	= '';	//	varchar(255)
	var $User_ID			= '';	//	smallint(20)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_last_ten_entries()	// Get last 10 entires from db
    {
        $query = $this->db->get('cinema_data', 100);
        return $query->result_array();
    }
	
	function get_user_entries($user_id)	// Get entries for the user
    {
        $this->db->where('User_ID', $user_id);
		$query = $this->db->get('cinema_data');
        return $query->result_array();
    }
	
	function get_movie_entry($Movie_ID)	// Get entry for the Movie_ID
    {
        $this->db->where('Movie_ID', $Movie_ID);
		$this->db->limit(1);
		$query = $this->db->get('cinema_data');
        return $query->result_array();
    }
	
	function insert_entry()	// Insert a movie in db
    {
		/*$this->db->select('Movie_ID');
		$this->db->from('cinema_data');
		$this->db->where('Movie_ID', $_POST['Movie_ID']);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result_array();
		*/
		//if(!count($result))	// If this Item ID is already in DB then don't insert it
		{
			//$this->Movie_ID			= $_POST['Movie_ID'];
			$this->Movie_Name			= $_POST['Movie_Name'];
			$this->Movie_TicketPrice	= $_POST['Movie_TicketPrice'];
			$this->Movie_ShowDate		= $_POST['Movie_ShowDate'];
			$this->Movie_ShowTime		= $_POST['Movie_ShowTime'];
			$this->Movie_Format			= $_POST['Movie_Format'];
			$this->Movie_CinemaHall		= $_POST['Movie_CinemaHall'];
			$this->Movie_Description	= $_POST['Movie_Description'];
			$this->Movie_TrailerURL		= $_POST['Movie_TrailerURL'];
			$this->User_ID				= $_POST['User_ID'];

			$this->db->insert('cinema_data', $this);
			
			if ($this->db->affected_rows()) {return true;}
			else 							{return false;}
		}
		//else return false;
    }
    
    function delete_entry($Movie_ID)	// Delete a movie from db
    {
		$this->db->delete('cinema_data', array('Movie_ID' => $Movie_ID));
		if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
	}
	
	function update_entry($Movie_ID)	// Update a movie in db
    {
		$data = array( 'Movie_Name' 		=> $_POST['Movie_Name'],
					   'Movie_TicketPrice'	=> $_POST['Movie_TicketPrice'],
					   'Movie_ShowDate' 	=> $_POST['Movie_ShowDate'],
					   'Movie_ShowTime' 	=> $_POST['Movie_ShowTime'],
					   'Movie_Format'		=> $_POST['Movie_Format'],
					   'Movie_CinemaHall' 	=> $_POST['Movie_CinemaHall'],
					   'Movie_Description'	=> $_POST['Movie_Description'],
					   'Movie_TrailerURL' 	=> $_POST['Movie_TrailerURL'],
					   'User_ID' 			=> $_POST['User_ID'],
					);

		$this->db->where('Movie_ID', $Movie_ID);
		$this->db->update('cinema_data', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
}