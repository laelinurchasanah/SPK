<?php  

if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
  /*$deleteSQL = sprintf("DELETE FROM tb_admin WHERE id_admin=%s",
                       GetSQLValueString($koneksi, $_GET['id_admin'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data berhasil dihapus!','?page=insert/admin'); */
  
  $updateSQL = sprintf("UPDATE tb_admin SET active_admin=%s, rb=%s WHERE id_admin=%s",
                       GetSQLValueString($koneksi, 'N', "text"),
                       GetSQLValueString($koneksi, $ID, "text"),
                       GetSQLValueString($koneksi, $_GET['id_admin'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Data Berhasil dihapus','?page=insert/admin');
}

if ((isset($_GET['id_menu'])) && ($_GET['id_menu'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_menu WHERE id_menu=%s",
                       GetSQLValueString($koneksi, $_GET['id_menu'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Menu berhasil dihapus!','?page=insert/menu');
}

if ((isset($_GET['id_photo'])) && ($_GET['id_photo'] != "")) {
  if ($_GET['img'] == $row_rs_profile['photo_master']) {
  	pesanlink('Oops! Gambar masih dipakai tidak bisa dihapus','?page=insert/photo');
  }else{
  $deleteSQL = sprintf("DELETE FROM tb_photo WHERE id_photo=%s",
                       GetSQLValueString($koneksi, $_GET['id_photo'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Photo berhasil dihapus!','?page=insert/photo');
  }
}
?> 