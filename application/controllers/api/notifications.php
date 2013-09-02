<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

// Notifications for Smart Mall
class Notifications extends REST_Controller
{
	function getnotifications_get()	// Get a Notification by Notification ID
    {
        if(!$this->get('Notification_ID')) {$this->response(NULL, 200);}
        
        $this->load->model('notifications_model');
        $data = $this->notifications_model->get_notification_entry($this->get('Notification_ID'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Notification could not be found'), 404);}
    }
	
	function getusernotifications_get()	// Get a Notification by User ID
    {
        if(!$this->get('User_ID')) {$this->response(NULL, 200);}
        
        $this->load->model('notifications_model');
        $data = $this->notifications_model->get_user_entries($this->get('User_ID'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Notification could not be found'), 404);}
    }
    
    function addnotifications_post()
    {        
        if($this->post('User_ID'))
        {
			$this->load->model('notifications_model');
			
			$_POST['Notification_Name']		= $this->post('Notification_Name');
			$_POST['Notification_Details']	= $this->post('Notification_Details');
			$_POST['Notification_StartDate']= $this->post('Notification_StartDate');
			$_POST['Notification_EndDate']	= $this->post('Notification_EndDate');
			$_POST['User_ID']				= $this->post('User_ID');
			
			if ($this->notifications_model->insert_entry())
				{$message = array('message' => 'New Notification Added to Database');}
			else
				{$message = array('message' => 'Error! Notification NOT Added to Database');}
		}
		else {$message = array('message' => 'Error! Enter valid User ID');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function delnotifications_post()
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
    	    	
		if($this->post('Notification_ID'))
		{
			$this->load->model('notifications_model');
			$this->notifications_model->delete_entry($this->post('Notification_ID'));
			$message = array('message' => 'Notification DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Notification not DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
	
	function updatenotifications_post()
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
    	    	
		if($this->post('Notification_ID'))
		{
			$this->load->model('notifications_model');
			$_POST['Notification_ID']		= $this->post('Notification_ID');
			$_POST['Notification_Name']		= $this->post('Notification_Name');
			$_POST['Notification_Details']	= $this->post('Notification_Details');
			$_POST['Notification_StartDate']= $this->post('Notification_StartDate');
			$_POST['Notification_EndDate']	= $this->post('Notification_EndDate');
			$_POST['User_ID']				= $this->post('User_ID');
			$this->notifications_model->update_entry($this->post('Notification_ID'));
			$message = array('message' => 'Notification Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Notification not Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
    
    function all_notifications_get()	// Get all movies
    {
        $this->load->model('notifications_model');
        $data = $this->notifications_model->get_last_ten_entries();        
        
        if($data) 	{$this->response($data, 200); /* 200 being the HTTP response code */}
        else       	{$this->response(array('error' => 'Couldn\'t find any Notifications!'), 404);}
    }
}
