<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_bstk SET no_bstk=%s, bon_bstk=%s, donoI_bstk=%s, donoII_bstk=%s, tanggal_bstk=%s, type_bstk=%s, mesin_bstk=%s, ket_bstk=%s, active_bstk=%s, ub_bstk=%s, ut_bstk=%s WHERE id_bstk=%s",
                       GetSQLValueString($koneksi, $_POST['no_bstk'], "text"),
                       GetSQLValueString($koneksi, $_POST['bon_bstk'], "text"),
                       GetSQLValueString($koneksi, $_POST['donoI_bstk'], "text"),
                       GetSQLValueString($koneksi, $_POST['donoII_bstk'], "text"),
                       GetSQLValueString($koneksi, $_POST['tanggal_bstk'], "date"),
                       GetSQLValueString($koneksi, $_POST['type_bstk'], "int"),
                       GetSQLValueString($koneksi, $_POST['mesin_bstk'], "int"),
                       GetSQLValueString($koneksi, $_POST['ket_bstk'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_bstk'], "text"),
                       GetSQLValueString($koneksi, $ID, "int"),
                       GetSQLValueString($koneksi, $today, "date"),
                       GetSQLValueString($koneksi, $_POST['id_bstk'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_bstk = "-1";
if (isset($_GET['id_bstk'])) {
  $colname_rs_bstk = $_GET['id_bstk'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_bstk = sprintf("SELECT * FROM tb_bstk WHERE id_bstk = %s", GetSQLValueString($koneksi, $colname_rs_bstk, "int"));
$rs_bstk = mysqli_query($koneksi, $query_rs_bstk) or die(mysqli_error($koneksi));
$row_rs_bstk = mysqli_fetch_assoc($rs_bstk);
$totalRows_rs_bstk = mysqli_num_rows($rs_bstk);
?>
<p><strong>UPDATE BSTK</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="407" height="403">
    <tr valign="baseline">
      <td width="112" align="right" nowrap="nowrap"><strong>NO. BSTK</strong></td>
<td width="14">&nbsp;</td>
      <td width="265"><input type="text" name="no_bstk" value="<?php echo htmlentities($row_rs_bstk['no_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>BON</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="bon_bstk" value="<?php echo htmlentities($row_rs_bstk['bon_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>DO NO 1</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="donoI_bstk" value="<?php echo htmlentities($row_rs_bstk['donoI_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>DO NO 2</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="donoII_bstk" value="<?php echo htmlentities($row_rs_bstk['donoII_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TANGGAL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tanggal_bstk" value="<?php echo htmlentities($row_rs_bstk['tanggal_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TIPE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="type_bstk" value="<?php echo htmlentities($row_rs_bstk['type_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>MESIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="mesin_bstk" value="<?php echo htmlentities($row_rs_bstk['mesin_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ket_bstk" value="<?php echo htmlentities($row_rs_bstk['ket_bstk'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_bstk">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_bstk['active_bstk'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_bstk['active_bstk'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/bstk"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_bstk" value="<?php echo $row_rs_bstk['id_bstk']; ?>" />
</form> 