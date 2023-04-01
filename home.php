<?php 
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs_informasi = 5;
$pageNum_rs_informasi = 0;
if (isset($_GET['pageNum_rs_informasi'])) {
  $pageNum_rs_informasi = $_GET['pageNum_rs_informasi'];
}
$startRow_rs_informasi = $pageNum_rs_informasi * $maxRows_rs_informasi;

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_informasi = "SELECT id_posting, title_posting, konten_posting, LEFT(konten_posting, 150) as desk, image_posting, ct_posting, cb_posting, Nama, active_posting FROM tb_posting  
INNER JOIN vw_login ON ID = cb_posting
WHERE active_posting = 'Y' ORDER BY id_posting DESC";
$query_limit_rs_informasi = sprintf("%s LIMIT %d, %d", $query_rs_informasi, $startRow_rs_informasi, $maxRows_rs_informasi);
$rs_informasi = mysqli_query($koneksi, $query_limit_rs_informasi) or die(mysqli_error($koneksi));
$row_rs_informasi = mysqli_fetch_assoc($rs_informasi);

if (isset($_GET['totalRows_rs_informasi'])) {
  $totalRows_rs_informasi = $_GET['totalRows_rs_informasi'];
} else {
  $all_rs_informasi = mysqli_query($koneksi, $query_rs_informasi);
  $totalRows_rs_informasi = mysqli_num_rows($all_rs_informasi);
}
$totalPages_rs_informasi = ceil($totalRows_rs_informasi/$maxRows_rs_informasi)-1;

$queryString_rs_informasi = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_informasi") == false && 
        stristr($param, "totalRows_rs_informasi") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_informasi = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_informasi = sprintf("&totalRows_rs_informasi=%d%s", $totalRows_rs_informasi, $queryString_rs_informasi);

//slider
$query_limit_rs_slider = sprintf("%s LIMIT %d, %d", $query_rs_informasi, $startRow_rs_informasi, $maxRows_rs_informasi);
$rs_slider = mysqli_query($koneksi, $query_limit_rs_slider) or die(mysqli_error($koneksi));
$row_rs_slider = mysqli_fetch_assoc($rs_slider);


 
?><style>
 /* Blink for Webkit and others
(Chrome, Safari, Firefox, IE, ...)
*/

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
}
</style><br />

<div class="callout callout-success">
<h3>Selamat Datang di Aplikasi <?= $title; ?></h3>
<p><?= $deskripsi; ?></p>
</div>
      <!-- START ACCORDION & CAROUSEL-->
       

      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">INFORMASI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
               
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <?php 
				$no = 1;
				do { ?>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?= $no; ?>">
                        <?php echo $row_rs_informasi['title_posting']; ?>                      </a>                    </h4>
                  </div>
                  <div id="collapseOne<?= $no; ?>" class="panel-collapse collapse">
                    <div class="box-body">
                    <small>Diposting oleh <strong><?php echo $row_rs_informasi['Nama']; ?></strong> pada <strong>
					<?php
					echo date('d F Y H:m:s', strtotime($row_rs_informasi['ct_posting']));
					?> WIB</strong> </small>
                    	<img src="feature_images/<?php echo $row_rs_informasi['image_posting']; ?>" height="200" class="img-responsive img-thumbnail" />
                       <?php echo $row_rs_informasi['konten_posting']; ?>                    </div>
                  </div>
                      </div>
                  <?php 
				  $no++;
				  } while ($row_rs_informasi = mysqli_fetch_assoc($rs_informasi)); ?></div>
                  
                  <hr />
            <p>
			<?php if ($pageNum_rs_informasi > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_informasi=%d%s", $currentPage, 0, $queryString_rs_informasi); ?>" class="pull-left btn btn-primary">First</a>
          <?php } // Show if not first page ?>
          <?php if ($pageNum_rs_informasi > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs_informasi=%d%s", $currentPage, max(0, $pageNum_rs_informasi - 1), $queryString_rs_informasi); ?>" class="pull-right btn btn-primary">Previous</a>
          <?php } // Show if not first page ?>
          <?php if ($pageNum_rs_informasi < $totalPages_rs_informasi) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_informasi=%d%s", $currentPage, min($totalPages_rs_informasi, $pageNum_rs_informasi + 1), $queryString_rs_informasi); ?>" class="pull-right btn btn-warning">Next</a>
          <?php } // Show if not last page ?>
          <?php if ($pageNum_rs_informasi < $totalPages_rs_informasi) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs_informasi=%d%s", $currentPage, $totalPages_rs_informasi, $queryString_rs_informasi); ?>" class="pull-left btn btn-danger">Last</a>
          <?php } // Show if not last page ?>
          </p>
            </div>
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
           <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">BERITA TERKINI </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				  <?php 
				  $slide = 1; $totalRows_rs_informasi;
				  do { ?>	
                  <li data-target="#carousel-example-generic" data-slide-to="<?= $slide; ?>" class=""></li>
				  <?php 
				  $slide++;
				  } while ($slide < $totalRows_rs_informasi); ?>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="https://1.bp.blogspot.com/-tgPC4hSN_nI/Xkntpn46RBI/AAAAAAAAAEw/1xiIFd4mOWQ7BJbOd3knMTIHpCqW2UXJgCLcBGAsYHQ/s1600/6.jpg" alt="First slide">

                    <div class="carousel-caption">
                      First Slide
                    </div>
                  </div>
                  
                 <?php 
				  $slide = 1; $totalRows_rs_informasi;
				  do { ?>	
                  <div class="item">
                    <img src="feature_images/<?= $row_rs_slider['image_posting']; ?>" alt="Second slide">

                    <div class="carousel-caption">
                      <?= $row_rs_slider['title_posting']; ?>
                    </div>
                  </div>
				  <?php 
				  $slide++;
				  } while ($row_rs_slider = mysqli_fetch_assoc($rs_slider)); ?> 
                  


                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
      <!-- END ACCORDION & CAROUSEL-->
       