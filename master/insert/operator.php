<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_operator (Login, Password, `Level`, nama_operator, gender_operator, alamat_operator, email_operator, nohp_operator, photo_operator, ket_operator, active_operator, key_operator, cb_operator, ct_operator) VALUES (%s, PASSWORD(%s), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($koneksi, $_POST['active_operator'], "text"),
                       GetSQLValueString($koneksi, $_POST['key_operator'], "text"),
                       GetSQLValueString($koneksi, $ID, "int"),
                       GetSQLValueString($koneksi, $today, "date"));

  mysqli_select_db($koneksi, $database_koneksi);
  $Result1 = mysqli_query($koneksi, $insertSQL) or die(mysqli_error($koneksi));
}
?>
<p><strong>INSERT DATA OPERATOR</strong> </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="359" height="471">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LOGIN</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Login" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SANDI</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Password" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>LEVEL</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="Level" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA LENGKAP</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nama_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>SAYA ADALAH (L/P)</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="gender_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>ALAMAT</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="alamat_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>EMAIL</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="email_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NO. HANDPHONE</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="nohp_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>NAMA FILE PHOTO</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="photo_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KETERANGAN</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="ket_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>STATUS OPERATOR</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><select class="form-control input-sm" name="active_operator" id="active_operator">
          <option value="Y">AKTIF</option>
          <option value="N">BLOK</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><strong>KEY PEMULIHAN</strong></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="text" name="key_operator" value="" size="32" class="form-control input-sm" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><a href="?page=view/operator">Kembali</a></td>
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Data" class="btn btn-success btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
