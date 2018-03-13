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
  <?php $this->load->view('common/header'); ?>  
  <!-- Page Features -->
  <?php print_msg_flashdata();?>
  <div class="row text-center">
  
  
    <div class="col-lg-12 col-md-12">
      <div class="card">
      	<img class="card-img-top" src="<?php echo base_url('assets/uploads/gallery_images/' . $image->image_name); ?>" title="<?php echo $image->title; ?>" alt="<?php echo $image->title; ?>" />
      
      
        <div class="card-body">
          <h4 class="card-title"><?php echo $image->title; ?></h4>
          <p class="card-text"><?php echo $image->description; ?></p>
        </div>
        <div class="card-footer">&nbsp;</div>
      </div>
    </div>
    
    
  </div>
  <!-- /.row --> 
  
</div>
<!-- /.container --> 

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_css_js'); ?>
</body>
</html>