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
  <?php $this->load->view('common/dashboard_header'); ?>
  <!-- Page Features -->
  <div class="row">
    <div class="col-md-8">
      <h1>Edit Image</h1>
      <?php print_msg_flashdata();?>
      <?php echo form_open_multipart('edit-image/' . $image->id); ?>
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="title_err" placeholder="Title" value="<?php echo set_value('title', $image->title); ?>">
        <small id="title_err" class="form-text text-danger"><?php echo form_error('title'); ?></small> </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description" placeholder="Description" aria-describedby="description_err"><?php echo set_value('description', $image->description); ?></textarea>
        <small id="description_err" class="form-text text-danger"><?php echo form_error('description'); ?></small> </div>
      <div class="form-group"> <img src="<?php echo base_url('assets/uploads/gallery_images/thumbs/' . $image->image_name); ?>" title="<?php echo $image->title; ?>" alt="<?php echo $image->title; ?>" /> <br>
      </div>
      
      
      <div class="form-group">
        <label for="category_id">Category</label>
        <?php if ($categories) { ?>
          <select name="category_id" id="category_id" class="form-control" placeholder="Category" aria-describedby="category_id_err">
          	<option value="">Select category</option>
            <?php foreach ($categories as $category) { ?>
            <?php $default = ($category->id == $image->category_id)? TRUE:FALSE;?>            		
            <option value="<?php echo $category->id;?>" <?php echo set_select('category_id', $category->id, $default); ?> ><?php echo $category->category;?></option>
            <?php } ?>
          </select>
        <?php } ?>
        <small id="category_id_err" class="form-text text-danger"><?php echo form_error('category_id'); ?></small> </div>
      
      
      
      <div class="form-group">
        <label for="image_name">Image</label>
        <input type="file" name="image_name" class="form-control" id="image_name" aria-describedby="image_name_err" placeholder="Image" />
        <small id="image_name_err" class="form-text text-danger"><?php echo form_error('image_name'); ?></small> </div>
      <button type="submit" class="btn btn-primary">Update Image</button>
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