<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ws_client extends CI_Controller 
{
	var $domain;
	
	function __construct()
	{		
		parent::__construct();		
		$this->domain = base_url();
	}

	function index()	// Add a new user to db
	{		
		// Hard-coded version
		$this->load->spark('restclient/2.0.0');		
		$this->load->library('rest');

		// Run some setup
		$this->rest->initialize(array(
										'server' => $this->domain.'index.php/api/user/'										
									 )
								);

		// Send/receive data		
		$username = 'to.msaads@gmail.com';
		$passwd = 'saadabc';
		$user_status = 'ACTIVE';
		$User_Type = '3';
		$user = $this->rest->post('adduser', 	array('Email' => $username, 
													  'Password' => $passwd,
													  'User_Type' => $User_Type,
													  'User_Status' => $user_status),
																							'json');
		
		//var_dump($user);
		//$this->rest->show_response();
		$this->rest->debug();
	}
	
	function reg_user()	// Add a new user to db
	{		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('username', 'Email', 'required|valid_email|min_length[5]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[again_password]|min_length[6]|xss_clean');
		$this->form_validation->set_rules('again_password', 'Reenter Password', 'required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('User_Status', 'User Status', 'required|xss_clean');
		$this->form_validation->set_rules('User_Type', 'User Type', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test/test_user_registration');
		}
		else
		{		
			$this->load->spark('restclient/2.0.0');		
			$this->load->library('rest');

			// Run some setup
			$this->rest->initialize(array(
											'server' => $this->domain.'index.php/api/user/'											
										 )
									);

			// Send/receive data		
			$username 	= $_POST['username'];
			$passwd 	= $_POST['password'];
			$User_Status = $_POST['User_Status'];
			$User_Type 	= $_POST['User_Type'];
			$user = $this->rest->post('adduser',	array('Email' => $username, 
														  'Password' => $passwd, 
														  'User_Status' => $User_Status,
														  'User_Type' => $User_Type),
																								'json');
					
			$this->rest->debug();
		} // else
	}
	
	function signin()	// Signin
	{		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('username', 'Email', 'required|valid_email|min_length[5]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test/test_signin');
		}
		else
		{		
			$this->load->spark('restclient/2.0.0');		
			$this->load->library('rest');

			// Run some setup
			$this->rest->initialize(array(
											'server' => $this->domain.'index.php/api/user/'											
										 )
									);

			// Send/receive data		
			$username = $_POST['username'];
			$passwd = $_POST['password'];
			
			$user = $this->rest->post('signin', array('Email' => $username, 
													  'Password' => $passwd),
																								'json');
					
			$this->rest->debug();
		} // else
	}
	
	function signout()	// SignOut
	{		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('token', 'Token', 'required|min_length[20]|xss_clean');		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test/test_signout');
		}
		else
		{		
			$this->load->spark('restclient/2.0.0');		
			$this->load->library('rest');

			// Run some setup
			$this->rest->initialize(array(
											'server' => $this->domain.'index.php/api/user/'											
										 )
									);

			// Send/receive data		
			$token = $_POST['token'];			
			
			$user = $this->rest->post('signout', 
									  array('token' => $token),
									  'json');
					
			$this->rest->debug();
		} // else
	}
	
	function session()	// Session
	{		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('token', 'Token', 'required|min_length[20]|xss_clean');		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test/test_session');
		}
		else
		{		
			$this->load->spark('restclient/2.0.0');		
			$this->load->library('rest');

			// Run some setup
			$this->rest->initialize(array(
											'server' => $this->domain.'index.php/api/user/'											
										 )
									);

			// Send/receive data		
			$token = $_POST['token'];			
			
			$user = $this->rest->post('session', 
											  array('token' => $token),
											  'json');
					
			$this->rest->debug();
		} // else
	}
	
	function del_user()	// Delete user from db
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('token', 'Token', 'required|min_length[20]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('test/test_del_user');
		}
		else
		{
			$this->load->spark('restclient/2.0.0');		
			$this->load->library('rest');

			// Run some setup
			$this->rest->initialize(array(
											'server' => $this->domain.'index.php/api/user/',											
										));

			// Send/receive data		
			$token = $_POST['token'];
			$user = $this->rest->post('del_user', array('token' => $token), 'json');
					
			$this->rest->debug();
		}
	}
}

/* End of file Ws_client.php */
