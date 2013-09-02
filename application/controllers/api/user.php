<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
include APPPATH.'/libraries/REST_Controller.php';

// User for Smart Mall
class User extends REST_Controller
{
	function getuser_get()	// Get a user by user ID
    {
        if(!$this->get('id')) {$this->response(NULL, 200);}
        
        $this->load->model('user_model');
        $user = $this->user_model->get_user_by_id_full($this->get('id'));    	
    	
        if($user) {$this->response($user, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'User could not be found'), 404);}
    }    
    
    function adduser_post()
    {        
        if($this->post('Email'))
        {
			$this->load->model('user_model');
			$count = $this->user_model->is_username($this->post('Email'));
			if ($count) // The user-name is already registered
			{
				$message = array('message' => 'Try a new Email');
			}
			else     // The user-name is NOT already registered   
			{		
				$_POST['Email'] 			= $this->post('Email'); 
				$_POST['Password'] 			= $this->post('Password');
				$_POST['User_Status'] 		= $this->post('User_Status');
				$_POST['User_Type'] 		= $this->post('User_Type');
				
				if ($this->user_model->insert_entry())
					{$message = array('message' => 'New user Added to Database');}
				else
					{$message = array('message' => 'Error! User NOT Added to Database');}
			} // else
		}
		else {$message = array('message' => 'Error! Enter valid Email');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function signin_post()
    {		
		$_POST['Email'] 			= $this->post('Email'); 
		$_POST['Password'] 			= md5($this->post('Password'));
		
		if(($this->post('Email')) && ($this->post('Password')))
		{
		$this->load->model('user_model');
		$count = $this->user_model->is_user_pass($_POST['Email'], $_POST['Password']);
		
		if($count)
		{			
			// Generate Token
			//$token = md5($_POST['Email'].date('j-m-Y_H:i:s:A').$_POST['Password']);
			
			// Set session information
			$newdata = array('Email'  => $_POST['Email'],
							 //'token'	 => $token,
							 'logged_in' => TRUE
							);
			$this->session->set_userdata($newdata);
			
			$session_id = $this->session->userdata('session_id');
			
			// Login Success
			$message = array('token'	=> $session_id,						 
							 'message' 	=> 'Login Success');
		}
		else
		{$message = array('message' => 'Login failed! Invalid user');}	// Invalid User
		}
		else {$message = array('message' => 'Login failed! Invalid user');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function signout_post()
    {
		// Check token
		if($this->post('token'))
		{
			$_POST['session_id'] 			= $this->post('token');			
			$this->load->model('session_model');
			$count = $this->session_model->is_session($_POST['session_id']);
			
			if($count)
			{
				$this->session_model->delete_entry_by_session_id($_POST['session_id']);
				
				// Signout Success
				$message = array('message' 	=> 'Signout Success');
			}
			else {$message = array('message' => 'Invalid user');}		// Invalid User
		}
		else {$message = array('message' => 'Invalid user');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function session_post()
    {
		// Check token
		if($this->post('token'))
		{
			$_POST['session_id'] 			= $this->post('token');			
			$this->load->model('session_model');
			$count = $this->session_model->is_session($_POST['session_id']);
			
			if($count)
			{
				$sess_data = $this->session_model->get_user_data($_POST['session_id']);
				//print_r($sess_data);				
				$sess_data = @unserialize(strip_slashes($sess_data[0]['user_data']));
				
				echo $sess_data['username']."\n";
				
				// Session Status
				if(isset($sess_data['username']))
					{$message = array('message' 	=> 'Session Success');}
				else
					{$message = array('message' 	=> 'Session Failed');}
			}
			else {$message = array('message' => 'Invalid user');}		// Invalid User
		}
		else {$message = array('message' => 'Invalid user');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }	
    
    function del_user_post()
    {
    	// Check token
		$username = '';
		if($this->post('token'))
		{
			$_POST['session_id'] 			= $this->post('token');			
			$this->load->model('session_model');
			$count = $this->session_model->is_session($_POST['session_id']);
			
			if($count)
			{
				$sess_data = $this->session_model->get_user_data($_POST['session_id']);
				//print_r($sess_data);				
				$sess_data = @unserialize(strip_slashes($sess_data[0]['user_data']));
				
				$username = $sess_data['username'];				
			}
			else {	// Invalid User
					$message = array('message' => 'Invalid user');
					$this->response($message, 200);
				 }				
		}
		else {
				$message = array('message' => 'Invalid user');
				$this->response($message, 200);
			 }
    	    	
		$this->load->model('user_model');
		$this->user_model->delete_entry_by_username($username);
		$this->session_model->delete_entry_by_session_id($_POST['session_id']);
		$message = array('message' => 'User DELETED');
		        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()	// Get all users
    {
        $this->load->model('user_model');
        $users = $this->user_model->get_last_ten_entries();        
        
        if($users) {$this->response($users, 200); /* 200 being the HTTP response code */}
        else       {$this->response(array('error' => 'Couldn\'t find any users!'), 404);}
    }
}
