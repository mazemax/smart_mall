<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smart_mall extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	function index()	// API usage examples
	{
		redirect('/smart_mall/main_page', 'refresh');
	}
	
	function index2()	// API usage examples
	{
		$this->load->view('ws_samples');
	}
	
	function main_page()	// Main home page of device tracker after login
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{			
			$this->load->model('user_model');
			$username = $this->session->userdata('username');
			$id = $this->user_model->get_user_id($username);
			$role = $this->user_model->get_user_role($username);
			$data['message']  = $this->session->flashdata('message');
			
			if($role[0]['User_Type'] == 1)		// System Admin
			{				
				$this->load->view('main_view1', $data);
			}
			else if($role[0]['User_Type'] == 2)	// Clients - Shops
			{
				redirect('/smart_mall/notifications_display', 'refresh');
			}
			else if($role[0]['User_Type'] == 3)	// Clients - Resturant
			{
				$this->load->model('restaurant_menu_model');
				$data['r_menus'] = $this->restaurant_menu_model->get_user_entries($id);
				$this->load->view('main_view3', $data);
			}
			else if($role[0]['User_Type'] == 4)	// Store Keeper
			{
				$this->load->model('store_data_model');
				$data['products'] = $this->store_data_model->get_user_entries($id);
				$this->load->view('main_view4', $data);
			}
			else if($role[0]['User_Type'] == 5)	// Cinema
			{
				$this->load->model('cinema_data_model');
				$data['movies'] = $this->cinema_data_model->get_user_entries($id);
				$this->load->view('main_view5', $data);
			}
			else if($role[0]['User_Type'] == 6)	// Customer
			{
				$this->load->view('main_view', $data);
			}
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}
	}
	
	/*====================== LOGIN SYSTEM ======================*/
	function login()	// login to website - before login
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			redirect('/smart_mall/main_page', 'refresh');
		}
		else
		{
			$this->load->library('form_validation');
					
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('username', 'Username', 'required|valid_email|min_length[5]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login_screen');
			}
			else
			{
				//var_dump($_POST);
				
				$this->load->model('user_model');
				
				if (isset($_POST['username']) && isset($_POST['password']))
				{
					$count = $this->user_model->is_user_pass($_POST['username'], md5($_POST['password']));
					if (!$count) // If username and password do not match with db
					{
						unset($_POST);					
						redirect('/smart_mall/login', 'refresh');
					}	// if !count
					else
					{
						// Set session information
						$newdata = array('username'  => $_POST['username'],
										 'logged_in' => TRUE
										);
						$this->session->set_userdata($newdata);
						redirect('/smart_mall/main_page', 'refresh');
					}	// else !count
				}	// if username and pass
							
			}	// else $this->form_validation->run()
		}	// else $logged_in
	}
	
	function logout()	// logout of website
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$newdata = array('logged_in' => FALSE);
			$this->session->set_userdata($newdata);
			redirect('/smart_mall/login', 'refresh');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}
	}
	/*====================== LOGIN SYSTEM ======================*/	
	
	/*====================== USER MANAGEMENT ======================*/
	function new_user()		// New user registration
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		$this->form_validation->set_rules('user', 'Email', 'required|valid_email|min_length[5]|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'required|matches[again_pass]|min_length[6]|xss_clean');
		$this->form_validation->set_rules('again_pass', 'Reenter Password', 'required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('user_type', 'Who are you?', 'required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('user_registration');
		}
		else
		{
			//var_dump($_POST);
			
			$this->load->model('user_model');
			
			if (isset($_POST['user']))
			{
				$count = $this->user_model->is_username($_POST['user']);				
				if ($count) // The user-name is already registered, so move to login
				{unset($_POST); redirect('/smart_mall/login', 'refresh');}
				else
				{
					$_POST['Email'] =  $_POST['user'];
					$_POST['Password'] =  $_POST['pass'];
					$_POST['User_Status'] = 'ACTIVE';
					$_POST['User_Type'] = $_POST['user_type'];
					$this->user_model->insert_entry();
				
					// Automatically login to the website
					if (isset($_POST['pass']))
					{
						$count = $this->user_model->is_user_pass($_POST['user'], md5($_POST['pass']));
						if (!$count) // If username and password do not match with db
						{
							unset($_POST);					
							redirect('/smart_mall/login', 'refresh');
						}	// if !count
						else
						{
							// Set session information
							$newdata = array('username'  => $_POST['user'],								   
											 'logged_in' => TRUE
											);
							$this->session->set_userdata($newdata);
							//redirect('/smart_mall/register_devices', 'refresh');
							redirect('/smart_mall/main_page', 'refresh');
						}	// else !count
					}	// if username and pass
				}
			}
			else
			{		
				// No user-name is submitted as input, so redirecting to get inputs again
				unset($_POST); redirect('/smart_mall/new_user', 'refresh');
			}
		}
	}
	
	function update_user()	// Update user information after login
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{			
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('username', 'Email', 'required|valid_email|min_length[5]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[again_password]|min_length[6]|xss_clean');
			$this->form_validation->set_rules('again_password', 'Reenter Password', 'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('Shop_No', 'Shop Number', 'required|xss_clean');
			$this->form_validation->set_rules('Shop_Name', 'Shop Name', 'required|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$this->load->model('shop_info_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$data['shop'] = $this->shop_info_model->get_user_entries($data['id']);
				
				// Get user data from db w.r.t session username
				$data['user_data'] = $this->user_model->get_user_full($data['username']);
				
				$this->load->view('update_user_view', $data);
			}
			else
			{
				//var_dump($_POST);
				
				$this->load->model('user_model');
				$this->load->model('shop_info_model');
				
				$_POST['Email'] 	  = $_POST['username'];
				$_POST['Password'] 	  =  $_POST['password'];
				$_POST['User_Status'] = 'ACTIVE';
				$_POST['User_ID']	  = $this->user_model->get_user_id($_POST['username']);;
				$this->user_model->update_entry();
				
				if($this->shop_info_model->is_Shop_No($_POST['Shop_No']))
				{	$d1 = $this->shop_info_model->update_entry();	}
				else
				{	$d2 = $this->shop_info_model->insert_entry();	}
				
				redirect('/smart_mall/update_user', 'refresh');
			}	// else $this->form_validation->run()
		}	// if $logged_in
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	/*====================== USER MANAGEMENT ======================*/
	
	/*====================== Store Keeper ======================*/
	function product_entry()	// Store Keeper - Add new product
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('p_code', 'Product Code', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_name', 'Product Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_brand', 'Product Brand', 'min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_quantity', 'Product Quantity', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('p_price', 'Product Unit Price', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('product_entry_view', $data);
			}
			else
			{
				// After form validation
				//print_r($_POST);
				
				$config['upload_path'] 	= './uploads/product/';
				$config['allowed_types']= 'gif|jpg|png';
				$config['max_size']		= '1000';
				$config['max_width']  	= '1024';
				$config['max_height']  	= '768';
				$this->load->library('upload', $config);
				$_POST['p_poster'] = '';
				
				if (!$this->upload->do_upload('p_poster'))
				{
					$message = 'Product Poster could not be uploaded!';
				}
				else
				{
					$upload_data = $this->upload->data();
					$_POST['p_poster'] = './uploads/product/'.$upload_data['file_name'];
				}
				
				//var_dump($_POST['p_poster']);
								
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['user_id'] = $this->user_model->get_user_id($username);
				
				$this->load->model('store_data_model');
				$inserted = $this->store_data_model->insert_entry();
				if($inserted) {$message = 'Product is added successfully. '.$message;}
				else {$message = 'Error! Product could not be added! '.$message;}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/product_entry', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function product_update($Product_Code)	// Store Keeper - Update a product
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('p_code', 'Product Code', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_name', 'Product Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_brand', 'Product Brand', 'min_length[3]|xss_clean');
			$this->form_validation->set_rules('p_quantity', 'Product Quantity', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('p_price', 'Product Unit Price', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('store_data_model');
				$data['message'] = $this->session->flashdata('message');
				$product	 	 = $this->store_data_model->get_product_entry($Product_Code);
				$data['data'] = $product[0];
				$this->load->view('product_update_view', $data);
			}
			else
			{
				// After form validation
				//var_dump($_POST);
				//var_dump($_FILES);
				
				$config['upload_path'] 	= './uploads/product/';
				$config['allowed_types']= 'gif|jpg|png';
				$config['max_size']		= '1000';
				$config['max_width']  	= '1024';
				$config['max_height']  	= '768';
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('p_poster'))
				{
					if (isset($_FILES['p_poster']['name']))
					$message = 'Product Poster could not be uploaded!';
				}
				else
				{
					$upload_data = $this->upload->data();
					$_POST['p_poster'] = './uploads/product/'.$upload_data['file_name'];
				}
				
				//var_dump($_POST['p_poster']);
								
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['user_id'] = $this->user_model->get_user_id($username);
				
				$this->load->model('store_data_model');
				$updated = $this->store_data_model->update_entry($Product_Code);
				if($updated) {$message = 'Product is updated successfully. '.$message;}
				else {$message = 'Error! Product could not be updated! '.$message;}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/main_page', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function product_delete($Product_Code)	// Store Keeper - Delete a product
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->model('store_data_model');
			$del = $this->store_data_model->delete_entry($Product_Code);
			if($del) {$message = 'Product is deleted successfully. ';}
			else {$message = 'Error! Product could not be deleted! ';}
			$this->session->set_flashdata('message', $message);
			
			redirect('/smart_mall/main_page', 'refresh');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	/*====================== Store Keeper ======================*/
	
	/*====================== Clients - Resturant ======================*/
	function restaurant_menu_add()	// Clients - Resturant - Add restaurant menu
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Item_Name', 'Item Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Item_Price', 'Item Price', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('restaurant_menu_view', $data);
			}
			else
			{
				// After form validation
				//print_r($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('restaurant_menu_model');
				$inserted = $this->restaurant_menu_model->insert_entry();
				if($inserted) {$message = 'Restaurant Menu is added successfully. ';}
				else {$message = 'Error! Restaurant Menu could not be added! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/restaurant_menu_add', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function restaurant_menu_update($Item_ID)	// Clients - Resturant - Update restaurant menu
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Item_Name', 'Item Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Item_Price', 'Item Price', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$this->load->model('restaurant_menu_model');
				$data['message'] = $this->session->flashdata('message');
				$r_menus	 	 = $this->restaurant_menu_model->get_item_entry($Item_ID);
				$data['data'] = $r_menus[0];
				$this->load->view('restaurant_menu_update_view', $data);
			}
			else
			{
				// After form validation
				//var_dump($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('restaurant_menu_model');
				$updated = $this->restaurant_menu_model->update_entry($Item_ID);
				if($updated) {$message = 'Restaurant Menu is updated successfully. ';}
				else {$message = 'Error! Restaurant Menu could not be updated! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/main_page', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function restaurant_menu_delete($Item_ID)	// Clients - Resturant - Delete restaurant menu
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->model('restaurant_menu_model');
			$del = $this->restaurant_menu_model->delete_entry($Item_ID);
			if($del) {$message = 'Restaurant Menu is deleted successfully. ';}
			else {$message = 'Error! Restaurant Menu could not be deleted! ';}
			$this->session->set_flashdata('message', $message);
			
			redirect('/smart_mall/main_page', 'refresh');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	/*====================== Clients - Resturant ======================*/
	
	/*====================== Cinema ======================*/
	function movie_add()	//Cinema - Add movie
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Movie_Name', 'Movie Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_TicketPrice', 'Ticket Price', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_ShowDate', 'Show Date', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_ShowTime', 'Show Time', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_Format', 'Format', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_CinemaHall', 'Cinema Hall','required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_Description', 'Description', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_TrailerURL', 'Trailer URL','prep_url|min_length[3]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('movie_view', $data);
			}
			else
			{
				// After form validation
				$pieces = explode("/", $_POST['Movie_ShowDate']);
				$_POST['Movie_ShowDate'] = $pieces[2]."-".$pieces[0]."-".$pieces[1];
				//var_dump($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('cinema_data_model');
				$inserted = $this->cinema_data_model->insert_entry();
				if($inserted) {$message = 'Movie is added successfully. ';}
				else {$message = 'Error! Movie could not be added! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/movie_add', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function movie_update($Movie_ID)	// Cinema - Update movie
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Movie_Name', 'Movie Name', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_TicketPrice', 'Ticket Price', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_ShowDate', 'Show Date', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_ShowTime', 'Show Time', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_Format', 'Format', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Movie_CinemaHall', 'Cinema Hall','required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_Description', 'Description', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Movie_TrailerURL', 'Trailer URL','prep_url|min_length[3]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				
				$this->load->model('cinema_data_model');
				$data['message'] = $this->session->flashdata('message');
				$r_menus	 	 = $this->cinema_data_model->get_movie_entry($Movie_ID);
				$data['data'] = $r_menus[0];
				$this->load->view('movie_update_view', $data);
			}
			else
			{
				// After form validation
				//var_dump($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('cinema_data_model');
				$updated = $this->cinema_data_model->update_entry($Movie_ID);
				if($updated) {$message = 'Movie is updated successfully. ';}
				else {$message = 'Error! Movie could not be updated! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/main_page', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function movie_delete($Movie_ID)	// Cinema - Delete movie
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->model('cinema_data_model');
			$del = $this->cinema_data_model->delete_entry($Movie_ID);
			if($del) {$message = 'Movie is deleted successfully. ';}
			else {$message = 'Error! Movie could not be deleted! ';}
			$this->session->set_flashdata('message', $message);
			
			redirect('/smart_mall/main_page', 'refresh');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	/*====================== Cinema ======================*/
	
	/*====================== Notifications ======================*/
	function notifications_add()	//Notifications - Add
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Notification_Name', 'Description', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Notification_StartDate', 'Start Date', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Notification_EndDate', 'End Date', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$data['message'] = $this->session->flashdata('message');
				$this->load->view('notifications_add_view', $data);
			}
			else
			{
				// After form validation
				$config['upload_path'] 	= './uploads/notifications/';
				$config['allowed_types']= 'gif|jpg|png';
				$config['max_size']		= '1000';
				$config['max_width']  	= '1024';
				$config['max_height']  	= '768';
				$this->load->library('upload', $config);
				$_POST['Notification_Details'] = '';
				
				if (!$this->upload->do_upload('Notification_Details'))
				{
					$message = 'Notification could not be uploaded!';
				}
				else
				{
					$upload_data = $this->upload->data();
					$_POST['Notification_Details'] = './uploads/notifications/'.$upload_data['file_name'];
				}
				
				//var_dump($_POST['Notification_Details']);
				
				$pieces = explode("/", $_POST['Notification_StartDate']);
				$_POST['Notification_StartDate'] = $pieces[2]."-".$pieces[0]."-".$pieces[1];
				$pieces = explode("/", $_POST['Notification_EndDate']);
				$_POST['Notification_EndDate'] = $pieces[2]."-".$pieces[0]."-".$pieces[1];
				//var_dump($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('notifications_model');
				$inserted = $this->notifications_model->insert_entry();
				if($inserted) {$message = 'Notification is added successfully. ';}
				else {$message = 'Error! Notification could not be added! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/notifications_add', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function notifications_update($Notification_ID)	// Notifications - Update
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->library('form_validation');

			$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
			$this->form_validation->set_rules('Notification_Name', 'Description', 'required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('Notification_StartDate', 'Start Date', 'required|min_length[1]|xss_clean');
			$this->form_validation->set_rules('Notification_EndDate', 'End Date', 'required|min_length[1]|xss_clean');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('user_model');
				$data['username'] = $this->session->userdata('username');
				$data['id'] = $this->user_model->get_user_id($data['username']);
				$role = $this->user_model->get_user_role($data['username']);
				$data['role'] = $role[0]['User_Type'];
				$this->load->model('notifications_model');
				$data['message'] = $this->session->flashdata('message');
				$notifications 	 = $this->notifications_model->get_notification_entry($Notification_ID);
				$data['data'] = $notifications[0];
				$this->load->view('notifications_update_view', $data);
			}
			else
			{
				// After form validation
				$config['upload_path'] 	= './uploads/notifications/';
				$config['allowed_types']= 'gif|jpg|png';
				$config['max_size']		= '1000';
				$config['max_width']  	= '1024';
				$config['max_height']  	= '768';
				$this->load->library('upload', $config);
				$_POST['Notification_Details'] = '';
				
				if (!$this->upload->do_upload('Notification_Details'))
				{
					$message = 'Notification could not be uploaded!';
				}
				else
				{
					$upload_data = $this->upload->data();
					$_POST['Notification_Details'] = './uploads/notifications/'.$upload_data['file_name'];
				}
				
				//var_dump($_POST['Notification_Details']);
				
				if(!empty($_POST['Notification_StartDate']))
				{
					$pieces1 = explode("/", $_POST['Notification_StartDate']);
					$_POST['Notification_StartDate'] = $pieces1[2]."-".$pieces1[0]."-".$pieces1[1];
				}
				if(!empty($_POST['Notification_EndDate']))
				{
					$pieces2 = explode("/", $_POST['Notification_EndDate']);
					$_POST['Notification_EndDate'] = $pieces2[2]."-".$pieces2[0]."-".$pieces2[1];
				}
				$_POST['Notification_StartDate'] = rtrim(ltrim($_POST['Notification_StartDate'], "-"), "-");
				$_POST['Notification_EndDate']   = rtrim(ltrim($_POST['Notification_EndDate'], "-"), "-");
				$_POST['Notification_ID']   	 = $Notification_ID;
				//var_dump($_POST);
				
				$username = $this->session->userdata('username');
				$this->load->model('user_model');
				$_POST['User_ID'] = $this->user_model->get_user_id($username);
				
				$this->load->model('notifications_model');
				$updated = $this->notifications_model->update_entry($Notification_ID);
				if($updated) {$message = 'Notification is updated successfully. ';}
				else 		 {$message = 'Error! Notification could not be updated! ';}
				$this->session->set_flashdata('message', $message);
				
				redirect('/smart_mall/notifications_display', 'refresh');
			}	// else $this->form_validation->run()
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function notifications_delete($Notification_ID)	// Notifications - Delete
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->model('notifications_model');
			$del = $this->notifications_model->delete_entry($Notification_ID);
			if($del) {$message = 'Notification is deleted successfully. ';}
			else {$message = 'Error! Notification could not be deleted! ';}
			$this->session->set_flashdata('message', $message);
			
			redirect('/smart_mall/notifications_display', 'refresh');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
	function notifications_display()	// Notifications - Display
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->model('user_model');
			$data['username'] = $this->session->userdata('username');
			$data['id'] = $this->user_model->get_user_id($data['username']);
			$role = $this->user_model->get_user_role($data['username']);
			$data['role'] = $role[0]['User_Type'];
			
			$this->load->model('notifications_model');
			$data['notifications'] = $this->notifications_model->get_user_entries($data['id']);
			$data['message']  	   = $this->session->flashdata('message');
			$this->load->view('notifications_display_view', $data);
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	/*====================== Notifications ======================*/
	
	function contact_us()
	{
		$logged_in = $this->session->userdata('logged_in');
		if($logged_in)
		{
			$this->load->view('main_view');
		}
		else
		{
			redirect('/smart_mall/login', 'refresh');
		}	// else $logged_in
	}
	
}

/* End of file smart_mall.php */
/* Location: ./system/application/controllers/smart_mall.php */
