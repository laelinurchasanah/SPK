<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_jenistransaksi SET kode_jenistransaksi=%s, nama_jenistransaksi=%s, active_jenistransaksi=%s WHERE id_jenistransaksi=%s",
                       GetSQLValueString($koneksi, $_POST['kode_jenistransaksi'], "text"),
                       GetSQLValueString($koneksi, $_POST['nama_jenistransaksi'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_jenistransaksi'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_jenistransaksi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_jenistransaksi = "-1";
if (isset($_GET['id_jenistransaksi'])) {
  $colname_rs_jenistransaksi = $_GET['id_jenistransaksi'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_jenistransaksi = sprintf("SELECT * FROM tb_jenistransaksi WHERE id_jenistransaksi = %s", GetSQLValueString($koneksi, $colname_rs_jenistransaksi, "int"));
$rs_jenistransaksi = mysqli_query($koneksi, $query_rs_jenistransaksi) or die(mysqli_error($koneksi));
$row_rs_jenistransaksi = mysqli_fetch_assoc($rs_jenistransaksi);
$totalRows_rs_jenistransaksi = mysqli_num_rows($rs_jenistransaksi);
?>
<p><strong>UPDATE DATA JENIS TRANSAKSI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="359" height="182">
    <tr valign="baseline">
      <td width="99" align="right" nowrap="nowrap"><strong>KODE</strong></td>
<td width="10">&nbsp;</td>
      <td width="234"><input type="text" name="kode_jenistransaksi" value="<?php echo htmlentities($row_rs_jenistransaksi['kode_jenistransaksi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA JENIS</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_jenistransaksi" value="<?php echo htmlentities($row_rs_jenistransaksi['nama_jenistransaksi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_jenistransaksi">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_jenistransaksi['active_jenistransaksi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_jenistransaksi['active_jenistransaksi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/jenistransaksi"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_jenistransaksi" value="<?php echo $row_rs_jenistransaksi['id_jenistransaksi']; ?>" />
</form>
 