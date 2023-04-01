<?php  
$colname_rs_pengunjung = "-1";
if (isset($_GET['id'])) {
  $colname_rs_pengunjung = $_GET['id'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pengunjung = sprintf("SELECT * FROM tb_pengunjung  INNER JOIN tb_pekerjaan ON pekerjaan_pengunjung = id_pekerjaan WHERE pekerjaan_pengunjung = %s", GetSQLValueString($koneksi, $colname_rs_pengunjung, "int"));
$rs_pengunjung = mysqli_query($koneksi, $query_rs_pengunjung) or die(mysqli_error($koneksi));
$row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung);
$totalRows_rs_pengunjung = mysqli_num_rows($rs_pengunjung);
?><style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
 
<h3>Daftar Pengunjung - &quot;<?php echo $row_rs_pengunjung['nama_pekerjaan']; ?>&quot;</h3>
<p> <a href="?page=pengunjung/insert" class="btn btn-sm btn-success">Buku Tamu</a></p>
<table class="table table-striped table-bordered table-hover" id="example1">
<thead>
  <tr bgcolor="#003399">
    <th><span class="style1">NO.</span></th>
    <th><span class="style1">NOMOR</span></th>
    <th><span class="style1">JK</span></th>
    <th><span class="style1">NAMA LENGKAP</span></th>
    <th><span class="style1">NO. KONTAK</span></th>
    <th><span class="style1">ALAMAT</span></th>
    <th><span class="style1">TANGGAL</span></th>
    <th><span class="style1">DATETIME</span></th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td><a href="?page=pengunjung/update&id_pengunjung=<?= $row_rs_pengunjung['id_pengunjung']; ?>" class="btn btn-warning btn-sm"><?php echo $no++; ?></a></td>
      <td><?php echo $row_rs_pengunjung['nomor_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['jk_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['nama_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['hp_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['alamat_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['tanggal_pengunjung']; ?></td>
      <td><?php echo $row_rs_pengunjung['today_pengunjung']; ?></td>
      <td><a href="?page=pengunjung/hapus&id_restore=<?= $row_rs_pengunjung['id_pengunjung']; ?>" class="btn btn-sm btn-danger"><span class="fa fa-close"></span></a></td>
    </tr>
    <?php } while ($row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung)); ?>
  </tbody>
</table> 
