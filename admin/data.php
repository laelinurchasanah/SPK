<?php 
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria= "SELECT COUNT(*) AS jumlahKriteria FROM tb_kriteria WHERE 1 = 1";
$rs_kriteria= mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria= mysqli_fetch_assoc($rs_kriteria);
$totalRows_rs_kriteria= mysqli_num_rows($rs_kriteria);

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_alternatif = "SELECT COUNT(*) AS jumlahAlternatif FROM tb_alternatif WHERE 1 = 1";
$rs_alternatif = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif);
$totalRows_rs_alternatif = mysqli_num_rows($rs_alternatif);


?>