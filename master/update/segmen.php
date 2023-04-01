<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_segmen SET nama_segmen=%s, active_segmen=%s WHERE id_segmen=%s",
                       GetSQLValueString($koneksi, $_POST['nama_segmen'], "text"),
                       GetSQLValueString($koneksi, $_POST['active_segmen'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_segmen'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_segmen = "-1";
if (isset($_GET['id_segmen'])) {
  $colname_rs_segmen = $_GET['id_segmen'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_segmen = sprintf("SELECT * FROM tb_segmen WHERE id_segmen = %s", GetSQLValueString($koneksi, $colname_rs_segmen, "int"));
$rs_segmen = mysqli_query($koneksi, $query_rs_segmen) or die(mysqli_error($koneksi));
$row_rs_segmen = mysqli_fetch_assoc($rs_segmen);
$totalRows_rs_segmen = mysqli_num_rows($rs_segmen);
?>
<p><strong>UPDATE DATA SEGMEN</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="351" height="132">
    <tr valign="baseline">
      <td width="128" align="right" nowrap="nowrap"><strong>NAMA SEGMEN</strong></td>
<td width="15">&nbsp;</td>
      <td width="192"><input type="text" name="nama_segmen" value="<?php echo htmlentities($row_rs_segmen['nama_segmen'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_segmen">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rs_segmen['active_segmen'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rs_segmen['active_segmen'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>BLOK</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/segmen"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_segmen" value="<?php echo $row_rs_segmen['id_segmen']; ?>" />
</form> 
