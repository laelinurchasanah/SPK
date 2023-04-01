<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_alternatif (nama_alternatif) VALUES (%s)",
                       GetSQLValueString($koneksi, $_POST['nama_alternatif'], "text"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('success','alternatif berhasil ditambahkan');
  }
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_alternatif = "SELECT * FROM tb_alternatif";
$rs_alternatif = mysqli_query($koneksi, $query_rs_alternatif) or die(mysqli_error($koneksi));
$row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif);
$totalRows_rs_alternatif = mysqli_num_rows($rs_alternatif);

//mengambil data faktor
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_faktor = "SELECT * FROM tb_faktor";
$rs_faktor = mysqli_query($koneksi, $query_rs_faktor) or die(mysqli_error($koneksi));
$rs_faktor2 = mysqli_query($koneksi, $query_rs_faktor) or die(mysqli_error($koneksi));
$row_rs_faktor = mysqli_fetch_assoc($rs_faktor);
$row_rs_faktor2 = mysqli_fetch_assoc($rs_faktor2);
$totalRows_rs_faktor = mysqli_num_rows($rs_faktor);
?>

<div class="col-md-5">

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="93">
    <tr valign="baseline">
      <td width="113" align="right" nowrap="nowrap"><div align="right">Nama alternatif</div></td>
      <td width="10" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="893"><input type="text" name="nama_alternatif" value="" size="32" class="form-control input-sm" /></td>
    </tr>
     
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" class="btn btn-primary btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<div class="col-md-7">
<?php if ($totalRows_rs_alternatif > 0) { ?>
<?php
	title('info','LIST ALTERNATIF','Berikut ini daftar alternatif yang telah ditambahkan');
?>
<table width="100%" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <th>NO.</th>
    <th>NAMA ALTERNATIF</th>
    <?php do { 
	$faktor_id[] = $row_rs_faktor['id_faktor']; 
	$faktor_nama[] = $row_rs_faktor['nama_faktor']; 
	?>
    <th><?= $row_rs_faktor['nama_faktor']; ?></th>
    <?php } while ($row_rs_faktor = mysqli_fetch_assoc($rs_faktor)); ?>
    <th>&nbsp; </th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td><a href="?page=alternatif/update&amp;id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>"><?php echo $no; ?></a></td>
      <td><?php echo $row_rs_alternatif['nama_alternatif']; ?></td>
      <?php for ($a = 0; $a < $totalRows_rs_faktor; $a++){ ?>
      	<td><a href="?page=bobot/insert&faktor_id=<?= $faktor_id[$a]?>&id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>" class="btn btn-sm btn-primary"> Berikan Nilai <?= $faktor_nama[$a]; ?> </a></td>
       <?php } ?>
      <td><a href="?page=alternatif/delete&amp;id_alternatif=<?php echo $row_rs_alternatif['id_alternatif']; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Hapus</a></td>
    </tr>
    <?php 
	$no++;
	} while ($row_rs_alternatif = mysqli_fetch_assoc($rs_alternatif)); ?>
    </tbody>
</table>
<p>
	<a href="?page=proses/view" class="btn btn-lg btn-primary btn-block">Lanjut ke Proses</a>
</p>
<?php }else{

	pesan('danger','<strong>Oops!</strong> Data alternatif belum ditambahkan');
} ?>
</div>