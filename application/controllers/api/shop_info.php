<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

// Shop Info for Smart Mall
class Shop_info extends REST_Controller
{
	function getshop_info_get()	// Get a shop by Shop No
    {
        if(!$this->get('no')) {$this->response(NULL, 200);}
        
        $this->load->model('shop_info_model');
        $shop = $this->shop_info_model->get_shop_entry($this->get('no'));    	
    	
        if($shop) {$this->response($shop, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Shop could not be found'), 404);}
    }    
    
    function addshop_info_post()
    {        
        if($this->post('Shop_No'))
        {
			$this->load->model('shop_info_model');
			
				$_POST['Shop_No'] 			= $this->post('Shop_No'); 
				$_POST['Shop_Name'] 		= $this->post('Shop_Name');
				$_POST['User_ID'] 			= $this->post('User_ID');
				
				if ($this->shop_info_model->insert_entry())
					{$message = array('message' => 'New shop Added to Database');}
				else
					{$message = array('message' => 'Error! Shop NOT Added to Database');}
		}
		else {$message = array('message' => 'Error! Enter valid Shop No');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function delshop_info_post()
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
    	    	
		if($this->post('Shop_No'))
		{
			$this->load->model('shop_info_model');
			$this->shop_info_model->delete_entry($this->post('Shop_No'));
			$message = array('message' => 'Shop DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Shop not DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
	
	function updateshop_info_post()
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
    	    	
		if($this->post('Shop_No'))
		{
			$this->load->model('shop_info_model');
			$_POST['Shop_No']	= $this->post('Shop_No');
			$_POST['Shop_Name']	= $this->post('Shop_Name');
			$_POST['User_ID']	= $this->post('User_ID');
			$this->shop_info_model->update_entry($this->post('Shop_No'));
			$message = array('message' => 'Shop Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Shop not Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
    
    function shops_info_get()	// Get all shops
    {
        $this->load->model('shop_info_model');
        $shops = $this->shop_info_model->get_last_ten_entries();        
        
        if($shops) {$this->response($shops, 200); /* 200 being the HTTP response code */}
        else       {$this->response(array('error' => 'Couldn\'t find any Shops!'), 404);}
    }
	
	function r_shops_get()	// Get all R shops
    {
        $this->load->model('shop_info_model');
        $shops = $this->shop_info_model->get_r_shops();        
        
        if($shops) {$this->response($shops, 200); /* 200 being the HTTP response code */}
        else       {$this->response(array('error' => 'Couldn\'t find any Shops!'), 404);}
    }
	
	function s_shops_get()	// Get all S shops
    {
        $this->load->model('shop_info_model');
        $shops = $this->shop_info_model->get_s_shops();        
        
        if($shops) {$this->response($shops, 200); /* 200 being the HTTP response code */}
        else       {$this->response(array('error' => 'Couldn\'t find any Shops!'), 404);}
    }
}
