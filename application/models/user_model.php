<?php

class user_model extends CI_Model 
{
	var $User_ID	 	= '';	//	bigint(20)
	var $Email	 		= '';	//	varchar(500)
	var $Password	 	= '';	//	varchar(500)
	var $User_Status	= '';	//	varchar(500)
	var $Creation_Date	= '';	//	date
	var $User_Type	 	= '';	//	int(11)

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()	// Get last 10 user from db
    {
        $query = $this->db->get('user', 100);
        return $query->result_array();
    }
    
	function is_username($uname='NULL')	// Check username when it is matched from db
    {
		$this->db->select('Email');
		$this->db->where('Email', $uname); 
		$this->db->from('user');		
		$count = $this->db->count_all_results();
		return $count;
	}
	
    function is_user_pass($uname='NULL', $pass='NULL')	// Check username and pass when it is matched from db
    {
		$this->db->select('Email, Password');
		$this->db->where('Email', $uname); 
		$this->db->where('Password', $pass);
		$this->db->from('user');
		$count = $this->db->count_all_results();
		return $count;
	}
	
	function get_user_id($uname='NULL')	// Get user id
    {
		$this->db->select('User_ID');
		$this->db->where('Email', $uname);		
		$query = $this->db->get('user');
		$id = $query->row_array();
		return $id['User_ID'];
	}
	
	function get_user_status($uname='NULL')	// Get user status
    {
		$this->db->select('User_Status');
		$this->db->where('Email', $uname);		
		$query = $this->db->get('user');
		return $query->result_array();
	}
	
	function get_user_full($uname='NULL')	// Get user full
	{
		$this->db->select('User_ID, Email, Password, User_Status, User_Type');
		$this->db->where('Email', $uname);		
		$query = $this->db->get('user');
		return $query->result_array();
	}
	
	function get_user_by_id_full($uid='1')	// Get user status
	{
		$this->db->select('Email, Password, User_Status, User_Type');
		$this->db->where('User_ID', $uid);		
		$query = $this->db->get('user');
		return $query->result_array();
	}

    function insert_entry()	// Insert a user in db
    {
		$this->Email	 		= $_POST['Email'];
		$this->Password	 		= md5($_POST['Password']);
		$this->User_Status	 	= $_POST['User_Status'];
		$this->Creation_Date	= date('o-m-d');		
		$this->User_Type		= $_POST['User_Type'];

        $this->db->insert('user', $this);
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
    
    function delete_entry($user_id)	// Delete a user from db
    {
		$this->db->delete('user', array('User_ID' => $user_id)); 
	}
	
	function delete_entry_by_username($username)	// Delete a user from db w.r.t. username
    {
		$this->db->delete('user', array('Email' => $username)); 
	}
	
    function update_password($new_passwd, $username)	// Update password in db
    {		
		$pass = md5($new_passwd);
		$code = '';
		
		$query = $this->db->query("UPDATE user SET Password='$pass' WHERE Email = '$username'");        
        
        if (mysql_affected_rows()) 		{return true;}
        else 							{return false;}
    }

    function update_entry()	// Update a user in db
    {
		$data = array(
					   'Password' 	=> md5($_POST['Password']),
					   'User_Type' 	=> $_POST['User_Type']
					);

		$this->db->where('User_ID', $_POST['User_ID']);
		$this->db->update('user', $data); 
        
        if ($this->db->affected_rows()) {return true;}
        else 							{return false;}
    }
	
	function get_user_role($email)
	{
		$this->db->select('User_Type');
		$this->db->from('user');
		$this->db->where('Email', $email);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}

}
