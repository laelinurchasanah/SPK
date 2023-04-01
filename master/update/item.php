<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_item SET kategori_item=%s, surat_item=%s, mesin_item=%s, tanggal_item=%s, ta_item=%s, ut_item=%s, ub_item=%s, keterangan_item=%s WHERE id_item=%s",
                       GetSQLValueString($koneksi, $_POST['kategori_item'], "text"),
                       GetSQLValueString($koneksi, $_POST['surat_item'], "int"),
                       GetSQLValueString($koneksi, $_POST['mesin_item'], "text"),
                       GetSQLValueString($koneksi, $_POST['tanggal_item'], "date"),
                       GetSQLValueString($koneksi, $_POST['ta_item'], "text"),
                       GetSQLValueString($koneksi, $today, "date"),
                       GetSQLValueString($koneksi, $ID, "int"),
                       GetSQLValueString($koneksi, $_POST['keterangan_item'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_item'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_item = "-1";
if (isset($_GET['id_item'])) {
  $colname_rs_item = $_GET['id_item'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_item = sprintf("SELECT * FROM tb_item WHERE id_item = %s", GetSQLValueString($koneksi, $colname_rs_item, "int"));
$rs_item = mysqli_query($koneksi, $query_rs_item) or die(mysqli_error($koneksi));
$row_rs_item = mysqli_fetch_assoc($rs_item);
$totalRows_rs_item = mysqli_num_rows($rs_item);
?>
<p><strong>UPDATE DATA ITEM</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="421" height="271">
    <tr valign="baseline">
      <td width="112" align="right" nowrap="nowrap"><strong>KATEGORI <br />
      (TA/TI)</strong></td>
<td width="21">&nbsp;</td>
      <td width="272"><input type="text" name="kategori_item" value="<?php echo htmlentities($row_rs_item['kategori_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SURAT ITEM</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="surat_item" value="<?php echo htmlentities($row_rs_item['surat_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID MESIN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="mesin_item" value="<?php echo htmlentities($row_rs_item['mesin_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>TANGGAL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="tanggal_item" value="<?php echo htmlentities($row_rs_item['tanggal_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>PERIODE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ta_item" value="<?php echo htmlentities($row_rs_item['ta_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="keterangan_item" value="<?php echo htmlentities($row_rs_item['keterangan_item'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/item"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_item" value="<?php echo $row_rs_item['id_item']; ?>" />
</form> 