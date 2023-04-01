<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_faktor (nama_faktor, persen_faktor) VALUES (%s, %s)",
                       GetSQLValueString($koneksi, $_POST['nama_faktor'], "text"),
                       GetSQLValueString($koneksi, $_POST['persen_faktor'], "double"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('success','Faktor berhasil ditambahkan');
  }
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_faktor = "SELECT * FROM tb_faktor";
$rs_faktor = mysqli_query($koneksi, $query_rs_faktor) or die(mysqli_error($koneksi));
$row_rs_faktor = mysqli_fetch_assoc($rs_faktor);
$totalRows_rs_faktor = mysqli_num_rows($rs_faktor);
?>

 
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<!--  <table width="100%" height="114">
    <tr valign="baseline">
      <td width="82" align="right" nowrap="nowrap"><div align="right">Nama Faktor</div></td>
      <td width="12" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="904"><input type="text" name="nama_faktor" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right">Persentase</div></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="persen_faktor" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" class="btn btn-primary btn-block" /></td>
    </tr>
  </table>
-->  
  <input type="hidden" name="MM_insert" value="form1" />
</form>
 <div class="col-md-12">
<?php if ($totalRows_rs_faktor > 0) { ?>

<table width="100%" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
    <th width="2%">NO.</th>
    <th width="36%">NAMA FAKTOR</th>
    <th width="33%">PERSENTASE</th>
    <th width="29%">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php $no = 1; do { ?>
    <tr>
      <td><?php echo $no; ?></a></td>
      <td><?php echo $row_rs_faktor['nama_faktor']; ?></td>
      <td><?php echo $row_rs_faktor['persen_faktor']; ?></td>
      <td><a href="?page=faktor/update&amp;id_faktor=<?php echo $row_rs_faktor['id_faktor']; ?>" class="btn btn-xs btn-primary">    Ubah Nilai Persenase  </a></td>
      <!--<td><a href="?page=faktor/delete&amp;id_faktor=< ? php echo $row_rs_faktor['id_faktor']; ? >" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Hapus</a></td> -->
    </tr>
    <?php 
	$no++;
	} while ($row_rs_faktor = mysqli_fetch_assoc($rs_faktor)); ?>
    </tbody>
</table>
<?php }else{

	pesan('danger','<strong>Oops!</strong> Data faktor belum ditambahkan');
} ?>
</div>