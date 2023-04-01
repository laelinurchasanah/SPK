<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_unit SET smh_unit=%s, warna_unit=%s, kodewarna_unit=%s, mesin_unit=%s, rangka_unit=%s, tahun_unit=%s, statusmilik_unit=%s, status_unit=%s, tanggal_unit=%s, sales_unit=%s, supir_unit=%s, active_unit=%s WHERE id_unit=%s",
                       GetSQLValueString($koneksi, $_POST['smh_unit'], "int"),
                       GetSQLValueString($koneksi, $_POST['warna_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['kodewarna_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['mesin_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['rangka_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['tahun_unit'], "date"),
                       GetSQLValueString($koneksi, $_POST['statusmilik_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['status_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['tanggal_unit'], "date"),
                       GetSQLValueString($koneksi, $_POST['sales_unit'], "int"),
                       GetSQLValueString($koneksi, $_POST['supir_unit'], "int"),
                       GetSQLValueString($koneksi, $_POST['active_unit'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_unit'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_unit = "-1";
if (isset($_GET['id_unit'])) {
  $colname_rs_unit = $_GET['id_unit'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_unit = sprintf("SELECT * FROM tb_unit WHERE id_unit = %s", GetSQLValueString($koneksi, $colname_rs_unit, "int"));
$rs_unit = mysqli_query($koneksi, $query_rs_unit) or die(mysqli_error($koneksi));
$row_rs_unit = mysqli_fetch_assoc($rs_unit);
$totalRows_rs_unit = mysqli_num_rows($rs_unit);
?>
<p><strong>UPDATE DATA UNIT</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="354" height="466">
    <tr valign="baseline">
      <td width="114" align="right" nowrap="nowrap"><strong>ID SMH</strong></td>
<td width="14">&nbsp;</td>
      <td width="210"><input type="text" name="smh_unit" value="<?php echo htmlentities($row_rs_unit['smh_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>WARNA</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="warna_unit" value="<?php echo htmlentities($row_rs_unit['warna_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KODE WARNA</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="kodewarna_unit" value="<?php echo htmlentities($row_rs_unit['kodewarna_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. MESIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="mesin_unit" value="<?php echo htmlentities($row_rs_unit['mesin_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. RANGKA</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="rangka_unit" value="<?php echo htmlentities($row_rs_unit['rangka_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TAHUN BUAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tahun_unit" value="<?php echo htmlentities($row_rs_unit['tahun_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS MILIK</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="statusmilik_unit" value="<?php echo htmlentities($row_rs_unit['statusmilik_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS UNIT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="status_unit" value="<?php echo htmlentities($row_rs_unit['status_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TANGGAL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tanggal_unit" value="<?php echo htmlentities($row_rs_unit['tanggal_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID SALES</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="sales_unit" value="<?php echo htmlentities($row_rs_unit['sales_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID SUPIR</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="supir_unit" value="<?php echo htmlentities($row_rs_unit['supir_unit'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS UNIT</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_unit">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_unit['active_unit'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_unit['active_unit'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/unit">Kembali</a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_unit" value="<?php echo $row_rs_unit['id_unit']; ?>" />
</form>

