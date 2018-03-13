<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Gallery Application</title>
<?php $this->load->view('admin/common/head_css_js'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/common/header'); ?>
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/common/aside'); ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Administrator <small>Update Profile</small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Administrator Profile</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profile</h3>
              <?php print_msg_flashdata();?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form class="form-horizontal" method="post" action="<?php echo site_url('admin/profile/'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
				  <?php echo $admin_user->email; ?>
                  </div>
                </div> 
                
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" name="password" id="password" class="form-control" placeholder="password" value="<?php echo set_value('password'); ?>">
                    <small id="password_err" class="form-text text-danger"><?php echo form_error('password'); ?></small>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="full_name" class="col-sm-2 control-label">Full Name</label>

                  <div class="col-sm-10">
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="full name" value="<?php echo set_value('full_name', $admin_user->full_name); ?>">
                    <small id="full_name_err" class="form-text text-danger"><?php echo form_error('full_name'); ?></small>
                  </div>
                </div>
                                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Update Profile</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
      <!-- /.box --> 
    </div>
  </div>
  <!-- /.row -->
  
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('admin/common/footer'); ?>
<?php $this->load->view('admin/common/control_sidebar'); ?>
</div>
<!-- ./wrapper --> 
<?php $this->load->view('admin/common/footer_css_js'); ?>
</body>
</html>
