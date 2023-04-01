<?php require_once('data.php'); ?>
<!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
	       
        </div>
        <div class="col-lg-6 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $row_rs_kriteria['jumlahKriteria']; ?> KRITERIA</h3>

              <p>KRITERIA</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="?page=kriteria/insert" class="small-box-footer">
              More Detail <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $row_rs_alternatif['jumlahAlternatif']; ?> ALTERNATIF</h3>

              <p>ALTERNATIF</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-o"></i>
            </div>
            <a href="?page=alternatif/insert" class="small-box-footer">
              More Detail <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-md-6 col-sm-6">
         <a href="?page=empty&reset=1" class="btn btn-primary btn-block">RESET ULANG SEMUA</a>
        </div>
        <div class="col-md-6 col-sm-6">
         <a href="?page=empty&kosongkan=1" class="btn btn-primary btn-block">KOSONGKAN NILAI TIAP ALTERNATIF</a>
        </div>
      </div>
      <!-- /.row -->
      <p></p>
            <p></p>
<?php require_once('proses/result.php'); ?>      