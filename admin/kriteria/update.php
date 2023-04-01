<?php  
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_kriteria SET kode_kriteria=%s, nama_kriteria=%s, faktor_id=%s, profile_ideal=%s WHERE id_kriteria=%s",
                       GetSQLValueString($koneksi, $_POST['kode_kriteria'], "text"),
                       GetSQLValueString($koneksi, $_POST['nama_kriteria'], "text"),
                       GetSQLValueString($koneksi, $_POST['faktor_id'], "int"),
                       GetSQLValueString($koneksi, $_POST['profile_ideal'], "int"),
                       GetSQLValueString($koneksi, $_POST['id_kriteria'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
  
  if ($Result1) {
  	pesan('warning','Kriteria berhasil diupdate');
  }
}

$colname_rs_kriteria = "-1";
if (isset($_GET['id_kriteria'])) {
  $colname_rs_kriteria = $_GET['id_kriteria'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_kriteria = sprintf("SELECT * FROM tb_kriteria WHERE id_kriteria = %s", GetSQLValueString($koneksi, $colname_rs_kriteria, "int"));
$rs_kriteria = mysqli_query($koneksi, $query_rs_kriteria) or die(mysqli_error($koneksi));
$row_rs_kriteria = mysqli_fetch_assoc($rs_kriteria);
$totalRows_rs_kriteria = mysqli_num_rows($rs_kriteria);

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_faktor = "SELECT * FROM tb_faktor";
$rs_faktor = mysqli_query($koneksi, $query_rs_faktor) or die(mysqli_error($koneksi));
$row_rs_faktor = mysqli_fetch_assoc($rs_faktor);
$totalRows_rs_faktor = mysqli_num_rows($rs_faktor);
?>
<?php
	title('warning','UPDATE KRITERIA','Silahkan ubah data kriteria');
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="100%" height="200">
    <tr valign="top">
      <td width="10%" align="right" nowrap="nowrap">Kode </td>
      <td width="1%" align="right" nowrap="nowrap">&nbsp;</td>
      <td width="89%"><input type="text" name="kode_kriteria" value="<?php echo htmlentities($row_rs_kriteria['kode_kriteria'], ENT_COMPAT, ''); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Nama Kriteria</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_kriteria" value="<?php echo htmlentities($row_rs_kriteria['nama_kriteria'], ENT_COMPAT, ''); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Bagian Faktor</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select name="faktor_id" class="form-control input-sm">
        <?php 
do {  
?>
        <option value="<?php echo $row_rs_faktor['id_faktor']?>" <?php if (!(strcmp($row_rs_faktor['id_faktor'], htmlentities($row_rs_kriteria['faktor_id'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_rs_faktor['nama_faktor']?></option>
        <?php
} while ($row_rs_faktor = mysqli_fetch_assoc($rs_faktor));
?>
      </select>      </td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right">Set Profile Ideal</td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="profile_ideal" value="<?php echo htmlentities($row_rs_kriteria['profile_ideal'], ENT_COMPAT, ''); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="top">
      <td nowrap="nowrap" align="right"><a href="?page=kriteria/insert"> Kembali</a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" class="btn btn-block btn-primary"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_kriteria" value="<?php echo $row_rs_kriteria['id_kriteria']; ?>" />
</form>
<p>&nbsp;</p>
 