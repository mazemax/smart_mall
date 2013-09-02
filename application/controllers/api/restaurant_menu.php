<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

// Restaurant menu for Smart Mall
class Restaurant_menu extends REST_Controller
{
	function getrestaurant_menu_get()	// Get a Item by Item ID
    {
        if(!$this->get('Item_ID')) {$this->response(NULL, 200);}
        
        $this->load->model('restaurant_menu_model');
        $data = $this->restaurant_menu_model->get_item_entry($this->get('Item_ID'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Item could not be found'), 404);}
    }
	
	function getuserrestaurant_menu_get()	// Get a Item by User ID
    {
        if(!$this->get('User_ID')) {$this->response(NULL, 200);}
        
        $this->load->model('restaurant_menu_model');
        $data = $this->restaurant_menu_model->get_user_entries($this->get('User_ID'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Item could not be found'), 404);}
    }
    
    function addrestaurant_menu_post()
    {        
        if($this->post('User_ID'))
        {
			$this->load->model('restaurant_menu_model');
			
			$_POST['Item_Name']		= $this->post('Item_Name');
			$_POST['Item_Price']	= $this->post('Item_Price');
			$_POST['User_ID']		= $this->post('User_ID');
			
			if ($this->restaurant_menu_model->insert_entry())
				{$message = array('message' => 'New Item Added to Database');}
			else
				{$message = array('message' => 'Error! Item NOT Added to Database');}
		}
		else {$message = array('message' => 'Error! Enter valid User ID');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function delrestaurant_menu_post()
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
    	    	
		if($this->post('Item_ID'))
		{
			$this->load->model('restaurant_menu_model');
			$this->restaurant_menu_model->delete_entry($this->post('Item_ID'));
			$message = array('message' => 'Item DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Item not DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
	
	function updaterestaurant_menu_post()
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
    	    	
		if($this->post('Item_ID'))
		{
			$this->load->model('restaurant_menu_model');
			$_POST['Item_Name']	= $this->post('Item_Name');
			$_POST['Item_Price']= $this->post('Item_Price');
			$_POST['User_ID']	= $this->post('User_ID');
			$this->restaurant_menu_model->update_entry($this->post('Item_ID'));
			$message = array('message' => 'Item Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Item not Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
    
    function restaurants_menu_get()	// Get all movies
    {
        $this->load->model('restaurant_menu_model');
        $data = $this->restaurant_menu_model->get_last_ten_entries();        
        
        if($data) 	{$this->response($data, 200); /* 200 being the HTTP response code */}
        else       	{$this->response(array('error' => 'Couldn\'t find any Items!'), 404);}
    }
}
