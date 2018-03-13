<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_model extends CI_Model
{
    
	private $seo_array = array(
	
		'welcome/index' => array(
							'seo_title'=>'Welcome to CI Gallery',
							'seo_description'=>'Welcome to CI Gallery'
							),
		'gallery' => array(
							'seo_title'=>'This is Gallery page',
							'seo_description'=>'This is Gallery page'
							),
		'add-image' => array(
							'seo_title'=>'This is add-image page',
							'seo_description'=>'This is add-image page'
							),
		'edit-image' => array(
							'seo_title'=>'This is edit-image page',
							'seo_description'=>'This is edit-image page'
							),
		'image-details' => array(
							'seo_title'=>'This is image-details page',
							'seo_description'=>'This is image-details page'
							),
		'about-us' => array(
							'seo_title'=>'This is about-us page',
							'seo_description'=>'This is about-us page'
							),
		'contact-us' => array(
							'seo_title'=>'This is contact-us page',
							'seo_description'=>'This is contact-us page'
							),
		'user-dashboard' => array(
							'seo_title'=>'This is user-dashboard page',
							'seo_description'=>'This is user-dashboard page'
							),
		'login' => array(
							'seo_title'=>'This is login page',
							'seo_description'=>'This is login page'
							),
		'register' => array(
							'seo_title'=>'This is register page',
							'seo_description'=>'This is register page'
							),
		'terms-conditions' => array(
							'seo_title'=>'This is terms-conditions page',
							'seo_description'=>'This is terms-conditions page'
							),
	
	);
	
    public function get_seo($route)
    {       
		if(isset($this->seo_array[$route])){
			return $this->seo_array[$route];
		}else{
			return array(
						'seo_title'=>'Welcome to CI Gallery',
						'seo_description'=>'Welcome to CI Gallery'
					);
		}
        
    }
	
}
