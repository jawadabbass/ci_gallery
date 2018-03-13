<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container"> <a class="navbar-brand" href="<?php echo site_url(); ?>">CI Gallery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"> <a class="nav-link" href="<?php echo site_url(); ?>gallery">Gallery <span class="sr-only">(current)</span> </a> </li>
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>about-us">About Us</a> </li>        
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>contact-us">Contact Us</a> </li>
                
        <?php if((bool)$this->session->userdata('site_user_logged_in') === true) { ?>
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>user-dashboard">Dashboard</a> </li>
        
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>logout">Sign Out</a> </li>
        <?php }else{ ?>
        
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>login">Sign In</a> </li>
        
        <li class="nav-item"> <a class="nav-link" href="<?php echo site_url(); ?>register">Sign Up</a> </li>
        <?php } ?>
        
        <li class="nav-item"> <a class="btn btn-success" href="<?php echo site_url(); ?>add-image/">Add Image</a> </li>&nbsp;&nbsp;&nbsp;
        <li class="nav-item"> <a class="btn btn-success" href="<?php echo site_url(); ?>admin/">Admin Area</a> </li>
        
        
      </ul>
    </div>
  </div>
</nav>