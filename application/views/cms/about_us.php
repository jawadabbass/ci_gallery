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
  <div class="">
    <h1>About Us!</h1>    
    <p class="text-muted text-justify">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </p>
    <p class="text-muted text-justify">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </p>
   
  </div>
  <!-- /.row --> 
  
</div>
<!-- /.container --> 

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_css_js'); ?>
</body>
</html>