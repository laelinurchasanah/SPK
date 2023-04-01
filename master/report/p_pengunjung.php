<?php  
require_once('akses.php'); 

$colname_rs_pengunjung = "-1";
if (isset($_GET['id'])) {
  $colname_rs_pengunjung = $_GET['id'];
  mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pengunjung = sprintf("SELECT * FROM tb_pengunjung  INNER JOIN tb_pekerjaan ON pekerjaan_pengunjung = id_pekerjaan WHERE pekerjaan_pengunjung = %s AND ta_pengunjung = %s", 
	GetSQLValueString($koneksi, $colname_rs_pengunjung, "int"),
	GetSQLValueString($koneksi, $ta, "int"));
}else{
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pengunjung = sprintf("SELECT * FROM tb_pengunjung  INNER JOIN tb_pekerjaan ON pekerjaan_pengunjung = id_pekerjaan WHERE ta_pengunjung = %s", GetSQLValueString($koneksi, $ta, "int"));
}
$rs_pengunjung = mysqli_query($koneksi, $query_rs_pengunjung) or die(mysqli_error($koneksi));
$row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung);
$totalRows_rs_pengunjung = mysqli_num_rows($rs_pengunjung);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN BERDASARKAN PENGUNJUNG <?= $row_rs_pengunjung['nama_pekerjaan']; ?></title>
    <link rel="stylesheet" href="../../assets/dist/js/paper.css">
    
    <style>
    @page { size: A4 }
 
    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }
 
    table {
        border-collapse: collapse;
        width: 100%;
    }
 
    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }
 
    .table td {
        padding: 3px 3px;
        border:1px solid #000000;
    }
	.table td .table td {
        padding: 3px 3px;
        border:0px solid #000000;
    }
    .text-center {
        text-align: center;
    }
.style1 {color: #FFFFFF}
    .style2 {
	font-family: Arial, Helvetica, sans-serif}
	.teks {
	text-transform:uppercase;
	}
    </style>
</head>
<body class="A4" onLoad="window.print()">
<section class="sheet padding-10mm style2">
<?php
	title('success','LAPORAN PENGUNJUNG STAND STMIK ROYAL ASAHAN EXPO 2020','Laporan berdasarkan');
	echo "Pengunjung : " . $row_rs_pengunjung['nama_pekerjaan'] . " Sebanyak : " . $totalRows_rs_pengunjung;
?>
<br>
<br>
 
<table class="table table-striped table-bordered table-hover teks" id="example1">
  <thead>
    <tr bgcolor="#003366">
      <th><small><span class="style1">NO.</span></small></th>
      <th><small><span class="style1">NOMOR</span></small></th>
      <th><small><span class="style1">JK</span></small></th>
      <th><small><span class="style1">NAMA LENGKAP</span></small></th>
      <th><small><span class="style1">NO. KONTAK</span></small></th>
      <th><small><span class="style1">ALAMAT</span></small></th>
      <th><small><span class="style1">TANGGAL</span></small></th>
      <th><small><span class="style1">DATETIME</span></small></th>
    </tr>
    </thead>
  <tbody>
    <?php $no = 1; do { ?>
    <tr>
      <td> <small><?php echo $no++; ?> </small></td>
        <td><small><?php echo $row_rs_pengunjung['nomor_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['jk_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['nama_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['hp_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['alamat_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['tanggal_pengunjung']; ?></small></td>
        <td><small><?php echo $row_rs_pengunjung['today_pengunjung']; ?></small></td>
      </tr>
    <?php } while ($row_rs_pengunjung = mysqli_fetch_assoc($rs_pengunjung)); ?>
    </tbody>
</table>
 
 
  </div>
    
 
   <h5>Dicetak oleh : 
      <?= $nama; ?>, pada <?= $today; ?> WIB</h5>
 </section>
</body>
</html> 