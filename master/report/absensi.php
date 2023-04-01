<?php 

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_panitia = "SELECT kode_panitia, nama_panitia FROM tb_panitia";
$rs_panitia = mysqli_query($koneksi, $query_rs_panitia) or die(mysqli_error($koneksi));
$row_rs_panitia = mysqli_fetch_assoc($rs_panitia);
$totalRows_rs_panitia = mysqli_num_rows($rs_panitia);

$kalender = CAL_GREGORIAN;
	if (!isset($_GET['bulan'])){ ;
		$_GET['bulan'] = date('m');
		$_GET['tahun'] = date('Y');
	}
 
$hari = cal_days_in_month($kalender, $bulan, $tahun);  
 
?>




<p>
  <?php
	title('success','LAPORAN ABSENSI PANITIA','Laporan berdasarkan Periode');
?>
</p>
<form id="form1" name="form1" method="get" action="">
Pilih Bulan  
  <select name="bulan" id="bulan">
 <option value="01" <?php if (!(strcmp('01', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Januari</option>
  <option value="02" <?php if (!(strcmp('02', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Februari</option>
  <option value="03" <?php if (!(strcmp('03', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Maret</option>
  <option value="04" <?php if (!(strcmp('04', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>April</option>
  <option value="05" <?php if (!(strcmp('05', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Mei</option>
  <option value="06" <?php if (!(strcmp('06', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Juni</option>
  <option value="07" <?php if (!(strcmp('07', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Juli</option>
  <option value="08" <?php if (!(strcmp('08', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Agustus</option>
  <option value="09" <?php if (!(strcmp('09', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>September</option>
  <option value="10" <?php if (!(strcmp('10', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Oktober</option>
  <option value="11" <?php if (!(strcmp('11', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>November</option>
  <option value="12" <?php if (!(strcmp('12', $_GET['bulan']))) {echo "selected=\"selected\"";} ?>>Desember</option>
  </select>  
Tahun 
<input name="tahun" type="text" value="<?= date('Y'); ?>" id="tahun" size="4" maxlength="4" />
<input type="submit" name="button" id="button" value="Submit" />
<input type="hidden" name="page" id="button" value="report/absensi" />
</form>
<p>&nbsp;</p>

<p><a href="report/p_absensi.php?bulan=<?= $_GET['bulan']; ?>&tahun=<?= $_GET['tahun']; ?>" class="btn btn-primary btn-sm"><span class="fa fa-print"></span> Print</a></p>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered" width="100%">
  
    <tr>
      <td rowspan="2" align="center" valign="middle"><div align="center"><strong>KODE</strong></div></td>
      <td rowspan="2" align="center" valign="middle"><div align="center"><strong>NAMA LENGKAP</strong></div></td>
      <td colspan="<?= $hari; ?>"><div align="center">TANGGAL</div></td>
    </tr>
    <tr>
      <?php for ($a = 1; $a <= $hari; $a++) { ?>
      <td><?= $a; ?></td>
      <?php } ?>
    </tr>
    <?php do { 
	
	 
	?>
    <tr>
      <td><?php echo $row_rs_panitia['kode_panitia']; ?></td>
      <td><?php echo $row_rs_panitia['nama_panitia']; ?></td>
      <?php for ($a = 1; $a <= $hari; $a++) { 
	   mysqli_select_db($koneksi, $database_koneksi);
$query_rs_hadir = sprintf("SELECT id_absensi, kode_panitia, nama_panitia, datang_absensi, tgl_datang, `datangwkt_absensi`, pulang_absensi, `pulangwkt_abseni`, ta_absensi FROM `tb_absensi` 
RIGHT JOIN tb_panitia ON kode_panitia = panitia_absensi 
WHERE tgl_datang = '".$_GET['tahun']."-".$_GET['bulan']."-".$a."' AND `ta_absensi` = %s AND kode_panitia = '".$row_rs_panitia['kode_panitia']."'",
		GetSQLValueString($koneksi, '20201', "text"));
$rs_hadir = mysqli_query($koneksi, $query_rs_hadir) or die(mysqli_error($koneksi));
$row_rs_hadir = mysqli_fetch_assoc($rs_hadir);
$totalRows_rs_hadir = mysqli_num_rows($rs_hadir);
	  ?>
      <td><?= $row_rs_hadir['datang_absensi']; ?></td>
      <?php } ?>
    </tr>
    <?php } while ($row_rs_panitia = mysqli_fetch_assoc($rs_panitia)); ?>
</table> 
</div>
</body>
</html>
