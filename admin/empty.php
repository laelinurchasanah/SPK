<?php 
if ((isset($_GET['reset'])) && ($_GET['reset'] != "")) {
  $deleteSQL1 = "TRUNCATE TABLE tb_kriteria";
  $deleteSQL2 = "TRUNCATE TABLE tb_bobot";
  $deleteSQL3 = "TRUNCATE TABLE tb_alternatif";
  
  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL1) or die(mysqli_error($koneksi));
  
  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL2) or die(mysqli_error($koneksi));
  
  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $deleteSQL3) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesanlink('Nilai berhasil dikosongkan','?page=home');
  }	
}

if ((isset($_GET['kosongkan'])) && ($_GET['kosongkan'] != "")) {
  $updateSQL = sprintf("UPDATE tb_bobot SET nilai_bobot=%s, temp_bobot=%s WHERE 1 = 1",
                       GetSQLValueString($koneksi, 0, "int"),
                       GetSQLValueString($koneksi, 0, "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  $updateSQL2 = sprintf("UPDATE tb_alternatif SET preferentif=%s WHERE 1 = 1",
                       GetSQLValueString($koneksi, 0, "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL2) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesanlink('Nilai berhasil dikosongkan','?page=home');
  }	
}
?> 