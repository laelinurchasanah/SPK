<?php 
require_once('../../logout.php');
require_once('../../restrict.php'); 
require_once('../../Connections/koneksi.php'); 

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_profile = "SELECT * FROM tb_admin WHERE id_admin = '".$ID."'";
$rs_profile = mysqli_query($koneksi, $query_rs_profile) or die(mysqli_error($koneksi));
$row_rs_profile = mysqli_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysqli_num_rows($rs_profile); 

?>