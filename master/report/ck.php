<?php  


$colname_rs_ck = "-1";
if (isset($_GET['ck'])) {
  $colname_rs_ck = $_GET['ck'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_pk = sprintf("SELECT id_penerimaankas, kode_penerimaankas, tanggal_penerimaankas, nama_pegawai, statuspanjar_penerimaankas, transaksi_penerimaankas, pembeli_penerimaankas, diserahkan_penerimaankas, uangmuka_penerimaankas, jenisbeli_penerimaankas, nominalpanjar_penerimaankas, nama_pegawai FROM tb_penerimaankas 
INNER JOIN tb_pegawai ON diserahkan_penerimaankas = id_pegawai
	WHERE active_penerimaankas = 'Y' AND periode_penerimaankas = '".$ta."' AND jenisbeli_penerimaankas = %s", 
	GetSQLValueString($koneksi, $colname_rs_ck, "text"));
$rs_pk = mysqli_query($koneksi, $query_rs_pk) or die(mysqli_error($koneksi));
$row_rs_pk = mysqli_fetch_assoc($rs_pk);
$totalRows_rs_pk = mysqli_num_rows($rs_pk);
 
?>


<?php
	title('success','CASH / KREDIT ','Laporan berdasarkan status jenis transaksi');
?>

<form id="form1" name="form1" method="get" action="" autocomplete="off">
  Cari berdasarkan jenis transaksi
    <select name="ck" id="ck">
      <option value="CASH" <?php if (!(strcmp("CASH", "CASH"))) {echo "selected=\"selected\"";} ?>>CASH</option>
      <option value="KREDIT" <?php if (!(strcmp("KREDIT", "CASH"))) {echo "selected=\"selected\"";} ?>>KREDIT</option>
    </select>
    <input type="hidden" name="page" value="report/ck"/>
    <input type="submit" name="button" id="button" value="Cari" />
</form>
<p></p>
<?php if ($totalRows_rs_pk == 0) { 
	pesan('danger','Oops! Data tidak ditemukan!'); 
	
?>

<?php } ?>

<?php if ($totalRows_rs_pk > 0) { ?>

<div class="alert alert-info">Hasil dari pencarian dengan status <?= $colname_rs_ck; ?> sebanyak : <?= $totalRows_rs_pk; ?></div>
 
 <p><a href="report/p_ck.php?ck=<?= $colname_rs_ck; ?>" target="_blank">Print</a></p>
 <p></p>
 <div class="table-responsive">
    <table width="100%" class="table table-striped table-bordered table-hover small" id="example2">
        <thead>
            <tr>
                <th width="6%">&nbsp; </th>
                <th width="52%">KODE PK</th>
                <th width="30%">STATUS</th>
          </tr>
        </thead>
        <tbody>  
          <?php $no = 1; do { ?>
            <tr>
              <td align="center">  
<a href="pk/preview.php?pk=<?php echo $row_rs_pk['id_penerimaankas']; ?>" target="_blank" class="btn btn-xs btn-primary"><span class="fa fa-print"></span></a></td>
              <td><strong><?php echo $row_rs_pk['kode_penerimaankas']; ?></strong><br>
              
                <table width="100%">
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
              <td><table width="100%">
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
          </tr>
    <?php } while ($row_rs_pk = mysqli_fetch_assoc($rs_pk)); ?>
</table>
</tbody>    
    </table> 
<?php } ?>
</body>
</html> 