<?php 
require_once('akses.php'); 
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_panitia = "SELECT kode_panitia, nama_panitia FROM tb_panitia";
$rs_panitia = mysqli_query($koneksi, $query_rs_panitia) or die(mysqli_error($koneksi));
$row_rs_panitia = mysqli_fetch_assoc($rs_panitia);
$totalRows_rs_panitia = mysqli_num_rows($rs_panitia);

$kalender = CAL_GREGORIAN; 
$hari = cal_days_in_month($kalender, $_GET['bulan'], $_GET['tahun']);  
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN PENGUNJUNG BERDASARKAN TANGGAL HARI INI</title>
    <style>
	table {
  border-collapse: collapse;
}

table, th, td {
  height: 30px;
  border: 1px solid black;
}
	</style> 
</head>
<body class="A4 landscape" onLoad="window.print()">
<section class="sheet padding-10mm style2">

<p>
  <?php
	title('success','LAPORAN ABSENSI PANITIA','Laporan berdasarkan Periode');
?>
</p> 
<p>
<?php $namaBulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
$bulan = $_GET['bulan'] - 1;
?>
Bulan <?= $namaBulan[$bulan];?> Tahun <?= $_GET['tahun'];	 ?>
</p>

<table width="100%" border="1">
  
    <tr>
      <td rowspan="2"><div align="center">KODE</div></td>
      <td rowspan="2"><div align="center">NAMA LENGKAP</div></td>
      <td colspan="<?= $hari ?>"><div align="center">TANGGAL</div></td>
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
 
   <h5>Dicetak oleh : 
      <?= $nama; ?>, pada <?= $today; ?> WIB</h5>
</section>
 </body>
</html> 