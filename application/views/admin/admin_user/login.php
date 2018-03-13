<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Gallery Application</title>
<?php $this->load->view('admin/common/head_css_js'); ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo"> <a href=""><b>Gallery</b>App.</a> </div>
<!-- /.login-logo -->
<div class="login-box-body">
<p class="login-box-msg">Sign in to start your session</p>
<?php print_msg_flashdata();?>
<form action="<?php echo site_url('admin/login'); ?>" method="post">
  <div class="form-group has-feedback">
    <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo set_value('email', $this->session->flashdata('email')); ?>">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    <small id="email_err" class="form-text text-danger"><?php echo form_error('email'); ?></small>
  </div>
  <div class="form-group has-feedback">
    <input name="password" type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password', $this->session->flashdata('password')); ?>">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    <small id="email_err" class="form-text text-danger"><?php echo form_error('password'); ?></small>
  </div>
  <div class="row">
    <div class="col-xs-8"></div>
    <!-- /.col -->
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <!-- /.col --> 
  </div>
  
  <div class="row">
    <div class="col-xs-12">    
    <p class="text text-success"><strong>Please use given below credentials to use admin</strong></p>
    <p>Email : <strong class="text text-danger">jawadabbass@hotmail.com</strong></p>
    <p>Password : <strong class="text text-danger">12may2009</strong></p>
    </div>
  </div>
</form>
</div>
<!-- /.login-box-body -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/footer_css_js'); ?>
</body>
</html>
