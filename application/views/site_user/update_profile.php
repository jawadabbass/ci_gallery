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
  <div class="row">
    <div class="col-md-8">
      <h1>Update Profile!</h1>
      <?php echo form_open_multipart('update-profile/'); ?>
      <?php print_msg_flashdata();?>
      
      <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="full_name_err" placeholder="Full Name" value="<?php echo set_value('full_name', $site_user->full_name); ?>">
        <small id="email_err" class="form-text text-danger"><?php echo form_error('full_name'); ?></small> </div>
      
      <div class="form-group">
        <label for="email">Email</label><br>
        <strong><?php echo $site_user->email; ?></strong>
      </div>
        
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>" aria-describedby="password_err">
        <small id="password_err" class="form-text text-danger"><?php echo form_error('password'); ?></small> </div>        
        
        <div class="form-group">
        <img src="<?php echo site_url('assets/uploads/site_users_images/thumbs/'.$site_user->image); ?>" alt="<?php echo $site_user->full_name; ?>" title="<?php echo $site_user->full_name; ?>" /></div>
        
        <div class="form-group">
        <label for="image">Select Image</label>
        <input name="image" type="file" class="form-control" id="image" placeholder="Select Image" aria-describedby="image_err">
        <small id="image_err" class="form-text text-danger"><?php echo form_error('image'); ?></small> </div>                     
      
      <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
  <!-- /.row --> 
  
</div>
<!-- /.container --> 

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_css_js'); ?>
</body>
</html>