<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="<?php echo $seo_description; ?>">
<title><?php echo $seo_title; ?></title>
<?php $this->load->view('common/header_css_js'); ?>
</head>

<body>
<?php $this->load->view('common/navigation'); ?>

<!-- Page Content -->
<div class="container"> 
  <?php $this->load->view('common/dashboard_header'); ?>  
  
  <!-- Page Features -->
  <div class="">
    <h1>Welcome <a href="<?php echo site_url('update-profile'); ?>"><?php echo $this->session->site_user_full_name; ?></a>!</h1> 
    <?php print_msg_flashdata();?>   
    <div>
  <form action="" method="get">
  <div class="row">
    <div class="col-md-4">
  	<?php if ($categories) { ?>
      <select name="category" class="form-control">
      <option value="">Select Category</option>
      	<?php
		foreach ($categories as $category) {
			$selected = ($category->category == $this->input->get('category', true))? 'selected="selected"':'';
		?>
      	<option value="<?php echo $category->category;?>" <?php echo $selected;?>><?php echo $category->category;?></option>
        <?php } ?>
      </select>
    <?php } ?>
    </div>
    <div class="col-md-2">
      <input type="submit" value="Filter" class="form-control btn btn-info " />
      </div>
      </div>
  </form>
  <br>
<br>

  </div>
  <div class="row text-center">
  <?php if ($gallery_images) { ?>
  <?php foreach ($gallery_images as $image) { ?>
  
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card">
      	<img class="card-img-top" src="<?php echo base_url('assets/uploads/gallery_images/thumbs/' . $image->image_name); ?>" title="<?php echo $image->title; ?>" alt="<?php echo $image->title; ?>" />
      
      
        <div class="card-body">
          <h4 class="card-title"><?php echo $image->title; ?></h4>
          <p class="card-text text-justify"><?php echo word_limiter($image->description, 10); ?></p>
        </div>
        <div class="card-footer">         
        <a class="btn btn-warning" href="<?php echo site_url('edit-image/' . $image->id); ?>">Edit</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="<?php echo site_url('remove-image/' . $image->id); ?>">Delete</a>
        </div>
      </div>
    </div>
    
  <?php } ?>
  <?php }else{echo 'No images found in this category!';} ?>
    
  </div>
    
   
  </div>
  <!-- /.row --> 
  
</div>
<!-- /.container --> 

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_css_js'); ?>
</body>
</html>