<?php 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_operator SET Login=%s, Password=%s, `Level`=%s, nama_operator=%s, gender_operator=%s, alamat_operator=%s, email_operator=%s, nohp_operator=%s, photo_operator=%s, ket_operator=%s, key_operator=%s, ut_operator=%s, ub_operator=%s, active_operator=%s WHERE id_operator=%s",
                       GetSQLValueString($koneksi, $_POST['Login'], "text"),
                       GetSQLValueString($koneksi, $_POST['Password'], "text"),
                       GetSQLValueString($koneksi, $_POST['Level'], "int"),
                       GetSQLValueString($koneksi, $_POST['nama_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['gender_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['alamat_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['email_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['nohp_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['photo_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['ket_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['key_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['ut_operator'], "date"),
                       GetSQLValueString($koneksi, $_POST['ub_operator'], "int"),
                       GetSQLValueString($koneksi, $_POST['active_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_operator'], "int"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
}

$colname_rs_operator = "-1";
if (isset($_GET['id_operator'])) {
  $colname_rs_operator = $_GET['id_operator'];
}
mysqli_select_db($koneksi, $database_koneksi);
$query_rs_operator = sprintf("SELECT * FROM tb_operator WHERE id_operator = %s", GetSQLValueString($koneksi, $colname_rs_operator, "int"));
$rs_operator = mysqli_query($koneksi, $query_rs_operator) or die(mysqli_error($koneksi));
$row_rs_operator = mysqli_fetch_assoc($rs_operator);
$totalRows_rs_operator = mysqli_num_rows($rs_operator);
?>
<p><strong>UPDATE DATA OPERATOR</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="438" height="576">
    <tr valign="baseline">
      <td width="148" align="right" nowrap="nowrap"><strong>LOGIN</strong></td>
<td width="21">&nbsp;</td>
      <td width="253"><input type="text" name="Login" value="<?php echo htmlentities($row_rs_operator['Login'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
<td>&nbsp;</td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LEVEL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="Level" value="<?php echo htmlentities($row_rs_operator['Level'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA OPERATOR</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nama_operator" value="<?php echo htmlentities($row_rs_operator['nama_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SAYA ADALAH</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="gender_operator" value="<?php echo htmlentities($row_rs_operator['gender_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="alamat_operator" value="<?php echo htmlentities($row_rs_operator['alamat_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="email_operator" value="<?php echo htmlentities($row_rs_operator['email_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. HANDPHONE</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="nohp_operator" value="<?php echo htmlentities($row_rs_operator['nohp_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="photo_operator" value="<?php echo htmlentities($row_rs_operator['photo_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="ket_operator" value="<?php echo htmlentities($row_rs_operator['ket_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KEY</strong></td>
<td>&nbsp;</td>
      <td><input type="text" name="key_operator" value="<?php echo htmlentities($row_rs_operator['key_operator'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS</strong></td>
<td>&nbsp;</td>
      <td><select class="form-control input-sm" name="active_operator" id="active_operator">
        <option value="Y" <?php if (!(strcmp("Y", $row_rs_operator['active_operator']))) {echo "selected=\"selected\"";} ?>>AKTIF</option>
        <option value="N" <?php if (!(strcmp("N", $row_rs_operator['active_operator']))) {echo "selected=\"selected\"";} ?>>BLOK</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/operator"><strong>Kembali</strong></a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_operator" value="<?php echo $row_rs_operator['id_operator']; ?>" />
</form> 