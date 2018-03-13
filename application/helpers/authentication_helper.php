<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_site_user_id'))
{
	
	function get_site_user_id()
	{
		$CI =& get_instance();
		return $CI->session->userdata('site_user_id');
	}	
	
}


if ( ! function_exists('verify_site_user'))
{
	
	function verify_site_user($return_to_url = '')
	{
		$CI =& get_instance();
		if((bool)$CI->session->userdata('site_user_logged_in') === false)
		{
			if($return_to_url != ''){
				$CI->session->set_userdata('return_to_url', $return_to_url);
			}
			redirect('login/', 'refresh');
		}
	}	
	
}


if ( ! function_exists('verify_admin_user'))
{
	
	function verify_admin_user($return_to_url = '')
	{
		$CI =& get_instance();
		if((bool)$CI->session->userdata('admin_user_logged_in') === false)
		{
			if($return_to_url != ''){
				$CI->session->set_userdata('admin_return_to_url', $return_to_url);
			}
			redirect('admin/login/', 'refresh');
		}
	}	
	
}

if ( ! function_exists('put_site_user_login_details'))
{
	
	function put_site_user_login_details($site_user)
	{
		$CI =& get_instance();
		$site_user_data = array(					
			'site_user_id'  => $site_user->id,
			'site_user_email'  => $site_user->email,
			'site_user_full_name' => $site_user->full_name,
			'site_user_logged_in' => TRUE
		);
		$CI->session->set_userdata($site_user_data);
		$return_to_url = $CI->session->userdata('return_to_url');
		$CI->session->unset_userdata('return_to_url');
		if($return_to_url != ''){
			redirect($return_to_url, 'refresh');
		}else{
			redirect('user-dashboard/', 'refresh');
		}
	}	
	
}

if ( ! function_exists('put_admin_user_login_details'))
{
	
	function put_admin_user_login_details($admin_user)
	{
		$CI =& get_instance();
		$admin_user_data = array(					
			'admin_user_id'  => $admin_user->id,
			'admin_user_email'  => $admin_user->email,
			'admin_user_full_name' => $admin_user->full_name,
			'admin_user_logged_in' => TRUE
		);
		$CI->session->set_userdata($admin_user_data);
		$return_to_url = $CI->session->userdata('admin_return_to_url');
		$CI->session->unset_userdata('admin_return_to_url');
		if($return_to_url != ''){
			redirect($return_to_url, 'refresh');
		}else{
			redirect('admin/', 'refresh');
		}
	}	
	
}

if ( ! function_exists('logout_site_user'))
{
	
	function logout_site_user()
	{
		$CI =& get_instance();
		$site_user_data = array(					
			'site_user_id'  => '',
			'site_user_email'  => '',
			'site_user_full_name' => '',
			'site_user_logged_in' => false
		);
		$CI->session->set_userdata($site_user_data);
		redirect('login/', 'refresh');
	}	
	
}

if ( ! function_exists('logout_admin_user'))
{
	
	function logout_admin_user()
	{
		$CI =& get_instance();
		$admin_user_data = array(					
			'admin_user_id'  => '',
			'admin_user_email'  => '',
			'admin_user_full_name' => '',
			'admin_user_logged_in' => false
		);
		$CI->session->set_userdata($admin_user_data);
		redirect('admin/login/', 'refresh');
	}	
	
}

if ( ! function_exists('password'))
{
	
	function password($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}	
	
}