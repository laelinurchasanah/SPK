<?php  

if ((isset($_GET['id_photo'])) && ($_GET['id_photo'] != "")) {
  if ($_GET['img'] == $row_rs_profile['photo_admin']) {
  	pesanlink('Oops! Gambar masih dipakai tidak bisa dihapus','?page=insert/photo');
  }else{
  $deleteSQL = sprintf("DELETE FROM tb_photo WHERE id_photo=%s",
                       GetSQLValueString($koneksi, $_GET['id_photo'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Photo berhasil dihapus!','?page=insert/photo');
  }
}



if ((isset($_GET['id_admin'])) && ($_GET['id_admin'] != "")) {
 
  $deleteSQL = sprintf("DELETE FROM tb_admin WHERE id_admin=%s",
                       GetSQLValueString($koneksi, $_GET['id_admin'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Admin berhasil dihapus!','?page=insert/admin');
 
}

if ((isset($_GET['id_member'])) && ($_GET['id_member'] != "")) {
 
  $deleteSQL = sprintf("DELETE FROM tb_member WHERE id_member=%s",
                       GetSQLValueString($koneksi, $_GET['id_member'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL) or die(mysqli_error($koneksi));
  
  pesanlink('Admin berhasil dihapus!','?page=insert/member');
 
}
?> 