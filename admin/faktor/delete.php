<?php  

if ((isset($_GET['id_faktor'])) && ($_GET['id_faktor'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_faktor WHERE id_faktor=%s",
                       GetSQLValueString($koneksi, $_GET['id_faktor'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesanlink('Data faktor berhasil dihapus','?page=faktor/insert');
  }
}
?> 