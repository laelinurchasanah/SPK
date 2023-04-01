<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  if (empty($_POST['Password'])) {
	    $updateSQL = sprintf("UPDATE tb_admin SET nama_admin=%s, gender_admin=%s, address_admin=%s, email_admin=%s, hp_admin=%s, key_admin=%s WHERE id_admin=%s",
                       GetSQLValueString($koneksi, $_POST['nama_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['gender_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['address_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['email_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['hp_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['key_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_admin'], "int"));;
	
	  	mysqli_select_db($koneksi, $database_koneksi);
	 	$Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
		
		pesan('success','Sukses! Data berhasil diupdate tanpa ganti password');
  }else{
	    $updateSQL = sprintf("UPDATE tb_admin SET Password=PASSWORD(%s), nama_admin=%s, gender_admin=%s, address_admin=%s, email_admin=%s, hp_admin=%s, key_admin=%s WHERE id_admin=%s",
                       GetSQLValueString($koneksi, $_POST['Password'], "text"),
                       GetSQLValueString($koneksi, $_POST['nama_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['gender_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['address_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['email_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['hp_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['key_admin'], "text"),
                       GetSQLValueString($koneksi, $_POST['id_admin'], "int"));
		
		mysqli_select_db($koneksi, $database_koneksi);
	  	$Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));	
		
		pesan('success','Sukses! Data berhasil diupdate beserta password');	   
  }
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_profile = "SELECT * FROM tb_admin WHERE id_admin = '".$ID."'";
$rs_profile = mysqli_query($koneksi, $query_rs_profile) or die(mysqli_error($koneksi));
$row_rs_profile = mysqli_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysqli_num_rows($rs_profile);
?> 

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="373" height="336">
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Change Password *</td>
      <td><input type="password" name="Password" value="" size="32" class="form-control input-sm"/></td>
    </tr>
    <tr valign="baseline">
      <td height="21" valign="top" nowrap="nowrap">&nbsp;</td>
      <td><h5>*) <em>Kosongkan jika tidak ingin ganti sandi</em></h5></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Nama Lengkap</td>
      <td><input type="text" name="nama_admin" value="<?php echo htmlentities($row_rs_profile['nama_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Gender</td>
      <td valign="baseline"><table>
        <tr>
          <td><input type="radio" name="gender_admin" value="L" <?php if (!(strcmp(htmlentities($row_rs_profile['gender_admin'], ENT_COMPAT, 'utf-8'),"L"))) {echo "CHECKED";} ?> />
            Laki-laki</td>
        </tr>
        <tr>
          <td><input type="radio" name="gender_admin" value="P" <?php if (!(strcmp(htmlentities($row_rs_profile['gender_admin'], ENT_COMPAT, 'utf-8'),"P"))) {echo "CHECKED";} ?> />
            Perempuan</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Address</td>
      <td><input type="text" name="address_admin" value="<?php echo htmlentities($row_rs_profile['address_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Email</td>
      <td><input type="email" name="email_admin" value="<?php echo htmlentities($row_rs_profile['email_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">No. Kontak</td>
      <td><input type="text" name="hp_admin" value="<?php echo htmlentities($row_rs_profile['hp_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">Key Lupa Password</td>
      <td><input type="text" name="key_admin" value="<?php echo htmlentities($row_rs_profile['key_admin'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td valign="top" nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admin" value="<?php echo $row_rs_profile['id_admin']; ?>" />
</form>