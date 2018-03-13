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
      <h1> Site Users <small>Site Users List</small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Site Users</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"> <?php print_msg_flashdata();?> </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="site_user_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <form name="search-form" id="search-form">
                    <table id="site_user" class="table table-bordered table-striped dataTable">
                      <thead>
                        <tr>
                          <th><input type="text" name="email" value="<?php echo $this->input->get('email', true); ?>" placeholder="Search by email" autocomplete="off"/></th>
                          <th><input type="text" name="full_name" value="<?php echo $this->input->get('full_name', true); ?>" placeholder="Search by name" autocomplete="off"/></th>                          
                          <th><input type="submit" value="filter"></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th></th>
                        </tr>
                      </thead>
                  <?php
                  if($site_users){
					  foreach($site_users as $site_user){
						  
						  $status_text = 'Make Active';
						  $status_css = 'btn-warning';
						  if($site_user->status == 'active'){
							 $status_text = 'Make Inactive';
							 $status_css = 'btn-success';
							}
				  ?>    
                      <tr>
                          <th><?php echo $site_user->email;?></th>
                          <th><?php echo $site_user->full_name;?></th>
                          <th><img src="<?php echo site_url('assets/uploads/site_users_images/thumbs/'.$site_user->image);?>" width="100"/></th>
                          <th><a class="btn <?php echo $status_css;?> btn-xs" href="javascript:;" onclick="update_status(<?php echo $site_user->id;?>, '<?php echo $site_user->status;?>');"><?php echo $status_text;?></a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger btn-xs" href="javascript:;" onclick="delete_site_user(<?php echo $site_user->id;?>)">DELETE</a></th>
                        </tr>
                  <?php
				  	}
				  }
				  ?>  
                      <tfoot>
                        <tr>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                    <?php echo $this->pagination->create_links();?>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box-body --> 
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
<script>
function delete_site_user(id){
	if(confirm('Are you sure?')){
		var url = '<?php echo site_url('admin/remove-site-user/'); ?>'+id;
		window.location.replace(url);
	}
}

function update_status(id, status){
	if(confirm('Are you sure?')){
		var url = '<?php echo site_url('admin/update-site-user-status/'); ?>'+id+'/'+status;
		window.location.replace(url);
	}
}
</script>
</body>
</html>
