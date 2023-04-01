<?php 
require_once('../logout.php');
require_once('../restrict.php'); 
require_once('../Connections/koneksi.php'); 
require_once('require/header.php');

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_profile = "SELECT * FROM tb_admin WHERE id_admin = '".$ID."'";
$rs_profile = mysqli_query($koneksi, $query_rs_profile) or die(mysqli_error($koneksi));
$row_rs_profile = mysqli_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysqli_num_rows($rs_profile); 
?>

<body class="skin-black fixed sidebar-mini sidebar-mini-expand-feature">
<div class="wrapper">

  <header class="main-header">
   <?php require_once('require/navbar.php'); ?>
  </header>
  <?php require_once('require/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard :: 
        <small>Selamat Datang, <?= $nama; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
       <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><a href="?page=home">DASHBOARD</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <?php if (isset($_GET['success'])) { 
			   		pesan('success','Selamat! Anda berhasil login');
			    } ?>
              <?php
              if(isset($_GET["page"]) && $_GET["page"] != "home"){
                  if(file_exists(htmlentities($_GET["page"]).".php")){
                            include(htmlentities($_GET["page"]).".php");
                      }else{
                            include("404.php");
                      }
                }else{
                    include("home.php");
              } 
              ?>
               
             
             
           
           </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
  
<?php require_once('require/footer.php'); ?>