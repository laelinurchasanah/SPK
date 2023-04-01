<?php
//PENCARIAN
$colname_rs_search = "-1";
if (isset($_GET['Search'])) {
  $colname_rs_search = $_GET['Search'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_search = sprintf("SELECT Login, nama_admin FROM tb_admin WHERE nama_admin OR Login LIKE %s", GetSQLValueString($koneksi, "%" . $colname_rs_search . "%", "text"));
$rs_search = mysqli_query($koneksi, $query_rs_search) or die(mysqli_error($koneksi));
$row_rs_search = mysqli_fetch_assoc($rs_search);
$totalRows_rs_search = mysqli_num_rows($rs_search);

?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../photos/<?= $row_rs_profile['photo_master']; ?>" class="img-rounded" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $nama; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="hidden" name="page" value="Search">
          <input type="text" name="Search" class="form-control" placeholder="Search Admin...">
         
              <span class="input-group-btn">
                <button type="submit"  id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		<li class="active">
          <a href="?page=home">
            <i class="fa fa-th"></i> <span>DASHBOARD</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Home</small>
            </span>
          </a>
        </li>
        <li>
          <a href="?page=#">
            <i class="fa fa-book"></i> <span>MENU SATU</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>
        <li>
          <a href="?page=#">
            <i class="fa fa-users"></i> <span>MENU DUA</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>
        <li>
          <a href="?page=#">
            <i class="fa fa-cog"></i> <span>MENU TIGA</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>
        <li>
          <a href="?page=#">
            <i class="fa fa-copy"></i> <span>MENU EMPAT</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">New</small>
            </span>
          </a>
        </li>  
        <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>CONFIGURASI</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          	<ul class="treeview-menu">
				<?php do { ?>
                <li>
                  <a href="<?php echo $row_rs_menu['link_menu']; ?>">
                    <i class="<?php echo $row_rs_menu['icon_menu']; ?>"></i><?php echo $row_rs_menu['text_menu']; ?>
                    <span class="pull-right-container">
                      <small class="label pull-right <?php echo $row_rs_menu['color_menu']; ?>"><?php echo $row_rs_menu['label_menu']; ?></small>
                    </span>
                  </a>
                </li>
	            <?php } while ($row_rs_menu = mysqli_fetch_assoc($rs_menu)); ?>        
        	</ul> 
        </li>
        
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->