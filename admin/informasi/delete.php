<?php
if ((isset($_GET['image'])) && ($_GET['image'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posting SET image_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($koneksi, "default.jpg", "text"),
					   GetSQLValueString($koneksi, $_GET['image'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  echo "<script>
  document.location = '?page=informasi/update&post=".$_GET['image']."'</script>";
}

if ((isset($_GET['post'])) && ($_GET['post'] != "")) {
  $updateSQL = sprintf("UPDATE tb_posting SET active_posting=%s WHERE id_posting=%s",
                       GetSQLValueString($koneksi, "N", "text"),
					   GetSQLValueString($koneksi, $_GET['post'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  echo "<script>
  	document.location = '?page=informasi/view&hapus=true';
  </script>";
}
?>