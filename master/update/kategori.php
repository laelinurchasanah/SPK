<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_kategori SET nama_kategori=%s, active_kategori=%s WHERE id_kategori=%s",
                       GetSQLValueString($koneksi, $_POST['nama_kategori'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_kategori'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_kategori'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_kategori = "-1";
if (isset($_GET['id_kategori'])) {
  $colname_rs_kategori = $_GET['id_kategori'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kategori = sprintf("SELECT * FROM tb_kategori WHERE id_kategori = %s", GetSQLValueString($koneksi, $colname_rs_kategori, "int"));
$rs_kategori = mysqli_query($koneksi, $query_rs_kategori) or die(mysqli_error($koneksi));
$row_rs_kategori = mysqli_fetch_assoc($rs_kategori);
$totalRows_rs_kategori = mysqli_num_rows($rs_kategori);
?>
<p><strong>UPDATE DATA KATEGORI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="335" height="143">
    <tr valign="baseline">
      <td width="60" align="right" nowrap="nowrap"><strong>NAMA</strong></td>
<td width="10">&nbsp;</td>
      <td width="249"><input type="text" name="nama_kategori" value="<?php echo htmlentities($row_rs_kategori['nama_kategori'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_kategori">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_kategori['active_kategori'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_kategori['active_kategori'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/kategori"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kategori" value="<?php echo $row_rs_kategori['id_kategori']; ?>" />
</form>
 