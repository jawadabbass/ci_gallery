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
      <h1> Categories <small>Categories List</small> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <a class="box-title btn btn-success" href="<?php echo site_url('admin/add-category');?>">Add new Category</a><br>
            <?php print_msg_flashdata();?>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div id="categories_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">              <div class="row">
                <div class="col-sm-12">
                <form name="search-form" id="search-form">                
                  <table id="categories" class="table table-bordered table-striped dataTable">
                    <thead>
                    <tr>                        
                        <th><input type="text" name="category" id="category" placeholder="Search by Category" autocomplete="off"/></th>
                        <th></th>                       
                      </tr>
                      <tr>                        
                        <th>Category</th>
                        <th></th>                      
                      </tr>
                    </thead>                    
                    <tfoot>
                      <tr>                        
                        <th>Category</th>
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
$(document).ready(function() {
		
    var oTable = $('#categories').DataTable( {
		"columnDefs": [
						 {
						  "targets": [1],
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
            "url": "<?php echo site_url('admin/category/load_datatable'); ?>",
            "type": "POST",
			"data": function (d) {                
                d.category = $('#category').val();
            }									
        },
        "columns": [            
            { "data": "category" },
            { "data": "edit_delete" }
        ]
    } );
			
	$('#category').on('keyup', function(e) {
        oTable.draw();
        e.preventDefault();
    });
	
} );
function delete_category(id){
	if(confirm('Are you sure?')){		
		var data = {id: id};        
		$.post("<?php echo site_url('admin/delete-category/'); ?>", data,
        function(ret_data, status){
			if(ret_data == 1){
				$('tr#'+id).remove();				
				alert('Category deleted successfully!');
			}
        });
	}
}
</script>
</body>
</html>
