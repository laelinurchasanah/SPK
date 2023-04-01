<?php  


$colname_rs_awal = "-1";
$colname_rs_akhir = "-1";
if (isset($_GET['ta'])) {
  $colname_rs_awal = $_GET['ta'];
  $colname_rs_akhir = $_GET['ti'];  
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pengunjung = sprintf("SELECT * FROM tb_pengunjung  INNER JOIN tb_pekerjaan ON pekerjaan_pengunjung = id_pekerjaan WHERE ta_pengunjung = %s AND tanggal_pengunjung BETWEEN %s AND %s", 
	GetSQLValueString($koneksi, $ta, "text"),
	GetSQLValueString($koneksi, $colname_rs_awal, "date"),
	GetSQLValueString($koneksi, $colname_rs_akhir, "date"));
$rs_pengunjung = mysqli_query($koneksi, $query_rs_pengunjung) or die(mysqli_error($koneksi));
$row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung);
$totalRows_rs_pengunjung = mysqli_num_rows($rs_pengunjung);
?>


<?php
	title('success','BERDASARKAN PERIODE','Laporan berdasarkan Periode Tanggal');
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>


<form id="form1" name="form1" method="get" action="" autocomplete="off">
  Cari data Pengunjung dari tanggal 
    <input type="text" name="ta" id="datepicker" /> 
    s/d 
    <input type="text" name="ti" id="datepicker2" />
    <input type="submit" name="button" id="button" value="Cari" />
    <input type="hidden" name="page" value="report/tanggal"/>
</form>
<p></p>
<?php if ($totalRows_rs_pengunjung == 0) { 
	pesan('danger','Oops! Data tidak ditemukan!'); 
	
?>

<?php } ?>

<?php if ($totalRows_rs_pengunjung > 0) { ?> 

<div class="alert alert-info">Hasil dari pencarian dari Tanggal : <?= $colname_rs_awal; ?> s/d <?= $colname_rs_akhir; ?> sebanyak : <?= $totalRows_rs_pengunjung; ?></div>
 
 <p><a href="report/p_tanggal.php?ta=<?= $colname_rs_awal; ?>&ti=<?= $colname_rs_akhir; ?>" target="_blank">Print</a></p>
 <p></p>
<table class="table table-striped table-bordered table-hover teks" id="example1">
  <thead>
    <tr bgcolor="#003366">
      <th><small><span class="style1">NO.</span></small></th>
      <th><small><span class="style1">NOMOR</span></small></th>
      <th><small><span class="style1">JK</span></small></th>
      <th><small><span class="style1">NAMA LENGKAP</span></small></th>
      <th><small><span class="style1">NO. KONTAK</span></small></th>
      <th><small><span class="style1">ALAMAT</span></small></th>
      <th><small><span class="style1">TANGGAL</span></small></th>
      <th><small><span class="style1">DATETIME</span></small></th>
    </tr>
    </thead>
  <tbody>
    <?php $no = 1; do { ?>
    <tr>
      <td> <small><?php echo $no++; ?> </small></td>
        <td><small><?php echo $row_rs_pengunjung['nomor_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['jk_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['nama_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['hp_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['alamat_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['tanggal_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['today_pengunjung']; ?></small></td>
      </tr>
    <?php } while ($row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung)); ?>
    </tbody>
</table>
<?php } ?>
</body>
</html> 