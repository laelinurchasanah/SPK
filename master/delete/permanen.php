<?php  

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_admin WHERE id_admin=%s",
                       GetSQLValueString($koneksi, $_GET['id_admin'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data Absen Ujian Berhasil di hapus','?page=view/admin');
}

 
?>