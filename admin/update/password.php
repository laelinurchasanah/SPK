<?php  

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  if ($_POST['new'] != $_POST['konfirmasi']) {
	  pesan('danger','Oops! Password tidak sama!');
  }elseif (empty($_POST['new']) || empty($_POST['konfirmasi'])){
	  pesan('danger','Oops! Field tidak boleh kosong!');
  }else{
	  $updateSQL = sprintf("UPDATE tb_admin SET Password=PASSWORD(%s)  WHERE id_admin=%s",
						   GetSQLValueString($koneksi, $_POST['konfirmasi'], "text"),
						   GetSQLValueString($koneksi, $_POST['id_admin'], "int"));
						   
	  mysqli_select_db($koneksi, $database_koneksi);
	  $Result1 = mysqli_query($koneksi, $updateSQL) or die(mysqli_error($koneksi));
	  pesan('success','Sukses!  Data Berhasil disimpan!');
  }
}

mysqli_select_db($koneksi, $database_koneksi);
$query_rs_profile = "SELECT * FROM tb_admin WHERE id_admin = '".$ID."'";
$rs_profile = mysqli_query($koneksi, $query_rs_profile) or die(mysqli_error($koneksi));
$row_rs_profile = mysqli_fetch_assoc($rs_profile);
$totalRows_rs_profile = mysqli_num_rows($rs_profile);
?> 

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="366" height="125">
    <tr valign="baseline">
      <td nowrap="nowrap">New Password</td>
      <td><input type="password" name="new" value="" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">Konfirmasi Password</td>
      <td><input type="password" name="konfirmasi" value="" size="32" class="form-control input-sm" required/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap">&nbsp;</td>
      <td><input type="submit" value="Simpan Perubahan" class="btn btn-warning btn-block" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admin" value="<?php echo $row_rs_profile['id_admin']; ?>" />
</form> 