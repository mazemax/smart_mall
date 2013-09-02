<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

// Products for Smart Mall
class Store_data extends REST_Controller
{
	function getstore_data_get()	// Get a product by product code
    {
        if(!$this->get('Product_Code')) {$this->response(NULL, 200);}
        
        $this->load->model('store_data_model');
        $data = $this->store_data_model->get_product_entry($this->get('Product_Code'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Product could not be found'), 404);}
    }    
    
    function addstore_data_post()
    {        
        if($this->post('p_code'))
        {
			$this->load->model('store_data_model');
			
			$_POST['p_code']	= $this->post('p_code');
			$_POST['p_name']	= $this->post('p_name');
			$_POST['p_brand']	= $this->post('p_brand');
			$_POST['p_quantity']= $this->post('p_quantity');
			$_POST['p_price']	= $this->post('p_price');
			$_POST['p_poster']	= $this->post('p_poster');
			$_POST['user_id']	= $this->post('user_id');
			
			if ($this->store_data_model->insert_entry())
				{$message = array('message' => 'New product Added to Database');}
			else
				{$message = array('message' => 'Error! Product NOT Added to Database');}
		}
		else {$message = array('message' => 'Error! Enter valid Product Code');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function delstore_data_post()
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
    	    	
		if($this->post('p_code'))
		{
			$this->load->model('store_data_model');
			$this->store_data_model->delete_entry($this->post('p_code'));
			$message = array('message' => 'Product DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Product not DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
	
	function updatestore_data_post()
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
    	    	
		if($this->post('p_code'))
		{
			$this->load->model('store_data_model');
			$_POST['p_code']	= $this->post('p_code');
			$_POST['p_name']	= $this->post('p_name');
			$_POST['p_brand']	= $this->post('p_brand');
			$_POST['p_quantity']= $this->post('p_quantity');
			$_POST['p_price']	= $this->post('p_price');
			$_POST['p_poster']	= $this->post('p_poster');
			$_POST['user_id']	= $this->post('user_id');
			$this->store_data_model->update_entry($this->post('p_code'));
			$message = array('message' => 'Product Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Product not Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
    
    function stores_data_get()	// Get all products
    {
        $this->load->model('store_data_model');
        $stores = $this->store_data_model->get_last_ten_entries();        
        
        if($stores) {$this->response($stores, 200); /* 200 being the HTTP response code */}
        else       {$this->response(array('error' => 'Couldn\'t find any Products!'), 404);}
    }
}
