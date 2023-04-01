<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_surat SET tanggal_surat=%s, jenis_surat=%s, no_surat=%s, supir_surat=%s, penerima_surat=%s, ket_surat=%s, active_surat=%s WHERE id_surat=%s",
                       GetSQLValueString($koneksi, $_POST['tanggal_surat'], "date"),
                       GetSQLValueString($koneksi, $_POST['jenis_surat'], "text"),
                       GetSQLValueString($koneksi, $_POST['no_surat'], "text"),
                       GetSQLValueString($koneksi, $_POST['supir_surat'], "int"),
                       GetSQLValueString($koneksi, $_POST['penerima_surat'], "text"),
                       GetSQLValueString($koneksi, $_POST['ket_surat'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_surat'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_surat'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_surat = "-1";
if (isset($_GET['id_surat'])) {
  $colname_rs_surat = $_GET['id_surat'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_surat = sprintf("SELECT * FROM tb_surat WHERE id_surat = %s", GetSQLValueString($koneksi, $colname_rs_surat, "int"));
$rs_surat = mysqli_query($koneksi, $query_rs_surat) or die(mysqli_error($koneksi));
$row_rs_surat = mysqli_fetch_assoc($rs_surat);
$totalRows_rs_surat = mysqli_num_rows($rs_surat);
?>
<p><strong>UPDATE DATA SURAT</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="385" height="320">
    <tr valign="baseline">
      <td width="157" align="right" nowrap="nowrap"><strong>TANGGAL SURAT</strong></td>
<td width="12">&nbsp;</td>
      <td width="200"><input type="text" name="tanggal_surat" value="<?php echo htmlentities($row_rs_surat['tanggal_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>JENIS SURAT (TA/TI)</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="jenis_surat" value="<?php echo htmlentities($row_rs_surat['jenis_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NOMOR SURAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="no_surat" value="<?php echo htmlentities($row_rs_surat['no_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID PEGAWAI (SUPIR)</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="supir_surat" value="<?php echo htmlentities($row_rs_surat['supir_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PENERIMA SURAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="penerima_surat" value="<?php echo htmlentities($row_rs_surat['penerima_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ket_surat" value="<?php echo htmlentities($row_rs_surat['ket_surat'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_surat">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_surat['active_surat'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_surat['active_surat'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/surat"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_surat" value="<?php echo $row_rs_surat['id_surat']; ?>" />
</form>