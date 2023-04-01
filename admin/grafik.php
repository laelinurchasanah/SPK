<?php
	title('success','DASHBOARD GRAFIK','TEMPLATE');
?> 

<div class="col-md-8">
	<h3>GRAFIK  </h3>
        <!-- Main content -->
    <section class="content">       
          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">TITLE</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <?php 
				 /* for ($bulan = 1; $bulan <= 12; $bulan++) {
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
				
				*/
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
	<strong>DESKRIPSI</strong>
	<table class="table table-bordered table-hover table-striped">
            <tr>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NO.</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">NAME</span></th>
              <th bgcolor="#006699"><span style="color: #FFFFFF">QTY</span></th>
            </tr>
             
            <tr>
              <td></td>
              <td> </td>
              <td align="center"> </td>
            </tr>
             
     </table>
</div>
 
 