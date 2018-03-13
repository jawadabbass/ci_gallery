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
      <h1>Signin Please!</h1>
      <?php echo form_open('login/'); ?>
      <?php print_msg_flashdata();?>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" id="email" aria-describedby="email_err" placeholder="Email" value="<?php echo set_value('email', $this->session->flashdata('email')); ?>">
        <small id="email_err" class="form-text text-danger"><?php echo form_error('email'); ?></small> </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="<?php echo set_value('password', $this->session->flashdata('password')); ?>" aria-describedby="password_err">
        <small id="password_err" class="form-text text-danger"><?php echo form_error('password'); ?></small> </div>
      
      
      <button type="submit" class="btn btn-primary">Signin</button>
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