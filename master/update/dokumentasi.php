<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_dokumentasi SET tanggal_dokumentasi=%s, noktp_dokumentasi=%s, namapembeli_dokumentasi=%s, alamat_dokumentasi=%s, telpon_dokumentasi=%s, photo_dokumentasi=%s, supir_dokumentasi=%s, lokasi_dokumentasi=%s, keterangan_dokumentasi=%s, active_dokumentasi=%s, ut_dokumentasi=%s, ub_dokumentasi=%s WHERE id_dokumentasi=%s",
                       GetSQLValueString($koneksi, $_POST['tanggal_dokumentasi'], "date"),
                       GetSQLValueString($koneksi, $_POST['noktp_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['namapembeli_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['alamat_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['telpon_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['photo_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['supir_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['lokasi_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['keterangan_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_dokumentasi'], "text"),
                       GetSQLValueString($koneksi, $today, "date"),
                       GetSQLValueString($koneksi, $ID, "int"),
                       GetSQLValueString($koneksi, $_POST['id_dokumentasi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_dokumentasi = "-1";
if (isset($_GET['id_dokumentasi'])) {
  $colname_rs_dokumentasi = $_GET['id_dokumentasi'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_dokumentasi = sprintf("SELECT * FROM tb_dokumentasi WHERE id_dokumentasi = %s", GetSQLValueString($koneksi, $colname_rs_dokumentasi, "int"));
$rs_dokumentasi = mysqli_query($koneksi, $query_rs_dokumentasi) or die(mysqli_error($koneksi));
$row_rs_dokumentasi = mysqli_fetch_assoc($rs_dokumentasi);
$totalRows_rs_dokumentasi = mysqli_num_rows($rs_dokumentasi);
?>
<p><strong>UPDATE DATA DOKUMENTASI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="422" height="435">
    <tr valign="baseline">
      <td width="148" align="right" nowrap="nowrap"><strong>TANGGAL</strong></td>
<td width="17">&nbsp;</td>
      <td width="241"><input type="text" name="tanggal_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['tanggal_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. KTP</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="noktp_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['noktp_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA PEMBELI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="namapembeli_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['namapembeli_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['alamat_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. TELPON</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="telpon_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['telpon_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="photo_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['photo_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ID SUPIR</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="supir_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['supir_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LOKASI</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="lokasi_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['lokasi_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="keterangan_dokumentasi" value="<?php echo htmlentities($row_rs_dokumentasi['keterangan_dokumentasi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS </strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_dokumentasi">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_dokumentasi['active_dokumentasi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_dokumentasi['active_dokumentasi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/dokumentasi"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_dokumentasi" value="<?php echo $row_rs_dokumentasi['id_dokumentasi']; ?>" />
</form>
 