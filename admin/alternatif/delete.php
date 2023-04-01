<?php  

if ((isset($_GET['id_alternatif'])) && ($_GET['id_alternatif'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_alternatif WHERE id_alternatif=%s",
                       GetSQLValueString($koneksi, $_GET['id_alternatif'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesanlink('Data alternatif berhasil dihapus','?page=alternatif/insert');
  }
}
?> 