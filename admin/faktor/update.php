<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_faktor SET nama_faktor=%s, persen_faktor=%s WHERE id_faktor=%s",
                       GetSQLValueString($koneksi, $_POST['nama_faktor'], "text"),
                       GetSQLValueString($koneksi, $_POST['persen_faktor'], "double"),
                       GetSQLValueString($koneksi, $_POST['id_faktor'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('warning','Faktor berhasil diupdate');
  }
}

$colname_rs_update = "-1";
if (isset($_GET['id_faktor'])) {
  $colname_rs_update = $_GET['id_faktor'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_update = sprintf("SELECT * FROM tb_faktor WHERE id_faktor = %s", GetSQLValueString($koneksi, $colname_rs_update, "int"));
$rs_update = mysqli_query($koneksi, $query_rs_update) or die(mysqli_error($koneksi));
$row_rs_update = mysqli_fetch_assoc($rs_update);
$totalRows_rs_update = mysqli_num_rows($rs_update);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="107">
    <tr valign="baseline">
      <td width="10%" align="right" nowrap="nowrap">Nama Faktor</td>
      <td width="1%" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="89%"><input type="text" name="nama_faktor" value="<?php echo htmlentities($row_rs_update['nama_faktor'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Persentase</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="persen_faktor" value="<?php echo htmlentities($row_rs_update['persen_faktor'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right"><a href="?page=faktor/insert">Kembali</a></div></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan perubahan" class="btn btn-primary btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_faktor" value="<?php echo $row_rs_update['id_faktor']; ?>" />
</form> 