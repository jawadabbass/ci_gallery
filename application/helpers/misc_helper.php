<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('set_success_flashdata'))
{
	
	function set_success_flashdata($message = '')
	{
		$CI =& get_instance();
		$CI->session->set_flashdata('success_msg', $message);
	}	
	
}

if ( ! function_exists('set_error_flashdata'))
{
	
	function set_error_flashdata($message = '')
	{
		$CI =& get_instance();
		$CI->session->set_flashdata('error_msg', $message);
	}	
	
}

if ( ! function_exists('print_error_flashdata'))
{
	
	function print_error_flashdata()
	{
		$CI =& get_instance();
		if(!empty($CI->session->flashdata('error_msg'))){
			echo '<p class="text-danger">';
			echo $CI->session->flashdata('error_msg');
			echo '</p>';
		}
	}	
	
}

if ( ! function_exists('print_success_flashdata'))
{
	
	function print_success_flashdata()
	{
		$CI =& get_instance();
		if(!empty($CI->session->flashdata('success_msg'))){
			echo '<p class="text-success">';
			echo $CI->session->flashdata('success_msg');
			echo '</p>';
		}
	}	
	
}

if ( ! function_exists('print_msg_flashdata'))
{
	
	function print_msg_flashdata()
	{
		print_success_flashdata();
		print_error_flashdata();
	}	
	
}