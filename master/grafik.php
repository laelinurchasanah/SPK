<?php  

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pos = "SELECT * FROM tb_pos";
$rs_pos = mysqli_query($koneksi, $query_rs_pos) or die(mysqli_error($koneksi));
$row_rs_pos = mysqli_fetch_assoc($rs_pos);
$totalRows_rs_pos = mysqli_num_rows($rs_pos);


mysqli_select_db($koneksi, $database_koneksi);
$query_rs_top = "SELECT id_pegawai, nama_pegawai, id_pos, nama_pos, kode_penerimaankas, periode_penerimaankas, COUNT(periode_penerimaankas) as BykTransaksi FROM `tb_pegawai` INNER JOIN tb_pos ON pos_pegawai = id_pos LEFT JOIN tb_penerimaankas ON diserahkan_penerimaankas = id_pegawai WHERE periode_penerimaankas = ".$ta." GROUP BY id_pegawai ORDER BY BykTransaksi DESC LIMIT 5";
$rs_top = mysqli_query($koneksi, $query_rs_top) or die(mysqli_error($koneksi));
$row_rs_top = mysqli_fetch_assoc($rs_top);
$totalRows_rs_top = mysqli_num_rows($rs_top);
?>

<?php
	title('success','DASHBOARD GRAFIK TRANSAKSI','Transaksi PK berdasarkan pegawai pada pos masing-masing');
?> 

<div class="col-md-8">
	<h3>GRAFIK PENERIMAAN KAS</h3>
        <!-- Main content -->
    <section class="content">       
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Cash <small>(Abu-abu)</small> & Kredit <small>(Hijau)</small></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <?php 
				for ($bulan = 1; $bulan <= 12; $bulan++) {
				mysqli_select_db($koneksi, $database_koneksi);
				$query_rs_grafik = "SELECT periode_penerimaankas, tanggal_penerimaankas, count(kode_penerimaankas) as BykTransaksi FROM `tb_penerimaankas` WHERE month(tanggal_penerimaankas) = ".$bulan." AND periode_penerimaankas = '".$ta."' AND jenisbeli_penerimaankas = 'CASH'";
				$rs_grafik = mysqli_query($koneksi, $query_rs_grafik) or die(mysqli_error($koneksi));
				$row_rs_grafik = mysqli_fetch_assoc($rs_grafik);
				$totalRows_rs_grafik = mysqli_num_rows($rs_grafik);
				
				//-----
				
				mysqli_select_db($koneksi, $database_koneksi);
				$query_rs_grafikB = "SELECT periode_penerimaankas, tanggal_penerimaankas, count(kode_penerimaankas) as BykTransaksi FROM `tb_penerimaankas` WHERE month(tanggal_penerimaankas) = ".$bulan." AND periode_penerimaankas = '".$ta."' AND jenisbeli_penerimaankas = 'KREDIT'";
				$rs_grafikB = mysqli_query($koneksi, $query_rs_grafikB) or die(mysqli_error($koneksi));
				$row_rs_grafikB = mysqli_fetch_assoc($rs_grafikB);
				$totalRows_rs_grafikB = mysqli_num_rows($rs_grafikB);
				
					if (empty($row_rs_grafik['BykTransaksi'])) {
						$jumlah_produk[] = 0 . ",";
					}else{ 
						$jumlah_produk[] = $row_rs_grafik['BykTransaksi'] . ",";
					}
					
					if (empty($row_rs_grafikB['BykTransaksi'])) {
						$jumlah_produkB[] = 0 . ",";
					}else{ 
						$jumlah_produkB[] = $row_rs_grafikB['BykTransaksi'] . ",";
					}
				}
			?>  
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 

    </section>
    <!-- /.content -->
</div>
<div class="col-md-4">
	<strong>TOP SALESMAN</strong>
	<table class="table table-bordered table-hover table-striped">
            <tr>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NO.</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NAMA PEGAWAI</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">JUMLAH</span></th>
            </tr>
            <?php $no = 1; do { ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_rs_top['nama_pegawai']; ?><br />
                dari <?php echo $row_rs_top['nama_pos']; ?></td>
              <td align="center"><?php echo $row_rs_top['BykTransaksi']; ?></td>
            </tr>
            <?php } while ($row_rs_top = mysqli_fetch_assoc($rs_top)); ?>
     </table>
</div>
<div class="row"></div>
<?php
	title('success','Jumlah Transaksi','Transaksi PK berdasarkan pegawai pada pos masing-masing');
?>  
<?php do { ?>
  <div class="col-md-4">
  <?php
  mysqli_select_db($koneksi, $database_koneksi);
$query_rs_transaksi = "SELECT id_pegawai, nama_pegawai, id_pos, nama_pos, kode_penerimaankas, periode_penerimaankas, COUNT(periode_penerimaankas) as BykTransaksi FROM `tb_pegawai` INNER JOIN tb_pos ON pos_pegawai = id_pos LEFT JOIN tb_penerimaankas ON diserahkan_penerimaankas = id_pegawai WHERE id_pos = ".$row_rs_pos['id_pos']." AND periode_penerimaankas = ".$ta." GROUP BY id_pegawai ORDER BY `tb_pegawai`.`id_pegawai` ASC";
$rs_transaksi = mysqli_query($koneksi, $query_rs_transaksi) or die(mysqli_error($koneksi));
$row_rs_transaksi = mysqli_fetch_assoc($rs_transaksi);
$totalRows_rs_transaksi = mysqli_num_rows($rs_transaksi);
  ?>
			<span style="font-weight: bold"><?php echo $row_rs_pos['kode_pos']; ?> - <?php echo $row_rs_pos['nama_pos']; ?></span><br /> 
            <?php echo $row_rs_pos['alamat_pos']; ?> 
          -   
          <?php echo $row_rs_pos['telp_pos']; ?>
          <table class="table table-bordered table-hover table-striped">
            <tr>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NO.</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NAMA PEGAWAI</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">JUMLAH</span></th>
            </tr>
            <?php $no = 1; do { ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row_rs_transaksi['nama_pegawai']; ?></td>
              <td align="center"><?php echo $row_rs_transaksi['BykTransaksi']; ?></td>
            </tr>
            <?php } while ($row_rs_transaksi = mysqli_fetch_assoc($rs_transaksi)); ?>
          </table>
          
  </div>     
    <?php } while ($row_rs_pos = mysqli_fetch_assoc($rs_pos)); ?>
 
