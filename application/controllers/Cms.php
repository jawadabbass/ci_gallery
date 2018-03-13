<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seo_model');                
    }

    public function about_us()
    {
        $data = $this->seo_model->get_seo('about-us');
		$this->load->view('cms/about_us', $data);
    }
	
	public function contact_us()
    {
        $data = $this->seo_model->get_seo('contact-us');
		$this->load->view('cms/contact_us', $data);
    }
	
	public function terms_conditions()
    {
        $data = $this->seo_model->get_seo('terms-conditions');
		$this->load->view('cms/terms_conditions', $data);
    }

}
