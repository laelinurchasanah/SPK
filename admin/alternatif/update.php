<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_alternatif SET nama_alternatif=%s WHERE id_alternatif=%s",
                       GetSQLValueString($koneksi, $_POST['nama_alternatif'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_alternatif'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('warning','alternatif berhasil diupdate');
  }
}

$colname_rs_update = "-1";
if (isset($_GET['id_alternatif'])) {
  $colname_rs_update = $_GET['id_alternatif'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_update = sprintf("SELECT * FROM tb_alternatif WHERE id_alternatif = %s", GetSQLValueString($koneksi, $colname_rs_update, "int"));
$rs_update = mysqli_query($koneksi, $query_rs_update) or die(mysqli_error($koneksi));
$row_rs_update = mysqli_fetch_assoc($rs_update);
$totalRows_rs_update = mysqli_num_rows($rs_update);
?>
<?php
	title('warning','UPDATE alternatif','Silahkan ubah data alternatif');
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="107">
    <tr valign="baseline">
      <td width="10%" align="right" nowrap="nowrap">Nama alternatif</td>
      <td width="1%" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="89%"><input type="text" name="nama_alternatif" value="<?php echo htmlentities($row_rs_update['nama_alternatif'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
 
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right"><a href="?page=alternatif/insert">Kembali</a></div></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan perubahan" class="btn btn-primary btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_alternatif" value="<?php echo $row_rs_update['id_alternatif']; ?>" />
</form> 