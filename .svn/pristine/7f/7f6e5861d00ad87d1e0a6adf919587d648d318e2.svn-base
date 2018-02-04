<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('base.php');

class Home extends Base {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index() {
		$this->set_title("Home");
		$this->add_to_center("home/","index");
		$this->load_lc_template();
	}
	
	public function admin() {
		$this->load->view('login');
	}
	
	public function register() {
		$this->load->view('register_view');
	}
	
	public function privilages() {
		
	}
	

}