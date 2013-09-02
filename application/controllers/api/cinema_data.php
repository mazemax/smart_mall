<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

// Cinema data for Smart Mall
class Cinema_data extends REST_Controller
{
	function getcinema_data_get()	// Get a Movie by Movie ID
    {
        if(!$this->get('Movie_ID')) {$this->response(NULL, 200);}
        
        $this->load->model('cinema_data_model');
        $data = $this->cinema_data_model->get_movie_entry($this->get('Movie_ID'));    	
    	
        if($data) {$this->response($data, 200); /* 200 being the HTTP response code */}
        else   	  {$this->response(array('error' => 'Movie could not be found'), 404);}
    }    
    
    function addcinema_data_post()
    {        
        if($this->post('User_ID'))
        {
			$this->load->model('cinema_data_model');
			
			$_POST['Movie_Name']		= $this->post('Movie_Name');
			$_POST['Movie_TicketPrice']	= $this->post('Movie_TicketPrice');
			$_POST['Movie_ShowDate']	= $this->post('Movie_ShowDate');
			$_POST['Movie_ShowTime']	= $this->post('Movie_ShowTime');
			$_POST['Movie_Format']		= $this->post('Movie_Format');
			$_POST['Movie_CinemaHall']	= $this->post('Movie_CinemaHall');
			$_POST['Movie_Description']	= $this->post('Movie_Description');
			$_POST['Movie_TrailerURL']	= $this->post('Movie_TrailerURL');
			$_POST['User_ID']			= $this->post('User_ID');
			
			if ($this->cinema_data_model->insert_entry())
				{$message = array('message' => 'New movie Added to Database');}
			else
				{$message = array('message' => 'Error! Movie NOT Added to Database');}
		}
		else {$message = array('message' => 'Error! Enter valid User ID');}
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function delcinema_data_post()
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
    	    	
		if($this->post('Movie_ID'))
		{
			$this->load->model('cinema_data_model');
			$this->cinema_data_model->delete_entry($this->post('Movie_ID'));
			$message = array('message' => 'Movie DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Movie not DELETED');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
	
	function updatecinema_data_post()
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
    	    	
		if($this->post('Movie_ID'))
		{
			$this->load->model('cinema_data_model');
			$_POST['Movie_Name']		= $this->post('Movie_Name');
			$_POST['Movie_TicketPrice']	= $this->post('Movie_TicketPrice');
			$_POST['Movie_ShowDate']	= $this->post('Movie_ShowDate');
			$_POST['Movie_ShowTime']	= $this->post('Movie_ShowTime');
			$_POST['Movie_Format']		= $this->post('Movie_Format');
			$_POST['Movie_CinemaHall']	= $this->post('Movie_CinemaHall');
			$_POST['Movie_Description']	= $this->post('Movie_Description');
			$_POST['Movie_TrailerURL']	= $this->post('Movie_TrailerURL');
			$_POST['User_ID']			= $this->post('User_ID');
			$this->cinema_data_model->update_entry($this->post('Movie_ID'));
			$message = array('message' => 'Movie Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
		else
		{
			$message = array('message' => 'Movie not Updated');
			$this->response($message, 200); // 200 being the HTTP response code
		}
    }
    
    function cinemas_data_get()	// Get all movies
    {
        $this->load->model('cinema_data_model');
        $data = $this->cinema_data_model->get_last_ten_entries();        
        
        if($data) 	{$this->response($data, 200); /* 200 being the HTTP response code */}
        else       	{$this->response(array('error' => 'Couldn\'t find any Movies!'), 404);}
    }
}
