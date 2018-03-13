<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pagination Config
*/
 
// --------------------------------------------------------------------------

//$config['base_url'] = '';
//$config['per_page'] = 2;
//$config['uri_segment'] = 3;
$config['num_links'] = 4;
//$config['page_query_string'] = TRUE;
//$config['use_page_numbers'] = TRUE;
//$config['query_string_segment'] = 'page';

$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-end">';
$config['full_tag_close'] = '</ul></nav><!--pagination-->';

$config['first_link'] = '&laquo; First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last &raquo;';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next &rarr;';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&larr; Previous';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:;"><span class="sr-only">(current)</span>';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

// $config['display_pages'] = FALSE;
// 
$config['attributes'] = array('class' => 'page-link');

// --------------------------------------------------------------------------

/* End of file pagination.php */