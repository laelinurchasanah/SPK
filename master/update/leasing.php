<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_leasing SET nama_leasing=%s, alamat_leasing=%s, nohp_leasing=%s, active_leasing=%s WHERE id_leasing=%s",
                       GetSQLValueString($koneksi, $_POST['nama_leasing'], "text"),
                       GetSQLValueString($koneksi, $_POST['alamat_leasing'], "text"),
                       GetSQLValueString($koneksi, $_POST['nohp_leasing'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_leasing'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_leasing'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_leasing = "-1";
if (isset($_GET['id_leasing'])) {
  $colname_rs_leasing = $_GET['id_leasing'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_leasing = sprintf("SELECT * FROM tb_leasing WHERE id_leasing = %s", GetSQLValueString($koneksi, $colname_rs_leasing, "int"));
$rs_leasing = mysqli_query($koneksi, $query_rs_leasing) or die(mysqli_error($koneksi));
$row_rs_leasing = mysqli_fetch_assoc($rs_leasing);
$totalRows_rs_leasing = mysqli_num_rows($rs_leasing);
?>
<p><strong>UPDATE DATA LEASING</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="375" height="231">
    <tr valign="baseline">
      <td width="134" align="right" nowrap="nowrap"><strong>NAMA LEASING</strong></td>
<td width="17">&nbsp;</td>
      <td width="208"><input type="text" name="nama_leasing" value="<?php echo htmlentities($row_rs_leasing['nama_leasing'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_leasing" value="<?php echo htmlentities($row_rs_leasing['alamat_leasing'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. HANDPHONE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nohp_leasing" value="<?php echo htmlentities($row_rs_leasing['nohp_leasing'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_leasing">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_leasing['active_leasing'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_leasing['active_leasing'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/leasing"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_leasing" value="<?php echo $row_rs_leasing['id_leasing']; ?>" />
</form>
 