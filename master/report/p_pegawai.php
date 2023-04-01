<?php  
require_once('akses.php'); 

$colname_rs_pegawai = "-1";
if (isset($_GET['pegawai'])) {
  $colname_rs_pegawai = $_GET['pegawai'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pk = sprintf("SELECT id_penerimaankas, kode_penerimaankas, tanggal_penerimaankas, nama_pegawai, statuspanjar_penerimaankas, transaksi_penerimaankas, pembeli_penerimaankas, diserahkan_penerimaankas, uangmuka_penerimaankas, jenisbeli_penerimaankas, nominalpanjar_penerimaankas, nama_pegawai FROM tb_penerimaankas 
INNER JOIN tb_pegawai ON diserahkan_penerimaankas = id_pegawai
	WHERE active_penerimaankas = 'Y' AND periode_penerimaankas = '".$ta."' AND diserahkan_penerimaankas = %s", 
	GetSQLValueString($koneksi, $colname_rs_pegawai, "int"));
$rs_pk = mysqli_query($koneksi, $query_rs_pk) or die(mysqli_error($koneksi));
$row_rs_pk = mysqli_fetch_assoc($rs_pk);
$totalRows_rs_pk = mysqli_num_rows($rs_pk);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN PK</title>
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
</style>
</head>
<body class="A4">
<section class="sheet padding-10mm">
<?php
	title('success','LAPORAN PENERIMAAN KAS','Laporan berdasarkan Pegawai');
?>
 
<div class="alert alert-info">Hasil dari pencarian dengan nama pegawai <?= $row_rs_pk['nama_pegawai']; ?></div>
 <p>&nbsp;</p>
 <div class="table-responsive">
    <table width="100%" class="table">
        <thead>
            <tr>
                <th width="6%">NO </th>
                <th width="52%">&nbsp;</th>
              <th width="30%">STATUS</th>
                <th width="12%">&nbsp;</th>
          </tr>
        </thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td align="center">  
				<?= $no++; ?>
			  </td>
              <td><strong>KODE PK : <?php echo $row_rs_pk['kode_penerimaankas']; ?></strong><br>
              
                <table width="100%" class="table">
                    <tr>
                      <td width="29%">Tanggal</td>
                      <td width="4%">&nbsp;</td>
                      <td width="67%"><?php echo date('d M Y', strtotime($row_rs_pk['tanggal_penerimaankas'])); ?></td>
                    </tr>
                    <tr>
                      <td>Atas nama</td>
                      <td>&nbsp;</td>
                      <td><strong><?php echo $row_rs_pk['pembeli_penerimaankas']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Oleh </td>
                      <td>&nbsp;</td>
                      <td><?php echo $row_rs_pk['nama_pegawai']; ?></td>
                    </tr>
                    <tr>
                      <td>Uang Muka</td>
                      <td>&nbsp;</td>
                      <td>Rp. <strong><?php echo number_format($row_rs_pk['uangmuka_penerimaankas']); ?></strong></td>
                    </tr>
                  </table></td>
              <td><table width="100%" class="table"> 
              <tr>
                    <td width="44%">STATUS</td>
                    <td width="5%">&nbsp;</td>
                    <td width="51%"><?php echo $st = $row_rs_pk['statuspanjar_penerimaankas']; ?></td>
                  </tr>
                  <tr>
                    <td>TRANSAKSI</td>
                    <td>&nbsp;</td>
                    <td><?php echo $tr = $row_rs_pk['transaksi_penerimaankas']; ?></td>
                  </tr>
                  <tr>
                    <td>PANJAR</td>
                    <td>&nbsp;</td>
                    <td>Rp. <strong><?php $pj = $row_rs_pk['nominalpanjar_penerimaankas']; echo number_format($pj); ?></strong></td>
                </tr>
                  <tr>
                    <td>KATEGORI</td>
                    <td>&nbsp;</td>
                    <td><strong><?php echo $row_rs_pk['jenisbeli_penerimaankas']; ?></strong></td>
                  </tr>
                </table>                
              <p>&nbsp;</p></td>
              <td>
              <a onClick="return confirm('Anda yakin mengubah data ini?');" href="?page=pk/update&pk=<?= $row_rs_pk['id_penerimaankas'];?>" class="btn btn-xs btn-warning" title="Edit"><span class="fa fa-edit"></span></a>
              <a onClick="return confirm('Anda yakin menghapus data ini?');" href="?page=pk/delete&pk=<?= $row_rs_pk['id_penerimaankas'];?>" class="btn btn-xs btn-danger" title="Hapus"><span class="fa fa-trash"></span></a>              </td>
    </tr>
    <?php } while ($row_rs_pk = mysqli_fetch_assoc($rs_pk)); ?>
</table>
</tbody>    
    </table> 
 
 
  </div>
    
    <hr/>
   <h5>Dicetak oleh : 
      <?= $nama; ?>, pada <?= $today; ?> WIB</h5>
 </section>
</body>
</html> 