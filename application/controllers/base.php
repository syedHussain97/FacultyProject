<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Base extends CI_Controller {
	
	protected $header_data = array();
	protected $left_data = array();
	protected $center_data = array();
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->header_data["title"] = DEFAULT_SITE_TITLE;
		
		$this->header_data["js_load"] = array();
		$this->header_data["js_type"] = array();
		
		$this->header_data["js_vars"] = array();
		$this->header_data["js_urls"] = array();
		
		$this->header_data["css_load"] = array("default", "jquery-ui-1.8.17.custom");
		$this->header_data["css_type"] = array("", "ui-lightness/");
		
		$this->left_data["view_name"] = array();
		$this->left_data["view_data"] = array();			
		
		$this->center_data["view_name"] = array();
		$this->center_data["view_data"] = array();
	}
	
	/**
	 * Set title of page
	 * 
	 * @param string $title
	 * @return void
	 */
	protected function set_title($title) 
	{
		$this->header_data["title"] = $title;
	}
	
	/**
	 * Add view to left sidebar
	 * 
	 * @param string $module_name
	 * @param string $view_name
	 * @param array $view_data
	 * @return void
	 */
	protected function add_to_left($module_name, $view_name, $view_data = array())
	{
		if(is_string($view_name) && is_array($view_data))
		{
			$this->left_data["view_name"][] = $module_name.$view_name;
			$this->left_data["view_data"][] = $view_data;
		}
	}
	
	/**
	 * Add to the main (centered) content area
	 * 
	 * @param string $module_name
	 * @param string $view_name
	 * @param array $view_data
	 * @return void
	 */
	protected function add_to_center($module_name, $view_name, $view_data = array()) 
	{
		if(is_string($view_name) && is_array($view_data))
		{
			$this->center_data["view_name"][] = $module_name.$view_name;
			$this->center_data["view_data"][] = $view_data;
		}
	}
	
	/**
	 * Add a javascript file
	 * Here $module_name = MISCELLANEOUS means that the JS file will be placed in JS_FOLDER."misc" directory
	 *  
	 * @param string $module_name
	 * @param string $file_name
	 * @return void
	 */
	protected function add_js($module_name, $file_name) 
	{
		if(is_string($file_name)) 
		{
			array_push($this->header_data["js_load"], $file_name);
			array_push($this->header_data["js_type"], $module_name);
		}
	}
	
	/**
	 * Add new stylesheet
	 * Here $module_name = THEME means that the style is specific to theme and will be placed in THEMES_FOLDER
	 * 
	 * @param string $module_name
	 * @param string $file_name
	 * @return void
	 */
	protected function add_css($module_name, $file_name) 
	{
		if(is_string($file_name)) 
		{
			array_push($this->header_data["css_load"], $file_name);
			array_push($this->header_data["css_type"], $module_name);
		}
	}
    
	/**
	 * Render 2 column (Left-Center) template
	 * 
	 * @return void
	 */
	protected function load_lc_template() 
	{
		$render_data = array("header_data" => $this->header_data,
							"left_data" => $this->left_data,
							"center_data" => $this->center_data);
		
		$this->load->view("default", $render_data);
	}
	
	
	/**
	 * Render 2 column (Left-Center) template
	 * 
	 * @return void
	 */
	protected function load_lc_template_admin() 
	{
		$this->header_data["css_load"] = array();
		$this->header_data["css_type"] = array();
		
		$this->add_css("admin/", "reset");
		$this->add_css("admin/", "style");
		$this->add_css("admin/", "invalid");
		
		$this->add_js("","jquery-1.7.1.min");
		$this->add_js("","simpla.jquery.configuration");
		$this->add_js("","facebox");
		$this->add_js("","jquery.wysiwyg");
		$this->add_js("","jquery.datePicker");
		$this->add_js("","jquery.date");
		$this->add_js("","jquery-ui-1.8.18.custom.min");
		
		$render_data = array("header_data" => $this->header_data,
							"left_data" => $this->left_data,
							"center_data" => $this->center_data);
		
		$this->load->view("admin", $render_data);
	}
}

?>