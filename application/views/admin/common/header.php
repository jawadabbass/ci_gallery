<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('admin/'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>G</b>App</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Gallery</b>App</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('admin/profile'); ?>" class="btn btn-default btn-flat">Profile</a></li>
          <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('admin/logout'); ?>" class="btn btn-default btn-flat">Sign out</a></li>        </ul>
      </div>
    </nav>
  </header>