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
      <h1>Signup Please!</h1>
      <?php echo form_open_multipart('register/'); ?>
      <?php print_msg_flashdata();?>
      
      <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="full_name_err" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>">
        <small id="email_err" class="form-text text-danger"><?php echo form_error('full_name'); ?></small> </div>
      
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="email_err" placeholder="Email" value="<?php echo set_value('email'); ?>">
        <small id="email_err" class="form-text text-danger"><?php echo form_error('email'); ?></small> </div>
        
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>" aria-describedby="password_err">
        <small id="password_err" class="form-text text-danger"><?php echo form_error('password'); ?></small> </div>
        
        <div class="form-group">
        <label for="password_confirm">Retype Password</label>
        <input name="password_confirm" type="password" class="form-control" id="password_confirm" placeholder="Retype Password" value="<?php echo set_value('password_confirm'); ?>" aria-describedby="password_err">
        <small id="password_confirm_err" class="form-text text-danger"><?php echo form_error('password_confirm'); ?></small> </div>
        
        <div class="form-group">
        <label for="image">Select Image</label>
        <input name="image" type="file" class="form-control" id="image" placeholder="Select Image" aria-describedby="image_err">
        <small id="image_err" class="form-text text-danger"><?php echo form_error('image'); ?></small> </div>
        
        <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="i_agree" name="i_agree">
          <label class="form-check-label" for="i_agree">
            I agree with <a href="<?php echo site_url('terms-conditions'); ?>">terms and conditions</a>.
          </label>
          <small id="image_err" class="form-text text-danger"><?php echo form_error('i_agree'); ?></small> 
        </div>
        </div>      
      
      <button type="submit" class="btn btn-primary">Signup</button>
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