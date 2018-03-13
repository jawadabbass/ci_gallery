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
                          <th><input type="text" name="email" id="email" placeholder="Search by email" autocomplete="off"/></th>
                          <th><input type="text" name="full_name" id="full_name" placeholder="Search by name" autocomplete="off"/></th>                          
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Email</th>
                          <th>Name</th>
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
<!-- /.content-wrapper -->
<?php $this->load->view('admin/common/footer'); ?>
<?php $this->load->view('admin/common/control_sidebar'); ?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/footer_css_js'); ?>
<script>
var oTable;
$(document).ready(function() {
		
    oTable = $('#site_user').DataTable( {
		"columnDefs": [
						 {
						  "targets": [2,3],
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
            "url": "<?php echo site_url('admin/site_user/load_datatable'); ?>",
            "type": "POST",
			"data": function (d) {                
                d.email = $('#email').val();
				d.full_name = $('#full_name').val();
            }									
        },
        "columns": [            
            { "data": "email" },
			{ "data": "full_name" },
			{ "data": "image" },
            { "data": "operations" }
        ]
    } );
	
	oTable.on( 'draw', function() {	  
	  updateStatusInit();
	});
			
	$('#email').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
	$('#full_name').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });	
	
} );
function delete_site_user(id){
	if(confirm('Are you sure?')){		
		var data = {id: id};        
		$.post("<?php echo site_url('admin/delete-site-user/'); ?>", data,
        function(ret_data, status){
			if(ret_data == 1){
				$('tr#'+id).remove();				
				alert('Site user deleted successfully!');
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
		$.post("<?php echo site_url('admin/update-site-user-status-ajax/'); ?>", data,
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
