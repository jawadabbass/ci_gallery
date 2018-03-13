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
      <h1> Gallery <small>Gallery Images List</small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gallery Images</li>
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
            <div id="gallery_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <form name="search-form" id="search-form">
                    <table id="gallery" class="table table-bordered table-striped dataTable">
                      <thead>
                        <tr>
                          <th><input type="text" name="title" id="title" placeholder="Search by title" autocomplete="off"/></th>
                          <th><input type="text" name="description" id="description" placeholder="Search by description" autocomplete="off"/></th>
                          <th>
						  <?php if ($categories) { ?>
                          <select name="category_id" id="category_id">
                          <option value="">Search by Category</option>
                          <?php foreach ($categories as $category) { ?>
                               	<option value="<?php echo $category->id;?>"><?php echo $category->category;?></option>
                          <?php } ?>
                          </select>
                          <?php } ?>
                          </th>
                          <th>
						  <?php if ($users) { ?>
                          <select name="user_id" id="user_id">
                          <option value="">Search by User</option>
                          <?php foreach ($users as $user) { ?>
                               	<option value="<?php echo $user->id;?>"><?php echo $user->full_name;?></option>
                          <?php } ?>
                          </select>
                          <?php } ?>
                          </th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>User</th>
                          <th>Image</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category</th>
                          <th>User</th>
                          <th>Image</th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
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
<button id="update_btn">CLICK ME</button>
<!-- /.content-wrapper -->
<?php $this->load->view('admin/common/footer'); ?>
<?php $this->load->view('admin/common/control_sidebar'); ?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/footer_css_js'); ?>
<script>
var table;
$(document).ready(function() {
		
    table = $('#gallery').DataTable( {
		"columnDefs": [
						 {
						  "targets": [4, 5],
						  "searchable": false,
						  "sortable": false
						  }
					  ],
		"searching": false,
		"rowId": 'id',
		"order": [[ 0, "asc" ]],
        "processing": true,
        "serverSide": true,
		"ajax": {
            "url": "<?php echo site_url('admin/gallery/load_datatable'); ?>",
            "type": "POST",
			"data": function (d) {                
                d.title = $('#title').val();
				d.description = $('#description').val();
				d.category_id = $('#category_id').val();
				d.user_id = $('#user_id').val();
            },
												
        },
        "columns": [            
            { "data": "title" },
			{ "data": "description" },
			{ "data": "category" },
			{ "data": "full_name" },
			{ "data": "image" },
            { "data": "operations" }
        ]		
    } );
	
	table.on( 'draw', function() {	  
	  updateStatusInit();
	});
			
	$('#title').on('keyup', function(e) {
        table.draw();
        e.preventDefault();
    });
	$('#description').on('keyup', function(e) {
        table.draw();
        e.preventDefault();
    });
	$('#category_id').on('change', function(e) {
        table.draw();
        e.preventDefault();
    });
	$('#user_id').on('change', function(e) {
        table.draw();
        e.preventDefault();
    });
	
	$('#gallery').css('width', '100%');	
	
} );

function delete_image(id){
	if(confirm('Are you sure?')){		
		var data = {id: id};        
		$.post("<?php echo site_url('admin/delete-image/'); ?>", data,
        function(ret_data, ret_status){
			if(ret_data == 1){
				$('tr#'+id).remove();				
				alert('Gallery image deleted successfully!');
			}
        });
	}
}

function updateStatusInit(){
	$("[data-status='inactive']").text('Make Active').removeClass('btn-success').addClass('btn-warning');
}
function update_status(id, status){
	if(confirm('Are you sure?')){		
		var data = {id: id, status: status};        
		$.post("<?php echo site_url('admin/update-image-status/'); ?>", data,
        function(ret_data, ret_status){
			if(ret_data == 1){
				if(status == 'active'){
					makeInActiveStatus(id);
				}else{
					makeActiveStatus(id)
				}
				alert('Gallery image status updated successfully!');
			}
        });
	}
}

function makeActiveStatus(id){
	$('a#anchor_'+id)
	.text('Make Inactive')
	.attr('data-status','active')
	.attr('onClick',"update_status("+id+", 'active');")
	.removeClass('btn-warning')
	.addClass('btn-success');
}

function makeInActiveStatus(id){
	$('a#anchor_'+id)
	.text('Make Active')
	.attr('data-status','inactive')
	.attr('onClick',"update_status("+id+", 'inactive');")
	.removeClass('btn-success')
	.addClass('btn-warning');
}
</script>
</body>
</html>
