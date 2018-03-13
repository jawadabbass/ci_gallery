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
  <div class="bg-faded">
    <h1>Contact Us!</h1>
    <div class="row">
                        <div class="col-md-7">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d715411.9110034187!2d72.94074702263802!3d33.59669510939778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbfd07891722f%3A0x6059515c3bdb02b6!2sIslamabad!5e0!3m2!1sen!2s!4v1518803607135" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <div class="col-md-5">
                            <h4><strong>Get in Touch</strong></h4>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="" value="" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="" value="" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="" value="" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="" rows="3" placeholder="Message"></textarea>
                                </div>
                                <button class="btn btn-default" type="submit" name="button">
                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit
                                </button>
                            </form>
                        </div>
                    </div>
   
  </div>
  <!-- /.row --> 
  
</div>
<!-- /.container --> 

<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/footer_css_js'); ?>
</body>
</html>