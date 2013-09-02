<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_client_sample extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		// Load the rest client spark
		$this->load->spark('restclient/2.0.0');

		// Load the library
		$this->load->library('rest');

		// Run some setup
		$this->rest->initialize(array('server' => 'http://twitter.com/'));

		// Pull in an array of tweets
		$username = 'virtual_saad';
		$tweets = $this->rest->get('statuses/public_timeline/'.$username.'.xml');
		
		var_dump($tweets);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

