<aside class="main-sidebar"> 
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar"> 
    <!-- Sidebar user panel --> 
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Gallery Application</li>
      <li><a href="<?php echo site_url('admin/'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="treeview"> <a href="#"> <i class="fa fa-align-justify"></i> <span>Categories</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li class="active"><a href="<?php echo site_url('admin/categories'); ?>"><i class="fa fa-circle-o"></i> View categories</a></li>
          <li><a href="<?php echo site_url('admin/add-category'); ?>"><i class="fa fa-circle-o"></i> Add category</a></li>
        </ul>
      </li>
      
      <li class=""><a href="<?php echo site_url('admin/gallery-images'); ?>"><i class="fa fa-camera"></i> Gallery Images</a></li>
      
      <li class=""><a href="<?php echo site_url('admin/site-users'); ?>"><i class="fa fa-user"></i> Site Users</a></li>
      <li class=""><a href="<?php echo site_url('admin/list-site-users/2/0'); ?>"><i class="fa fa-user"></i> Site Users (Without Datatables)</a></li>
      
      
    </ul>
  </section>
  <!-- /.sidebar --> 
</aside>
