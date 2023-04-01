<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_ta SET `kode_ta`=%s, `nama_ta`=%s, `ket_ta`=%s WHERE id_ta=%s",
                       GetSQLValueString($koneksi, $_POST['kode_ta'], "text"),
                       GetSQLValueString($koneksi, $_POST['nama_ta'], "text"),
                       GetSQLValueString($koneksi, $_POST['ket_ta'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_ta'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_ta = "SELECT * FROM tb_ta WHERE id_ta = 1";
$rs_ta = mysqli_query($koneksi, $query_rs_ta) or die(mysqli_error($koneksi));
$row_rs_ta = mysqli_fetch_assoc($rs_ta);
$totalRows_rs_ta = mysqli_num_rows($rs_ta);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="479" height="160">
    <tr valign="baseline">
      <td nowrap="nowrap">Kode TA</td>
      <td><input type="text" name="kode_ta" value="<?php echo htmlentities($row_rs_ta['kode_ta'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Judul</td>
      <td><input type="text" name="nama_ta" value="<?php echo htmlentities($row_rs_ta['nama_ta'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Keterangan</td>
      <td><input type="text" name="ket_ta" value="<?php echo htmlentities($row_rs_ta['ket_ta'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_ta" value="<?php echo $row_rs_ta['id_ta']; ?>" />
</form> 