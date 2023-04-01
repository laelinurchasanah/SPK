<?php  

if ((isset($_GET['id_kriteria'])) && ($_GET['id_kriteria'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_kriteria WHERE id_kriteria=%s",
                       GetSQLValueString($koneksi, $_GET['id_kriteria'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesanlink('Data Kriteria berhasil dihapus','?page=kriteria/insert');
  }
}
?> 