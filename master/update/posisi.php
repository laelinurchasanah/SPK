<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_posisi SET nama_posisi=%s, active_posisi=%s WHERE id_posisi=%s",
                       GetSQLValueString($koneksi, $_POST['nama_posisi'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_posisi'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_posisi'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_posisi = "-1";
if (isset($_GET['id_posisi'])) {
  $colname_rs_posisi = $_GET['id_posisi'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_posisi = sprintf("SELECT * FROM tb_posisi WHERE id_posisi = %s", GetSQLValueString($koneksi, $colname_rs_posisi, "int"));
$rs_posisi = mysqli_query($koneksi, $query_rs_posisi) or die(mysqli_error($koneksi));
$row_rs_posisi = mysqli_fetch_assoc($rs_posisi);
$totalRows_rs_posisi = mysqli_num_rows($rs_posisi);
?>
<p><strong>UPDATE DATA POSISI</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="302" height="147">
    <tr valign="baseline">
      <td width="77" align="right" nowrap="nowrap"><strong>JABATAN</strong></td>
<td width="17">&nbsp;</td>
      <td width="192"><input type="text" name="nama_posisi" value="<?php echo htmlentities($row_rs_posisi['nama_posisi'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_posisi">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_posisi['active_posisi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_posisi['active_posisi'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/posisi"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_posisi" value="<?php echo $row_rs_posisi['id_posisi']; ?>" />
</form> 