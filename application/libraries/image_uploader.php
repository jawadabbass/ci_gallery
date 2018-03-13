<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_uploader {
	
	public function do_upload($file, $caption, $dist_path = 'assets/uploads/gallery_images', $make_thumb = true)
	{
		

        $new_file_name = strtolower($caption . '-');
        $new_file_name = str_replace(array('.', ' ', '/'), '-', $new_file_name);
        $new_file_name = str_replace(array('"', "'"), '', $new_file_name);

        $image_name = '';
        if (isset($_FILES[$file]) && !empty($_FILES[$file]['tmp_name'])) {

            $config = array();
            $config['upload_path'] = realpath(APPPATH . '../'.$dist_path.'/');
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['size'] = '5120';
            $config['file_name'] = $new_file_name;
            $config['remove_spaces'] = TRUE;
			
			$CI =& get_instance();
			$CI->load->library('upload', $config);

            if (!$CI->upload->do_upload($file)) {
                die($CI->upload->display_errors());
            } else {
                $file_data = $CI->upload->data();
                $image_name = $file_data['file_name'];
				if($make_thumb === true){
					$this->resize_image($image_name, $dist_path);
				}
            }
        }
        return $image_name;
    
	}
	
	private function resize_image($image_name, $dist_path = 'assets/uploads/gallery_images')
    {

        $config_img = array();
        $config_img['image_library'] = 'gd2';
        $config_img['source_image'] = realpath(APPPATH . '../'.$dist_path.'/') . '/' . $image_name;
		
        $config_img['maintain_ratio'] = TRUE;
        $config_img['width'] = 800;
        $config_img['height'] = 800;
        $config_img['quality'] = 100;
		
		$CI =& get_instance();
        $CI->load->library('image_lib', $config_img);

        if (!$CI->image_lib->resize()) {
            die($CI->image_lib->display_errors());
        }

        /*         * ****************************************************************************************** */
        $CI->image_lib->clear();
        /*         * ****************************************************************************************** */
        $config_img = array();
        $config_img['image_library'] = 'gd2';
        $config_img['source_image'] = realpath(APPPATH . '../'.$dist_path.'/') . '/' . $image_name;
        $config_img['new_image'] = realpath(APPPATH . '../'.$dist_path.'/thumbs/');
        $config_img['maintain_ratio'] = TRUE;
        $config_img['width'] = 200;
        $config_img['height'] = 200;
        $config_img['quality'] = 100;

        $CI->image_lib->initialize($config_img);
        if (!$CI->image_lib->resize()) {
            die($CI->image_lib->display_errors());
        }
    }
}
